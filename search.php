<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Seattle
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'seattle' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

            <div id="post-wrapper">
				<div class="gallery-wrapper">
                    <div class="gallery-sizer col-xs-6 col-sm-6 col-md-1"></div>

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content-grid-item' );

			endwhile;

			seattle_paging_nav();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

            </div><!-- .gallery-wrapper -->
        </div><!-- #post-wrapper -->

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_footer();
