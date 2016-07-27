<?php
/**
 * Seattle functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Seattle
 */

if ( ! function_exists( 'seattle_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function seattle_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Seattle, use a find and replace
	 * to change 'seattle' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'seattle', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

    // Large post image
	add_image_size( 'seattle-full-width', 1200 );

	// Gallery thumb - small
	add_image_size( 'seattle-grid-small', 425 );

	// Gallery thumb - medium
	add_image_size( 'seattle-grid-medium', 650 );

	// Gallery thumb - large
	add_image_size( 'seattle-grid-large', 1300 );

	// Logo size
	add_image_size( 'seattle-logo', 600 );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

    /**
	 * Add video metabox
	 */
	add_theme_support( 'array_themes_video_support' );

    /**
	 * Add Site Logo feature
	 */
	add_theme_support( 'site-logo', array(
		'header-text' => array(
			'titles-wrap',
		),
		'size' => 'seattle-logo',
	) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'seattle' ),
        'footer'  => esc_html__( 'Footer', 'seattle' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'seattle_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

}
endif;
add_action( 'after_setup_theme', 'seattle_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function seattle_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'seattle_content_width', 640 );
}
add_action( 'after_setup_theme', 'seattle_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function seattle_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'seattle' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'seattle' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'seattle_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function seattle_scripts() {
    wp_enqueue_style(
    	'seattle-style', get_template_directory_uri() . '/dist/css/seattle.min.css', array(), '20151215', 'screen'
	);

	wp_enqueue_script(
		'seattle-js', get_template_directory_uri() . '/dist/js/seattle.js', array('jquery'), '20151215', true
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'seattle_scripts' );

/**
 * Add button class to next/previous post links
 */
function seattle_posts_link_attributes() {
	return 'class="btn btn-primary"';
}
add_filter( 'next_posts_link_attributes', 'seattle_posts_link_attributes' );
add_filter( 'previous_posts_link_attributes', 'seattle_posts_link_attributes' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Self-hosted functionality
 */
require get_template_directory() . '/inc/wporg.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Adds extra fields to Wordpress Posts
 */
require get_template_directory() . '/inc/post_extras.php';
