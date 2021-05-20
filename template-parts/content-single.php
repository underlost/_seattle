<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Seattle
 */

$square_thumbnail = true;
$thumbnail_arr = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $square_thumbnail ? 'large' : 'medium');
$thumbnail_url = !empty($thumbnail_arr[0]) ? $thumbnail_arr[0] : '';
$sizeWidth = get_post_meta(get_the_ID(), 'display-img-size', true);
$sizeHeight = get_post_meta(get_the_ID(), 'display-img-height', true);
$location = get_post_meta(get_the_ID(), 'location', true);
$nsfw = get_post_meta(get_the_ID(), 'nsfw', true);
if (empty($sizeWidth)) {
  $sizeWidth = 'col-md-4';
}
if (empty($sizeHeight)) {
  $sizeHeight = 'grid-md';
}

// Determine size for the container
// For testing only. Will replace with something better later.
if ($sizeWidth == 'col-md-1' || $sizeWidth == 'col-md-2' || $sizeWidth == 'col-md-3' || $sizeWidth == 'col-md-4' || $sizeWidth == 'col-md-5') {
  $colWidth_1 = 'col-md-6';
  $colWidth_2 = 'col-md-6';
} elseif ($sizeWidth == 'col-md-6' || $sizeWidth == 'col-md-7' || $sizeWidth == 'col-md-8') {
  $colWidth_1 = 'col-md-8';
  $colWidth_2 = 'col-md-4';
} elseif ($sizeWidth == 'col-md-9' || $sizeWidth == 'col-md-10' || $sizeWidth == 'col-md-11' || $sizeWidth == 'col-md-12') {
  $colWidth_1 = 'col-md-12';
  $colWidth_2 = 'col-md-12';
} else {
  $colWidth_1 = 'col-md-6';
  $colWidth_2 = 'col-md-6';
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <div class="entry-inner mb-3 px-4">
  
    <header class="entry-header pt-5 mb-4 px-md-5">
      <div class="row justify-content-md-center">
        <div class="col-md-10 text-md-center pb-5">
          <?php if (!empty($nsfw)) { ?>
            <div class="badge-group mb-1">
              <span class="badge text-dark bg-secondary">NSFW</span>
            </div>
          <?php } ?>
          <?php the_title('<h1 class="entry-title h1 mb-0">', '</h1>'); ?>
        </div>
      </div>
    </header><!-- .entry-header -->
  
    <div class="row justify-content-md-center">
      <div class="col-md-8 pb-5">
        <div class="featured-image <?php echo $sizeHeight; ?>">
          <img class="fsr-lazy" data-src="<?php echo $thumbnail_url; ?>" alt="<?php the_title(); ?>" />
        </div>
      </div><!-- .col -->
    </div><!-- .row -->

    <div class="row">
      <div class="col-md-4 text-md-end">
        <div class="entry-meta pe-md-5 pb-5">
          <?php if (!empty($location)) { ?>
            <div class="pb-2">
              <span class="d-block h6 text-secondary mb-1 fw-bold text-uppercase">Location</span>
              <span class="location d-block mb-2"><i class="fas fa-map-marker-alt fa-fw"></i><?php echo $location; ?></span>
            </div>
          <?php } ?>
          <?php if ('post' === get_post_type()): _seattle_meta(); endif;?>
        </div><!-- .entry-meta -->
      </div><!-- .col -->

      <div class="col-md-6">
        <div class="entry-content pb-3">
          <?php the_content();
            wp_link_pages(array(
              'before' => '<div class="page-links">' . esc_html__('Pages:', 'seattle'),
              'after' => '</div>',
            ));
          ?>
        </div><!-- .entry-content -->
      </div><!-- .col -->
    </div><!-- .row -->

    <div class="row">
      <div class="col-md-8 offset-md-4">
        <footer class="entry-footer pb-5">
          <?php seattle_entry_footer(); ?>
        </footer><!-- .entry-footer -->
      </div><!-- .col -->
    </div><!-- .row -->
    
  </div><!-- .entry-inner-->
</article><!-- #post-<?php the_ID(); ?> -->

<?php get_template_part('template-parts/attachment_gallery'); ?>
