<?php
/*
Template Name: Representations page
*/
get_header();

require 'class.amsterdamAPI.php';

$apiKey = 'lC7UO1LW75kSeyhaHfFB9IMnTuZPn9fdBtDTSTbcX76k1oLXdMp3ZvVFYdv5';
$apiSecret = '1svooKg0SCigJ2pPG3RnfIWpJwlqzesiaEmV76iCnbAZwOBONOqg9JVnKQNM';
$amsterdam = new AmsterdamAPI($apiKey, $apiSecret);


?>

    <div id="root">
        <iframe src="http://task1.apps.tandem15.eu" frameborder="0"></iframe>
    </div>


<?php get_footer(); ?>