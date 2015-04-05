<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Saga
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">

		<?php saga_paginate_links(); ?>

		<div class="container">
			<div class="site-info">
				<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'saga' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'saga' ), 'WordPress' ); ?></a>
				<span class="sep"> &middot; </span>
				<?php printf( __( 'Theme: %1$s by %2$s', 'saga' ), 'Saga', '<a href="http://justintadlock.com/" rel="designer">Justin Tadlock</a>' ); ?>
			</div><!-- .site-info -->
		</div><!-- .container -->
	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
