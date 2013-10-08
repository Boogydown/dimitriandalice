<?php
$linkID = @mysql_connect( "localhost", "dimitria_web", "wedding" ) or die( "Error opening database: " . mysql_error() . ". Please try again.");
mysql_select_db( "dimitria_wedding", $linkID );

echo <<<EOD
<style>
td { border-bottom: 0.5px solid #228822; border-left: 0.5px solid #228822; padding: 2px;  }
</style>
<table style="border: 1px solid #222222;"><tbody>
EOD;

$emails = @fopen( 'emails.txt', 'w' );
$result = mysql_query( "SELECT first_name, last_name, email, phone, num_adults, num_children, message, total_due, total_paid FROM rsvps WHERE attendance='{$_GET['attendance']}'");
$totalOwe = $totalAdult = $totalChild = 0;

while ( $row = mysql_fetch_assoc( $result ) )
{
	$totalAdult += $row['num_adults'];
	$totalChild += $row['num_children'];
	$totalOwe += $row['total_due'] * 1.06 - $row['total_paid'];
	@fwrite( $emails, "\"{$row['first_name']} {$row['last_name']}\" <{$row['email']}>\n" );
	echo "<tr>";
	foreach ( $row as $index => $val )
		echo "<td>$val</td>";
	echo "</tr>";
}
$totalPeople = $totalAdult + $totalChild;
@fclose( $emails );

echo <<<EOD
</tbody></table>
Total Adult: $totalAdult<br />
Total Child: $totalChild<br />
<b>Total People: $totalPeople</b><br />
<b>Total Owe: \$$totalOwe</b><br />
EOD;

?>
