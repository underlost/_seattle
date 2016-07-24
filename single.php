<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Seattle
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_format() ); ?>

			<!-- Next and previous post links -->
			<div class="post-navigation">
				<div class="post-navigation-links">
					<?php previous_post_link( '%link', __( 'Previous', 'seattle' ) ); ?>
					<?php next_post_link( '%link', __( 'Next', 'seattle' ) ); ?>
				</div>

				<a class="button all-posts" href="<?php echo home_url( '/' ); ?>">
					<i class="fa fa-th"></i> <?php esc_html_e( 'View All', 'seattle' ); ?>
				</a>
			</div>

			<?php

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); get_footer();
