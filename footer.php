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
        <span class="hotel">
          <span class="cat block">
            <h2>Booking:</h2>
            <span class="block">+351 262 700 030</span>
            <span class="block">
              <a href="mailto:info@surferslodgepeniche.com">
                info@surferslodgepeniche.com
              </a>
            </span>
          </span>
          <span class="cat block">
            <h2>Address:</h2>
            <span class="block">
              Avenida do mar, Nº 132<br/>
              2520-050 Casais do Baleal - Ferrel<br/>
              Peniche - Portugal
            </span>
          </span>
          <span class="cat block">
            <h2>GPS:</h2>
            <span class="block">
              Latitude: N39 22 14<br/>
              Longitude: W9 19 41
            </span>
          </span>
        </span>
        <span class="social">
          <form>
            <input class="block" type="text" />
            <button>Subscribe</button>
          </form>
          <span class="icons block">
            <a class="icon inline-table" href="https://google.com">
              <span class="table-cell"><img src="<?php echo get_site_url() . "/wp-content/uploads/2017/05/facebook-letter-logo.png" ?>" /></span>
            </a>
            <a class="icon inline-table" href="https://google.com">
              <span class="table-cell"><img src="<?php echo get_site_url() . "/wp-content/uploads/2017/05/instagram-logo.png" ?>" /></span>
            </a>
            <a class="icon inline-table" href="https://google.com">
              <span class="table-cell"><img src="<?php echo get_site_url() . "/wp-content/uploads/2017/05/google-plus.png" ?>" /></span>
            </a>
            <a class="icon inline-table" href="https://google.com">
              <span class="table-cell"><img src="<?php echo get_site_url() . "/wp-content/uploads/2017/05/vimeo-logo.png" ?>" /></span>
            </a>
          </span>
        </span>
        <span class="restaurant">
          <span class="cat block">
            <h2>Reservations:</h2>
            <span class="block">+351 262 700 030</span>
            <span class="block">
              <a href="mailto:info@surferslodgepeniche.com">
                info@surferslodgepeniche.com
              </a>
            </span>
          </span>
          <span class="cat block hours">
            <h2>Hours:</h2>
            <span class="block">
              <strong>Breakfast (buffet)</strong>
              <br/>
              Mon-Sun 07:30am - 10:00am
            </span>
            <span class="block">
              <strong>Lunch</strong>
              <br/>
              Mon-Sun 07:30am - 10:00am
            </span>
            <span class="block">
              <strong>Snacks</strong>
              <br/>
              Mon-Sun 07:30am - 10:00am
            </span>
            <span class="block">
              <strong>Dinner</strong>
              <br/>
              Mon-Sun 07:30am - 10:00am
            </span>
          </span>
        </span>
        <span class="attribution">
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
