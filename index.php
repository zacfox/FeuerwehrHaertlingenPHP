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

<?php
	if(!isset($_SESSION['Nickname'])) {
		echo "<script type=\"text/javascript\">window.location.href=\"login.php\" </script>";
	exit;
	}

	if(isset($_POST['coming'])) {
		$sql = "UPDATE Aktive SET Status = 1 WHERE SessionID = '".mysql_real_escape_string(session_id())."'";
		mysql_query($sql) OR die("<pre>\n".$sql."</pre>\n".mysql_error());
	} else if(isset($_POST['notComing'])) {
		$sql = "UPDATE Aktive SET Status = 2 WHERE SessionID = '".mysql_real_escape_string(session_id())."'";
		mysql_query($sql) OR die("<pre>\n".$sql."</pre>\n".mysql_error());		
	} else if(isset($_POST['unknown'])) {
		$sql = "UPDATE Aktive SET Status = 0 WHERE SessionID = '".mysql_real_escape_string(session_id())."'";
		mysql_query($sql) OR die("<pre>\n".$sql."</pre>\n".mysql_error());		
	}
	
	$sql = "SELECT ID FROM Aktive WHERE SessionID = '".mysql_real_escape_string(session_id())."'";
	$thisID = mysql_result(mysql_query($sql),0);
	echo "Angemeldet als: <b>".$_SESSION['Nickname']."</b> \n";
?>
	
	<br/><br/>Aktueller Status:<br/>
	
<?php
	$sql = "SELECT Status FROM Aktive WHERE SessionID = '".mysql_real_escape_string(session_id())."'";
	$status = mysql_result(mysql_query($sql),0);
	if($status == 0) {
		echo "<font color=\"#FFBF00\">UNBEKANNT</font>";
	} else if($status == 1) {
		echo "<font color=\"#01DF01\">ICH KOMME</font>";
	} else {
		echo "<font color=\"#FF0000\">ICH KOMME NICHT</font>";
	}
?>
	<br/><br/>
	
	<form action="index.php" method="post">
		<button type="submit" class="btn btn-large btn-success btn-block" name="coming">Ich komme</button>
	</form>
	<br/>
	<form action="index.php" method="post">
		<button type="submit" class="btn btn-large btn-danger btn-block" name="notComing">Ich komme nicht</button>
	</form>
	<br/>
	<form action="index.php" method="post">
		<button type="submit" class="btn btn-large btn-warning btn-block" name="unknown">Unbekannt</button>
	</form>
	<br/>
	<form action="status.php" method="post">		
			<button type="submit" class="btn btn-large btn-info btn-block">Kameradenstatus</button>
	</form>
	<br/>
	<form action="logout.php" method="post">		
			<button type="submit" class="btn btn-large btn-primary btn-block">Abmelden</button>
	</form>
	
</h4>	
</div>
	
</body>

</html>
