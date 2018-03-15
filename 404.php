<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Seattle
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<section class="error-404 not-found">
				<div class="page-content text-center py-5">

          <header class="px-4 py-2 mb-2">
  					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'seattle' ); ?></h1>
  				</header><!-- .page-header -->

					<p><?php esc_html_e( 'It looks like nothing was found at this location.', 'seattle' ); ?></p>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
