<?php
/*
  Template Name: Blog Template
*/

get_header();

global $post;
// $post_slug = $post->post_name;
$post_slug = "blog";

$thumb_id = get_post_thumbnail_id();
$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
$thumb_url = $thumb_url_array[0];

?>

<header>
  <div class="banner img-cont"
       style="background-image: url(<?php echo $thumb_url ?>);">
    <img class="none" src="<?php echo $thumb_url ?>" />
  </div>
</header>

  <div id="blog_primary" class="content-area">
    <main id="main" class="site-main" role="main">

    <?php
    $args = [
      'post_type'      => 'post',
      'category_name'  => $post_slug,
      'posts_per_page' => -1,
      'order'          => 'DESC',
    ];
    $q = new WP_Query( $args );
    if ( $q->have_posts() ) {
      /* Start the Loop */
      while ( $q->have_posts() ) {
        $q->the_post();
        /*
         * Include the Post-Format-specific template for the content.
         * If you want to override this in a child theme, then include a file
         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
         */
        // get_template_part( 'template-parts/post/content', get_post_format() );
        ?>
        <div class="post">
          <h1 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
          <h5 class="date"><?php the_time( get_option( 'date_format' ) ); ?></h5>
          <div class="content">
            <?php the_excerpt(); ?>
          </div>
        </div>
        <?php
      }
    }
    else {
      get_template_part( 'template-parts/post/content', 'none' );
    }
    ?>

    </main><!-- #main -->
  </div><!-- #primary -->

<?php
include 'blog-sidebar.php';
get_footer();
