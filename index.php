<?php
set_time_limit(0);//no time limiit
ini_set('default_socket_timeout', 300);//timeout
session_start();//starting session

//Make Constants using define.
define('clientID', '286f5d5cab964acea2333b38249165d2'); //insert client id);
define('clientSecret', '60bc0c4f4b3a4c3a97583145f696ede2'); //insert client secret);
define('redirectURI', 'https://localhost/appacademyapi/index.php'); //insert URI);
define('ImageDirectory', 'pics/');


//Function that is going to connect to Instagram
function connectToInstagram($url){
	//connecting to insagram function
	$ch = curl_init();
	//ch isthe curl init

	curl_setopt_array($ch, array((
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_SSL_VERIFYHOST => 2,
	));
	$result = curl_exec($ch);
	curl_close($ch);
	//closing the curl
	return $result;
	//return the result
}
//Function to get userID userName dosen't allow us to get pictures!
function getUserID($userName){
	$url = '$http://api.instagram.com/v1/users/search?q='.$userName.'&client_id='.clientID;
	$instagramInfo = connectToInstagram($url);
	$results = json_decode($instagramInfo, true);

	echo $results['data']['0']['id'];
}


if (isset($_GET['code'])){
	$code = ($_GET['code']);
	//variable code is calling the code variable
	$url = 'https://api.instagram.com/oauth/access_token';
	//the url is the access token for instagram
	$access_token_settings = array('client_id' => clientID,
									//'clientID' if equal to the actual clientID
									'cliend_secret' => clientSecret,
									//'client secret' if equal to the actual client secret
									'grant_type' => 'authorization_code',
									//'grant type is equal to the authorization code'
									'redirect_uri' => redirectURI,
									//'redirect_uri' if equal to the actual redirect uri
									'code' => $code
									//code is equal to the variable code
									);
//cURL is what we use in PHP, it's a library to other API's.
$curl = curl_init($url);//stting a cURL session and we out in $url because that's where we are getting the data from
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $access_token_settings);//setting the POSTFIELDS to the array setup that we created
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); //setting it equal to 1 because we are getting dtrings back.
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //but in live work-production we want to set this to true.

$result = curl_exec($curl);
curl_close();

$results = json_decode($result, true);
getUserID($results['user']['username']);
}
else{
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
<?php
}
?>