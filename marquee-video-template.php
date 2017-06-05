<?php

/*
  Template Name: Marquee Video
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

  <?php
    while ( have_posts() ) : the_post(); ?>

    <div class="marquee-vid">
      <div class="vid-cont">
        <?php the_field('embed'); ?>
        <span class="mask absolute pointer"
              style="background-image: url(<?php echo $thumb_url ?>);">
          <span class="watch-cta absolute">
            <p class="uppercase text-center">watch</p>
            <svg width="100" height="100" viewBox="0 0 30 30" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg">
              <defs>
                <path d="M0,15.089434 C0,16.3335929 5.13666091,24.1788679 14.9348958,24.1788679 C24.7325019,24.1788679 29.8697917,16.3335929 29.8697917,15.089434 C29.8697917,13.8456167 24.7325019,6 14.9348958,6 C5.13666091,6 0,13.8456167 0,15.089434 Z" id="welcome_eye_outline"></path>
                <mask id="welcome_eye_mask">
                  <rect width="100%" height="100%" fill="rgba(242,242,242,1)"></rect>
                  <use xlink:href="#welcome_eye_outline" id="welcome_eye_lid" fill="rgba(30,30,30,1)"></use>
                </mask>
              </defs>
              <g id="welcome_eye">
                <path d="M0,15.089434 C0,16.3335929 5.13666091,24.1788679 14.9348958,24.1788679 C24.7325019,24.1788679 29.8697917,16.3335929 29.8697917,15.089434 C29.8697917,13.8456167 24.7325019,6 14.9348958,6 C5.13666091,6 0,13.8456167 0,15.089434 Z M14.9348958,22.081464 C11.2690863,22.081464 8.29688487,18.9510766 8.29688487,15.089434 C8.29688487,11.2277914 11.2690863,8.09740397 14.9348958,8.09740397 C18.6007053,8.09740397 21.5725924,11.2277914 21.5725924,15.089434 C21.5725924,18.9510766 18.6007053,22.081464 14.9348958,22.081464 L14.9348958,22.081464 Z M18.2535869,15.089434 C18.2535869,17.0200844 16.7673289,18.5857907 14.9348958,18.5857907 C13.1018339,18.5857907 11.6162048,17.0200844 11.6162048,15.089434 C11.6162048,13.1587835 13.1018339,11.593419 14.9348958,11.593419 C15.9253152,11.593419 14.3271242,14.3639878 14.9348958,15.089434 C15.451486,15.7055336 18.2535869,14.2027016 18.2535869,15.089434 L18.2535869,15.089434 Z" fill="rgba(242,242,242,1)"></path>
                <use xlink:href="#welcome_eye_outline" mask="url(#welcome_eye_mask)" fill="#FFFFFF"></use>
              </g>
            </svg>
          </span>
        </span>
      </div>
    </div>

    <?php endwhile; // End of the loop.
  ?>

  <?php if ($post_slug == "lodge") { ?>
    <nav class="sub-menu">
    <?php
      wp_nav_menu( array('menu' => 'Lodge Navigation') );
    ?>
    </nav>
  <?php } else { ?>
    <p class="spacer"></p>
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
      ?>

        <div class="post relative">
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
                          <circle cx="50" cy="50" r="45" stroke="black" stroke-width="10" fill="none" />
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
