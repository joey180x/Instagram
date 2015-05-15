<?php
set_time_limit(0);//no time limiit
ini_set('default_socket_timeout', 300);//timeout
session_start();//starting session

//Make Constants using define.
define('clientID', '7f587811996949baa090eb8cba3935e5'); //insert client id);
define('clientSecret', 'ac0350e544a64362a44032eaea7fdfa0'); //insert client secret);
define('redirectURI', 'http://localhost/appacademyapi1/index.php'); //insert URI);
define('ImageDirectory', 'pics/');


//Function that is going to connect to Instagram
function connectToInstagram($url){

	$ch = curl_init();

	curl_setopt_array($ch, array(
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_SSL_VERIFYHOST => 2,
	));

	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
		
}
//Function to get userID userName dosen't allow us to get pictures!
function getUserID($userName){
	$url = 'https://api.instagram.com/v1/users/search?q='. $userName .'&client_id='.clientID;
	$instagramInfo = connectToInstagram($url);
	$results = json_decode($instagramInfo, true);

	return $results['data']['0']['id'];
}
//Function to print out images on screen
function printImages($userID){
	$url = 'https://api.instagram.com/v1/users/'. $userID . '/media/recent?client_id='.clientID.'&count=5';

	$instagramInfo = connectToInstagram($url);
	$results = json_decode($instagramInfo, true);
	//Parse through the information one by one.
	require_once(__DIR__ . "../view/header.php");

	foreach ($results['data'] as $items){
		$image_url = $items['images']['low_resolution']['url'];//going through all results and gives back url of pictures to save in php server
		//require_once(__DIR__ . "/view/carousel.php");
		echo '<img id="pics" src=" '.$image_url.' "/><br/>';
		//calling a function to save that $image_url
		savePictures($image_url);
	}
require_once(__DIR__ . "../view/footer.php");

}
//Function to save images to server
function savePictures($image_url){
	// echo $image_url . '<br>'; 
	$filename = basename($image_url); //the filename is what we are storing is the PHP built in methos to store $image_url
	echo "<form action='$image_url'> <input type='submit' class='fullscreen' value='Fullscreen'></form>". '<br>';

	$destination = ImageDirectory . $filename; //making sure that the image dosen't exist in the storage.
	file_put_contents($destination, file_get_contents($image_url));//grabs image file and stores the image
}


if (isset($_GET['code'])){
	$code = ($_GET['code']);
	//variable code is calling the code variable
	$url = 'https://api.instagram.com/oauth/access_token';
	//the url is the access token for instagram
	$access_token_settings = array('client_id' => clientID,
									//'clientID' if equal to the actual clientID
									'client_secret' => clientSecret,
									//'client secret' if equal to the actual client secret
									'grant_type' => 'authorization_code',
									//'grant type is equal to the authorization code'
									'redirect_uri' => redirectURI,
									//'redirect_uri' if equal to the actual redirect uri
									'code' => $code
									//code is equal to the variable code
									);
//cURL is what we use in PHP, it's a library to other API's.
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_POST, true);
//aetting the POSTFIELDS to the array setup that we created. 
curl_setopt($curl, CURLOPT_POSTFIELDS, $access_token_settings);
//setting it equal to 1 bc we are getting strings back.
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//but in live work-production we want to set this to true.
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);


$result = curl_exec($curl);
curl_close($curl);

$results = json_decode($result, true);

$userName = $results['user']['username'];

$userID = getUserID($userName);


printImages($userID);
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body class="second">

</body>
</html>
<?php
}
else{
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
		<link href='http://fonts.googleapis.com/css?family=Indie+Flower' rel='stylesheet' type='text/css'>
		<title>Learning Api</title>
		<link rel="stylesheet" type="text/css" href="css/main.css">
	</head>
	<body class="main-body">
	<!-- Creating a login for people to go and give approval for our web app to sccess their Instagram Account
	After getting approval we are now going to have the information and we can play with it. -->
	<!-- <div class="jumbotron">
		<div class="container">
				<a  class="btn btn-primary btn-lg" href="https://api.instagram.com/oauth/authorize/?client_id=<?php //echo clientID; ?>&redirect_uri=<?php //echo redirectURI; ?>&response_type=code">
					<h1>Log Into Instagram</h1>
				</a>
		</div>
	</div> -->
	<div style="text-align:center; margin-top:5em;">
  
    <a class="btn-instagram" href="https://api.instagram.com/oauth/authorize/?client_id=<?php echo clientID; ?>&redirect_uri=<?php echo redirectURI; ?>&response_type=code">
      <b>Sign in</b> with Instagram
  	</a>
  
</div>
	 <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>-->
	<script type="text/javascript" src="js/main.js"></script>
	</body>
</html>
<?php
}
?>