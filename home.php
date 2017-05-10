<?php
  wp_register_script( 'yt-iframe', 'https://www.youtube.com/iframe_api', null, 1.1, true );
  wp_enqueue_script( 'yt-iframe' );
  wp_register_script('home', get_template_directory_uri() . '/js/home.js', array( 'jquery', 'gsap' ), null, 1.1, true);
  wp_enqueue_script( 'home' );
  get_header();
  $post = get_post(89);
?>

  <div id="Home">
    <div id="home_player" data-yt-id="<?php echo get_field('video_embed_id') ?>"></div>

    <div class="slideshow absolute">
    <?php

      $slideshow = get_field_object("slideshow");
      if( have_rows("slideshow") ):

        while ( have_rows("slideshow") ) : the_row();
          $image = get_sub_field("images");
          ?>
      <span class="slide absolute">
        <span class="block img-cont absolute"
              style="background-image: url(<?php echo $image["url"] ?>)"></span>
      </span>

    <?php
        endwhile;

    else :
      echo "no slides";
    endif;

    ?>
    </div>

    <div class="table-of-contents absolute text-center">
      <span class="title block">
        <h2>Surfers Lodge</h2>
        <h3>Peniche</h3>
      </span>
      <?php
        wp_nav_menu( array('menu' => 'Home Menu') );

        $custom_logo_id = get_theme_mod( 'custom_logo' );
        $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
      ?>
      <img class="logo block" src="<?php echo $logo[0] ?>" />
    </div>

    <span class="watch-cta absolute pointer">
      WATCH
    </span>

  </div>

<?php get_footer() ?>