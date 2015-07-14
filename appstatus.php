<?php
    error_reporting(E_ALL);
	include("mysql.php");
	
	//mysql_set_charset('utf8');
	mysql_query('SET CHARACTER SET utf8');
	$result = mysql_query("SELECT ID, Vorname, Nachname, Status, Admin from Aktive");
	
	while($row = mysql_fetch_assoc($result)) {
		$output[] = $row;
	}
	
	print(json_encode($output));
	
	mysql_close($connid);
?>