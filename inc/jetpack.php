<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.com/
 *
 * @package Seattle
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 */
function seattle_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'seattle_infinite_scroll_render',
		'footer'    => 'page',
        'wrapper'   => 'new-infinite-posts',
		'type'      => 'click'
	) );

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );
}
add_action( 'after_setup_theme', 'seattle_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function seattle_infinite_scroll_render() {
    while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content', 'grid-item' );
	}
}

/**
 * Changes the text of the "Older posts" button in infinite scroll
 * for portfolio related views.
 */
function seattle_infinite_scroll_button_text( $js_settings ) {
	$js_settings['text'] = esc_html__( 'Load more', 'seattle' );
	return $js_settings;
}
add_filter( 'infinite_scroll_js_settings', 'seattle_infinite_scroll_button_text' );
