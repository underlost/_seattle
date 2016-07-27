<?php


function post_size_get_meta( $value ) {
	global $post;

	$field = get_post_meta( $post->ID, $value, true );
	if ( ! empty( $field ) ) {
		return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
	} else {
		return false;
	}
}

function post_size_add_meta_box() {
	add_meta_box(
		'post_size-post-size',
		__( 'Post Size', 'post_size' ),
		'post_size_html',
		'post',
		'side',
		'default'
	);
}
add_action( 'add_meta_boxes', 'post_size_add_meta_box' );

function post_size_html( $post) {

    // Post Sizes
    $size1 = 'col-xs-12 col-sm-12 col-md-12';
    $size2 = 'col-xs-12 col-sm-12 col-md-6';
    $size3 = 'col-xs-12 col-sm-12 col-md-4';
    $size4 = 'col-xs-12 col-sm-12 col-md-8';

	wp_nonce_field( '_post_size_nonce', 'post_size_nonce' ); ?>

	<p>Size of Post</p>

	<p>
		<label for="post_col_size"><?php _e( 'Size', 'post_size' ); ?></label><br>
		<select name="post_col_size" id="post_col_size">
			<option <?php echo (post_size_get_meta( 'post_col_size' ) === $size1 ) ? 'selected' : '' ?>>Full-width (12-COL)</option>
			<option <?php echo (post_size_get_meta( 'post_col_size' ) === $size2 ) ? 'selected' : '' ?>>Half (6-COL)</option>
			<option <?php echo (post_size_get_meta( 'post_col_size' ) === $size3 ) ? 'selected' : '' ?>>1/3 (4-COL)</option>
			<option <?php echo (post_size_get_meta( 'post_col_size' ) === $size4 ) ? 'selected' : '' ?>>2/3 (8-COL)</option>
			<option <?php echo (post_size_get_meta( 'post_col_size' ) === '' ) ? 'selected' : '' ?>></option>
		</select>
	</p><?php
}

function post_size_save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! isset( $_POST['post_size_nonce'] ) || ! wp_verify_nonce( $_POST['post_size_nonce'], '_post_size_nonce' ) ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

	if ( isset( $_POST['post_col_size'] ) )
		update_post_meta( $post_id, 'post_col_size', esc_attr( $_POST['post_col_size'] ) );
}
add_action( 'save_post', 'post_size_save' );

/*
	Usage: post_size_get_meta( 'post_col_size' )
*/
