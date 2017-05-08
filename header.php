<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Peniche
 */

	global $post;
  $post_slug=$post->post_name;

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site <?php echo $post_slug ?>">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'peniche' ); ?></a>

	<header id="masthead" class="site-header flex align-center" role="banner">
		<?php
			if( has_custom_logo() ) {
				the_custom_logo();
			} else { ?>
				<h1 class="site-root-link"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Surfers Lodge Peniche</a></h1>
		<?php	} ?>
		<nav id="site-navigation" class="main-navigation table-cell" role="navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_id' => 'primary-menu' ) ); ?>
		</nav><!-- #site-navigation -->
		<span class="booking table-cell">
			<button class="booking-button">BOOKING</button>
		</span>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
