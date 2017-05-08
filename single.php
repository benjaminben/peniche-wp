<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Peniche
 */

get_header();

global $post;
$post_slug = $post->post_name;

$thumb_id = get_post_thumbnail_id();
$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
$thumb_url = $thumb_url_array[0];

?>

<div class="banner"
     style="background-image: url(<?php echo $thumb_url ?>);">
</div>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();

		?>

		<div class="post">
		  <h1 class="title"><?php the_title(); ?></h1>
		  <h5 class="date"><?php the_time( get_option( 'date_format' ) ); ?></h5>
		  <div class="content">
		    <?php the_content(); ?>
		  </div>
		</div>

		<?php

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
