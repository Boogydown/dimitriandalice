<head>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js" type="text/javascript"></script>
</head>
<body>
<form id="activitiesSignup">
	If you would like to participate in one or more of the following activities then please sign yourself up below.
	You can sign up for as many as you wish.  Your own personal schedule of which time slots you were given will be handed to you once you get to the event.<br/>
	<br/>
	<div>To begin, please select your name from the list.</div>
	<div>If your name is not in this list then <u><a href="http://dimitriandalice.com/RSVP.php" title="">RSVP here</a></u>, first.</div><br />
	<select id="nameSelect" name="guest_name" onchange="toggleSignups(true)">
		<?php
			require_once("/home/dimitria/public_html/scripts/utility.php");
			require_once("/home/dimitria/public_html/scripts/constants.php");
			// Connect to mySQL and navigate to my wedding database
			$linkID = @mysql_connect( "localhost", WEDDING_DB_USER, WEDDING_DB_PASSWORD ) 
					  or die( "Error opening database: " . mysql_error() . ". please try again.  If the problem persists then please email <a href=\"mailto:dimitri@dimitriandalice.com\">dimitri@dimitriandalice.com</a>" );
			mysql_select_db("dimitria_wedding");
			print Utils::PopulateGuestList();
		?>
	</select><br/>	
	<div id="signupArea">
		<h4>Kayak/canoe</h4>
		Moon River is nestled in a horseshoe of the Brazos River.  The river is calm but beautiful.  Canoeing down the Brazos you'll see some sandy beaches, tall trees, neat wildlife, and other quirks of one of the US's only salt-water rivers.<br/>
		The trip covers about 3 miles and takes about 1.5 hours.  There are enough canoes and kayaks to cover about 15 people, and we'll do 3 trips.<br/>
		<li>Number of slots remaining: <b><span id="canoeRemain"></span></b>.</li>
		<div class="qtyDiv">
			<li>Sign me up for <input name="qtyCanoe" type="text" maxlength="3" size="5"/> people.<br/></li>
		</div>
		<div class="qtyAlt">
			<li>Please select your name from the drop down, above, to sign up.</li>
		</div>
		<hr/>
		<h4>Horseback Riding</h4>
		For a more land-based tour of Moon River, Gloria and her team of horses will take you around the orchard, the pastures, and by the river.<br/>
		The trip takes about 40 minutes and she can take 8 at a time.  She can also tailor the lesson/ride depending on experience, so when you sign up, please do so according to your experience level and we'll group you accordingly. <br/>
		<li>Number of slots remaining: <b><span id="horseRemain"></span></b>.<br/></li>
		<div class="qtyDiv">
			<li>Sign me up for <input name="qtyHorse0" type="text" maxlength="3" size="5"/> people who have never/rarely ridden a horse.</li>
			<li>Sign me up for <input name="qtyHorse1" type="text" maxlength="3" size="5"/> people who occasionally ride a horse.</li>
			<li>Sign me up for <input name="qtyHorse2" type="text" maxlength="3" size="5"/> people who ride a horse weekly.</li>
		</div>
		<div class="qtyAlt">
			<li>Please select your name from the drop down, above, to sign up.</li>
		</div>
		<hr/>
		<h4>Skeet Shooting</h4>
		Another taste of life on the ranch is learning how to shoot.  Skeet shooting is available for those who would be interested.<br/>
		This is the only activity that you will have to pay for.  It is $100/hr, and sign-up is for 15-minute increments.  They provide a 20 gauge, 870 Wingmaster (or you can bring your own), and ammunition is $10 per box of shells.<br/>
		Please bring cash.
		<li>Number of slots remaining: <b><span id="skeetRemain"></span></b>.<br/></li>
		<div class="qtyDiv">
			<li>Sign me up for <input name="qtySkeet" type="text" maxlength="3" size="5"/> 15-minute slots.</li>
		</div>
		<div class="qtyAlt">
			<li>Please select your name from the drop down, above, to sign up.</li>
		</div>
		<hr/>
		<h4>Hay Ride</h4>
		For those with younger kiddos, the Hay Ride is also a fun option.  Throw some hay bales on a trailor, pull it with a tractor through the orchard and back pasture, and you've got yourselves some easy entertainment!<br/>
		The Hay Ride will run every hour and can fit about 10 people each time.<br/>
		<li>Number of slots remaining: <b><span id="hayRemain"></span></b>.<br/></li>
		<div class="qtyDiv">
			<li>Sign me up for <input name="qtyHay" type="text" maxlength="3" size="5"/> people.</li>
		</div>
		<div class="qtyAlt">
			<li>Please select your name from the drop down, above, to sign up.</li>
		</div>
		<hr/>
		<button type="submit" onclick="return submitForm()">Submit signups!</button>
	</div>
</form>
<script>
// Auto-run funcs
// (need to make sure doc is loaded, first)
$(document).ready( function () 
{
	$.ajaxSetup(
	{
		cache: false,
		type: "POST",
		dataType: "json",
		error: onAjaxError,
		traditional: false,
		url: "carpool.php"
	});
	resetForm();
});

function toggleSignups( on )
{
	if ( on )
	{
		$(".qtyDiv").show( 500 );
		$(".qtyAlt").hide( 500 );
	}
	else
	{
		$(".qtyDiv").hide( 500 );
		$(".qtyAlt").show( 500 );
	}
}

function fillRemains()
{
	$.ajax( { data:{ status:"loadActivities" }, success:onFillRemains } );
}

function onFillRemains( data )
{
	var remains = data.payload;
	for ( var i in remains )
		if ( remains[i][1] <= 0 )
		{
			$("#" + remains[i][0] + "Remain").text( "full" );
			$("#" + remains[i][0] + "Remain").css( "color", "red" );
		}
		else
			$("#" + remains[i][0] + "Remain").text( remains[i][1] );
}

function submitForm()
{
	$.ajax( { data:{ status:"actSignup", payload: $("#activitiesSignup").serialize() }, success:onActivitySubmitted } );
	return false;
}

function onActivitySubmitted( data )
{
	if ( data.status.substr(0,5) == "Error" )
		window.alert( "Oopsies!  We have an error.\n " + data.status.substr(6) );
	else
		window.alert( "Thanks!\n " + data.status );
	resetForm();
	//fillRemains();
}

function resetForm()
{
	fillRemains();
	toggleSignups( false );
	$("#activitiesSignup")[0].reset();
}

// AJAX Global callback for all errors
function onAjaxError( xhr, ts, et )
{
	window.alert( "Server-side error:<<<\n" +
				   xhr.responseText + "<<<\n" +
				   ts + "<<<\n" +
				   et );
	resetForm();
}
</script>
</body>
