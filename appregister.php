<?php
    error_reporting(E_ALL);
    include("mysql.php");

	$username = $_POST['username'];
	$regId	= $_POST['regid'];

	$sql = "UPDATE Aktive SET RegId = '$regId' WHERE Nickname = '$username'";
	mysql_query($sql) OR die("<pre>\n".$sql."</pre>\n".mysql_error());
	echo "1";
	mysql_close($connid);
?>