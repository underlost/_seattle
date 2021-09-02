<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Seattle
 */

$term = get_queried_object();
$archive_photo = null;
$image_settings = null;
if (function_exists('get_field')) {
  $archive_photo = get_field('image', $term);
}
if (!empty($archive_photo['url'])) {
  $image_settings = 'data-bg=" ' . $archive_photo['url'] . '"';
}

get_header();

?>

<div id="primary" class="content-area container px-0">
  <main id="main" class="site-main">
    <?php if (have_posts()) : ?>
      <div class="row grid">
        <div class="grid-sizer col-md-1 col-sm-6"></div>

        <article class="grid-item col-md-4 d-block-square">
          <div class="post-inner d-flex align-items-center h-100">

            <header class="entry-header text-center w-100 position-relative z-10">
              <?php
              the_archive_title('<h1 class="page-title h3 px-4 text-center">', '</h1>');
              the_archive_description('<div class="archive-description">', '</div>');
              ?>
            </header>
            <div class="archive-cover fsr-lazy" <?php echo $image_settings; ?>></div>

          </div>
        </article>

        <?php while (have_posts()) :
          the_post();
          $is_fixed_width = true;
          include get_template_directory() . '/template-parts/content-grid-item.php';
        endwhile; ?>
      </div>

    <?php

      // the_posts_navigation();
      _seattle_pagination();
    
    else :
      get_template_part('template-parts/content', 'none');
    endif; ?>

  </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
