<?php
/**
* DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"
*/

require_once "utility.php";
require_once "constants.php";

// start logging session
$log = new Logger( PAYPAL_IPN_LOG, "ipnHandler.php", TRUE, "PayPal" );

if(array_key_exists("txn_id", $_POST))
{
	$guestName = "{$_POST["last_name"]}, {$_POST["first_name"]}";
	$log->setName( $guestName );
	$log->status("Received IPN,  TX ID : ".htmlspecialchars($_POST["txn_id"]));
}
else 
	$log->fatal("IPN Listner recieved an HTTP request without a Transaction ID.");

$tmpAr = array_merge($_POST, array("cmd" => "_notify-validate"));
$postFieldsAr = array();
foreach ($tmpAr as $name => $value) {
	$postFieldsAr[] = "$name=$value";
}
$log->status("Sending IPN values:\n".implode("\n", $postFieldsAr));

$ppResponseAr = Utils::PPHttpPost("https://www.paypal.com/cgi-bin/webscr", implode("&", $postFieldsAr), false);
if(!$ppResponseAr["status"]) 
{
	$logStr = "IPN Listner recieved an Error:\n";
	if(0 !== $ppResponseAr["error_no"])
		$logStr .= "Error ".$ppResponseAr["error_no"].": ";
	$logStr .= $ppResponseAr["error_msg"];
	$log->fatal("$logStr\n");
}

$log->status( "IPN Post Response: {$ppResponseAr["httpResponse"]}");

