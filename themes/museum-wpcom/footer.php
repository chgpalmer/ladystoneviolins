<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Museum
 */
?>

	</div><!-- #content -->

	<?php get_sidebar(); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'museum' ) ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'museum' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php
				printf( __( 'Theme: %1$s by %2$s.', 'museum' ),
					'Museum',
					'<a href="http://themes.redradar.net" rel="designer">Kelly Dwan</a> &amp; <a href="https://profiles.wordpress.org/melchoyce" rel="designer">Mel Choyce</a>'
				);
			?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
