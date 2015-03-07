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
		<h1><?php echo the_title(); global $wp_roles; ?></h1>
		<?php if (count($editors) > 0) : ?>
		<section class="editors col-md-6 col-md-offset-3">
			<?php foreach($editors as $editor) : $avatar = get_author_image_url($editor->ID); ?>
				<div class="col-md-6">
					<div class="member-pic" style="background: url(<?php echo $avatar ?>); background-size: cover;"></div>
					<p class="member-name text-center">
						<?php echo $editor->display_name; ?><br>
						<?php echo $wp_roles->roles[$editor->roles[0]]['name']; ?>
					</p>
			</div>
			<?php endforeach; ?>
		</section>
		<?php endif; ?>
		<?php if (count($EA) > 0 && count($VE) > 0) : ?>
			<section class="ed_asses col-md-6 col-md-offset-3">
				<?php foreach($EAs as $EdAss) : $avatar = get_author_image_url($EdAss[0]->ID); ?>
					<div class="col-md-6">
						<div class="member-pic" style="background: url(<?php echo $avatar ?>); background-size: cover;"></div>
						<p class="member-name text-center">
							<?php echo $EdAss[0]->display_name; ?><br>
							<?php echo $wp_roles->roles[$EdAss[0]->roles[0]]['name']; ?>
						</p>
				</div>
				<?php endforeach; ?>
			</section>
			<div class="clearfix"></div>
		<?php endif; ?>
		<?php if (count($journos) > 0) : ?>
		<section class="journos">
			<?php foreach($journos as $journo) : $avatar = get_author_image_url($journo[0]->ID); ?>
				<div class="col-md-3">
					<div class="member-pic" style="background: url(<?php echo $avatar ?>); background-size: cover;"></div>
					<p class="member-name text-center">
						<?php echo $journo->display_name; ?><br>
						<?php echo $wp_roles->roles[$journo->roles[0]]['name']; ?>
					</p>
			</div>
			<?php endforeach; ?>
		</section>
		<?php endif; ?>
	</div>
</main>

<?php get_footer(); ?>