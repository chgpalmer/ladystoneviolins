<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Museum
 */

function museum_jetpack_setup() {
	/**
	 * add theme support for infinite scroll.
	 * see: http://jetpack.me/support/infinite-scroll/
	 */
	add_theme_support( 'infinite-scroll', array(
		'wrapper'        => false,
		'container'      => 'main',
		'footer'         => 'page',
		'footer_widgets' => array( 'sidebar-1', 'sidebar-2' ),
	) );

	/**
	 * Add theme support for Responsive Videos.
	 */
	add_theme_support( 'jetpack-responsive-videos' );

	/**
	 * Add theme support for Site Logo.
	 */
	add_theme_support( 'site-logo', array( 'size' => 'small' ) );
}
add_action( 'after_setup_theme', 'museum_jetpack_setup' );
