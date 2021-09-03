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
        <div class="row">
          <div class="col-md-6">
            <h1 class="page-title mb-0">
            <?php printf(esc_html__('Search Results for: %s', 'seattle'), '<span class="text-white">' . get_search_query() . '</span>'); ?></h1>
          </div>
        </div>
      </header><!-- .page-header -->
      <div class="row grid">
        <div class="grid-sizer col-md-1 col-sm-6"></div>
		      <?php if (have_posts()):
            /* Start the Loop */
            while (have_posts()):
              the_post();
              _seattle_grid_item(get_the_ID(), $is_fixed_width = true);
            endwhile;
            
          else:
            get_template_part('template-parts/content', 'none');
          endif; ?>
      </div>
      <div>
        <?php _seattle_pagination(); ?>
      </div>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_footer();
