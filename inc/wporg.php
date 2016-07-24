<?php
/**
 * Self-hosted functionality not to be included on WordPress.com
 *
 * @package Seattle
 */

/**
 * Registers additional customizer controls
 */
function array_register_customizer_options( $wp_customize ) {

	// Border Color
	$wp_customize->add_setting( 'seattle_customizer_border_color', array(
		'default'           => '#333',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'seattle_customizer_border_color', array(
		'label'    => esc_html__( 'Border Color', 'seattle' ),
		'section'  => 'colors',
		'settings' => 'seattle_customizer_border_color',
		'priority' => 15
	) ) );


	// Border Width
	$wp_customize->add_setting( 'seattle_customizer_border_width', array(
		'default'           => '0',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'seattle_sanitize_range',
	) );

	$wp_customize->add_control( 'seattle_customizer_border_width', array(
		'type'        => 'range',
		'priority'    => 16,
		'section'     => 'colors',
		'label'       => esc_html__( 'Body Border Width', 'seattle' ),
		'priority'    => 10,
		'input_attrs' => array(
			'min'   => 0,
			'max'   => 50,
			'step'  => 1,
			'style' => 'width: 100%',
		),
	) );

	// Body Text Color
	$wp_customize->add_setting( 'seattle_customizer_body_text', array(
		'default'           => '#666',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'seattle_customizer_body_text', array(
		'label'    => esc_html__( 'Body Text Color', 'seattle' ),
		'section'  => 'colors',
		'settings' => 'seattle_customizer_body_text',
		'priority' => 15
	) ) );

	// Accent Color
	$wp_customize->add_setting( 'seattle_customizer_accent_color', array(
		'default'           => '#a1a1a1',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'seattle_customizer_accent_color', array(
		'label'    => esc_html__( 'Accent Color', 'seattle' ),
		'section'  => 'colors',
		'settings' => 'seattle_customizer_accent_color',
		'priority' => 20
	) ) );

	// Button Color
	$wp_customize->add_setting( 'seattle_customizer_button_color', array(
		'default'           => '#999',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'seattle_customizer_button_color', array(
		'label'    => esc_html__( 'Button Color', 'seattle' ),
		'section'  => 'colors',
		'settings' => 'seattle_customizer_button_color',
		'priority' => 25
	) ) );

	// Custom CSS
	$wp_customize->add_setting( 'seattle_customizer_css',
		array(
			'default'              => '',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'seattle_sanitize_textarea',
			'sanitize_js_callback' => 'wp_filter_nohtml_kses',
		)
	);

	$wp_customize->add_control( 'seattle_customizer_css_control', array(
			'label'     => esc_html__( 'Custom CSS', 'seattle' ),
			'section'   => 'colors',
			'settings'  => 'seattle_customizer_css',
			'type'      => 'textarea',
			'priority'  => 30
		)
	);


	// Footer tagline
	$wp_customize->add_setting( 'seattle_customizer_footer_text', array(
		'sanitize_callback' => 'seattle_sanitize_text',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'seattle_customizer_footer_text', array(
			'label'    => esc_html__( 'Footer Tagline', 'seattle' ),
			'section'  => 'seattle_customizer_basic',
			'settings' => 'seattle_customizer_footer_text',
			'type'     => 'text',
			'priority' => 20
		)
	);
}
add_action( 'customize_register', 'array_register_customizer_options' );


/**
 * Add infinite-scroll class if active
 */
function seattle_is_class( $classes ) {
	if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) {
		$classes[] = 'infinite-scroll';
	}

	return $classes;
}
add_filter( 'body_class', 'seattle_is_class' );


/**
 * Add Customizer CSS To Header
 */
function seattle_customizer_css() {
	?>
	<style type="text/css">
		body {
			color: <?php echo get_theme_mod( 'seattle_customizer_body_text', '#333' ); ?>;
			border-color: <?php echo get_theme_mod( 'seattle_customizer_border_color', '#333' ); ?>;
			border-width: <?php echo get_theme_mod( 'seattle_customizer_border_width', '0' ); ?>px;
		}

		.entry-content a {
			border-color: <?php echo get_theme_mod( 'seattle_customizer_accent_color', '#999' ); ?>;
		}

		button,
		input[type="button"],
		input[type="reset"],
		input[type="submit"],
		.button,
		.comment-navigation a {
			background: <?php echo get_theme_mod( 'seattle_customizer_button_color', '#333' ); ?>;
		}

		<?php echo get_theme_mod( 'seattle_customizer_css' ); ?>
	</style>
<?php
}
add_action( 'wp_head', 'seattle_customizer_css' );


/**
 * Replaces the footer tagline text
 */
function seattle_filter_footer_text() {

	// Get the footer copyright text
	$footer_copy_text = get_theme_mod( 'seattle_customizer_footer_text' );

	if ( $footer_copy_text ) {
		// If we have footer text, use it
		$footer_text = $footer_copy_text;
	} else {
		// Otherwise show the fallback theme text
		$footer_text = '&copy; ' . date("Y") . sprintf( esc_html__( ' %1$s Theme by %2$s.', 'seattle' ), 'Seattle', '<a href="https://underlost.net" rel="nofollow">underlost.net</a>' );
	}

	return $footer_text;

}
add_filter( 'seattle_footer_text', 'seattle_filter_footer_text' );
