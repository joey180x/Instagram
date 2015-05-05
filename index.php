<?php
set_time_limit(0);//no time limiit
ini_set('default_socket_timeout', 300);//timeout
session_start();//starting session

//Make Constants using define.
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