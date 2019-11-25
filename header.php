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

	$site_logo = get_option('site_logo');

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
  <?php echo get_option('extra_header_scripts'); ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="site page-container">
  <div class="page-container-inner">
	<a class="skip-link sr-only" href="#content"><?php esc_html_e( 'Skip to content', 'seattle' ); ?></a>
	<div id="content" class="site-content">

	<header class="site-header container px-lg-0 my-3">
		<div class="row no-gutters mb-2">
			<a class="col-12 col-md-6 col-lg-1" href="<?php echo home_url(); ?>">
				<?php if (!empty($site_logo)) { ?>
					<img src="<?php echo get_option('site_logo'); ?>" class="site-logo w-100" alt="<?php bloginfo( 'name' ); ?>" />
				<?php } else { ?>
					<img src="<?php echo get_template_directory_uri() . '/inc/svg/logo.svg' ?>" width="36" height="36" alt="<?php bloginfo( 'name' ); ?>">
				<?php }?>
			</a>
		</div>
  	<?php get_template_part( 'template-parts/navbar' ); ?>
	</header>
