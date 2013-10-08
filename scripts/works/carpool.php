<?php
	require_once("utility.php");
	
	// start logging session
	$log = new Logger( OTHER_LOG, "carpool.php", TRUE, "--" );

	$payload = "";
	$statusMessage = '';
	
	// Open DB connection...
	$linkID = @mysql_connect( "localhost", WEDDING_DB_USER, WEDDING_DB_PASSWORD ) 
			  or die( "Error opening database: " . mysql_error() . ". please try again.  If the problem persists then please email <a href=\"mailto:dimitri@dimitriandalice.com\">dimitri@dimitriandalice.com</a>" );
	mysql_select_db("dimitria_wedding", $linkID );
	
	if ( $argc > 1 ) 
	{
		$guestName = "Command Line";
		$myID = -1;
		$status = $argv[1];
		$payload = $argv[2];
		if ( MODE_DEBUG )
		{
			echo ( "Script run with command line args:\n" );
			var_dump( $argv );
		}
		else 
			$statusMessage = "Command line: $status";
	}
	else
	{
		//$guestName = $_POST['name'];
		$myID = time();
		$status = $_POST[ 'status' ];
		$payload = $_POST[ 'payload' ];
		if ( MODE_DEBUG )
		{
			echo ( "Script run with POST:\n" );
			var_dump( $_POST );
		}
		else
			$statusMessage = "POST: $status";
	}
	
	$log->setName( $guestName );
	
	// this will capture latest buffer (var_dumps) and log them
	$log->debug("-----------------------------");
		
	If ( !MODE_DEBUG ) $log->status( $statusMessage );
	

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
	
		//============== Load Carpools ==============
		case 'loadCarpools':
			$toFrom = $payload;
			$result = mysql_query( "SELECT name, zipcode, time, remain, carpool_id FROM carpools WHERE to_from = '$toFrom'" );
			if ( $result == FALSE )
				$log->error( $statusMessage = 'DB Reading error from carpools: ' . mysql_error());
			else
			{
				// Populate room remains and prices for easy lookup later
				$payload = array( "$toFrom" );
				while ( $row = mysql_fetch_assoc( $result ) ) 
					$payload[ ] = $row;

				echo "carpoolData: ";
			}			
			break;
	
		//============== Add a Driver ==============
		case 'addDriver':
			parse_str( $payload, $payload );
			//if ( ($statusMessage = Utils::Spinlock( TABLE_LOCKS_CARPOOL, $myID, TRUE, TRUE, $payload['nameInput'], "carpool" )) != "" ) break;
			if ( FALSE == mysql_query( "INSERT INTO carpools( 	name, 
																zipcode, 
																time, 
																remain,
																phone,
																email,
																to_from ) 
													   VALUES ( '{$payload['nameInput']}',
																'{$payload['zipcodeInput']}',
																'{$payload['daySelect']}, {$payload['departTimeInput']}',
																'{$payload['numPeopleInput']}',
																'{$payload['phoneInput']}',
																'{$payload['emailInput']}',
																'{$payload['toFrom']}')" ) )
				$statusMessage .= "Error inserting carpool info: " . mysql_error();
			else
			{
				$log->status( "Carpool added: {$payload['nameInput']} | {$payload['zipcodeInput']} | {$payload['daySelect']}, {$payload['departTimeInput']} | {$payload['numPeopleInput']} | {$payload['phoneInput']} | {$payload['emailInput']}");
				$statusMessage .= "\nCarpool added. You are driving {$payload['toFrom']} the event on {$payload['daySelect']}, {$payload['departTimeInput']}.\n\nIf anything changes, just contact me: Dimitri@DimitriAndAlice.com";
			}
			//Utils::releaseLocks( "carpool" );
			break;
		//============== Add a Rider ==============
		case 'addRider':
			parse_str($payload, $payload);
			$carpoolID = $payload['carpoolID'];

			// lock tables  (add this to addDrivers, too)
			//if ( ($statusMessage = Utils::Spinlock( TABLE_LOCKS_CARPOOL, $myID, TRUE, TRUE, $payload['nameInput'], "carpool" )) != "" ) break;
			
			// check num avail riders
			$result = mysql_query( "SELECT remain, to_from, name, zipcode, time, remain, phone, email FROM carpools WHERE carpool_id='$carpoolID'" );
			$carpool = mysql_fetch_assoc( $result );
			$remain = $carpool['remain'];
			$toFrom = $carpool['to_from'];
			$name = $carpool['name'];
			$numPpl = $payload['numPeopleInput'];
			if ( $numPpl > $remain ) 
				$statusMessage = "Error: not enough empty seats!  Only $remain remain.";
			else
			{
				$remain -= $numPpl;
				if ( FALSE == mysql_query( "UPDATE carpools SET remain='$remain' WHERE carpool_id='$carpoolID'" ) )
					$statusMessage = "Error: problem updating carpool total.";
				else
				{
					if ( FALSE == mysql_query( "INSERT INTO riders( name, 
																	street,
																	zipcode, 
																	num, 
																	phone,
																	email,
																	carpool_id ) 
															   VALUES ( '{$payload['nameInput']}',
																		'{$payload['streetAddress']}',
																		'{$payload['zipcodeInput']}',
																		'{$payload['numPeopleInput']}',
																		'{$payload['phoneInput']}',
																		'{$payload['emailInput']}',
																		'$carpoolID')" ) )
					{
						$statusMessage .= "Error inserting rider reservation: " . mysql_error();
					}
					else
					{
						$log->status( "Rider added: {$payload['nameInput']} | {$payload['zipcodeInput']} | {$payload['streetAddress']} | {$payload['numPeopleInput']} | {$payload['phoneInput']} | {$payload['emailInput']}");
						$toFrom = strtoupper( $toFrom );
						$statusMessage .= "\nYou are riding with $name $toFrom the event.  Details will be emailed to {$payload['emailInput']}.\n\nIf anything changes, just contact me: Dimitri@DimitriAndAlice.com";
						
						// now we're going to get all of the other riders' info for this carpool and stick it in the email
						$emailMessage = <<<EOD
Carpool Update!

Carpool #$carpoolID (travelling $toFrom the event)

Driver info:
	Name - $name
	Zipcode - {$carpool['zipcode']}
	Phone# - {$carpool['phone']}
	E-mail - {$carpool['email']}
	Departure date and time - {$carpool['time']}
	Number of seats remaining - $remain

==============================================================
EOD;
						$result = mysql_query( "SELECT name, street, zipcode, num, phone, email FROM riders WHERE carpool_id='$carpoolID'" );
						$riderNum = 1;
						$numPssg = 0;
						$ccEmails = "";
						while ( $rider = mysql_fetch_assoc($result) )
						{
							$emailMessage .= <<< EOD

Rider #$riderNum
	Name - {$rider['name']}
	Number of passengers - {$rider['num']}
	Address - {$rider['street']}, {$rider['zipcode']}
	Phone# - {$rider['phone']}
	E-Mail - {$rider['email']}

EOD;
							$riderNum++;
							$numPssg += $rider['num'];
							$ccEmails .= ", " . $rider['email'];
						}

						$emailMessage .= <<< EOD
------------------------------------------------------------						
Total Passengers: $numPssg

DRIVER: You should check your email immediately before you leave in case any new riders were added at the last minute!  Also, please be on time and email/call your passengers before you leave.

Thank you so much for driving, and also for coming to the wedding and partying with as out at Moon River!

Drive safe!!
= Dimitri's Robot (automated email)
EOD;
						$ccEmails = substr( $ccEmails, 2 );
						mail( $carpool['email'], "DimitriAndAlice Wedding Carpool Signup", $emailMessage, "From: Dimitri's Robot <dimitri@dimitriandalice.com>\r\nCc: $ccEmails\r\nBcc: carpools@dimitriandalice.com" );						
					}
				}
			}
			//Utils::releaseLocks( "carpool" );
			break;
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
								$log->debug( "Updated room_type $roomType: new remain = " . ($remain-$numRooms));
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
										$log->debug( "Found rsvps for #$myID: num_rooms: {$row[0]}, total_due: {$row[1]}" );
										$numRooms = $row[0] + $numRooms; 
										$totalDue = $row[1] + $_POST['totalDue'];
										if ( FALSE == mysql_query( "UPDATE rsvps SET num_rooms='$numRooms', total_due='$totalDue' WHERE guest_id='$myID'"))
											$statusMessage .= "Error updating guest info for guest #" . $myID . ": " . mysql_error();
										else
											$log->debug( "Updated rsvps for #$myID: new num_rooms: $numRooms, new total_due: $totalDue");
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
				$log->debug( "Found ".count($payload)." reservations for guest #$myID with no pmnt" );
				$statusMessage = deleteReservations( "WHERE guestID = '$myID' AND paymentID='0'" );
			}
			else
				$log->debug( "Could not get table lock for $myID so skipping checking of previous reservations..." );
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
	

	if ( MODE_DEBUG )
	{
		echo "Payload:\n";
		var_dump( $payload );
	}
	$log->status( "Handler finished.  Status: $statusMessage" );

	// stop logging and output buffer capture
	$log->stop( TRUE );
	echo json_encode( array( 'status' => $statusMessage, 'payload' => $payload ) );
	
		
//}	
?>
