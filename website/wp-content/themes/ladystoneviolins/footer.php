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

<script src="https://maps.googleapis.com/maps/api/js"></script>
<script>
function initialize() {
	var myLatLng = new google.maps.LatLng(53.595557, -1.383121);
	var myOptions = {
		zoom: 8,
		center: myLatLng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};

	var map = new google.maps.Map( document.getElementById("map-canvas"), myOptions );

	var marker = new google.maps.Marker({
		position: position,
		map: map
	});  

}
initialize();
</script>
			<div id="map-canvas">
			</div>
			<div class="contact-details">
				
			</div>
			<div class="social-media">
				
			</div>

		</div><!-- .wrapper -->
	</footer><!-- #site-footer -->
</div><!-- #page -->

<?php wp_footer(); ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-1.11.2.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/hammer.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/custom.js"></script>

</body>
</html>
