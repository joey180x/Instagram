<?php
set_time_limit(0);//no time limiit
ini_set('default_socket_timeout', 300);//timeout
session_start();//starting session

//Make Consta nts using define.
define('client_id', '286f5d5cab964acea2333b38249165d2'); //insert client id);
define('client_secret', '60bc0c4f4b3a4c3a97583145f696ede2'); //insert client secret);
define('redirectURI', 'https://localhost:8888/appacademyapi/index.php'); //insert URI);
define('ImageDirectory', 'pics/');
?>
<!-- CLIENT INFO
CLIENT ID 286f5d5cab964acea2333b38249165d2
CLIENT SECRET 60bc0c4f4b3a4c3a97583145f696ede2
WEBSITE URL https://localhost:8888/appacademyapi/index.php
REDIRECT URI https://localhost:8888/appacademyapi/index.php

-->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="decription" context="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Untitled</title>
		<link rel="stylesheet" type="text/css" href="humans.txt">
	</head>
	<body>
	<!-- Creating a login for people to go and give approval for our web app to sccess their Instagram Account
	After getting approval we are now going to have the information and we can play with it. -->
	<a href="https://api.instgram/oauth/authorize/?client_id=<?php echo client_ID; ?>&redirect_uri=<?php redirectURI; ?>&response_type=code">LOGIN</a>
	<script type="text/javascript" src="js/main.js"></script>
	</body>
</html>
