<?php 
/* AUTHENTICATION */
require 'auth_vimeo.php';

/* API CALL */

// We fetch the latest video uploaded by a user
// CHANGE TO FETCH FROM ALBUM
$response = $vimeo->request('/users/23320497/videos', array('per_page' => 1), 'GET');
$data = $response['body']['data'][0];	//Since we're only fetching one video anyway, we can just pop that array straight into our data variable
$url = $data['link'];	//Simply fetching the URL of the video, for embedding purposes

/* EMBED CODE BELOW */

$requesturl = 'http://vimeo.com/api/oembed.xml?url=' . rawurlencode($url);	//Our request url (if we want an xml array, otherwise replace .xml with .json)

// cURL helper function
function curl_get($url) {
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_TIMEOUT, 30);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
    $return = curl_exec($curl);
    curl_close($curl);
    return $return;
}

$oembed = simplexml_load_string(curl_get($requesturl));
echo html_entity_decode($oembed->html);

?>