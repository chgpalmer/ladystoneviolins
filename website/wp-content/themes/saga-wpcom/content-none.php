<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Saga
 */
?>

<section class="no-results not-found">

  <div class="entry-inner">
  	<header class="singular-header">
  		<h1 class="singular-title"><?php _e( 'Nothing Found', 'saga' ); ?></h1>
  	</header><!-- .singular-header -->

  	<div class="entry-content">
  		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

  			<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'saga' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

  		<?php elseif ( is_search() ) : ?>

  			<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'saga' ); ?></p>
  			<?php get_search_form(); ?>

  		<?php else : ?>

  			<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'saga' ); ?></p>
  			<?php get_search_form(); ?>

  		<?php endif; ?>
  	</div><!-- .entry-content -->
  </div><!-- /.entry-inner -->
</section><!-- .no-results -->
