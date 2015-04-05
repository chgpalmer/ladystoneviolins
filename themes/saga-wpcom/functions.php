<?php
/**
 * saga functions and definitions
 *
 * @package Saga
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1024; /* pixels */
}

if ( ! function_exists( 'saga_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function saga_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on saga, use a find and replace
	 * to change 'saga' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'saga', get_template_directory() . '/languages' );

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
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'saga-featured', 1024, 666, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'saga' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link', 'audio', 'gallery', 'status'
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'saga_custom_background_args', array(
		'default-color' => '151515',
		'default-image' => '',
	) ) );
}
endif; // saga_setup
add_action( 'after_setup_theme', 'saga_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function saga_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Menu Widget Area', 'saga' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'saga_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function saga_scripts() {

	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.3' );

	wp_enqueue_style( 'saga-style', get_stylesheet_uri() );

	wp_enqueue_script( 'saga-navigation', get_template_directory_uri() . '/js/navigation.js', array( 'jquery' ), '20120206', true );

	wp_enqueue_script( 'saga-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_style( 'saga-fonts', saga_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'saga_scripts' );

/**
 * Register Google Fonts
 */
function saga_fonts_url() {
  $fonts_url = '';

  $font_families = array();

	/* Translators: If there are characters in your language that are not
	 * supported by Playfair Display, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$playfair_display = _x( 'on', 'Playfair Display font: on or off', 'saga' );

	if ( 'off' !== $playfair_display ) {

		$font_families[] = 'Playfair Display:400,400italic,700,700italic,900,900italic';

	}

  /* Translators: If there are characters in your language that are not
	 * supported by Lato, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$lato = _x( 'on', 'Lato font: on or off', 'saga' );

	if ( 'off' !== $lato ) {

		$font_families[] = 'Lato:400,300,300italic,400italic,700,700italic,900,900italic';

	}

	if ( 'off' !== $playfair_display || 'off' !== $lato ) {

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
	}

	return $fonts_url;

}

/* Reduce the default excerpt length to avoid breakage in the layout */
function saga_custom_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'saga_custom_excerpt_length', 999 );

/**
 * Enqueue Google Fonts for Editor Styles
 */
function saga_editor_styles() {
    add_editor_style( array( 'editor-style.css', saga_fonts_url() ) );
}
add_action( 'after_setup_theme', 'saga_editor_styles' );

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
require get_template_directory() . '/inc/jetpack.php';


// updater for WordPress.com themes
if ( is_admin() )
	include dirname( __FILE__ ) . '/inc/updater.php';
