<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Peniche
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="site-info">
      <div class="content flex flow-row-wrap">
        <span class="hotel section">
          <h1 class="title">HOTEL</h1>

          <?php
            $hotel = get_field('hotel', 'option');
            if (have_rows('hotel', 'option')):
              while (have_rows('hotel', 'option')) : the_row();
                $label = get_sub_field('label');
                $content = get_sub_field('content');
          ?>
          <span class="cat block">
            <h2><?php echo $label ?></h2>
            <span class="block">
              <?php echo $content ?>
            </span>
          </span>
          <?php
              endwhile;
            endif;
          ?>

        </span>
        <span class="social section">
          <span class="icons block">
            <?php
              $socials = get_field('social', 'option');
              if (have_rows('social', 'option')):
                while (have_rows('social', 'option')) : the_row();
                  $logo = get_sub_field('logo');
                  $link = get_sub_field('link');
            ?>
              <a class="icon inline-table bloob" href="<?php echo $link ?>">
                <span class="table-cell"><img src="<?php echo $logo ?>" /></span>
              </a>
            <?php
                endwhile;
              endif;
            ?>
          </span>
        </span>
        <span class="restaurant section">
          <h1 class="title">RESTAURANT</h1>
          <?php
            $restaurant = get_field('restaurant', 'option');
            if (have_rows('restaurant', 'option')):
              while (have_rows('restaurant', 'option')) : the_row();
                $label = get_sub_field('label');
                $content = get_sub_field('content');
          ?>
          <span class="cat block">
            <h2><?php echo $label ?></h2>
            <span class="block">
              <?php echo $content ?>
            </span>
          </span>
          <?php
              endwhile;
            endif;
          ?>
        </span>
        <span class="attribution section">
          <h2>Surfers Lodge Peniche</h2>
          <span>&copy; 2017 - all rights reserved.</span>
          <span>Read our <a href="<?php echo get_page_link(291) ?>">Terms & Conditions</a></span>
        </span>
      </div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
