<?php
    error_reporting(E_ALL);
	include("mysql.php");
	include("functions.php");
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Feuerwehr H&auml;rtlingen</title>
<meta http-equiv="refresh" content="5; url=status.php" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
<script type="text/javascript" type="bootstrap/js/bootstrap.min.js"></script>

</head>

<body>

<div class="container">
<h4>
	<form action="index.php" method="post">		
			<button type="submit" class="btn btn-large btn-primary btn-block">Zur&uuml;ck</button>
	</form>
	
<?php
	echo"<table class=\"table\">";
	$sql = "SELECT Vorname, Nachname FROM Aktive WHERE Status = 1;";
	$tabelle = mysql_query($sql) OR die("<pre>\n".$sql."</pre>\n".mysql_error());
	$namen = array();
	while($row_namen = mysql_fetch_assoc($tabelle)) {
		$namen[] = $row_namen;
	}
	foreach($namen as $name) {
		$vorname = utf8_encode($name["Vorname"]);
		$nachname = utf8_encode($name["Nachname"]);
		echo"<tr class=\"success\"><td>".$vorname." ".$nachname."</td></tr>";
	}
	echo"</table>";
	echo"<br/>";
	echo"<table class=\"table\">";
	$sql = "SELECT Vorname, Nachname FROM Aktive WHERE Status = 2;";
	$tabelle = mysql_query($sql) OR die("<pre>\n".$sql."</pre>\n".mysql_error());
	$namen = array();
	while($row_namen = mysql_fetch_assoc($tabelle)) {
		$namen[] = $row_namen;
	}
	foreach($namen as $name) {
		$vorname = utf8_encode($name["Vorname"]);
		$nachname = utf8_encode($name["Nachname"]);
		echo"<tr class=\"error\"><td>".$vorname." ".$nachname."</td></tr>";
	}
	echo"</table>";
	echo"<br/>";
	echo"<table class=\"table\">";
	$sql = "SELECT Vorname, Nachname FROM Aktive WHERE Status = 0;";
	$tabelle = mysql_query($sql) OR die("<pre>\n".$sql."</pre>\n".mysql_error());
	$namen = array();
	while($row_namen = mysql_fetch_assoc($tabelle)) {
		$namen[] = $row_namen;
	}
	foreach($namen as $name) {
		$vorname = utf8_encode($name["Vorname"]);
		$nachname = utf8_encode($name["Nachname"]);
		echo"<tr class=\"warning\"><td>".$vorname." ".$nachname."</td></tr>";
	}	
	echo"</table>";
?>
	
</h4>	
</div>
	
</body>

</html>
