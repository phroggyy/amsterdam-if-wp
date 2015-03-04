<?php
/*
 * Template Name: Authors
*/
get_header();
$editors = get_users(array('role' => 'Editor'));
$EA = get_users(array('role' => 'editorial_assistant'));
$VE = get_users(array('role' => 'video_editor'));
$EAs = [$EA,$VE];
$journos = get_users(array('role' => 'journalist'));
?>

<main role="main">
	<div class="container members">
		<h1><?php echo the_title(); ?></h1>
		<?php if (count($editors) > 0) : ?>
		<section class="editors col-md-8 col-md-offset-2">
			<?php foreach($editors as $editor) : $avatar = get_author_image_url($editor->ID); ?>
				<div class="col-md-6">
					<div class="member-pic">
						<img src="<?php echo $avatar; ?>">
					</div>
					<p class="member-name">
						<?php echo $editor->display_name; ?>
					</p>
			</div>
			<?php endforeach; ?>
		</section>
		<?php endif; ?>
		<?php if (count($EA) > 0 && count($VE) > 0) : ?>
		<section class="ed_asses col-md-8 col-md-offset-2">
			<?php foreach($EAs as $EdAss) : $avatar = get_author_image_url($EA[0]->ID); ?>
				<div class="col-md-6">
					<div class="member-pic">
						<img src="<?php echo $avatar; ?>">
					</div>
					<p class="member-name text-center">
						<?php echo $EdAss[0]->display_name; ?>
					</p>
			</div>
			<?php endforeach; ?>
		</section>
		<?php endif; ?>
		<?php if (count($journos) > 0) : ?>
		<section class="journos">
			<?php foreach($journos as $journo) : $avatar = get_author_image_url($journo->ID); ?>
				<div class="col-md-4">
					<div class="member">
						<img src="<?php echo $avatar; ?>">

						<p class="member-name">
							<?php echo $journo->display_name; ?>
						</p></div>
			</div>
			<?php endforeach; ?>
		</section>
		<?php endif; ?>
	</div>
</main>

<?php get_footer(); ?>