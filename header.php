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

$site_logo = get_option('site_logo'); ?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php echo get_option('extra_header_scripts'); ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<div id="page" class="site page-container">
		<div class="page-container-inner px-3 px-lg-0">
			<a class="skip-link sr-only" href="#content"><?php esc_html_e('Skip to content', 'seattle'); ?></a>
			<div id="content" class="site-content">

				<header class="site-header container px-lg-0 my-2">
					<div class="row no-gutters mb-2 site-branding ">
						<a class="col-4 col-md-3 col-lg-1 " href="<?php echo home_url(); ?>">
							<?php if (!empty($site_logo)) { ?>
								<img src="<?php echo get_option('site_logo'); ?>" class="site-logo w-100 d-block-square" alt="<?php bloginfo('name'); ?>" />
							<?php } else { ?>
								<img class="d-block-square" src="<?php echo get_template_directory_uri() . '/inc/svg/logo.svg'; ?>" width="36" height="36" alt="<?php bloginfo('name'); ?>">
							<?php } ?>
						</a>
						<div class="offset-lg-1 col-lg-10 align-self-end">
							<?php get_template_part('template-parts/header-featured'); ?>
						</div>
					</div>
					<?php get_template_part('template-parts/navbar'); ?>
				</header>