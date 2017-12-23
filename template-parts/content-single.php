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
 if(empty($sizeWidth)) { $sizeWidth = 'col-md-4'; }
 if(empty($sizeHeight)) { $sizeHeight = 'grid-md'; }


// Determine size for the container
if ($sizeWidth == 'col-md-5' || 'col-md-4' || 'col-md-3' | 'col-md-2'| 'col-md-1') {
  $colWidth = 'col-md-6';
} elseif ($sizeWidth == 'col-md-6' || 'col-md-7' || 'col-md-8' || 'col-md-9') {
  $colWidth = 'col-md-8';
} elseif ($sizeWidth ==  'col-md-10'  || 'col-md-11' || 'col-md-12') {
  $colWidth = 'col-md-12';
} else {
  $colWidth = 'col-md-12';
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <div class="entry-inner mb-3">
    <div class="row align-items-center">
      <div class="<?php echo $colWidth ?>">
        <div class="featured-image">
          <img src="<?php echo $thumbnail_url ?>" alt="<?php the_title(); ?>" />
        </div>
      </div><!-- .col-md-6 -->
    <div class="col-md-6">
      <div class="entry-details px-4">
      <header class="entry-header pt-4 mb-4">
        <?php
        if ( is_singular() ) :
          the_title( '<h1 class="entry-title mb-0">', '</h1>' );
        else :
          the_title( '<h2 class="entry-title mb-0"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
        endif;

        if ( 'post' === get_post_type() ) : ?>
        <div class="entry-meta">
          <?php seattle_posted_on(); ?>
        </div><!-- .entry-meta -->
        <?php
        endif; ?>
      </header><!-- .entry-header -->

      <div class="entry-content">
    		<?php
    			the_content( sprintf(
    				wp_kses(
    					/* translators: %s: Name of current post. Only visible to screen readers */
    					__( 'Continue reading<span class="screen-reader-text sr-only"> "%s"</span>', 'seattle' ),
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

      <footer class="entry-footer pb-4">
    		<?php seattle_entry_footer(); ?>
    	</footer><!-- .entry-footer -->
    </div><!-- .entry-details -->
    </div><!-- .col-md-6 -->
  </div><!-- .entry-inner-->
  </div>





</article><!-- #post-<?php the_ID(); ?> -->
