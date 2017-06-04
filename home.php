<?php
  wp_register_script( 'yt-iframe', 'https://www.youtube.com/iframe_api', null, 1.1, true );
  wp_enqueue_script( 'yt-iframe' );
  wp_register_script('home', get_template_directory_uri() . '/js/home.js', array( 'gsap' ), null, 1.1, true);
  wp_enqueue_script( 'home' );
  get_header();
  $post = get_post(89);
?>

  <div id="Home">
    <div id="intro_loader" class="loader absolute flex justify-center align-center">
      <div class="cont">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 268.507 326.682"><path d="M265.36,320.027,42.028,326.682,0,190.479l219.9.184" fill="#41449b" opacity="0.9"></path><path d="M265.989,274.872,42.657,281.526.629,145.323l219.9.184" fill="#6769b0" opacity="0.9"></path><path d="M266.776,228.293,43.444,234.947,1.416,98.744l219.9.184" fill="#8d8ec2" opacity="0.9"></path><path d="M267.969,178.859,44.637,185.513,2.609,49.31l219.9.184" fill="#b3b4d7" opacity="0.9"></path><path d="M268.507,129.549,45.175,136.2,3.147,0l219.9.184" fill="#d9d9eb" opacity="0.9"></path></svg>
        <span id="loader_cta">LOADING...</span>
      </div>
    </div>

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

    <span id="home_watch_cta" class="watch-cta absolute pointer uppercase text-center"
          style="opacity: 0">
      <p>WATCH</p>
      <svg id="welcome_intro_cta_svg" width="100" height="100" viewBox="0 0 30 30" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg">
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

  </div>

<?php get_footer() ?>

