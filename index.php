<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Seattle
 */

get_header(); ?>
	<div id="primary" class="content-area container px-0">
		<main id="main" class="site-main">
		<?php if (have_posts()):
    if (is_home() && !is_front_page()): ?>
				<header>
					<h1 class="page-title sr-only"><?php single_post_title(); ?></h1>
				</header>
			<?php endif;
    /* Start the Loop */
    echo '<div class="row">';
    while (have_posts()):
      the_post();
      //get_template_part('template-parts/content', get_post_format());
      _seattle_grid_item(get_the_ID(), $is_fixed_width = true);
    endwhile;
    echo '</div>';
    _seattle_pagination();
  else:
    get_template_part('template-parts/content', 'none');
  endif; ?>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_footer();
