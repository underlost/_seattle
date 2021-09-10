<?php

/**
 * Template Name: Featured Post
 * Template Post Type: post, page
 */

get_header(); ?>
<div id="primary" class="content-area container-fluid px-0">
  <main id="main" class="site-main">
    <?php while (have_posts()) :
      the_post();
      get_template_part('template-parts/content-featured');

    ?>

    <div class="container">
      <?php _seattle_post_navigation(); ?>
    </div>

    <?php // If comments are open or we have at least one comment, load up the comment template.
      if (comments_open() || get_comments_number()) :
        comments_template();
      endif;

    endwhile; // End of the loop.
    ?>
  </main><!-- #main -->
</div><!-- #primary -->
<?php get_footer();
