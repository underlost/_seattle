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
      <header class="page-header px-4 py-3 mb-2">
        <h1 class="page-title">
        <?php printf(esc_html__('Search Results for: %s', 'seattle'), '<span>' . get_search_query() . '</span>'); ?></h1>
      </header><!-- .page-header -->
      <div class="row grid">
        <div class="grid-sizer col-md-1 col-sm-6"></div>
		<?php if (have_posts()):
    if (is_home() && !is_front_page()): ?>
			<?php endif;
    /* Start the Loop */
    while (have_posts()):
      the_post();
      get_template_part('template-parts/content-grid-item');
    endwhile;
    the_posts_navigation();
  else:
    get_template_part('template-parts/content', 'none');
  endif; ?>
    </div>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_footer();
