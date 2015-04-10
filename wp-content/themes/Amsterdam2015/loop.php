<?php if (have_posts()): while (have_posts()) : the_post(); ?>

	<?php if (has_post_thumbnail()) {
		$thumbid = get_post_thumbnail_id();
		$thumb_url_array = wp_get_attachment_image_src($thumbid, 'large', true);
		$thumb_url = $thumb_url_array[0];
	} else {
		$thumb_url = null;
		} ?>
	<!-- article -->
	<article id="post-<?php the_ID(); ?>" <?php post_class('col-xs-12 col-sm-6 col-md-4 col-lg-3 article-mini'); ?>>

		<!-- post title -->
		<h2 <?php if (!is_null($thumb_url)) : ?> style="background: linear-gradient(rgba(0, 0, 0, 0.3),rgba(0, 0, 0, 0.3)), url(<?php echo $thumb_url; ?>); background-size: cover; background-repeat: no-repeat;" <?php endif; ?>>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
		</h2>
		<!-- /post title -->

		<!-- post details -->
		<!--
		<span class="date"><?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?></span>
		<span class="author"><?php _e( 'Published by', 'html5blank' ); ?> <?php the_author_posts_link(); ?></span>
		<span class="comments"><?php if (comments_open( get_the_ID() ) ) comments_popup_link( __( 'Leave your thoughts', 'html5blank' ), __( '1 Comment', 'html5blank' ), __( '% Comments', 'html5blank' )); ?></span>
		--><!-- /post details -->

		<!--<?php html5wp_excerpt('html5wp_index'); // Build your custom callback length in functions.php ?>
-->
		<?php edit_post_link(); ?>

	</article>
	<!-- /article -->

<?php endwhile; ?>

<?php else: ?>

	<!-- article -->
	<article>
		<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
	</article>
	<!-- /article -->

<?php endif; ?>
