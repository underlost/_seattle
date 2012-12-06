<?php
/**
 * @package seattle
 * @since seattle 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() ) { ?>
	<div class="photo">
	<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'seattle-large');
	echo '<a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" >';
	the_post_thumbnail('large');
	echo '</a>'; ?> </div>
	<?php } ?>
	
	<header class="entry-header">
	
	<?php if ( in_category( 'instagram' )) { ?>
		<div class="instagramy">
		<img width="32" height="32" src="<?php bloginfo('template_url'); ?>/img/instagram.jpg" class="instagram-thumbnail" alt="Taken with Instagram" title="Taken with Instagram" />		
		</div>
	<?php } ?>
	
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'seattle' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<span class="borders"><i class="icon-time"></i> <?php seattle_posted_on(); ?>
			<i class="icon-comment"></i> <?php comments_popup_link( __( 'No comments', 'seattle' ), __( '1 Comment', 'seattle' ), __( '% Comments', 'seattle' ) ); ?>
			</span>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'seattle' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'seattle' ), 'after' => '</div>' ) ); ?>
	
	
	<div class="thumbs">
	<?php
	$thumb_ID = get_post_thumbnail_id( $post->ID );
	$attachments = get_children(array(
		'post_type' => 'attachment',
		'numberposts' => -1,
		'exclude' => $thumb_ID,
		'post_parent' => $post->ID,
		'post_status' => 'inherit',
		'post_mime_type' => 'image',
		'order' => 'ASC',
		'orderby' => 'menu_order ID'));
	
	foreach($attachments as $att_id => $attachment) {
		$full_img_url = wp_get_attachment_url($attachment->ID);
	        $split_pos = strpos($full_img_url, 'wp-content');
	        $split_len = (strlen($full_img_url) - $split_pos);
	        $abs_img_url = substr($full_img_url, $split_pos, $split_len);
	        $full_info = @getimagesize(ABSPATH.$abs_img_url);
	        ?>
	        <div class="thumb">
				<a href="<?php echo $full_img_url; ?>" title="<?php echo $attachment->post_title; ?>" target="_blank">
				<?php echo wp_get_attachment_image($attachment->ID, 'thumbnail'); ?> </a>
			</div>
	<?php } ?>
	
	</div>

	
	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-meta">
		<?php edit_post_link( __( 'Edit', 'seattle' ), '<span class="sep"> | </span><span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->

</article><!-- #post-<?php the_ID(); ?> -->
