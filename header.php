<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Seattle
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page-wrap" class="site">
    <button class="menu-toggle" type="button">
	<span class="button-open"><i class="fa fa-bars"></i> <?php esc_html_e( 'Menu', 'seattle' ); ?></span>
	<span class="button-close"><i class="fa fa-times"></i> <?php esc_html_e( 'Close Menu', 'seattle' ); ?></span>
</button>

<header id="masthead" class="site-header" role="banner">
	<div class="container-fluid">
        <div class="col-md-12">
		<!-- Site title and logo -->
		<?php seattle_title_logo(); ?>
		<!-- Main navigation -->
		<div class="mobile-overlay">
			<div class="mobile-overlay-inside">
				<nav id="site-navigation" class="main-navigation" role="navigation">
					<?php wp_nav_menu( array(
						'theme_location' => 'primary'
					) );?>
				</nav><!-- #site-navigation -->
			</div>
		</div><!-- .mobile-overlay -->
        </div><!-- .col-md-12 -->
	</div><!-- .container -->
</header><!-- #masthead -->

<div id="page" class="hfeed site">
	<div id="content" class="site-content container-fluid">
