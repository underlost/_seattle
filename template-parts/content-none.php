<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Seattle
 */

?>

<section class="no-results not-found grid-item col-12">
	<div class="page-content text-center py-5">

    <header class="px-4 py-2 mb-2">
      <h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'seattle' ); ?></h1>
    </header><!-- .page-header -->

		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
		<?php elseif ( is_search() ) : ?>
			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'seattle' ); ?></p>
			<?php else : ?>
			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for.', 'seattle' ); ?></p>
			<?php endif; ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
