<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Seattle
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main blocks-page" role="main">
		<?php if ( have_posts() ) : ?>
			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="entry-content"><div class="taxonomy-description">', '</div></div>' );
                // Grab author description on author archive
			    if ( is_author() ) { ?>
				<div class="entry-content">
					<div class="taxonomy-description">
						<?php the_author_archive_description(); ?>
					</div>
				</div>
			<?php } ?>
            </header><!-- .page-header -->

            <div id="post-wrapper">
				<div class="gallery-wrapper">
                    <div class="gallery-sizer col-xs-6 col-sm-6 col-md-1"></div>
    			<?php
    			/* Start the Loop */
    			while ( have_posts() ) : the_post();
                    get_template_part( 'template-parts/content-grid-item' );
    			endwhile; ?>
				</div><!-- .gallery-wrapper -->
			</div><!-- #post-wrapper -->
            <?php seattle_paging_nav();
		else :
			get_template_part( 'template-parts/content', 'none' );
		endif; ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer();
