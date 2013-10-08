<html>
<head>
</head>
<style>
	table.myResTable { width: 650px; padding: 0px; border: 1px solid #789DB3; }
	table.myResTable td { border: none; background-color: #F4F4F4; vertical-align: middle; text-align: center; padding: 3px; }
	table.myResTable th { width:120px; border-bottom: 1px solid #000000; }
	table.myResTable tr.topRow td { border-bottom: 1px solid #000000;  }
	table.myResTable td.description { width:300px; text-align:left; border-bottom:0px ; border-left: 1px solid #000000; }
</style>
<body>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js" type="text/javascript"></script>	
	<script>
		// Useful get-var parser by Josh Fraser
		function $_GET(q,s) 
		{
			s = (s) ? s : window.location.search;
			var re = new RegExp('&'+q+'=([^&]*)','i');
			return (s=s.replace(/^\?/,'&').match(re)) ? s=s[1] : s='';
		}
		
		$(document).ready(function()
		{
			// Hide the template table
			$("#hideableSection").hide();
			$("#dueNowP").hide();
			if ( $_GET( 'status' ) != "" )
				switch ( $_GET( 'status' ) )
				{
					case "reserved":
						$("#resForm").hide();
						$("#orderConfirmation").html( "<h3>Thank you for placing a reservation!</h3>" +
													  "Your payment of $" + $_GET( 'message' ) + " is processing.<br/>" +
													  "You will get a confirmation email shortly!<br/><br/>" +
													  "We're excited to have you out there with us!<br/>" );
						break;
					case "canceled":
						$("#orderConfirmation").html( "<h3>Order was canceled.</h3>" );
						cancelOrder( $_GET( 'resID' ) );
						break;
				}						
			
			// set some global AJAX defaults
			$.ajaxSetup(
			{
				cache: false,
				type: "POST",
				dataType: "json",
				error: onAjaxError,
				traditional: false,
				url: "http://dimitriandalice.com/scripts/accommHandler.php"
			});

			// zero all values
			$(":text").val("");
		});
	</script>
	<noscript>
		This page uses Javascript.<br/>
		Your browser either does not support Javascript, or you have it turned off.<br/>
		You will need Javascript to access the room reservation system.<br/>
	</noscript>
<hr style="width: 50%" align="left"/>
<a name="reservationTop"><h1>Reservations</h1></a>
<div id="orderConfirmation"></div>
<form id="resForm" onsubmit="return submitForm()" method="post">
<div>To begin, please select your name from the list.</div>
<div>If your name is not in this list then <u><a href="http://dimitriandalice.com/RSVP.php" title="">RSVP here</a></u>, first.</div><br />
	<select id="nameSelect" name="guest_name" onchange="guestSelected( this.options[ this.selectedIndex ].value )">
		<?php
			require_once("/home/dimitria/public_html/scripts/utility.php");
			// Connect to mySQL and navigate to my wedding database
			$linkID = @mysql_connect( "localhost", "dimitria_web", "wedding" ) 
					  or die( "Error opening database: " . mysql_error() . ". please try again.  If the problem persists then please email <a href=\"mailto:dimitri@dimitriandalice.com\">dimitri@dimitriandalice.com</a>" );
			mysql_select_db("dimitria_wedding");
			print Utils::PopulateGuestList();
		?>
	</select><br/>
	<br/>
	<div id="hideableSection">
	<div id="roomTables">
	<div class="tableTemplate">
	<table id="roomTable" class="myResTable">
		<tr class="topRow"><th id="roomType"/><td id="sleeps"/><td><span id="remain"></span><span id="remainText"> remaining</span></td><td rowspan="3" class="description"/></tr>
		<tr><td>qty: <input id="qty1" type="text" size="2" maxlength="2" defaultValue=""/></td><td>1 night</td><td>$<span id="price1nt"></span> ea.</td></tr>
		<tr><td>qty: <input id="qty2" type="text" size="2" maxlength="2" defaultValue=""/></td><td>2 nights</td><td>$<span id="price2nt"></span> ea.</td></tr>
	</table><br/>
	</div>
	</div>
	<b>Payment options:</b><br/>
	<input type="radio" name="amtToPay" value="full" onClick="updateTotal( null )" checked="true"/>Full amount now<br/>
	<input type="radio" id="payHalf" name="amtToPay" value="half" onClick="updateTotal( null )" />Half now, half at event<br/>
	</div>
	<div  id="totalDueDiv">
	<p><b>Total due: $<span id="totalDue"></span></b></p>
	<p id="dueNowP"><i>Due Now: $<span id="dueNow"></span></i><br/></p>
	</div>
	<input type="reset" name="reset" value="Start Over" onClick="resetForm()"/>
	<input type="submit" name="submit" value="Make Reservation"/>
</form>
<br/>
<hr style="width: 50%" align="left"/>
<script type="text/javascript">
	// TODO: add roomdata reload on form reset
	// TODO: set up auto-email reminders for event and Payment Due
	// TODO: add cronJob to clean out timed-out reservations
	// TODO: create logger php class
	// TODO: secure paypal log
	
	// FIXME: umm... multiple resIDs!?  one per room!
	// FIXME: if AccommPage reloads and there's a 'waiting' reservation for your guestID then re-populate
	// TODO: add table lock on ipnHandler.php
	// TODO: insert into webpage, make fit and look pretty
	
	// Room data, loaded server-side from the wedding database
	var roomData = 
	{
		<?php
			// Populate Javascript array with room type data
			$result = mysql_query( "SELECT room_type, price_1nt, price_2nt, remain, sleeps_ea, description FROM room_types ORDER BY price_1nt DESC" );
			$first = TRUE;
			while ( $row = mysql_fetch_row( $result ) ) 
			{
				if ( $first )
					$first = FALSE;
				else
					print ",";
				
				print "\t\"$row[0]\": { price1nt:$row[1], price2nt:$row[2], remain:$row[3], sleeps:$row[4], description:\"" . addslashes( $row[5] ) . "\" }\n\t";
			}
		?> 
	};
	
	var tablesCreated = false;
	var busyIndic = { id: 0, status: "" };
	
	/***************************************************
	 * Class for holding reservation data.  Can instantiate and null easily
	 */
	function ReservationData ( newName, newGuestID ) 
	{ 
		this.name = newName;
		this.guestID = newGuestID;
		this.resIDs = [];
		this.totalDue = 0;
		this.dueNow = 0;
		this.rooms = {};
	};
	ReservationData.prototype.serializeRooms = function ()
	{
		var outStr = "";
		for ( var roomType in this.rooms )
		{
			outStr += roomType + " (";
			for ( var nights in this.rooms[ roomType ] )
				outStr += this.rooms[ roomType ][ nights ] + " x " + nights + ", ";
			outStr = outStr.substr(0, outStr.length - 2 );
			outStr += "), ";
		}
		return outStr.substr(0, outStr.length - 2 );
	};
	ReservationData.prototype.toString = function ()
	{
		var outStr = "Name: " + this.name + "\n" +
					 "GuestID: " + this.guestID + "\n\n" + 
					 "Room reservations:\n";
		for ( var roomType in this.rooms )
		{
			outStr += "\t" + roomType + "\n";
			for ( var nights in this.rooms[ roomType ] )
				outStr += "\t\tNum. rooms for " + nights + ": " + this.rooms[ roomType ][ nights ] + "\n";
			outStr += "\n";
		}
		
		outStr += "TOTAL DUE: $" + this.totalDue + "\n";
		if ( Number(this.dueNow) < Number(this.totalDue) ) 
		{
			outStr += "Due now: $" + this.dueNow + "\n";
			outStr += "Due at event: $" + this.dueNow + "\n";
		}
		return outStr;
	};
	ReservationData.prototype.toJSON = function ( status )
	{
		return { status: status,
				 name: this.name,
				 guestID: this.guestID,
				 totalDue: this.totalDue,
				 rooms: this.rooms };
	};
	
	// Global instance var for the current ReservationData
	var currentResData = {};
	
	/***************************************************
	 * Static struct for handling busy indicator
	 */
	var busyIndic = 
	{
		id: -1,
		status: "",
		start: function ()
		{
			$("#totalDueDiv").after( "<div id=\"busyIndic\"><i>Please Wait... Working.....</i><br/><span id=\"busyStatus\"></span></div>" );
			$("#busyIndic").css({width:'200px', 'background-color':'#bca'});
			this.id = window.setInterval( this.update, 1400 );
		},
		stop: function ()
		{
			if ( this.id != -1 )
			{
				window.clearInterval( this.id );
				$("#busyStatus").text( "" );
				$("#busyIndic").detach();
			}
		},
		update: function ()
		{
			// TODO: iterate the animation of some fancy busy indicator		
			$("#busyIndic").css({width:'300px', 'background-color':'#bca'});
			$("#busyStatus").text( busyIndic.status );
			$("#busyIndic").animate( {width:"600px"}, 500, 'swing', this.update2);
		},
		update2: function ()
		{
			$("#busyIndic").css({width:'600px'});
			$("#busyStatus").text( busyIndic.status );
			$("#busyIndic").animate( {width:"300px"}, 500 );
		}
	}
		
	
	/***************************************************
	 * Handles guest selection and creates tables
	 */
	function guestSelected( guestID )
	{
		currentResData = new ReservationData( $("#nameSelect [value='" + guestID + "']").text(), guestID );
		// if guestID == -1 then send to RSVP page
		if ( guestID == -1 ) 
			window.location = "http://dimitriandalice.com/RSVP.php";

		// Otherwise, erase and redraw table
		else 
		{
			// Erase tables
			$("#hideableSection").hide("normal");
			
			// Redraw if guest selected
			if ( guestID != " " )
			{
				if ( ! tablesCreated )
				{
					var firstPass = true;
					var counter = 0;
					for ( var roomType in roomData )
					{
						// clone table template for each row after first
						if ( firstPass ) 
							firstPass = false;
						else
							// appends clone of bottom table to bottom
							$(".tableTemplate:last").clone().appendTo("#roomTables");
						
						// fill in values
						var curRoomData = roomData[ roomType ];
						var curTable = $(".myResTable:last");
						curTable.attr( "roomType", roomType );
						$("#roomType", curTable).text( roomType );
						$("#sleeps", curTable).text( "sleeps " + curRoomData.sleeps );
						
						// Fill prices
						var q1 = $("#qty1", curTable);
						q1.change( updateTotal );
						q1.attr( "name", "1nt" + roomType );
						$("#price1nt", curTable).text( curRoomData.price1nt );
						var q2 = $("#qty2", curTable)
						q2.change( updateTotal );
						q2.attr( "name", "2nt" + roomType );
						$("#price2nt", curTable).text( curRoomData.price2nt );

						// Fill Remaining and mark sold-out room types
						var n = $("#remain", curTable);
						n.text( curRoomData.remain );
						n.attr( "name", roomType + "remain" );
						if ( curRoomData.remain == 0 )
						{
							n.hide();
							q1.hide();
							q2.hide();
							n = $("#remainText", curTable);
							n.text( "Sold Out");
							n.css( "color", "red" );
						}
						else
						{
							n.show();
							q1.show();
							q2.show();
							n = $("#remainText", curTable);
							n.text( " remaining");
							n.css( "color", "black" );
						}
						
						$(".description", curTable).text( curRoomData.description );
					}
					tablesCreated = true;
				}
				// clear entires
				$(":text").val("");
				// show all after creation
				$("#hideableSection").show("normal");
				// load any previous, pending reservations
				spinLockPost( { status:"checkForRes", guestID:guestID}, pendingRes );
			} //guest!=" "
			else
				resetForm();
		}
	}

	/***************************************************
	 * Updates amount due and #-remaining for all room types
	 */
	function updateTotal( e )
	{
		// validate entry...
		if ( e )
			if ( isNaN(e.target.value) )
			{
				window.alert( "Must enter a number!" );
				e.target.value = "";
			}
			else
			{
				var roomType = e.target.name.slice( 3 );
				var remain = roomData[ roomType ].remain 
							 - $("[name='1nt" + roomType + "']" ).val() 
							 - $("[name='2nt" + roomType + "']" ).val();
				if ( remain < 0 )
				{
					window.alert( "Not enough available!  Only " + ( remain + Number( e.target.value ) ) + " remaining!" );
					e.target.value = "";
				}
			}
		
		// update totals...
		$("#totalDue").text(0);
		var allRoomTables = $(".myResTable");
		if ( allRoomTables.length > 1 )
			allRoomTables.each( function()
			{
				var roomType = $("#roomType", this).text();
				var q1 = Number( $("#qty1", this).val() );
				var q2 = Number( $("#qty2", this).val() );
				$("#remain", this).text( roomData[ roomType ].remain - q1 - q2 );
				if ( q1 + q2 > 0 ) currentResData.rooms[ roomType ] = {};
				if ( q1 > 0 ) currentResData.rooms[ roomType ]["one night"] = q1;
				if ( q2 > 0 ) currentResData.rooms[ roomType ]["two nights"] = q2;
				var totalDue = $("#totalDue");
				totalDue.text( Number(totalDue.text()) + Number($("#price1nt", this).text()) * q1
													   + Number($("#price2nt", this).text()) * q2 );
			});
		
		// process payment type and pad total with zeros
		if ( $("#totalDue").text() > 0 )
		{
			$("#totalDueDiv").css( "background-color", "#ffff88" );
			var tdStr = currentResData.totalDue = currentResData.dueNow = Number($("#totalDue").text()).toFixed(2);
			$("#totalDue").text( tdStr );
			if ( $("#payHalf").attr("checked") )
			{
				currentResData.dueNow = (tdStr /= 2).toFixed(2);
				$("#dueNowP").show("normal");
				$("#dueNow").text( currentResData.dueNow );
			}
			else
				$("#dueNowP").hide("normal");
			
		}
		else
		{
			$("#totalDueDiv").css( "background-color", "" );
			$("#dueNowP").hide("normal");
		}
	}
	
	/***************************************************
	 * Resets all values and hides table
	 */
	function resetForm()
	{
		busyIndic.stop();
		$(":text").val("");
		spinLockPost( { status:"getRoomRemains" }, reloadRemains );
		updateTotal( );		
		//guestSelected( " " );
		$("#hideableSection").hide("normal");
	}	

	/***************************************************
	 * Uses AJAX techniques for passing reservation info back to server
	 */
	function submitForm()
	{
		if ( $("#totalDue").text() == 0 )
		{
			window.alert( "No rooms selected!" );
			return false;
		}
		
		// start timer that calls updateBusyIndicator() every 500 ms
		busyIndic.start();
		
		// assemble all roomtype/qty pairs (qty is total of both 1 and 2 night)
		spinLockPost( currentResData.toJSON( "checkAvail" ), resCheck );
		return false;
	}
	
	/***************************************************
	 * Handles spin-locking of a table within an AJAX call
	 * If tables needed are locked by another guest then set timer to poll, waiting for unlock
	 */
	var spinLockArgs = null;
	function spinLockPost( data, callback, xhr )
	{
		//debugger;
		// if global is null then this is original call
		if ( spinLockArgs == null )
		{
			spinLockArgs = { data:data, success:callback };
			$.ajax( { data:data, success:spinLockPost } );
		}
		
		// otherwise this is an ajax callback, and data = data, callback = returnText, xhr = XMLHttpRequest
		else
		{
			// if locked, spin on itself every 5 seconds
			if ( data.status.substr( 0, 4 ) == "Lock" )
			{
				if ( dara.status.substr( 0, 9 ) == "Locked by" )
					busyIndic.status = "\n" + dara.status + ". Please wait...";
				window.setTimeout( function(){$.ajax( { dara: spinLockArgs.data, success: spinLockPost } );}, 5000 );
				return;
			}
			
			// otherwise, pass data along to original callback
			else
			{
				var origCallback = spinLockArgs.success;
				spinLockArgs = null;
				origCallback( data, callback, xhr );
			}
		}	
	}

//{--------------------------------------------- AJAX Callbacks ---------------------------------------------
	/***************************************************
	 * AJAX Callback for checking a reservation
	 */
	function pendingRes( data )
	{
		// if data contains an array of resIDs then populate table with those reservations
		if ( data.payload instanceof Array && data.payload.length > 0 )
		{
			for ( var i in data.payload )
			{
				var roomObj = data.payload[i];
				var myTable = $("[roomType=" + roomObj.room_type + "]");
				if ( roomObj.num_1nts > 0 ) $("#qty1", myTable).val( roomObj.num_1nts );
				if ( roomObj.num_2nts > 0 ) $("#qty2", myTable).val( roomObj.num_2nts );
			}
			spinLockPost( { status:"getRoomRemains" }, reloadRemains );
		}
	}

	/***************************************************
	 * AJAX Callback for reloading room remain #s
	 */
	function reloadRemains ( data )
	{
		if ( data.payload instanceof Array && data.payload.length > 0 )
			for ( var i in data.payload )
			{
				var roomObj = data.payload[i];
				$('[roomType="' + roomObj.room_type + '"] #remain').text( roomData[ roomObj.room_type ].remain = roomObj.remain );
		updateTotal();
			}
	}
	
	/***************************************************
	 * AJAX Callback for checking a reservation
	 */
	function resCheck( data )
	{
		// Room quantities invalid?
		if ( data.status != "" )
		{
			window.alert( "One or more of your room requests did not go through.\n" +
						  "Reason:\n" +
						  data.status );
			resetForm();
			return;
		}
		
		// Otherwise, we can assume all requested rooms were available and the server handler placed a lock on them
		busyIndic.stop();
		if ( window.confirm( "CONFIRMATION OF ORDER\n\n" +
							 "Please verify the information below:\n\n" +
							 currentResData.toString() + "\n\n" +
							 "(Press OK to enter payment info)" ) )
		{
			busyIndic.start();
			spinLockPost( currentResData.toJSON( "makeRes" ), resConfirmedNowPay );
		}
		else
			// release all locks
			$.ajax( { data: currentResData.toJSON( "cancel" ) } );
	}
	
	/***************************************************
	 * AJAX for placing a reservation
	 */
	function resConfirmedNowPay( data )
	{
		// Error placing reservation?
		if ( data.status != "" || data.payload == "" )
		{
			window.alert( "Error placing reservation!\n" +
						  "Reason:\n" +
						  data.status );
			window.location.reload();
		}
		
		currentResData.resIDs = data.payload;
		
		//window.alert( "Reservation Made!" );
		
		// Send to PayPal....
		var ppSubmission = 
		{
			cmd: "_xclick",
			//business: "dimitri@dimitriandalice.com",
			business: "seller_1292859600_biz@gmail.com", //sandbox
			no_shipping: 1,
			notify_url: "http://dimitriandalice.com/scripts/ipnHandler.php",
			custom: currentResData.guestID + ";" + currentResData.resIDs.join(','),
			item_name: currentResData.serializeRooms(),
			'return': "http://dimitriandalice.com/Accommodations.php?status=reserved&message=" + currentResData.dueNow + "#reservationTop",
			cancel_return: "http://dimitriandalice.com/Accommodations.php?status=canceled&resID=" + currentResData.resIDs.join(',') + "#reservationTop",
			cbt: "Return to DimitriAndAlice.com",
			amount: currentResData.dueNow,
			cpp_header_image: "http://dimitriandalice.com/documents/Header.JPG"
		};
		window.location.assign( "https://www.sandbox.paypal.com/cgi-bin/webscr?" + $.param( ppSubmission, true ) );
	}
	
	/***************************************************
	 * AJAX Callback for checking a reservation
	 */
	function cancelOrder( resID )
	{
		// TODO: mark reservation as canceled (active = 0) and add remaining values back to rooms
	}

	/***************************************************
	 * AJAX Global callback for all errors
	 */
	function onAjaxError( xhr, ts, et )
	{
		debugger;
		window.alert( "Server-side error: \n" +
					   xhr.responseText + "\n" +
					   ts + "\n" +
					   et );
	}
//}--------------------------------------------- ================ ---------------------------------------------	
</script>
</body>
</html>
