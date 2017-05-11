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

  <header>
    <div class="banner"
         style="background-image: url(<?php echo $thumb_url ?>);">
    </div>
  </header>

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

    if ( $q->have_posts() ) { ?>
      <div class="posts"> <?php
      while ( $q->have_posts() ) {
        $q->the_post();
        $thumb_id = get_post_thumbnail_id();
        $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
        $thumb_url = $thumb_url_array[0];

        $format = get_field('format');
      ?>

        <div class="post relative">
          <div class="content relative <?php echo $format ?>">
          <?php if ($format == 'flex-column') { ?>
            <?php if (get_field('arrangement') == 'text-img') { ?>
              <div class="text text-img">
                <h1 class="title"><?php the_title() ?></h1>
                <p><?php the_content() ?></p>
              </div>
            <?php } ?>
            <?php if ($thumb_id) { ?>
              <div class="img-cont">
                <img src="<?php echo $thumb_url ?>" />
              </div>
            <?php } ?>
            <?php if (get_field('arrangement') == 'img-text') { ?>
              <div class="text img-text">
                <h1 class="title"><?php the_title() ?></h1>
                <p><?php the_content() ?></p>
              </div>
            <?php } ?>
          <?php } ?>

          <?php if ($format == 'banner') { ?>
            <div class="text relative">
              <h1 class="title"><?php the_title() ?></h1>
              <p><?php the_content() ?></p>
            </div>
            <?php if ($thumb_id) { ?>
              <div class="img-cont" style="background-image:url(<?php echo $thumb_url ?>)">
                <img src="<?php echo $thumb_url ?>" />
              </div>
            <?php } ?>
          <?php } ?>

          <?php if ($format == 'slideshow') { ?>
            <?php if (get_field('arrangement') == 'text-img') { ?>
              <div class="text text-img">
                <h1 class="title"><?php the_title() ?></h1>
                <p><?php the_content() ?></p>
              </div>
            <?php } ?>
            <span class="slides-cont block relative">
              <div class="slides relative">
                <?php
                  $slides = get_field('slides');
                  if (have_rows('slides')):
                    while (have_rows('slides')) : the_row();
                      $image = get_sub_field('image');
                      $desc = get_sub_field('description');
                    ?>
                    <span class="slide absolute"
                          style="background-image:url(<?php echo $image ?>)">
                        <img src="<?php echo $image ?>" />
                      <p class="absolute"><?php echo $desc ?></p>
                    </span>
                <?php
                    endwhile;
                  else :
                    echo "no slides";
                  endif;
                ?>
              </div>
            </span>
            <?php if (get_field('arrangement') == 'img-text') { ?>
              <div class="text img-text">
                <h1 class="title"><?php the_title() ?></h1>
                <p><?php the_content() ?></p>
              </div>
            <?php } ?>
          <?php } ?>

          </div>
        </div>

    <?php
        }
        wp_reset_postdata(); ?>
      </div> <?php
      }
    ?>

</div>

<?php get_footer(); ?>
