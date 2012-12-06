<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package seattle
 * @since seattle 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() ) { ?>
	<div class="photo">
	<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
	echo '<a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" >';
	the_post_thumbnail('large');
	echo '</a>'; ?> </div>
	<?php } ?>
	
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'seattle' ), 'after' => '</div>' ) ); ?>
		<?php edit_post_link( __( 'Edit', 'seattle' ), '<span class="edit-link">', '</span>' ); ?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
