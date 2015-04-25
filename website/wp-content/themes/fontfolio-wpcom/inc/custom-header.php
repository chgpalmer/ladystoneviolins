<?php
/**
 * @package Fontfolio
 */

/**
 * Setup the WordPress core custom header feature.
 *
 * @uses fontfolio_header_style()
 * @uses fontfolio_admin_header_style()
 * @uses fontfolio_admin_header_image()
 *
 * @package Fontfolio
 */
function fontfolio_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'fontfolio_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '000000',
		'width'                  => 235,
		'height'                 => 100,
		'flex-height'            => true,
		'flex-width'             => true,
		'wp-head-callback'       => 'fontfolio_header_style',
		'admin-head-callback'    => 'fontfolio_admin_header_style',
		'admin-preview-callback' => 'fontfolio_admin_header_image',
	) ) );
}
add_action( 'after_setup_theme', 'fontfolio_custom_header_setup' );

if ( ! function_exists( 'fontfolio_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see fontfolio_custom_header_setup().
 */
function fontfolio_header_style() {
	$header_text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == $header_text_color )
		return;

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == $header_text_color ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		.site-title a,
		.site-description {
			color: #<?php echo $header_text_color; ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // fontfolio_header_style

if ( ! function_exists( 'fontfolio_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see fontfolio_custom_header_setup().
 */
function fontfolio_admin_header_style() {
?>
	<style type="text/css">
		.appearance_page_custom-header #headimg {
			border: none;
		}
		#headimg h1,
		#desc {
			font-family: Arial, Helvetica, sans-serif;
		}
		#headimg h1 {
			font-size: 24px;
			letter-spacing: -1px;
			margin: 0;
			text-transform: uppercase;
		}
		#headimg h1 a {
			color: #000;
			text-decoration: none;
		}
		#desc {
			font-size: 12px;
			margin: 0;
		}
		#headimg img {
			max-width: 506px;
			height: auto;
		}
	</style>
<?php
}
endif; // fontfolio_admin_header_style

if ( ! function_exists( 'fontfolio_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see fontfolio_custom_header_setup().
 */
function fontfolio_admin_header_image() {
	$style        = sprintf( ' style="color:#%s;"', get_header_textcolor() );
	$header_image = get_header_image();
?>
	<div id="headimg">
		<?php if ( ! empty( $header_image ) ) : ?>
			<img src="<?php echo esc_url( $header_image ); ?>" alt="">
		<?php endif; ?>
		<h1 class="displaying-header-text"><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div class="displaying-header-text" id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
	</div>
<?php
}
endif; // fontfolio_admin_header_image