if (strcmp ($ppResponseAr["httpResponse"], "VERIFIED") == 0) 
{
	// Check the payment_status is Completed
	switch( $_POST['payment_status'] )
	{
		//case 'Denied':
		//	mail (
		//	break;
		case 'Completed':
		case 'Processed':
			$linkID = @mysql_connect( "localhost", "dimitria_web", "wedding" ) 
					  or die( "Error opening database: " . mysql_error() . ". please try again." );
			mysql_select_db("dimitria_wedding");
			
			// Secure table lock
			$log->status("Securing table lock: " . Utils::Spinlock( TABLE_LOCKS, -1, FALSE, TRUE, $guestName ) );
				
			// Check that txn_id has not been previously processed
			$result = mysql_query("SELECT txn_id FROM payments WHERE txn_id='{$_POST['txn_id']}'" );
			if ( mysql_fetch_array( $result ) != FALSE )
			{
				$log->error("txn_id {$_POST['txn_id']} already processed!");
				break;
			}
			
			// Check that receiver_email is your Primary PayPal email
			if ( $_POST['receiver_email'] != PRIMARY_BIZ_EMAIL )
			{
				$log->error( "Invalid receiver_email: {$_POST['receiver_email']} != " . PRIMARY_BIZ_EMAIL );
				break;
			}
			
			// pull guestID and resIDs from transaction
			$tmpAry = explode( ';', $_POST['custom'] );
			$guestID = $tmpAry[0];
			$resIDs = explode( ',', $tmpAry[1] );
			
			//== Update amt paid in rsvps =============
			$result = mysql_query( "SELECT total_paid, email, total_due, first_name FROM rsvps WHERE guest_id='$guestID'" );
			if ( $result == FALSE )
			{
				$log->error( "Error loading guest record:\n" . mysql_error());
				break;
			}
			$row = mysql_fetch_array( $result );
			$grossPmnt = array_key_exists('mc_gross_1', $_POST) ? $_POST['mc_gross_1'] : $_POST['mc_gross'];
			$row['total_paid'] += $grossPmnt;
			$guestEmail = $row['email'];
			$remainingBalance = $row['total_due'] - $row['total_paid'];
			$firstName = $row['first_name'];
			$result = mysql_query( "UPDATE rsvps SET total_paid='" . $row['total_paid'] . "' WHERE guest_id='$guestID'" );
			if ( $result == FALSE )
			{
				$log->error( "Error updating guest record:\n" . mysql_error());
				break;
			}
			else
				$log->status( "Updated guest record for guestID #$guestID: paid $grossPmnt for total of {$row['total_paid']}" );
			
			//== Create payments record with info =============
			$result = mysql_query("INSERT INTO payments ( guestID,
														  amt_paid,
														  txn_id,
														  status )
												  VALUE ( '$guestID',
														  '$grossPmnt',
														  '" . $_POST['txn_id'] . "',
														  'paid')" );
			if ( $result == FALSE )
			{
				$log->error( "Error inserting new payment record:\n" . mysql_error());
				break;
			}
			// Fetch last paymentID (this one)
			$result = mysql_query( "SELECT paymentID FROM payments ORDER BY paymentID DESC" );
			$row = mysql_fetch_row( $result );
			$newPmntID = $row[0];
			$log->status( "Inserted payment #$newPmntID for guest #$guestID: $grossPmnt, txn_id: {$_POST['txn_id']}");

			//== Update status to paid in room_res =============
			$mailMessage = "Hey $firstName!\n\nYour payment is received and reservation confirmed.  Thanks again for reserving a room at the Moon River Ranch with us!  This wedding is going to be a blast, especially for those staying the night!\n\n" . 
						   "Here are your reservation details:\n";
			foreach ( $resIDs as $resID )
			{
				$result = mysql_query( "SELECT room_type, num_1nts, num_2nts FROM room_res WHERE resID='$resID'" );
				if ( $result == FALSE )
				{
					$log->error( "Error reading room_res info: " . mysql_error());
					break;
				}
				if ( $resRoomInfo = mysql_fetch_array( $result ) )
				{
					$result = mysql_query( "UPDATE room_res SET paymentID='$newPmntID' WHERE resID='$resID'" );
					if ( $result == FALSE )
					{
						$log->error( "Error updating room_res record: " . mysql_error());
						break;
					}
					else
						$log->status( "Updated room_res record for resID #$resID: paymentID=$newPmntID");
					$mailMessage .="\tRoom type: " . $resRoomInfo['room_type'] . "\n" . 
								   ( $resRoomInfo['num_1nts'] > 0 ? "\t\tNumber of rooms for 1-night: " . $resRoomInfo['num_1nts'] . "\n" : "" ) . 
								   ( $resRoomInfo['num_2nts'] > 0 ? "\t\tNumber of rooms for 2-nights: " . $resRoomInfo['num_2nts'] . "\n" : "" );
				}
				else
				{
					$log->error( "Reservation was deleted: $resID" );
				}
			} //for-each resIDs
			
			// send email to guest
			$mailMessage .="\n\tAmount paid: \$$grossPmnt\n\n" . 
						   ( $remainingBalance > 0 ? "Since you opted to pay half now and half at the event, for one of your reservations, you still owe \$$remainingBalance when you arrive.  We will accept check or credit card there.\n\n" : "" ) . 
						   "Here is a copy of the Cancellation Policy:\n" . 
						   "=================================================\n".
						   CANCELLATION_POLICY . "\n" .
						   "=================================================\n\n".
						   "\nPlease feel free to contact Dimitri at Dimitri@DimitriAndAlice.com, any time, if you have any questions or concerns.  Otherwise, keep your eyes on your inbox for more news of the event as it gets closer!\n\n" .
						   "Thanks again!\n" . 
						   "- Dimitri's Robot (Automated Email)";
						   
			if ( !$log->hasErrored() ) 
			{
				mail( $guestEmail, "DimitriAndAlice Wedding Room Reservation!", $mailMessage, "From: Dimitri's Robot <dimitri@dimitriandalice.com>" );
				$log->status( "Email sent to $guestEmail:\n" . $mailMessage );
			}
			break;
		default:
			$log->error( "Invalid payment status: {$_POST['payment_status']}");
			break;
	}	
}
if ( $log->hasErrored() )
	mail( "boogydown@gmail.com", "Paypal error", "Please see log" );
	
$log->stop();
?>
