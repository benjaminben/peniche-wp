<?php

/*
  Template Name: Lodge Template
*/

get_header();

global $post;
$post_slug = $post->post_name;

$thumb_id = get_post_thumbnail_id();
$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
$thumb_url = $thumb_url_array[0];

?>

<div id="Lodge">

  <div class="banner"
       style="background-image: url(<?php echo $thumb_url ?>);">
  </div>

  <nav class="sub-menu">
  <?php
    wp_nav_menu( array('menu' => 'Lodge Navigation') );
  ?>
  </nav>

  <?php
    $args = [
      'post_type'      => 'post',
      'category_name'  => $post_slug,
      'posts_per_page' => -1,
      'post_parent'    => 0,
      'meta_key'       => 'order',
      'orderby'        => 'meta_value',
      'order'          => 'ASC',
    ];

    $q = new WP_Query( $args );

    if ( $q->have_posts() ) {
      while ( $q->have_posts() ) {
        $q->the_post();
        $thumb_id = get_post_thumbnail_id();
        $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
        $thumb_url = $thumb_url_array[0];
      ?>

      <div class="post">
        <div class="text">
          <h1 class="title"><?php the_title() ?></h1>
          <p><?php the_content() ?></p>
        </div>
        <?php if ($thumb_id) { ?>
        <div class="img-cont">
          <img src="<?php echo $thumb_url ?>" />
        </div>
        <?php } ?>
      </div>

    <?php
        }
        wp_reset_postdata();
      }
    ?>

</div>

<?php get_footer(); ?>
