<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Seattle
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="article-wrap">

	<?php if ( has_post_thumbnail() ) { ?>
	<div class="photo layout-single-column">
	<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), '_bellevue-large');
	echo '<a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" >'; ?>
	<figure><?php the_post_thumbnail('large');?></figure>
	<?php echo '</a>'; ?> </div>
	<?php } ?>

	<header class="entry-header layout-single-column">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content layout-single-column">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'seattle' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<footer class="entry-footer layout-single-column">
		<?php edit_post_link( __( 'Edit', 'seattle' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</div>
</article><!-- #post-## -->
