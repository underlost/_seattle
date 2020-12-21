<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Seattle
 */

get_header(); ?>

	<div id="primary" class="content-area container px-0">
		<main id="main" class="site-main">
			<header class="page-header px-4 py-3 mb-2 sr-only">
				<?php
          the_archive_title('<h1 class="page-title">', '</h1>');
          the_archive_description('<div class="archive-description">', '</div>');
        ?>
			</header><!-- .page-header -->
        <?php if (have_posts()): ?>
        <div class="row grid">
          <div class="grid-sizer col-md-1 col-sm-6"></div>

          <article class="grid-item col-md-4 grid-md">
            <div class="post-inner d-flex align-items-center">
              <header class="entry-header text-center">
                <?php
                  the_archive_title('<h1 class="page-title">', '</h1>');
                  the_archive_description('<div class="archive-description">', '</div>');
                ?>
              </header>
            </div>
          </article>
        <?php while (have_posts()):
          the_post();
          $is_fixed_width = true;
          include get_template_directory() . '/template-parts/content-grid-item.php';
        endwhile; ?>
        </div>

        <?php the_posts_navigation();
        else:
        get_template_part('template-parts/content', 'none');
        endif; ?>
    	
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer();
