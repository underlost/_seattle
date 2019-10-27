<?php
/**
 * Seattle functions and definitions
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

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'seattle' ),
      'menu-2' => esc_html__( 'Footer', 'seattle' ),
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

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		* Add post type formats
		*
		* @link https://codex.wordpress.org/Post_Formats
		*/

		add_theme_support( 'post-formats', array(
			'aside',
			'gallery',
			'video',
		));
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
	$GLOBALS['content_width'] = apply_filters( 'seattle_content_width', 940 );
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
  wp_deregister_script('jquery');
  wp_enqueue_style( 'seattle-style', get_template_directory_uri() . '/dist/css/site.min.css', array(), '20181215', 'screen' );
  wp_enqueue_script( 'seattle-js', get_template_directory_uri() . '/dist/js/site.min.js', array(), '20181215', true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'seattle_scripts' );

add_filter('manage_posts_columns', 'add_img_column');
add_filter('manage_posts_custom_column', 'manage_img_column', 10, 2);

function add_img_column($columns) {
  $columns = array_slice($columns, 0, 1, true) + array("img" => "Featured Image") + array_slice($columns, 1, count($columns) - 1, true);
  return $columns;
}

function manage_img_column($column_name, $post_id) {
 if( $column_name == 'img' ) {
  echo get_the_post_thumbnail($post_id, 'thumbnail');
 }
 return $column_name;
}

// Global variables
require get_template_directory() . '/inc/globals.php';
require get_template_directory() . '/inc/utils.php';

// Custom template tags for this theme.
require get_template_directory() . '/inc/template-tags.php';

// Functions which enhance the theme by hooking into WordPress.
require get_template_directory() . '/inc/template-functions.php';

// Custom nav walker to make site compatible with bootstrap
require_once get_template_directory() . '/inc/wp_bootstrap_navwalker.php';

// Load Jetpack compatibility file.
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

// Load WooCommerce compatibility file.
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

// Post type meta settings
require get_template_directory() . '/inc/post_type/post-meta.php';
require get_template_directory() . '/inc/post_type/attachment-meta.php';
require get_template_directory() . '/inc/gallery-metabox/gallery.php';

// Theme Options
require get_template_directory() . '/inc/theme_settings.php';
