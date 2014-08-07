<?php
/**
 * @package Seattle
 */
?>

<?php if ( has_post_format(array('quote', 'image', 'aside'))  ) : ?>
	<?php if ( has_post_thumbnail() ) : ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>
		<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), '_bellevue-large');
		echo ' style="background-image: url(' . $large_image_url[0] . ')"'; ?>>
	<?php else : ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php endif; ?>
<?php else : ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php endif; ?>

<div class="article-wrap">

	<header class="entry-header layout-single-column">
		<div class="entry-meta">
			<?php edit_post_link( __( '<i class="glyphicon glyphicon-pencil"></i> Edit', 'seattle' ), '<span class="edit-link">', '</span>' ); ?>
			<?php seattle_posted_on(); ?>
			<?php seattle_comments_link(); ?>
		</div><!-- .entry-meta -->

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content layout-single-column">

		<?php if ( has_post_format( array('image', 'aside', 'gallery') )) { ?>
			<?php if ( has_post_thumbnail() ) { ?>
				<div class="photo photo-featured">
				<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'seattle-large');
				echo '<a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" >'; ?>
				<figure class="expand"><?php the_post_thumbnail('large');?></figure>
				<?php echo '</a>'; ?> </div>
			<?php } ?>
		<?php } ?>

		<?php the_content(); ?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'seattle' ),
				'after'  => '</div>',
			) );
		?>

	<?php if ( has_post_format( array('image', 'aside', 'gallery') )) { ?>

		<div class="gallery">

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
						<figure class="expand"><a href="<?php echo $full_img_url; ?>" title="<?php echo $attachment->post_title; ?>" target="_blank">
						<?php echo wp_get_attachment_image($attachment->ID, 'large'); ?> </a></figure>
					</div>
			<?php } ?>
		</div><!-- .gallery -->
	<?php } ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer layout-single-column">
		<?php
			/* translators: used between list items, there is a space after the comma */
			$category_list = get_the_category_list( __( ', ', 'seattle' ) );

			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list( '<div class="tags"><i class="glyphicon glyphicon-tag"></i> ', __( ' <i class="glyphicon glyphicon-tag"></i> ', 'seattle' ), '</div>' );

			if ( ! seattle_categorized_blog() ) {
				// This blog only has 1 category so we just need to worry about tags in the meta text
				if ( '' != $tag_list ) {
					$meta_text = __( 'This entry was tagged %2$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'seattle' );
				} else {
					$meta_text = __( 'Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'seattle' );
				}

			} else {
				// But this blog has loads of categories so we should probably display them here
				if ( '' != $tag_list ) {
					$meta_text = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'seattle' );
				} else {
					$meta_text = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'seattle' );
				}

			} // end check for categories on this blog

			printf(
				$tag_list
			);
		?>

	</footer><!-- .entry-footer -->
	</div>
</article><!-- #post-## -->
