<?php
  /* WPCF7 date-picker fallback */
  add_filter( 'wpcf7_support_html5_fallback', '__return_true' );

  wp_register_script('booking', get_template_directory_uri() . '/js/booking.js', null, 1.1, true);
  wp_enqueue_script( 'booking' );
  get_header();
  $post = get_post(102);
  $fields = get_fields();
  $seasons = get_field("seasons");
  $rooms = get_field("rooms");
  $surf_options = get_field("surf_options");
?>

<div id="Booking" class="page-content">
  <div id="booking_src" class="none">
    <?php if (have_rows("seasons")) : ?>
      <div class="seasons">
      <?php while (have_rows("seasons")) : the_row(); ?>
        <span class="season"
              data-title="<?php echo get_sub_field("title") ?>"
              data-start-date="<?php echo get_sub_field("start_date") ?>"
              data-end-date="<?php echo get_sub_field("end_date") ?>"
              data-rate="<?php echo get_sub_field("rate") ?>"
        ></span>
      <?php endwhile ?>
      </div>
    <?php endif ?>
    <?php if (have_rows("rooms")) : ?>
      <div class="rooms">
      <?php while (have_rows("rooms")) : the_row(); ?>
        <span class="room"
              data-title="<?php echo get_sub_field("title") ?>"
              data-low-rate="<?php echo get_sub_field("low_rate") ?>"
              data-mid-rate="<?php echo get_sub_field("mid_rate") ?>"
              data-high-rate="<?php echo get_sub_field("high_rate") ?>"
              data-peak-rate="<?php echo get_sub_field("peak_rate") ?>"
              data-image="<?php echo get_sub_field("image") ?>"
        ></span>
      <?php endwhile ?>
      </div>
    <?php endif ?>

    <?php if (have_rows("surf_options")) : ?>
      <div class="surf-options">
      <?php while (have_rows("surf_options")) : the_row(); ?>
        <span class="surf-option"
              data-title="<?php echo get_sub_field("title") ?>"
              data-rate="<?php echo get_sub_field("rate") ?>"
              data-extras="<?php echo get_sub_field("extras") ?>"
              data-image="<?php echo get_sub_field("image") ?>"
        ></span>
      <?php endwhile ?>
      </div>
    <?php endif ?>
  </div>

  <h1 class="text-center title">Booking Request</h1>

  <?php
  while ( have_posts() ) : the_post();

    get_template_part( 'template-parts/content', 'page' );

  endwhile; // End of the loop.
  ?>
</div>

<?php get_footer() ?>
