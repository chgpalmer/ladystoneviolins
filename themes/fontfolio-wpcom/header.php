<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Fontfolio
 */

$fontfolio_facebook = get_theme_mod( 'jetpack-facebook' );
$fontfolio_twitter = get_theme_mod( 'jetpack-twitter' );
$fontfolio_tumblr = get_theme_mod( 'jetpack-tumblr' );
$fontfolio_linkedin = get_theme_mod( 'jetpack-linkedin' );

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
	<header id="masthead" class="site-header" role="banner">

		<div class="header-wrapper clear">
			<div class="header-search">
				<?php get_search_form(); ?>
			</div>

			<nav id="site-navigation" class="main-navigation" role="navigation">
				<h1 class="menu-toggle"><?php _e( 'Menu', 'fontfolio' ); ?></h1>
				<div class="screen-reader-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'fontfolio' ); ?>"><?php _e( 'Skip to content', 'fontfolio' ); ?></a></div>

				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			</nav><!-- #site-navigation -->

			<?php if ( $fontfolio_facebook || $fontfolio_twitter || $fontfolio_tumblr || $fontfolio_linkedin ) : ?>
				<div class="social-links">
				<?php if ( $fontfolio_facebook ) : ?>
					<a href="<?php echo esc_url( $fontfolio_facebook ); ?>" class="facebook-link" data-icon="&#xF204;">
						<span class="screen-reader-text"><?php esc_html_e( 'Facebook', 'fontfolio' ); ?></span>
					</a>
				<?php endif; ?>
				<?php if ( $fontfolio_linkedin ) : ?>
					<a href="<?php echo esc_url( $fontfolio_linkedin ); ?>" class="linkedin-link" data-icon="&#xF207;">
						<span class="screen-reader-text"><?php esc_html_e( 'LinkedIn', 'fontfolio' ); ?></span>
					</a>
				<?php endif; ?>
				<?php if ( $fontfolio_tumblr ) : ?>
					<a href="<?php echo esc_url( $fontfolio_tumblr ); ?>" class="tumblr-link" data-icon="&#xF214;">
						<span class="screen-reader-text"><?php esc_html_e( 'Tumblr', 'fontfolio' ); ?></span>
					</a>
				<?php endif; ?>
				<?php if ( $fontfolio_twitter ) : ?>
					<a href="<?php echo esc_url( $fontfolio_twitter ); ?>" class="twitter-link" data-icon="&#xF202;">
						<span class="screen-reader-text"><?php esc_html_e( 'Twitter', 'fontfolio' ); ?></span>
					</a>
				<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>

		<div class="site-branding">
			<?php $header_image = get_header_image();
			if ( ! empty( $header_image ) ) { ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="">
				</a>
			<?php } // if ( ! empty( $header_image ) ) ?>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		</div>

		<?php if ( has_nav_menu( 'secondary' ) ) : ?>
			<nav id="secondary-navigation" class="secondary-navigation" role="navigation">
				<div class="screen-reader-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'fontfolio' ); ?>"><?php _e( 'Skip to content', 'fontfolio' ); ?></a></div>
				<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'depth' => '1', 'fallback_cb' => false ) ); ?>
			</nav><!-- #site-navigation -->
		<?php endif; ?>
	</header><!-- #masthead -->

	<div id="main" class="site-main clear">
