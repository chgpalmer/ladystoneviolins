<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Fontfolio
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function fontfolio_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container'      => 'content',
		'footer'         => 'page',
		'wrapper'        => false,
		'render'         => 'fontfolio_infinite_scroll_render',
		'posts_per_page' => 9
	) );

	/* Enable Social Links */
	add_theme_support( 'social-links', array(
		'facebook', 'twitter', 'tumblr', 'linkedin'
	) );
}
add_action( 'after_setup_theme', 'fontfolio_jetpack_setup' );

function fontfolio_infinite_scroll_render() {
	while ( have_posts() ) : the_post();

		get_template_part( 'content', get_post_format() );

		$fontfolio_count++;

	endwhile;
}
