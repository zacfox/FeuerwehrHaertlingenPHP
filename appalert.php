<?php
    error_reporting(E_ALL);
    include("mysql.php");
	
	//Generic php function to send GCM push notification
   function sendMessageThroughGCM($registatoin_ids, $message) {
		//Google cloud messaging GCM-API url
        $url = 'https://android.googleapis.com/gcm/send';
        $fields = array(
            'registration_ids' => $registatoin_ids,
            'data' => $message,
        );
		// Update your Google Cloud Messaging API Key
		define("GOOGLE_API_KEY", "X"); 		
        $headers = array(
            'Authorization: key=' . GOOGLE_API_KEY,
            'Content-Type: application/json'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);	
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);				
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        curl_close($ch);
        return $result;
    }
?>
<?php
	
	//Post message to GCM when submitted
	$pushStatus = "GCM Status Message will appear here";	
	if(isset($_POST['alertActive'])) {
		$sql = "SELECT RegId FROM Aktive";
		$result = mysql_query($sql) OR die("<pre>\n".$sql."</pre>\n".mysql_error());
		$gcmReg = array();
		while ($row = mysql_fetch_array($result, MYSQLI_NUM)) {
		   $gcmReg[] = $row;
		}
		$gcmRegIds = array();
		$c = count($gcmReg);
		for($i = 0; $i < $c; $i++) {
			$gcmRegI[0] = $gcmReg[$i];
			$gcmRegIDa = $gcmRegI[0];
			$gcmRegIds[] = $gcmRegIDa[0];
		}
			// Hier der Text, der übertragen wird
			// $pushMessage = $_POST["message"];
			$pushMessage[0] = "Alarm ausgelöst";
			if (isset($gcmRegIDa) && isset($pushMessage)) {
//				$gcmRegIds = array($gcmRegID);
				$message = array("m" => $pushMessage);	
				$pushStatus = sendMessageThroughGCM($gcmRegIds, $message);
			}
	}
	
	// //Get Reg ID sent from Android App and store it in text file
	// if(!empty($_GET["shareRegId"])) {
		// $gcmRegID  = $_POST["regId"]; 
// //		file_put_contents("GCMRegId.txt",$gcmRegID);
		
		// $f = fopen("GCMRegId.txt", "w+");
		// $log = fputs($f,$gcmRegID);
		// fclose($f);
		
		// echo "Done!";
		// exit;
	// }	
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
<!--		<form method="post" action="/gcm/gcm.php/?push=true" onsubmit="return checkTextAreaLen()">					                                                      
				<textarea rows="5" name="message" cols="45" placeholder="Message to send via GCM"></textarea> <br/>
				<input type="submit"  value="Send Push Notification through GCM" />
		</form>
-->		
		Alarm<br/>
		<form action="appalert.php" method="post">
			<button type="submit" class="btn btn-large btn-danger btn-block" name="alertActive">ALARM AUSL&Ouml;SEN</button>
		</form>
		</h4>
		</div>
		
		<p id="status">
		<?php echo $pushStatus; ?>
		</p> 
		
    </body>
</html>