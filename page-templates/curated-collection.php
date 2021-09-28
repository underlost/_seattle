<?php

/**
 * Template Name: Curated Collection
 * Template Post Type: page
 * 
 * Similar to homepage but allows a selection of posts to be displayed.
 * 
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Seattle
 */

$curated_posts = get_field('posts', get_the_ID());
//print_r($curated_posts);
$args = array(
  'posts_per_page' => 100,
  'post_status' => 'publish',
  'ignore_sticky_posts' => 1,
  'post__in' => $curated_posts,
);
$the_query = new WP_Query($args);
get_header();
?>

<div id="primary" class="content-area container px-0">
  <main id="main" class="site-main">
    <header class="sr-only">
      <h1 class="page-title sr-only"><?php single_post_title(); ?></h1>
    </header>
    <div class="row grid">
      <div class="grid-sizer col-md-1 col-6"></div>
      <?php if ($the_query->have_posts()) {
        /* Start the Loop */
        while ($the_query->have_posts()) {
          $the_query->the_post();
          _seattle_grid_item(get_the_ID(), $is_fixed_width = false);
        }
        wp_reset_postdata();
      } else {
        get_template_part('template-parts/content', 'none');
      } ?>
    </div>
  </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
