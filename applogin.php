<?php
    error_reporting(E_ALL);
    include("mysql.php");

	$username = $_GET['username'];
	$sql = "SELECT Admin FROM Aktive WHERE Nickname = '".$username."'";
	$result = mysql_query($sql) OR die("<pre>\n".$sql."</pre>\n".mysql_error());
	
	$row = mysql_fetch_array($result);
	$data = $row[0];	

	//Gibt zurück an die App: 1 = normaler Benutzer, 2 = Admin, 3 = Nickname steht nicht in der Datenbank
	if($data){
		echo $data;
	} else {
		echo "3";
	}
	
	
	mysql_close($connid);
?>