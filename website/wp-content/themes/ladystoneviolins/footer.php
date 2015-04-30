<?php
/**
 * The template for displaying the footer.
 * @package Ladystoneviolins
 */
?>

		</div><!-- .wrapper -->
	</div><!-- #site-content -->

	<footer id="site-footer">
		<div class="wrapper">
			<?php if ( has_nav_menu ( 'social' ) ) : ?>
				<?php wp_nav_menu( array( 'theme_location' => 'social', 'depth' => 1, 'link_before' => '<span class="screen-reader-text">', 'link_after' => '</span>', 'container_class' => 'social-links', ) ); ?>
			<?php endif; ?>

			<div class="site-info"  role="contentinfo">
				Website created by charliepalmer.net
			</div><!-- .site-info -->
		</div><!-- .wrapper -->
	</footer><!-- #site-footer -->
</div><!-- #page -->

<?php wp_footer(); ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-1.11.2.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/custom.js"></script>

</body>
</html>
