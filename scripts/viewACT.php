<?php
$linkID = @mysql_connect( "localhost", "dimitria_web", "wedding" ) or die( "Error opening database: " . mysql_error() . ". Please try again.");
mysql_select_db( "dimitria_wedding", $linkID );

$actList = array();
//$actList['tots'] = array( '', '', 
$emails = @fopen( 'act_emails.txt', 'w' );
$result = mysql_query( "SELECT guest_id, act_name, group_num, num FROM activity_res");
$tots = array();
$guestKeys = array();

while ( $row = mysql_fetch_assoc( $result ) )
{
	$tot = $row['num'];
	$actName = $row['act_name'] . $row['group_num'];
	$guestID = $row['guest_id'];
	// guest assignments
	if ( ! array_key_exists( $guestID, $actList ) )
	{
		$guestResult = mysql_query( "SELECT first_name, last_name, email FROM rsvps WHERE guest_id = $guestID" );
		$actList[ $guestID ] = mysql_fetch_assoc( $guestResult );
	    $guestInfo = $actList[ $guestID ];
		@fwrite( $emails, "\"{$guestInfo['first_name']} {$guestInfo['last_name']}\" <{$guestInfo['email']}>\n" );
	}
	if ( ! array_key_exists( $actName, $actList[ $guestID ]) )
		$actList[ $guestID][ $actName ] = $tot;
	else
		$actList[ $guestID][ $actName ] += $tot;
		
		
	// totals
	if ( ! array_key_exists( $actName, $tots ) )
		$tots[ $actName ] = $tot;
	else
		$tots[ $actName ] += $tot;
}

echo <<<EOD
<style>
td { border-bottom: 0.5px solid #228822; border-left: 0.5px solid #228822; padding: 2px;  }
</style>
<table style="border: 1px solid #222222;"><tbody>
EOD;

$firstPass = true;
foreach ( $actList as $name => $guestData)
{
	// header row
	if ( $firstPass )
	{
		echo "<tr>";
		foreach( $guestInfo as $key => $val )
			echo "<td>$key</td>";
		foreach( $tots as $key => $val )
			echo "<td>$key</td>";
		echo "</tr>";
		$firstPass = false;
	}
	
	echo "<tr>";
	foreach( $guestInfo as $key => $val )
		echo "<td>{$guestData[$key]}</td>";
	foreach( $tots as $key => $val )
		echo "<td>{$guestData[$key]}</td>";
	echo "</tr>";
}
		echo "<tr>";
		foreach( $guestInfo as $key => $val )
			echo "<td> </td>";
		foreach( $tots as $key => $val )
			echo "<td>$val</td>";
		echo "</tr>";
echo <<<EOD
</tbody></table>
EOD;
 
@fclose( $emails );

// last row: totals
foreach ( $tots as $act => $tot )
	echo "Activity total for $act: $tot<br/>";

?>


