<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Seattle
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<header class="entry-header">
				<h1 class="entry-title"><?php esc_html_e( 'Page Not Found', 'seattle' ); ?></h1>

				<div class="entry-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Please use the search box or the navigation menu to locate the content you were looking for.', 'seattle' ); ?></p>

					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			</header><!-- .entry-header -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
