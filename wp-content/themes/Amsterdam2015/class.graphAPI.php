<?php
/**
 * Created by PhpStorm.
 * User: leosjoberg
 * Date: 24/02/15
 * Time: 11:06
 */
class graphAPI {

    public $accessToken;

    function __construct($appId, $appSecret)
    {
        $this->accessToken = '&access_token='. $appId . '|' . $appSecret;
    }

    function curl_get ($requestUrl) {
        $baseRequestUrl = 'https://graph.facebook.com/';
        $request = $baseRequestUrl . $requestUrl . $this->accessToken;
        $curl = curl_init($request);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        $return = curl_exec($curl);
        curl_close($curl);
        return json_decode($return);
    }
}