<?php
/**
 * Template Name: Post Style
 */

get_header(); ?>

	<div id="primary" class="content-area container px-0">
		<main id="main" class="site-main">
		  <?php while (have_posts()):
      the_post();
      get_template_part('template-parts/content-single');
      //the_post_navigation();
      the_post_navigation( array(
        'prev_text' => __( '<span class="h6 text-uppercase text-secondary d-block mb-0">Previous</span>%title' ),
        'next_text' => __( '<span class="h6 text-uppercase text-secondary d-block mb-0">Next</span> %title' ),
      ) );
      
      // If comments are open or we have at least one comment, load up the comment template.
      if (comments_open() || get_comments_number()):
        comments_template();
      endif;
      
      endwhile; // End of the loop.
      ?>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_footer();
