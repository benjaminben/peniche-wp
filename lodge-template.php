<?php

/*
  Template Name: Lodge Template
*/

wp_register_script('lodge', get_template_directory_uri() . '/js/lodge.js', array( 'jquery', 'gsap' ), null, 1.1, true);
wp_enqueue_script( 'lodge' );

get_header();

global $post;
$post_slug = $post->post_name;

$thumb_id = get_post_thumbnail_id();
$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
$thumb_url = $thumb_url_array[0];

?>

<div class="primary-page-type">

  <header>
    <div class="banner img-cont"
         style="background-image: url(<?php echo $thumb_url ?>);">
      <img class="none" src="<?php echo $thumb_url ?>" />
    </div>
  </header>

  <?php if ($post->post_parent == "5") { ?>
    <nav class="sub-menu">
    <?php
      wp_nav_menu( array('menu' => 'Lodge Navigation') );
    ?>
    </nav>
  <?php } else { ?>
    <div class="header-spacer"></div>
  <?php } ?>

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
        $id = get_field('id');
      ?>

        <div <?php if ($id) { ?> id="<?php echo $id ?>" <?php } ?>
             class="post relative">
          <div class="content relative <?php echo $format ?>">
          <?php if ($format == 'flex-column') { ?>
            <?php if (get_field('arrangement') == 'text-img') { ?>
              <div class="text fadie text-img">
                <h1 class="title"><?php the_title() ?></h1>
                <p><?php the_content() ?></p>
              </div>
            <?php } ?>
            <?php if ($thumb_id) { ?>
              <div class="img-cont fadie">
                <img src="<?php echo $thumb_url ?>" />
              </div>
            <?php } ?>
            <?php if (get_field('arrangement') == 'img-text') { ?>
              <div class="text fadie img-text">
                <h1 class="title"><?php the_title() ?></h1>
                <p><?php the_content() ?></p>
              </div>
            <?php } ?>
          <?php } ?>

          <?php if ($format == 'video-embed') { ?>
            <?php if (get_field('arrangement') == 'text-img') { ?>
              <div class="text fadie text-img">
                <h1 class="title"><?php the_title() ?></h1>
                <p><?php the_content() ?></p>
              </div>
            <?php } ?>

              <div class="vid-cont inline-block">
                <div class="wrapper">
                  <?php the_field('embed'); ?>
                </div>
              </div>

            <?php if (get_field('arrangement') == 'img-text') { ?>
              <div class="text fadie img-text">
                <h1 class="title"><?php the_title() ?></h1>
                <p><?php the_content() ?></p>
              </div>
            <?php } ?>
          <?php } ?>

          <?php if ($format == 'banner') { ?>
            <div class="text fadie relative">
              <h1 class="title"><?php the_title() ?></h1>
              <p><?php the_content() ?></p>
            </div>
            <?php if ($thumb_id) { ?>
              <div class="img-cont fadie" style="background-image:url(<?php echo $thumb_url ?>)">
                <img src="<?php echo $thumb_url ?>" />
              </div>
            <?php } ?>
          <?php } ?>

          <?php if ($format == 'slideshow') { ?>
            <?php if (get_field('arrangement') == 'text-img') { ?>
              <div class="text fadie text-img">
                <h1 class="title"><?php the_title() ?></h1>
                <p><?php the_content() ?></p>
              </div>
            <?php } ?>
            <span class="slides-cont fadie block relative">
              <div class="slides relative">
                <?php
                  $slides = get_field('slides');
                  if (have_rows('slides')):
                    $slide_count = 0;
                    while (have_rows('slides')) : the_row();
                      $image = get_sub_field('image');
                      $desc = get_sub_field('description');
                    ?>
                    <span class="slide absolute<?php echo ($slide_count == 0 ? " active" : "") ?>"
                          style="background-image:url(<?php echo $image ?>)">
                        <img src="<?php echo $image ?>" alt="<?php echo $desc ?>" />
                        <?php if ($desc) { ?>
                          <p class="absolute"><?php echo $desc ?></p>
                        <?php } ?>
                    </span>
                <?php
                    $slide_count++;
                    endwhile;
                ?>

                <span class="absolute index-array table">
                  <?php
                    $index_count = 0;
                    while (have_rows('slides')) : the_row();
                    ?>
                      <span class="index pointer table-cell v-middle<?php echo ($index_count == 0 ? " active" : "") ?>"
                            data-index="<?php echo $index_count ?>">
                        <svg class="block" width="100" height="100" viewbox="0 0 100 100">
                          <circle cx="50" cy="50" r="45" fill="none" />
                        </svg>
                      </span>
                  <?php
                      $index_count++;
                    endwhile;
                  ?>
                </span>
                <?php
                  else :
                    echo "no slides";
                  endif;
                ?>
              </div>
            </span>
            <?php if (get_field('arrangement') == 'img-text') { ?>
              <div class="text fadie img-text">
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
