<?php
/**
 * The Header for our theme.
 * Displays all of the <head> section and everything up till <main id="main">
 * @package Ladystoneviolins
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>">
<?php wp_head(); ?>
</head>


<body <?php body_class(); ?>>
<div id="page">
    <header id="site-header">
		<div id="menu-toggle">
			<button id="site-nav-toggle">toggle</button>
		</div>

        <div class="site-branding">
            <?php //sela_the_site_logo(); ?>
            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
            <?php if ( '' != get_bloginfo( 'description' ) ) : ?>
            <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
            <?php endif; ?>
        </div><!-- .site-branding -->

    </header><!-- #site-header -->

	<nav id="site-nav">
		<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
	</nav><!-- #site-navigation -->
    <div id="nav-push"></div>

    <div id="site-content">
