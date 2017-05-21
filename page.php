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

	<header>
		<?php if ($post_slug == "contact") { ?>
			<div class="banner">
				<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d6072.612064489609!2d-9.332066566174134!3d39.372415989642825!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2spt!4v1495361457524" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
			</div>
		<?php } else { ?>
			<div class="banner img-cont"
			     style="background-image: url(<?php echo $thumb_url ?>);">
			  <img class="none" src="<?php echo $thumb_url ?>" />
			</div>
		<?php } ?>
	</header>

	<div class="generic-page-content">
		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', 'page' );

		endwhile; // End of the loop.
		?>
	</div>

<?php
get_footer();
