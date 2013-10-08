<?php
	require_once("constants.php");
	require_once("utility.php");
	
	// start logging session
	$log = new Logger( PAYPAL_IPN_LOG, "accommHandler.php", TRUE );
	
	// Open DB connection...
	$linkID = @mysql_connect( "localhost", "dimitria_web", "wedding" ) 
			  or die( "Error opening database: " . mysql_error() . ". please try again.  If the problem persists then please email <a href=\"mailto:dimitri@dimitriandalice.com\">dimitri@dimitriandalice.com</a>" );
	mysql_select_db("dimitria_wedding", $linkID );
	
	if ( $argc > 1 ) 
	{
		$guestName = "Command Line";
		$myID = -1;
		$status = $argv[1];
		echo ( "Script run with command line args:\n" );
		var_dump( $argv );
	}
	else
	{
		$guestName = $_POST['name'];
		$myID = $_POST[ 'guestID' ];
		$status = $_POST[ 'status' ];
		echo ( "Script run with POST:\n" );
		var_dump( $_POST );
	}
	
	$log->setName( $guestName );
	
	// this will capture latest buffer (var_dumps) and log them
	$log->status("-----------------------------");
	
	$payload = "";
	$statusMessage = '';

//{--------------------------------------------- Main Switch ---------------------------------------------
	/**
	 * Table locking and reservation process:
	 * if table is locked by another guest then tell the client and have it re-send the request later
	 * When table is unlocked:
	 * 	Pull room numbers from database (server)
	 * 	If still enough available to meet request, lock table (with timeout of 2 minutes) (server)
	 * 	Display confirmation alert window with all info and have ok/cancel (client)
	 * 	Post info to SQL and unlock (server)
	 * 	Reservation record will be marked as pending (server)
	 * Redirect to PayPal payment page, and have ipnHandler.php be the callback when payment is received (server)
	 */
	switch( $status )
	{
		//============== Check Availability ==============
		case 'checkAvail':
			if ( ($statusMessage = Utils::Spinlock( TABLE_LOCKS, $myID, TRUE, TRUE, $guestName )) == "" ) 
				if ( ( $statusMessage = validateAvail() ) != "" ) 
					// if invalid then release locks (they were locked with Spinlock
					$statusMessage = releaseLocks( );
			break;
				
		//============== Place a Reservation ==============
		case 'makeRes':
			if ( ($statusMessage = Utils::Spinlock( TABLE_LOCKS, $myID, FALSE, FALSE, $guestName )) == "" ) 
			{
				$result = mysql_query( "SELECT room_type, remain, price_1nt, price_2nt FROM room_types");
				if ( $result == FALSE )
					$log->error( $statusMessage = 'DB Reading error from room_types: ' . mysql_error());
				else
				{
					// Populate room remains and prices for easy lookup later
					$roomRemains = array();
					$prices = array();
					while ( $row = mysql_fetch_row( $result ) ) 
					{
						$roomRemains[ $row[0] ] = $row[1];
						$prices[ $row[0] ] = array( $row[2], $row[3] );
					}
					echo "prices: ";
					var_dump( $prices);
						
					// Place Reservations
					// ** One resID per roomType **
					foreach ( $_POST[ 'rooms' ] as $roomType => $roomNights )
					{
						$numRooms = 0;
						foreach ( $roomNights as $numNights => $roomRemain )
							$numRooms += $roomRemain;
						$remain = $roomRemains[ $roomType ];
						if ( $remain < $numRooms )
							$log->error($statusMessage .= "Cannot reserve " . $numRooms . " of room type " . $roomType . ", only " . $remain . " remain.  Please try again.");
						else
						{
							// update room data
							if ( FALSE == mysql_query( "UPDATE room_types SET remain='" . ($remain-$numRooms) . "' WHERE room_type='" . $roomType . "'" ) )
								$log->error($statusMessage .= 'Error updating room_types table: ' . mysql_error());
							else
							{
								$log->status( "Updated room_type $roomType: new remain = " . ($remain-$numRooms));
								// add room reservation
								$num1nt = array_key_exists( 'one night', $roomNights ) ? $roomNights[ 'one night' ] : 0;
								$num2nt = array_key_exists( 'two nights', $roomNights ) ? $roomNights[ 'two nights' ] : 0;
								$timeout = time() + RES_TIMEOUT;
								$res_price = $num1nt * $prices[$roomType][0] + $num2nt * $prices[$roomType][1];
								if ( FALSE == mysql_query( "INSERT INTO room_res ( 	guestID, 
																					room_type, 
																					num_1nts, 
																					num_2nts,
																					timeout,
																					paymentID,
																					res_price) 
																		   VALUES ( '$myID',
																					'$roomType',
																					'$num1nt',
																					'$num2nt',
																					'$timeout',
																					'0',
																					'$res_price')" ) )
									$statusMessage .= "Error inserting room reservation for " . $roomType . ": " . mysql_error();
								else
								{
									$log->status( "room_res added: $myID, $roomType, $num1nt, $num2nt, $timeout, 0, $res_price");
									// update guest info
									$result = mysql_query( "SELECT num_rooms, total_due FROM rsvps WHERE guest_id='$myID'" );
									if ( $result == FALSE )
										$statusMessage .= 'DB Reading error from rsvps: ' . mysql_error();
									else
									{
										$row = mysql_fetch_row( $result );
										$log->status( "Found rsvps for #$myID: num_rooms: {$row[0]}, total_due: {$row[1]}" );
										$numRooms = $row[0] + $numRooms; 
										$totalDue = $row[1] + $_POST['totalDue'];
										if ( FALSE == mysql_query( "UPDATE rsvps SET num_rooms='$numRooms', total_due='$totalDue' WHERE guest_id='$myID'"))
											$statusMessage .= "Error updating guest info for guest #" . $myID . ": " . mysql_error();
										else
											$log->status( "Updated rsvps for #$myID: new num_rooms: $numRooms, new total_due: $totalDue");
									} //update guest info
								} //insert room_res
							} //update room_type
						} //enough rooms
					} //foreach roomType
					
					//now find all new (pmnt = 0) resIDs and return them in the payload
					$result = mysql_query( "SELECT resID FROM room_res WHERE guestID = '$myID' AND paymentID = '0'");
					$payload = array();
					while ( $row = mysql_fetch_row( $result ) ) 
						$payload[] = $row[ 0 ];
					
				} //read room_types
				$statusMessage .= releaseLocks();
			} //if have lock
			break;
		
		//============== Update Payment info ==============
		case 'checkForRes':
			// make sure we can gain access to the table...
			if ( ($statusMessage = Utils::Spinlock( TABLE_LOCKS, $myID, FALSE, FALSE, $guestName )) == "" )
			{
				//now find all new resIDs and return them in the payload
				$result = mysql_query( "SELECT room_type, num_1nts, num_2nts FROM room_res WHERE guestID = '$myID' AND paymentID='0'" );
				$payload = array();
				while ( $row = mysql_fetch_row( $result ) ) 
					$payload[] = array( 'room_type' => $row[0], 'num_1nts' => $row[1], 'num_2nts' => $row[2] );
				$log->status( "Found ".count($payload)." reservations for guest #$myID with no pmnt" );
				$statusMessage = deleteReservations( "WHERE guestID = '$myID' AND paymentID='0'" );
			}
			else
				$log->status( "Could not get table lock for $myID so skipping checking of previous reservations..." );
			break;
			
		//============== Get Room remain #'s ==============
		case 'getRoomRemains':
			if ( ( $statusMessage = Utils::Spinlock( TABLE_LOCKS, $myID, FALSE, FALSE, $guestName ) ) == "" )
			{
				$result = mysql_query( "SELECT room_type, remain FROM room_types" );
				if ( $result == FALSE )
				{
					$statusMessage = "Error reading from room_types: " . mysql_error();
					break;
				}
				$payload = array();
				while ( $row = mysql_fetch_row( $result ) ) 
					$payload[] = array( 'room_type' => $row[0], 'remain' => $row[1] );
			}
			break;
			
		//============== Close Lock ==============
		case 'cancel':
			// if we have the lock then release them
			if ( ($statusMessage = Utils::Spinlock( TABLE_LOCKS, $myID, FALSE, FALSE, $guestName )) == "" )
				$statusMessage = releaseLocks( );
			break;

		//============== Clean Reservations ==============
		case 'cleanRes':
			// Secure a lock (spin if needed until locked) and delete any reservations that have not associated payment and are lapsed
			if ( ($statusMessage = Utils::Spinlock( TABLE_LOCKS, $myID, FALSE, TRUE, $guestName )) == "" )
			{
				$statusMessage = deleteReservations( "WHERE paymentID='0' AND timeout<'" . time() . "'" );
			}
			break;
	}

	echo "Payload:\n";
	var_dump( $payload );
	$log->status( "Handler finished.  Status: $statusMessage" );

	// stop logging and output buffer capture
	$log->stop( TRUE );
	echo json_encode( array( 'status' => $statusMessage, 'payload' => $payload ) );
//}	
//{--------------------------------------------- Helper Functions ---------------------------------------------
	function validateAvail( )
	{
		$myResponse = "";
		$roomRemains = array();
		
		// Retrieve current room availability
		$result = mysql_query( "SELECT room_type, remain FROM room_types");
		if ( $result == FALSE )
			$myResponse = 'DB Reading error: ' . mysql_error();
		else
		{
			while ( $row = mysql_fetch_row( $result ) ) 
				$roomRemains[ $row[0] ] = $row[1];
				
			// Validate against request
			$valid = TRUE;
			foreach ( $_POST[ 'rooms' ] as $roomType => $roomNights )
			{
				$numRooms = 0;
				foreach ( $roomNights as $numNights => $roomRemain )
					$numRooms += $roomRemain;
				if ( $roomRemains[ $roomType ] < $numRooms )
					$myResponse .= "Not enough " . roomType . " rooms available. ";
			}
		}
		return $myResponse;
	}
	
	function releaseLocks( )
	{
		$result = mysql_query( "UPDATE session SET locked='-1'" );
		if ( $result == FALSE )
			return 'Error clearing lock: ' . mysql_error();
		$result = mysql_query( "UNLOCK TABLES");
		return '';
	}
	
	/**
	 * Deleted a reservation, adding the quantities back to the room counts
	 * @param	whereClause - a matching condition.  Must include the word "WHERE" at the beginning
	 */
	function deleteReservations( $whereClause )
	{
		global $log;
		// get room counts and price from reservation(s)
		$result = mysql_query( "SELECT room_type, num_1nts, num_2nts, res_price, guestID, resID  FROM room_res $whereClause" );
		if ( $result == FALSE )
			return 'Error selecting room_res: ' . mysql_error();
		$roomTotals = array();
		$guestReimbursements = array();
		$guestRoomTotals = array();
		$resIDs = "";
		while ( $row = mysql_fetch_row( $result ) )
		{
			$guestRoomTotals[ $row[4] ] = $roomTotals[ $row[0] ] = $row[1] + $row[2];
			$guestReimbursements[ $row[4] ] = $row[3];
			$resIDs .= $row[5] . " ";
		}
		if ( count($roomTotals) == 0 ) 
		{
			$log->status( "No reservations to delete." );
			return "";
		}
		$log->status( "Deleting reservations: $whereClause. Found resIDs: $resIDs." );
	
		// add room counts back to room totals
		foreach ( $roomTotals as $roomType => $roomCount )
		{
			$result = mysql_query( "SELECT remain FROM room_types WHERE room_type='$roomType'");
			if ( $result == FALSE )
				return 'Error selecting room_type: ' . mysql_error();
			$row = mysql_fetch_row( $result );
			$newRoomCount = $roomCount + $row[0];
			$result = mysql_query( "UPDATE room_types SET remain='$newRoomCount' WHERE room_type='$roomType'" );
			if ( $result == FALSE )
				return 'Error updating room_types: ' . mysql_error();
			$log->status( "Updated $roomType remain from {$row[0]} to $newRoomCount" );
		}			
		
		// deduct res price from total due from the guest's rsvp profile
		foreach ( $guestReimbursements as $curGuestID => $guestResDue )
		{
			$result = mysql_query( "SELECT total_due, num_rooms FROM rsvps WHERE guest_id='$curGuestID'" );
			if ( $result == FALSE )
				return 'Error selecting total_due: ' . mysql_error();
			$row = mysql_fetch_row( $result );
			$newTotalDue = $row[0] - $guestResDue;
			$newNumRooms = $row[1] - $guestRoomTotals[ $curGuestID ];
			$result = mysql_query( "UPDATE rsvps SET total_due='$newTotalDue', num_rooms='$newNumRooms' WHERE guest_id='$curGuestID'" );
			if ( $result == FALSE )
				return 'Error updating rsvps: ' . mysql_error();
			$log->status( "Updated guest #$curGuestID total_due from \${$row[0]} to \$$newTotalDue, num_rooms from {$row[1]} to $newNumRooms" );
		}
		
		// delete reservation(s)
		if ( FALSE == mysql_query( "DELETE FROM room_res $whereClause" ) )
			return "Could not delete reservations: " . mysql_error();	

		return "";
	}
//}
?>