<?php
  // wp_register_script( 'yt-iframe', 'https://www.youtube.com/iframe_api', null, 1.1, true );
  // wp_enqueue_script( 'yt-iframe' );
  wp_register_script('booking', get_template_directory_uri() . '/js/booking.js', null, 1.1, true);
  wp_enqueue_script( 'booking' );
  get_header();
?>

<div id="Booking" class="page-content">
  <h1 class="text-center title">Submit A Booking Request</h1>

  <?php
  while ( have_posts() ) : the_post();

    get_template_part( 'template-parts/content', 'page' );

  endwhile; // End of the loop.
  ?>
</div>

<?php get_footer() ?>

