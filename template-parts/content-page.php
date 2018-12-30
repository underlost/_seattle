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

 $classes = array(
   'row',
   'mb-4',
 );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
  <?php if ($thumbnail_url) {?>
  <div class="col-md-5 offset-md-1 order-md-12">
    <div class="featured-image">
      <img src="<?php echo $thumbnail_url ?>" alt="<?php the_title(); ?>" />
    </div>
    <?php get_template_part( 'template-parts/attachment_gallery' ); ?>
  </div>
  <?php } ?>
  <div class="col-md-6 order-md-1">
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->
	<div class="entry-content">
		<?php
			the_content();
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'seattle' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
				edit_post_link(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Edit <span class="screen-reader-text sr-only">%s</span>', 'seattle' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>

  </div>
</article><!-- #post-<?php the_ID(); ?> -->
