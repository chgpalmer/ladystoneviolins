<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Saga
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function saga_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	if ( is_singular() || is_404() ) {
		$classes[] = 'singular';
	} else {
		$classes[] = 'plural';
	}

	// add paged class if pagination links are present
	global $wp_query;
	$big = 999999999;
	$paginate_links = paginate_links( array(
		'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
		'current' => max( 1, get_query_var('paged') ),
		'total' => $wp_query->max_num_pages,
		'mid_size' => 2
	) );

	if ( $paginate_links ) {
		$classes[] = 'paged';
	}


	return $classes;
}
add_filter( 'body_class', 'saga_body_classes' );

/**
 * Adds custom classes to the array of post classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function saga_post_classes( $classes ) {
	if ( has_post_thumbnail() && 'image' !== get_post_format() ) {
		$classes[] = 'featured-img';
	}
	
	return $classes;
}
add_filter( 'post_class', 'saga_post_classes' );

if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ) :
	/**
	 * Filters wp_title to print a neat <title> tag based on what is being viewed.
	 *
	 * @param string $title Default title text for current view.
	 * @param string $sep Optional separator.
	 * @return string The filtered title.
	 */
	function saga_wp_title( $title, $sep ) {
		if ( is_feed() ) {
			return $title;
		}

		global $page, $paged;

		// Add the blog name
		$title .= get_bloginfo( 'name', 'display' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title .= " $sep $site_description";
		}

		// Add a page number if necessary:
		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			$title .= " $sep " . sprintf( __( 'Page %s', 'saga' ), max( $paged, $page ) );
		}

		return $title;
	}
	add_filter( 'wp_title', 'saga_wp_title', 10, 2 );

	/**
	 * Title shim for sites older than WordPress 4.1.
	 *
	 * @link https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
	 * @todo Remove this function when WordPress 4.3 is released.
	 */
	function saga_render_title() {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}
	add_action( 'wp_head', 'saga_render_title' );
endif;

/**
 * Regex the 1st gallery shortcode from Gallery post content.
 */
function saga_strip_first_gallery( $content ) {
	
	$regex = '/\[gallery.*]/';
	$content = preg_replace( $regex, '', $content, 1 );

	return $content;
}
add_filter( 'the_content', 'saga_strip_first_gallery' );

/**
 * Echo the first image attached to post
 */
function saga_the_first_image( $size = 'thumbnail', $post_id = null ) {
	$post_id = ( null === $post_id ) ? get_the_ID() : $post_id;

	$query_args = array(
		'post_parent' => $post_id,
		'post_type' => 'attachment',
		'numberposts' => 1,
		'order' => 'ASC',
		'orderby' => 'menu_order',
		'post_mime_type' => 'image'
	);
	$images = get_children( $query_args );
	if ( $images ) {
		foreach ( $images as $image ) {
			echo wp_get_attachment_image( $image->ID, $size );
		} // endforeach
	} // endif ( $images )
}


/**
 * Returns the URL from the post.
 *
 * @uses get_the_link() to get the URL in the post meta (if it exists) or
 * the first link found in the post content.
 *
 * Falls back to the post permalink if no URL is found in the post.
 *
 * @return string URL
 */
function saga_get_link_url() {
	$content = get_the_content();
	$has_url = get_url_in_content( $content );

	return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}

