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
  </div>

<?php get_footer() ?>
