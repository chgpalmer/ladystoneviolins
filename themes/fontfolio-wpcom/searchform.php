<?php
/**
 * The template for displaying search forms in Fontfolio
 *
 * @package Fontfolio
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php _ex( 'Search for:', 'label', 'fontfolio' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'fontfolio' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'fontfolio' ); ?>">
	</label>
	<span class="search-button"><input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'fontfolio' ); ?>"></span>
</form>
