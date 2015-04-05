<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Saga
 */

get_header();

?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<section class="hentry error-404 not-found">

  			<div class="entry-inner">
  				<header class="singular-header">
  					<h1 class="singular-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'saga' ); ?></h1>
  				</header><!-- .singular-header -->

  				<div class="entry-content">
  					<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'saga' ); ?></p>

  					<?php get_search_form(); ?>

  				</div><!-- .entry-content -->
  			</div><!-- /.entry-inner -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
