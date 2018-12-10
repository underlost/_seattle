<?php
/**
 * The Homepage
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Seattle
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<header class="sr-only">
				<h1 class="page-title sr-only"><?php single_post_title(); ?></h1>
			</header>
	    <div class="row grid">
	    <div class="grid-sizer col-md-1 col-6"></div>
			<?php if ( have_posts() ) :
				/* Start the Loop */
				while ( have_posts() ) : the_post();
					get_template_part( 'template-parts/content-grid' );
				endwhile;
			else :
				get_template_part( 'template-parts/content', 'none' );
			endif; ?>
	    </div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
