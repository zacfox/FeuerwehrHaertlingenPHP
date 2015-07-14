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
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

    </style>
    <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
<script type="text/javascript" type="bootstrap/js/bootstrap.min.js"></script>

</head>

<body>
<div class="container">    

<?php
    if(isset($_POST['submit']) AND $_POST['submit']=='einloggen'){
        // Falls der Login übereinstimmt:
        $sql = "SELECT
                        ID
                FROM
                        Aktive
                WHERE
                        Nickname = '".mysql_real_escape_string(trim($_POST['Nickname']))."'
               ";
        $result = mysql_query($sql) OR die("<pre>\n".$sql."</pre>\n".mysql_error());
        // wird die ID des Users geholt und der User damit eingeloggt
        $row = mysql_fetch_assoc($result);
        // Prüft, ob wirklich genau ein Datensatz gefunden wurde
        if (mysql_num_rows($result)==1){
             doLogin($row['ID'], isset($_POST['Autologin']));
				echo "<script type=\"text/javascript\">window.location.href=\"index.php\" </script>";
		}
        else{
				echo "<h4><p align=\"center\">";
				echo "Du konntest nicht angemeldet werden.<br>\n".
                  "Login fehlerhaft.<br>\n".
                  "<a href=\"".$_SERVER['PHP_SELF']."\">Zur&uuml;ck zum Anmelde-Formular</a>\n";
				echo "</p></h4>";
		}
	}
    else{
		echo "<form class=\"form-signin\"".
             " name=\"Login\" ".
             " action=\"".$_SERVER['PHP_SELF']."\" ".
             " method=\"post\" ".
             " accept-charset=\"ISO-8859-1\">\n";
			 
		echo "<h2 class=\"form-signin-heading\">Bitte Anmelden</h2>".
			"<input type=\"text\" class=\"input-block-level\" placeholder=\"Benutzername\" name=\"Nickname\" maxlength=\"32\">".
			"<label class=\"checkbox\">".
			"<input type=\"checkbox\" value=\"remember-me\"> Anmeldung merken".
			"</label>".
			"<button class=\"btn btn-large btn-primary\" type=\"submit\" name=\"submit\" value=\"einloggen\">Anmelden</button>".
			"</form>";
    }
?>

</div>

</body>

</html>
