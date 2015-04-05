<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Saga
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function saga_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );

	/**
	* Add theme support for Site logo
	* See: http://jetpack.me/support/site-logo/
	*/
	add_image_size( 'saga-logo', 240, 240 );
	
	$args = array(
		'size' => 'saga-logo',
	);
	add_theme_support( 'site-logo', $args );

	/**
	* Add theme support for responsive videos
	*/
	add_theme_support( 'jetpack-responsive-videos' );

}
add_action( 'after_setup_theme', 'saga_jetpack_setup' );
