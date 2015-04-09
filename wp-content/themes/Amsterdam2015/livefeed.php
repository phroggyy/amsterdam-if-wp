<?php
// Template Name: Live feed

get_header();

//$options = get_option('mytheme_options');
//$tag = $options['hashtag'];
require_once STYLESHEETPATH . '/TwitterAPIExchange.php';

function array_msort($array, $cols)
{
    $colarr = array();
    foreach ($cols as $col => $order) {
        $colarr[$col] = array();
        foreach ($array as $k => $row) { $colarr[$col]['_'.$k] = strtolower($row[$col]); }
    }
    $eval = 'array_multisort(';
    foreach ($cols as $col => $order) {
        $eval .= '$colarr[\''.$col.'\'],'.$order.',';
    }
    $eval = substr($eval,0,-1).');';
    eval($eval);
    $ret = array();
    foreach ($colarr as $col => $arr) {
        foreach ($arr as $k => $v) {
            $k = substr($k,1);
            if (!isset($ret[$k])) $ret[$k] = $array[$k];
            $ret[$k][$col] = $array[$k][$col];
        }
    }
    return $ret;

}

function callInstagram($url)
{
	$ch = curl_init();
	curl_setopt_array($ch, array(
	CURLOPT_URL => $url,				//URL to send the request to
	CURLOPT_RETURNTRANSFER => true,		//let the result be accessed through curl_exec
	CURLOPT_SSL_VERIFYPEER => false,
	CURLOPT_SSL_VERIFYHOST => 2
	));

	$result = curl_exec($ch);
	curl_close($ch);					//close the connection
	return $result;
}

//Instagram
$client_id = "5d955280bacd4c63a9fd6b5971ce74d5";
$instaurl = 'https://api.instagram.com/v1/tags/tandem2015/media/recent?client_id='.$client_id;


//Twitter
$settings = array(
    'oauth_access_token' => "201161804-EGBwzKHYNe5LYVxWzGsYOOJgsCWPDRUmBXf3rBF7",
    'oauth_access_token_secret' => "3P0UOntKdxWZV7326hngY4W4RF8ulKQMRXtAjohsMlpeJ",
    'consumer_key' => "x6OcGlyZW77KUjftdWlLCvpdK",
    'consumer_secret' => "1DIunG3HvLVX4mFNJcOIumZht2lYeGx186cxILFqibiZ9sMSfq"
);

$url = 'https://api.twitter.com/1.1/search/tweets.json';
$getfield = '?q=%23'.$tag;
$requestMethod = 'GET';

?>
<div class="feed">
<?php
$instjson = callInstagram($instaurl);
$instresults = json_decode($instjson, true);
$socialfeed = array();

foreach ($instresults['data'] as $post) {
	$temp = array(
		'type'			=> 'instagram',
		'timestamp'		=> $post['created_time'],
		'caption'		=> $post['caption']['text'],
		'postlink'		=> $post['link'],
		'profile_pic'	=> $post['user']['profile_picture'],
		'username'		=> $post['user']['username'],
		'user_url'		=> 'http://instagram.com/' . $post['user']['username'],
		'full_name'		=> $post['user']['full_name'],
		'post_img'		=> $post['images']['low_resolution']['url']
	);
	$socialfeed[] = $temp;
}

$twitter = new TwitterAPIExchange($settings);
$json = $twitter->setGetfield($getfield)
     		->buildOauth($url, $requestMethod)
            ->performRequest();
$twresults = json_decode($json, true);

foreach ($twresults['statuses'] as $post) {
	$temp = array(
		'type'			=> 'twitter',
		'timestamp'		=> strtotime($post['created_at']),
		'caption'		=> $post['text'],
		'postlink'		=> 'https://twitter.com/' . $post['user']['screen_name'] . '/statuses/' . $post['id'],
		'postid'		=> $post['id'],
		'profile_pic'	=> $post['user']['profile_image_url_https'],
		'username'		=> $post['user']['screen_name'],
		'user_url'		=> 'https://twitter.com/' . $post['user']['screen_name'],
		'full_name'		=> $post['user']['name']
	);
	$socialfeed[] = $temp;
}

