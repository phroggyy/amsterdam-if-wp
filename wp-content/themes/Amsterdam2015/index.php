<?php get_header(); ?>

	<main role="main">

		<section class="col-xs-12 col-sm-12 col-md-12 col-lg-12 fp-video">
			<?php // get_template_part('fpvideo'); ?>
			<iframe src="https://player.vimeo.com/video/124613098" width="1280" height="720" frameborder="0" title="Welcome to Amsterdam2015!" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe>
		</section>
		
		<section class="col-xs-12 col-sm-12 col-md-12 col-lg-12 articles">
			<?php get_template_part('loop'); ?>
	</main>

<?php get_footer(); ?>
