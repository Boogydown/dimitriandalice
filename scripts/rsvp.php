<html>
	<head>
		<title>
			RSVP Received!
		</title>
	</head>
	<body>
		Thank you for responding!<br/>
		<?php
			require_once( "utility.php" );
			require_once( "constants.php" );
			$log = new Logger( PAYPAL_IPN_LOG, "rsvp.php", FALSE );

			if ( count($_POST) < 9 )
			{
				print "Nothing to do.  Received:<br/>";
				var_dump( $_POST );
				return;
			}
			$guestName = "{$_POST['last_name']}, {$_POST['first_name']}";
			$log->setName( $guestName );
			
			// Connect to mySQL and navigate to 
			$linkID = @mysql_connect( "localhost", "dimitria_web", "wedding" ) 
					  or die( "Error opening database: " . mysql_error() . ". please try again." );
			mysql_select_db("dimitria_wedding", $linkID );
			
			Utils::Spinlock( "rsvps WRITE", -1, FALSE, TRUE, $guestName );
			
			// Transpose _POST array into an object so we can easily ref it in the query
			$message = addslashes( $_POST['message'] );
			$result = mysql_query( "INSERT INTO rsvps (first_name, 
													   last_name, 
													   attendance, 
													   email, 
													   phone, 
													   address_street, 
													   address_statezip, 
													   num_adults, 
													   num_children, 
													   message) 
								    VALUES ( '" . $_POST['first_name'] . "',
											 '" . $_POST['last_name'] . "',
											 '" . $_POST['attendance'] . "',
											 '" . $_POST['email'] . "',
											 '" . $_POST['phone'] . "',
											 '" . $_POST['address_street'] . "',
											 '" . $_POST['address_statezip'] . "',
											 '" . $_POST['num_adults'] . "',
											 '" . $_POST['num_children'] . "',
											 '$message')", $linkID );
											 
			// Query successful?
			if ( $result == TRUE )
			{
				$result = mysql_query( "SELECT guest_id FROM rsvps WHERE first_name = '" . $_POST['first_name'] . "' AND last_name = '" . $_POST['last_name'] . "'" );
				// will find the lastmost guest added with this name to get the guestID
				while ( $row = mysql_fetch_row( $result ) ) 
					$guest_id = $row[ 0 ];

				print "RSVP #$guest_id successfully added!<br/><br/>";
				$log->status( "RSVP added: $guest_id, $guestName, {$_POST['email']}, attending: {$_POST['attendance']}-{$_POST['num_adults']}-{$_POST['num_children']}, {$_POST['phone']}, {$_POST['address_street']}, {$_POST['address_statezip']}");
				if ( $_POST['attendance'] == "yes" )
				{
					print "Glad you can make it!<br/><br/>
						   Please consider reserving a room on the <a href=\"../Accommodations.php\">Accommodations</a> page<br/>
						   and signing up for activities on the <a href=\"../Schedule--and--Activities.php\">Schedule & Activities</a> page!<br/><br/>";
				}
				else
					print "Sorry you can't make it!<br/><br/>
						   Please keep in touch!<br/><br/>";
			}
			else
				print $log->error( "Error adding RSVP! Code:" . mysql_error() . " Please try again.  If this persists then please email <a href=\"mailto:dimitri@dimitriandalice.com\">dimitri@dimitriandalice.com</a>");
			
			mysql_close( $linkID );
		?>
		<br/>
		If there are any problems please contact <a href="mailto:dimitri@dimitriandalice.com">Dimitri@DimitriandAlice.com</a>.
	</body>
</html>