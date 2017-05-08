<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Peniche
 */

global $post;
$post_slug = $post->post_name;

$thumb_id = get_post_thumbnail_id();
$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
$thumb_url = $thumb_url_array[0];

get_header(); ?>

	<div class="banner"
	     style="background-image: url(<?php echo $thumb_url ?>);">
	</div>

	<?php
	while ( have_posts() ) : the_post();

		get_template_part( 'template-parts/content', 'page' );

	endwhile; // End of the loop.
	?>

<?php
get_footer();
