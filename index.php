<?php
set_time_limit(0);//no time limiit
ini_set('default_socket_timeout', 300);//timeout
session_start();//starting session

//Make Constants using define.
define('clientID', '286f5d5cab964acea2333b38249165d2'); //insert client id);
define('clientSecret', '60bc0c4f4b3a4c3a97583145f696ede2'); //insert client secret);
define('redirectURI', 'https://localhost/appacademyapi/index.php'); //insert URI);
define('ImageDirectory', 'pics/');

if isset(($_GET['code'])){
	$code = ($_GET['code']);
	//variable code is calling the code variable
	$url = 'https://api.instagram.com/oauth/access_token';
	//the url is the access token for instagram
	$access_token_settings = array('client_id' => clientID,
									//'clientID' if equal to the actual clientID
									'cliend_secret' => clientSecret,
									//'client secret' if equal to the actual client secret
									'grant_type' = > 'authorization_code',
									//'grant type is equal to the authorization code'
									'redirect_uri' => redirectURI,
									//'redirect_uri' if equal to the actual redirect uri
									'code' => $code
									//code is equal to the variable code
									);
}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="decription" context="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- <title>Untitled</title> -->
		<!-- <link rel="stylesheet" type="text/css" href="css/style.css"> -->
		<link rel="author" href="humans.txt">
	</head>
	<body>
	<!-- Creating a login for people to go and give approval for our web app to sccess their Instagram Account
	After getting approval we are now going to have the information and we can play with it. -->
	<a href="https:api.instagram.com/oauth/authorize/?client_id=<?php echo clientID; ?>&redirect_uri=<?php echo redirectURI; ?>&response_type=code">Login</a>
	<!--<script type="text/javascript" src="js/main.js"></script>-->
	</body>
</html>
