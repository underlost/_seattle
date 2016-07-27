<?php
/**
 * Seattle Theme Customizer.
 *
 * @package Seattle
 */


// Sanitize gallery select option
function seattle_sanitize_gallery_select( $layout ) {
    if ( ! in_array( $layout, array(
        'portfolio-grid-large',
        'portfolio-grid-medium',
        'portfolio-grid-small'
    ) ) ) { $layout = 'portfolio-grid-medium'; }
    return $layout;
}

//Sanitize text
function seattle_sanitize_text( $input ) {
	return wp_kses_post( force_balance_tags( $input ) );
}

// Sanitize textarea output
function seattle_sanitize_textarea( $text ) {
    return esc_textarea( $text );
}

// Sanitize title select option
function seattle_sanitize_title_select( $title ) {
   if ( ! in_array( $title, array( 'show', 'hover' ) ) ) {
       $title = 'hover';
   }
   return $title;
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function seattle_customizer_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

    $wp_customize->add_section( 'seattle_customizer_basic', array(
		'title'    => esc_html__( 'Theme Options', 'seattle' ),
		'priority' => 1
	) );

    // Logo and header text options - only show if Site Logos is not supported
	if ( ! function_exists( 'jetpack_the_site_logo' ) ) {
		$wp_customize->add_setting( 'seattle_customizer_logo', array(
			'transport'         => 'postMessage',
			'sanitize_callback' => 'seattle_sanitize_text'
		) );

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'seattle_customizer_logo', array(
			'label'    => esc_html__( 'Logo Upload', 'seattle' ),
			'section'  => 'title_tagline',
			'settings' => 'seattle_customizer_logo',
		) ) );
	}

    // Homepage Intro Title
	$wp_customize->add_setting( 'seattle_customizer_homepage_title', array(
		'sanitize_callback' => 'seattle_sanitize_text',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'seattle_customizer_homepage_title', array(
			'label'    => esc_html__( 'Homepage Intro Title', 'seattle' ),
			'section'  => 'seattle_customizer_basic',
			'settings' => 'seattle_customizer_homepage_title',
			'type'     => 'text',
			'priority' => 1
		)
	);
	// Homepage Intro Text
	$wp_customize->add_setting( 'seattle_customizer_homepage_text',
		array(
			'default'              => '',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'seattle_sanitize_textarea',
			'sanitize_js_callback' => 'wp_filter_nohtml_kses',
			'transport'            => 'postMessage',
		)
	);

	$wp_customize->add_control( 'seattle_customizer_homepage_text_control', array(
			'label'     => esc_html__( 'Homepage Intro Text', 'seattle' ),
			'section'   => 'seattle_customizer_basic',
			'settings'  => 'seattle_customizer_homepage_text',
			'type'      => 'textarea',
			'priority'  => 2
		)
	);

    // Grid Layout
	$wp_customize->add_setting( 'seattle_customizer_gallery_style', array(
		'default'           => 'portfolio-grid-medium',
		'capability'        => 'edit_theme_options',
		'type'              => 'option',
		'sanitize_callback' => 'seattle_sanitize_gallery_select',

	));

	$wp_customize->add_control( 'seattle_customizer_gallery_select', array(
		'settings' => 'seattle_customizer_gallery_style',
		'label'    => esc_html__( 'Grid Layout', 'seattle' ),
		'section'  => 'seattle_customizer_basic',
		'type'     => 'select',
		'choices'  => array(
			'portfolio-grid-large'  => esc_html__( 'One Column', 'seattle' ),
			'portfolio-grid-medium' => esc_html__( 'Two Column', 'seattle' ),
			'portfolio-grid-small'  => esc_html__( 'Three Column', 'seattle' ),
		),
		'priority' => 3
	) );

    // Always show titles
	$wp_customize->add_setting( 'seattle_customizer_show_titles', array(
		'default'           => 'hide',
		'capability'        => 'edit_theme_options',
		'type'              => 'option',
		'sanitize_callback' => 'seattle_sanitize_title_select',
	));

	$wp_customize->add_control( 'seattle_customizer_title_select', array(
		'settings' => 'seattle_customizer_show_titles',
		'label'    => esc_html__( 'Grid Post Titles', 'seattle' ),
		'section'  => 'seattle_customizer_basic',
		'type'     => 'select',
		'choices'  => array(
			'hover' => esc_html__( 'Show on hover', 'seattle' ),
			'show'  => esc_html__( 'Always show', 'seattle' ),
		),
		'priority' => 5
	) );

    $wp_customize->add_setting( '_disable_typekit', array(
        'default'           => 0,
        'type'              => 'option',
        'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
        'transport'         => 'postMessage',
        'capability'        => 'edit_theme_options',
    ) );

    $wp_customize->add_control( 'disable_typekit', array(
        'type'            => 'checkbox',
        'label'           => __( 'Disable Typekit', 'seattle' ),
        'description'     => __( 'Check to disable the Typekit fonts included with this theme if you would like to use your own fonts.', 'seattle' ),
        'section'         => 'typekit',
        'settings'        => '_disable_typekit',
        'priority'        => 1,
        'active_callback' => array( $this, 'active_license' ),
    ) );
}
add_action( 'customize_register', 'seattle_customizer_register' );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function seattle_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
}
add_action( 'customize_register', 'seattle_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function seattle_customize_preview_js() {
	wp_enqueue_script( 'seattle_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'seattle_customize_preview_js' );
