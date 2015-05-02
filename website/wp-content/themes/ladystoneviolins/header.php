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
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300&amp;subset=latin,cyrillic,greek' rel='stylesheet' type='text/css' />
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Source+Sans+Pro">
<?php wp_head(); ?>
</head>


<body <?php body_class(); ?>>
<div id="page">
    <header id="site-header">
		<div class="wrapper">
			<div id="menu-toggle">
			</div>

			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<div class="site-branding-mobile">
						<img src="<?php echo get_template_directory_uri(); ?>/img/ladystoneviolins_mobile.png" alt="Ladystone Violins - British maker and restorer of stringed instruments">
				</div><!-- .site-branding-mobile -->
				<div class="site-branding">
						<img src="<?php echo get_template_directory_uri(); ?>/img/ladystoneviolins.png" alt="Ladystone Violins - British maker and restorer of stringed instruments">
				</div><!-- .site-branding -->
			</a>
		</div><!-- .wrapper -->

    </header><!-- #site-header -->

	<nav id="site-nav">
		<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
	</nav><!-- #site-navigation -->
    <div id="nav-push"></div>

    <div id="site-content">
		<div class="wrapper">
