<?php
/**
 * Disable Editor script
 * Removes Gutenberg from specific page templates
**/

function seattke_disable_editor( $id = false ) {

	$excluded_templates = array(
		// Page Templates
		'page-templates/curated-collection.php',
	);

	$excluded_ids = array(
		// get_option( 'page_on_front' )
	);

	if( empty( $id ) )
		return false;

	$id = intval( $id );
	$template = get_page_template_slug( $id );

	return in_array( $id, $excluded_ids ) || in_array( $template, $excluded_templates );
}

//Disable Gutenberg by template
function seattke_disable_gutenberg( $can_edit, $post_type ) {

	if( ! ( is_admin() && !empty( $_GET['post'] ) ) )
		return $can_edit;

	if( seattke_disable_editor( $_GET['post'] ) )
		$can_edit = false;

	return $can_edit;

}
add_filter( 'gutenberg_can_edit_post_type', 'seattke_disable_gutenberg', 10, 2 );
add_filter( 'use_block_editor_for_post_type', 'seattke_disable_gutenberg', 10, 2 );

//Disable Classic Editor by template
function seattke_disable_classic_editor() {

	$screen = get_current_screen();
	if( 'page' !== $screen->id || ! isset( $_GET['post']) )
		return;

	if( seattke_disable_editor( $_GET['post'] ) ) {
		remove_post_type_support( 'page', 'editor' );
	}

}
add_action( 'admin_head', 'seattke_disable_classic_editor' );