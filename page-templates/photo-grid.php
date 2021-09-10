<?php

/**
 * Template Name: Photo Grid
 * Template Post Type: post
 */

get_header(); ?>

<div id="primary" class="content-area container px-0">
  <main id="main" class="site-main">
    <?php while (have_posts()) :
      the_post();
    ?>
      <div class="bg-tertiary mb-2 px-md-5">
        <header class="entry-header pt-5">
          <div class="row justify-content-md-center">
            <div class="col-md-12 pb-4">
              <?php if (!empty($nsfw)) { ?>
                <div class="badge-group mb-1">
                  <span class="badge text-dark bg-secondary">NSFW</span>
                </div>
              <?php } ?>
              <?php the_title('<h1 class="entry-title h1 mb-0">', '</h1>'); ?>
            </div>
          </div>
        </header><!-- .entry-header -->
        
        <div class="row">
          <div class="entry-content col-md-8 col-lg-8 pb-4">
            <?php the_content();
            wp_link_pages(array(
              'before' => '<div class="page-links">' . esc_html__('Pages:', 'seattle'),
              'after' => '</div>',
            ));
            ?>
          </div><!-- .entry-content -->
        </div>
      </div>

    <?php //get_template_part('template-parts/content-single');
      get_template_part('template-parts/attachment_gallery');
      //the_post_navigation();
      
      _seattle_post_navigation();

      // If comments are open or we have at least one comment, load up the comment template.
      if (comments_open() || get_comments_number()) :
        comments_template();
      endif;

    endwhile; // End of the loop.
    ?>
  </main><!-- #main -->
</div><!-- #primary -->
<?php get_footer();
