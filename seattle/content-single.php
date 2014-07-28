<?php
/**
 * @package seattle
 * @since seattle 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>

		<div class="entry-meta">
			<span class="borders"><span class="glyphicon glyphicon-time"></span> <?php seattle_posted_on(); ?>
			<span class="glyphicon glyphicon-comment"></span> <?php comments_popup_link( __( 'No comments', 'seattle' ), __( '1 Comment', 'seattle' ), __( '% Comments', 'seattle' ) ); ?>
			</span>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'seattle' ), 'after' => '</div>' ) ); ?>
		
		
		<div class="gallery">
		
		<?php if ( has_post_thumbnail() ) { ?>
		<div class="photo">
		<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
		echo '<a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" >';
		the_post_thumbnail('large');
		echo '</a>'; ?> </div>
		<?php } ?>
		
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
		        <div class="photo">
					<a href="<?php echo $full_img_url; ?>" title="<?php echo $attachment->post_title; ?>" target="_blank">
					<?php echo wp_get_attachment_image($attachment->ID, 'large'); ?> </a>
				</div>
		<?php } ?>
		
		</div>
	
	
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php
			/* translators: used between list items, there is a space after the comma */
			$category_list = get_the_category_list( __( ', ', 'seattle' ) );

			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list( '', ', ' );

			if ( ! seattle_categorized_blog() ) {
				// This blog only has 1 category so we just need to worry about tags in the meta text
				if ( '' != $tag_list ) {
					$meta_text = __( 'This entry was tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'seattle' );
				} else {
					$meta_text = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'seattle' );
				}

			} else {
				// But this blog has loads of categories so we should probably display them here
				if ( '' != $tag_list ) {
					$meta_text = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'seattle' );
				} else {
					$meta_text = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'seattle' );
				}

			} // end check for categories on this blog

			printf(
				$meta_text,
				$category_list,
				$tag_list,
				get_permalink(),
				the_title_attribute( 'echo=0' )
			);
		?>

		<?php edit_post_link( __( 'Edit', 'seattle' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