$sorted = array_msort($socialfeed, array('timestamp'=>SORT_DESC, 'type'=>SORT_ASC));


if ($sorted) {
	foreach ($sorted as $post) {
		?>
		<div class="tweet">
			<div class="tile-head">
				<p class="timestamp"><?php echo date('H.i', $post['timestamp']); ?></p>
				<p class="datestamp"><?php echo date('M d', $post['timestamp']); ?></p>
			</div>
			<div class="user">
				<img class="twitpic" height=48 width=48 src="<?php echo $post['profile_pic']; ?>" alt="">
				<a target="_blank" class="tweeter" href="<?php echo $post['user_url']; ?>"><?php echo $post['full_name']; ?><br><small>@<?php echo $post['username']; ?></small></a>
			</div>
			<div class="content">
				<?php if($post['post_img']) : ?>
					<img class="instapic" src="<?php echo $post['post_img']; ?>" alt="">
				<?php endif; ?>
				<p>
				<?php if(strlen($post['caption']) <= 140) :
					echo $post['caption'];
				else :
					echo substr($post['caption'], 0, 140) . '<a href="' . $post['postlink'] . '">[...]</a>';
				endif;
				?>
				</p>
			</div>
			<?php if($post['post_img']) : ?>
				<p style="text-align: center;"><a target="_blank" href="<?php echo $post['postlink']; ?>"><i class="fa fa-instagram fa-2x"></i></a></p>
			<?php else : ?>
				<p style="text-align: center;"><a target="_blank" href="<?php echo $post['postlink']; ?>"><i class="fa fa-twitter fa-2x"></i></a></p>
			<?php endif; ?>
			<?php if(!$post['post_img']) : ?>
				<div class="tile-foot">
					<a target="_blank" href="https://twitter.com/intent/tweet?in_reply_to=<?php echo $post['postid']; ?>"><i class="fa fa-reply"></i></a>
					<a target="_blank" href="https://twitter.com/intent/retweet?tweet_id=<?php echo $post['postid']; ?>"><i class="fa fa-retweet"></i></a>
					<a target="_blank" href="https://twitter.com/intent/favorite?tweet_id=<?php echo $post['postid']; ?>"><i class="fa fa-star"></i></a>
				</div>
			<?php endif; ?>
		</div>
	<?php }
} ?>

<?php /* if($twresults) {
	foreach ($twresults['statuses'] as $tweet) {
		?>
		<div class="tweet">
			<div class="tile-head">
				<p id="timestamp"><?php echo date('H.i', strtotime($tweet['created_at'])); ?></p>
				<p id="datestamp"><?php echo date('M d', strtotime($tweet['created_at'])); ?></p>
			</div>
			<div class="user">
				<img class="twitpic" src="<?php echo $tweet['user']['profile_image_url_https']; ?>" alt="">
				<a target="_blank" class="tweeter" href="https://twitter.com/<?php echo $tweet['user']['screen_name']; ?>"><?php echo $tweet['user']['name']; ?><br><small>@<?php echo $tweet['user']['screen_name']; ?></small></a>
			</div>
			<p><?php echo $tweet['text']; ?></p>
			<p style="text-align: center;"><a target="_blank" href="https://twitter.com/<?php echo $tweet['user']['screen_name']; ?>/statuses/<?php echo $tweet['id']; ?>"><i class="fa fa-twitter fa-2x"></i></a></p>
			<div class="tile-foot">
				<a target="_blank" href="https://twitter.com/intent/tweet?in_reply_to=<?php echo $tweet['id']; ?>"><i class="fa fa-reply"></i></a>
				<a target="_blank" href="https://twitter.com/intent/retweet?tweet_id=<?php echo $tweet['id']; ?>"><i class="fa fa-retweet"></i></a>
				<a target="_blank" href="https://twitter.com/intent/favorite?tweet_id=<?php echo $tweet['id']; ?>"><i class="fa fa-star"></i></a>
			</div>
		</div>
		<?php
	}
}
*/
?>
</div>
<?php

get_footer();

?>