<?php
/**
 * @package Seattle
 */

get_header(); ?>

    <!-- Get the homepage title and intro text -->
    <?php if ( get_theme_mod( 'seattle_customizer_homepage_title' )) { ?>
        <header class="entry-header">
            <?php if ( get_theme_mod( 'seattle_customizer_homepage_title' ) ) {
                printf( '<h1 class="entry-title">%s</h1>', get_theme_mod( 'seattle_customizer_homepage_title' ) );
            }

            if ( get_theme_mod( 'seattle_customizer_homepage_text' ) ) {
                printf( '<div class="entry-content"><p>%s</p></div>', get_theme_mod( 'seattle_customizer_homepage_text' ) );
            } ?>
        </header><!-- .entry-header -->
    <?php } ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
            <div id="post-wrapper">
                <div class="gallery-wrapper">
                <div class="gallery-sizer col-xs-6 col-sm-6 col-md-1"></div>

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) : ?>
				<h1 class="sr-only"><?php single_post_title(); ?></h1>
			<?php
			endif;

			/* Start the Loop */
			while ( have_posts() ) : the_post();
				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
                get_template_part( 'template-parts/content-grid-item' );
			endwhile;
		    else :
			get_template_part( 'template-parts/content', 'none' );
		endif; ?>
        </div>
        </div>

        <?php seattle_paging_nav(); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer();
