<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Seattle
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
			if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php seattle_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->

    <!-- Grab the video -->
	<?php if ( get_post_meta( $post->ID, 'array-video', true ) ) { ?>
		<div class="featured-video">
			<?php echo get_post_meta( $post->ID, 'array-video', true ) ?>
		</div>
	<?php } else if ( has_post_thumbnail() ) { ?>
		<!-- Grab the featured image -->
		<div class="featured-image fadeInUpImage"><?php the_post_thumbnail( 'candid-full-width' ); ?></div>
	<?php } ?>

	<!-- Grab the excerpt to use as a byline -->
	<?php if ( has_excerpt() ) { ?>
		<div class="entry-excerpt">
			<?php the_excerpt(); ?>
		</div>
	<?php } ?>

    <div class="entry-content">
		<?php the_content( esc_html__( 'Read More', 'seattle' ) ); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'seattle' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php seattle_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
