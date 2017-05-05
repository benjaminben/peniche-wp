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

<div style="height: 500px;
            background-image: url(<?php echo $thumb_url ?>);
            background-size: cover;
            background-position: center center;">
</div>

<?php
  wp_nav_menu( array('menu' => 'Lodge Menu') );

  query_posts( array(
    'category_name'  => $post_slug,
    'posts_per_page' => -1,
    'meta_key'       => 'order',
    'orderby'        => 'meta_value',
    'order'          => 'ASC'
  ) );

  while (have_posts()) : the_post();
    $thumb_id = get_post_thumbnail_id();
    $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
    $thumb_url = $thumb_url_array[0];
  ?>

  <div class="post">
    <h1><?php the_title() ?></h1>
    <p><?php the_content() ?></p>
    <?php if ($thumb_id) { ?>
      <img src="<?php echo $thumb_url ?>" />
    <?php } ?>
  </div>

  <?php endwhile;

  wp_reset_query();
?>

<?php get_footer(); ?>
