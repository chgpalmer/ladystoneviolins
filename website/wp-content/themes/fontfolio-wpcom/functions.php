<?php
/**
 * Fontfolio functions and definitions
 *
 * @package Fontfolio
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 788; /* pixels */

function fontfolio_content_width() {
	global $content_width;

	if ( is_page_template( 'nosidebar-page.php' ) )
		$content_width = 1125;
}
add_action( 'template_redirect', 'fontfolio_content_width' );

if ( ! function_exists( 'fontfolio_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function fontfolio_setup() {

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on Fontfolio, use a find and replace
	 * to change 'fontfolio' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'fontfolio', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on home and archives
	 *
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'featured-home-big', 562, 461, true );
	add_image_size( 'featured-home-small', 282, 211, true );
	add_image_size( 'featured-search', 788, 999 );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary'   => __( 'Primary Menu', 'fontfolio' ),
		'secondary' => __( 'Secondary Menu', 'fontfolio' ),
	) );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link', 'gallery' ) );

	/**
	 * Setup the WordPress core custom background feature.
	 */
	add_theme_support( 'custom-background', apply_filters( 'fontfolio_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // fontfolio_setup
add_action( 'after_setup_theme', 'fontfolio_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function fontfolio_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'fontfolio' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'fontfolio_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function fontfolio_scripts() {
	wp_enqueue_style( 'fontfolio-style', get_stylesheet_uri() );

	wp_enqueue_script( 'fontfolio-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'fontfolio-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'fontfolio-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}

	wp_enqueue_style( 'fontfolio-droid-sans' );

}
add_action( 'wp_enqueue_scripts', 'fontfolio_scripts' );

/**
 * Loads the Genericons font file
 */
function fontfolio_genericons() {

	wp_enqueue_style( 'fontfolio-genericons', get_template_directory_uri() . '/font/genericons.css', array(), '2.09' );

}
add_action( 'wp_enqueue_scripts', 'fontfolio_genericons' );

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
 * Load Jetpack compatibility file.
 */
if ( file_exists( get_template_directory() . '/inc/jetpack.php' ) )
	require get_template_directory() . '/inc/jetpack.php';


/**
 * Register Google Fonts
 */
function fontfolio_google_fonts() {

	$protocol = is_ssl() ? 'https' : 'http';

	/*	translators: If there are characters in your language that are not supported
		by Droid Sans, translate this to 'off'. Do not translate into your own language. */

	if ( 'off' !== _x( 'on', 'Droid Sans font: on or off', 'fontfolio' ) ) {

		wp_register_style( 'fontfolio-droid-sans', "$protocol://fonts.googleapis.com/css?family=Droid+Sans:400,700" );

	}

}
add_action( 'init', 'fontfolio_google_fonts' );

/**
 * Enqueue Google Fonts for custom headers
 */
function fontfolio_admin_scripts( $hook_suffix ) {

	if ( 'appearance_page_custom-header' != $hook_suffix )
		return;

	wp_enqueue_style( 'fontfolio-droid-sans' );

}
add_action( 'admin_enqueue_scripts', 'fontfolio_admin_scripts' );

// updater for WordPress.com themes
if ( is_admin() )
	include dirname( __FILE__ ) . '/inc/updater.php';
