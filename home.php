<?php
  get_header();
  $post = get_post(89);
?>

  <div id="Home">
    <div class="slideshow absolute" data-urls="">
    <?php

      $slideshow = get_field_object("slideshow");
      if( have_rows("slideshow") ):

        while ( have_rows("slideshow") ) : the_row();
          $image = get_sub_field("images");
          ?>
      <span class="block slide absolute"
            style="background-image: url(<?php echo $image["url"] ?>)"></span>

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

  </div>

<?php get_footer() ?>
