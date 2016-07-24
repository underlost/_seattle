<?php
/**
 * Seattle Theme Customizer.
 *
 * @package Seattle
 */

function get_typekit_id() {
	return get_option( 'seattle_customizer_typekit', '' );
}

function sanitize_typekit_id( $id ) {
	return preg_replace( '/[^0-9a-z]+/', '', $id );
}

function sanitize_checkbox( $input ) {
    if( 1 == $input ) {
        return 1;
    } else {
        return '';
    }
}

function seattle_typekit_register( $wp_customize ) {
    $wp_customize->add_section( 'seattle_typekit', array(
        'title'           => __( 'Typekit', 'seattle' ),
        'priority'        => 1,
    ) );

	$wp_customize->add_setting( 'seattle_customizer_typekit', array(
		'sanitize_callback' => 'seattle_sanitize_text',
		'transport'         => 'postMessage',
	));

	$wp_customize->add_control( 'seattle_customizer_typekit', array(
		'label'    => esc_html__( 'Typekit ID', 'seattle' ),
		'section'  => 'seattle_typekit',
		'settings' => 'seattle_customizer_typekit',
		'type'     => 'text',
		'priority' => 1
    ));

    $wp_customize->add_setting( 'seattle_disable_typekit', array(
		'default'           => 0,
		'type'              => 'option',
		'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
		'transport'         => 'postMessage',
		'capability'        => 'edit_theme_options',
	));

	$wp_customize->add_control( 'disable_typekit', array(
		'type'            => 'checkbox',
		'label'           => __( 'Disable Typekit', 'seattle' ),
		'description'     => __( 'Check to disable the Typekit.', 'seattle' ),
		'section'         => 'seattle_customizer_typekit',
		'settings'        => 'seattle_disable_typekit',
		'priority'        => 1,
	));
}
add_action( 'customize_register', 'seattle_typekit_register' );

function seattle_load_typekit() {

	// Check for a saved Typekit Kit ID
	$id = get_typekit_id();

	// If we have a kit ID and not disabled, load Typekit
	if ( '' !== $id
	&& '' == get_option( 'seattle_disable_typekit', '' ) ) : ?>
	<script type="text/javascript" src="//use.typekit.net/<?php echo sanitize_typekit_id( $id ); ?>.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
	<?php endif;
}
add_action( 'wp_head', 'seattle_load_typekit' );
