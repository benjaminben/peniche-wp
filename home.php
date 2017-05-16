<?php
  wp_register_script( 'yt-iframe', 'https://www.youtube.com/iframe_api', null, 1.1, true );
  wp_enqueue_script( 'yt-iframe' );
  wp_register_script('home', get_template_directory_uri() . '/js/home.js', array( 'gsap' ), null, 1.1, true);
  wp_enqueue_script( 'home' );
  get_header();
  $post = get_post(89);
?>

  <div id="Home">
    <div id="home_player" data-yt-id="<?php echo get_field('video_embed_id') ?>"></div>

    <div class="slideshow absolute">
    <?php

      $slideshow = get_field("slideshow");
      if( have_rows("slideshow") ):
        $count = 0;
        while ( have_rows("slideshow") ) : the_row();
          $image = get_sub_field("images");
          ?>
      <span class="slide absolute<?php echo ($count == 0 ? " active" : "") ?>"
            <?php echo $count==0 ? "style='opacity: 0'" : "" ?>>
        <span class="block img-cont absolute"
              style="background-image: url(<?php echo $image["url"] ?>)">
          <img src="<?php echo $image["url"] ?>" />
        </span>
      </span>

    <?php
        $count = $count + 1;
        endwhile;

    else :
      echo "no slides";
    endif;

    ?>
    </div>

    <div id="home_toc" class="table-of-contents absolute text-center"
         style="opacity: 0">
      <span class="title block">
        <h2 class="logo-med">Surfers Lodge</h2>
        <h3 class="uppercase logo-dark">Peniche</h3>
      </span>
      <?php
        wp_nav_menu( array('menu' => 'Home Menu') );

        $custom_logo_id = get_theme_mod( 'custom_logo' );
        $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
      ?>
      <img class="logo block" src="<?php echo $logo[0] ?>" />
    </div>

    <span id="home_watch_cta" class="watch-cta absolute pointer uppercase"
          style="opacity: 0">
      PREVIEW
    </span>

  </div>

<?php get_footer() ?>
