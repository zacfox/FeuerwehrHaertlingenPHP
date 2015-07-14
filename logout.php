<?php
    error_reporting(E_ALL);
    include("mysql.php");
    include("functions.php");

    session_start();
    doLogout();
    // $_SESSION leeren
    $_SESSION = array();
    // Session löschen
    session_destroy();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<title>Feuerwehr H&auml;rtlingen</title>
</head>

<body>
<script type="text/javascript"> window.location.href="index.php" </script>
</body>

</html>

