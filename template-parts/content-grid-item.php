<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Seattle
 */

$format = get_post_format(get_the_ID());
$square_thumbnail = true;
$thumbnail_arr = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'large');
$thumbnail_url = !empty($thumbnail_arr[0]) ? $thumbnail_arr[0] : '';
$url = get_the_permalink();

$sizeWidth = get_post_meta(get_the_ID(), 'display-img-size', true);
$sizeHeight = get_post_meta(get_the_ID(), 'display-img-height', true);
$location = get_post_meta(get_the_ID(), 'location', true);
$nsfw = get_post_meta(get_the_ID(), 'nsfw', true);
$lightboxEndabled = get_post_meta(get_the_ID(), 'lightbox', true);

if (empty($sizeWidth)) {
  $sizeWidth = 'col-md-4';
}
if (empty($sizeHeight)) {
  $sizeHeight = 'grid-md';
}

if (!empty($nsfw)) {
  $nsfwClass = 'grid-item-nsfw';
} else {
  $nsfwClass = null;
}
$classes = array($sizeWidth, $sizeHeight, $nsfwClass, 'grid-item', 'grid-item-clickable');

$lightbox = null;
$element = 'article';

if ($format == 'aside') {
  $element = 'aside';
  $lightbox = 'data-featherlight="' . $thumbnail_url . '"';
}

if (!empty($lightboxEndabled)) {
  $lightbox = 'data-featherlight="' . $thumbnail_url . '"';
}
?>

<<?php echo $element; ?> id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
	<a href="<?php echo $url; ?>" rel="bookmark" <?php echo $lightbox; ?> class="post-inner d-flex align-items-center" data-bg="url(<?php echo $thumbnail_url; ?>)">
	<?php if (!empty($nsfw)) { ?>
	<div class="badge-group">
		<span class="badge badge-secondary">NSFW</span>
	</div>
	<?php } ?>
	<div class="image-wrapper">
		<img class="fsr-lazy" alt="<?php echo get_the_title(); ?>" data-src="<?php echo $thumbnail_url; ?>" />
	</div>
  	<header class="entry-header text-center">
  		<?php
    the_title('<h2 class="entry-title h4 px-lg-5">', '</h2>');
    if ('post' === get_post_type()): ?>
  		<div class="entry-meta">
  			<span class="sr-only"><?php seattle_posted_on(); ?></span>
				<?php if (!empty($location)) { ?> 
				<span class="location"><span class="sr-only">In: </span><?php echo $location; ?></span>
				<?php } ?>
  		</div><!-- .entry-meta -->
  		<?php endif;
    ?>
  	</header><!-- .entry-header -->

    <?php if (is_singular()) { ?>
  	<div class="entry-content">
  		<?php
    the_content(
      sprintf(
        wp_kses(
          /* translators: %s: Name of current post. Only visible to screen readers */
          __('Continue reading<span class="sr-only"> "%s"</span>', 'seattle'),
          array(
            'span' => array(
              'class' => array(),
            ),
          ),
        ),
        get_the_title(),
      ),
    );
    wp_link_pages(array(
      'before' => '<div class="page-links">' . esc_html__('Pages:', 'seattle'),
      'after' => '</div>',
    ));
    ?>
  	</div><!-- .entry-content -->
      <footer class="entry-footer">
    		<?php seattle_entry_footer(); ?>
    	</footer><!-- .entry-footer -->
    <?php } ?>
  </a>
</<?php echo $element; ?>><!-- #post-<?php the_ID(); ?> -->
