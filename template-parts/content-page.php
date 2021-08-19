<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Seattle
 */

$square_thumbnail = true;
$thumbnail_arr = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $square_thumbnail ? 'large' : 'medium');
$thumbnail_url = !empty($thumbnail_arr[0]) ? $thumbnail_arr[0] : '';
$images = get_post_meta($post->ID, 'seattle_gallery_id', true);

$classes = array('row', 'mb-4', 'justify-content-center', );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
  
  <div class="col-lg-6 order-lg-1 py-lg-5">
		<header class="entry-header ps-lg-5 mt-4">
			<?php the_title('<h1 class="entry-title h1">', '</h1>'); ?>
		</header><!-- .entry-header -->
		<div class="entry-content ps-lg-5">
		<?php
      the_content();
      wp_link_pages(array(
        'before' => '<div class="page-links">' . esc_html__('Pages:', 'seattle'),
        'after' => '</div>',
      ));
    ?>
		</div><!-- .entry-content -->
		<?php if (get_edit_post_link()): ?>
		<footer class="entry-footer ps-lg-5">
			<?php seattle_entry_footer(); ?>
		</footer><!-- .entry-footer -->
		<?php endif; ?>
  </div>
	
	<?php if ( !empty($thumbnail_url) || !empty($images) ) { ?>
	<div class="offset-lg-1 col-lg-5 order-md-1">
		<?php if ($thumbnail_url) { ?>
			<div class="featured-image my-2">
				<img src="<?php echo $thumbnail_url; ?>" alt="<?php the_title(); ?>" />
			</div>
  	<?php } ?>
		<?php get_template_part('template-parts/attachment_gallery_page'); ?>
	</div>
	<?php } ?>

</article><!-- #post-<?php the_ID(); ?> -->
