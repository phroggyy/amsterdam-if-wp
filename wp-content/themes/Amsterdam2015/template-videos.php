<?php
/*
Template Name: Videos page
*/
get_header();
require 'auth_vimeo.php';
?>
<main role="main">
	<div class="container videos">
		<h1><?php echo the_title(); ?></h1>
		<?php
		$response = $vimeo->request('/users/tandem15/videos', 'GET');
		$videos = $response['body']['data'];

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

		if (count($videos) > 0) :
			foreach ($videos as $video) :
				$video_id = mb_substr($video['uri'], 8);
				$pic = end($video['pictures']['sizes'])['link'];
				$url = $video['link'];
				$requesturl = 'http://vimeo.com/api/oembed.xml?url=' . rawurlencode($url);	//Our request url (if we want an xml array, otherwise replace .xml with .json)

				$oembed = simplexml_load_string(curl_get($requesturl));
				?>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 single-video" style="background: url(<?php echo $pic; ?>);">
					<h2><a data-toggle="modal" data-url="<?php echo $video['link']; ?>" data-target="#video-<?php echo $video_id; ?>" class="playvideo" data-src="<?php echo $video['link']; ?>" href="#"><?php echo html_entity_decode($video['name']); ?></a></h2>
				</div>
				<div class="modal fade" id="video-<?php echo $video_id; ?>">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4><?php echo html_entity_decode($video['name']); ?></h4>
							</div>
							<div class="modal-body">
								<?php echo html_entity_decode($oembed->html); ?>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach;
		else : ?>
			<p class="text-info">Unfortunately, no videos are yet available. Check back later!</p>
		<?php
		endif;
		?>
	</div>
</main>
<?php get_footer(); ?>