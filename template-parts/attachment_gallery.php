<?php
$images = get_post_meta($post->ID, 'seattle_gallery_id', true);
if ($images) {
  echo '<div class="bg-tertiary px-4 py-4 mb-3"><div class="row grid">';
  echo '<div class="grid-sizer col-md-1 col-6"></div>';
  foreach ($images as $image) {
    //echo wp_get_attachment_link($image, 'large');
    $image_meta = get_post($image);
    $image_title = $image_meta->post_title;
    $image_caption = $image_meta->post_excerpt;
    $image_arr = wp_get_attachment_image_src($image, 'large');
    $image_url = !empty($image_arr[0]) ? $image_arr[0] : '';

    $image_sizeWidth = get_post_meta($image, 'display-img-size', true);
    $image_sizeHeight = get_post_meta($image, 'display-img-height', true);
    if (empty($image_sizeWidth)) {
      $image_sizeWidth = 'col-md-4';
    }
    if (empty($image_sizeHeight)) {
      $image_sizeHeight = 'grid-md';
    }
?>
    <div class="hentry gallery-item grid-item <?php echo $image_sizeWidth; ?>">
      <div class="entry-inner">
        <div class="featured-image">
          <img class="image-cover-overlay" src="<?php echo get_template_directory_uri() . '/dist/images/1x1.png'; ?>" />
          <img class="fsr-lazy" alt="<?php echo get_the_title(); ?>" data-src="<?php echo $image_url; ?>" />
        </div>
        <?php if ($image_caption) { ?>
          <div class="entry-details px-4">
            <header class="entry-header pt-4 mb-2">
              <div class="entry-meta">
                <?php echo $image_title; ?>
              </div><!-- .entry-meta -->
            </header><!-- .entry-header -->
            <footer class="entry-footer pb-4">
              <?php echo $image_caption; ?>
            </footer><!-- .entry-footer -->
          </div>
        <?php } ?>
      </div>
    </div>
<?php
  }
  echo '</div></div>';
} ?>