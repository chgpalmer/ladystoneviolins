<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Museum
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function museum_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'museum_body_classes' );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function museum_wp_title( $title, $sep ) {
	global $page, $paged;

	if ( is_feed() ) {
		return $title;
	}

	// Add the blog name
	$title .= get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 ) {
		$title .= " $sep " . sprintf( __( 'Page %s', 'museum' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'museum_wp_title', 10, 2 );

/**
 * Add some custom classes to the post container.
 *
 * @param array $classes Classes for the post container
 * @return array
 */
function museum_post_class( $classes, $class, $post_id ) {
	if ( ! is_singular() && has_post_thumbnail( $post_id ) )
		$classes[] = 'with-image';
	elseif ( ! is_singular() && ! has_post_thumbnail( $post_id ) )
		$classes[] = 'no-image';

	return $classes;
}
add_filter( 'post_class', 'museum_post_class', 10, 3 );
