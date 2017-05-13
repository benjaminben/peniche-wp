<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Peniche
 */

get_header();

global $post;

$thumb_id = get_post_thumbnail_id();
$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
$thumb_url = $thumb_url_array[0];

?>

<header>
  <div class="banner"
       style="background-image: url(<?php echo $thumb_url ?>);">
  </div>
</header>

	<section id="blog_primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) :
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				?>
				<div class="post">
				  <h1 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
				  <h5 class="date"><?php the_time( get_option( 'date_format' ) ); ?></h5>
				  <div class="content">
				    <?php the_excerpt(); ?>
				  </div>
				</div>
				<?php

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
include 'blog-sidebar.php';
get_footer();
