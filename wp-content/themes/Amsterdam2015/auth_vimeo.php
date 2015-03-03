<?php
require 'vimeo/autoload.php';
$client_id = '14321efccb44b30e24fd45ef7156c40501bdb330';
$client_secret = '0c0e12d6f0d388a355c49ca0e8118544645f2cea';

// Establish a connection to the API
$vimeo = new \Vimeo\Vimeo($client_id, $client_secret);



if (!isset($_SESSION['token'])) {
	// Set credentials
	// These should actually be saved in a cookie to not constantly reauth
	$token = $vimeo->clientCredentials();
	$_SESSION['token'] = $token;
}
if($vimeo->setToken($_SESSION['token']['body']['access_token'])) {
	//echo 'token set';
} else {
	//echo 'failed';
}
?>