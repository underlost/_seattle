<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Seattle
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="stylesheet" href="https://use.typekit.net/vco5ckf.css">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php get_template_part( 'template-parts/sidebar' ); ?>
<div id="page" class="site page-container">
  <div class="page-container-inner">
	<a class="skip-link screen-reader-text sr-only sr-only" href="#content"><?php esc_html_e( 'Skip to content', 'seattle' ); ?></a>
	<div id="content" class="site-content">
