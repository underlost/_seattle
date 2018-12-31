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
if(empty($sizeWidth)) { $sizeWidth = 'col-md-4'; }
if(empty($sizeHeight)) { $sizeHeight = 'grid-md'; }

$classes = array(
  $sizeWidth,
  $sizeHeight,
  'grid-item',
  'grid-item-clickable',
);

if ($format == 'aside') {
  $element = 'aside';
  $lightbox = 'data-featherlight="'.$thumbnail_url.'"';
} else {
  $element = 'article';
}
?>

<<?php echo $element; ?> id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
  <a href="<?php echo $url; ?>" rel="bookmark" <?php echo $lightbox; ?> class="post-inner d-flex align-items-center fsr-holder fsr-lazy" data-src="<?php echo $thumbnail_url ?>">
    <img src="<?php echo $thumbnail_url ?>" alt="<?php the_title(); ?>" class="sr-only" />
  	<header class="entry-header text-center">
  		<?php if ( is_singular() ) :
  			the_title( '<h1 class="entry-title">', '</h1>' );
  		else :
  			the_title( '<h4 class="entry-title h4">', '</h4>' );
  		endif;
  		if ( 'post' === get_post_type() ) : ?>
  		<div class="entry-meta">
  			<?php seattle_posted_on(); ?>
  		</div><!-- .entry-meta -->
  		<?php
  		endif; ?>
  	</header><!-- .entry-header -->

    <?php if ( is_singular() ) {?>
  	<div class="entry-content">
  		<?php
  			the_content( sprintf(
  				wp_kses(
  					/* translators: %s: Name of current post. Only visible to screen readers */
  					__( 'Continue reading<span class="sr-only"> "%s"</span>', 'seattle' ),
  					array(
  						'span' => array(
  							'class' => array(),
  						),
  					)
  				),
  				get_the_title()
  			) );

  			wp_link_pages( array(
  				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'seattle' ),
  				'after'  => '</div>',
  			) );
  		?>
  	</div><!-- .entry-content -->
      <footer class="entry-footer">
    		<?php seattle_entry_footer(); ?>
    	</footer><!-- .entry-footer -->
    <?php } ?>

  </a>
</<?php echo $element; ?>><!-- #post-<?php the_ID(); ?> -->
