<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Saga
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( has_post_thumbnail() ) { ?>
		<figure class="entry-thumbnail">
			<?php the_post_thumbnail( 'saga-featured' ); ?>
		</figure>
	<?php } ?>
	<div class="entry-inner">
		<header class="entry-header singular-header">
			<?php the_title( '<h1 class="entry-title singular-title">', '</h1>' ); ?>
		</header><!-- .entry-header.singular-header -->

		<div class="entry-content">
			<?php the_content(); ?>
			<?php
				wp_link_pages( array(
					'before'      => '<div class="page-links">' . __( 'Pages:', 'saga' ),
					'after'       => '</div>',
					'link_before' => '<span class="active-link">',
					'link_after'  => '</span>'
				) );
			?>
		</div><!-- .entry-content -->

		<?php edit_post_link( __( 'Edit', 'saga' ), '<footer class="entry-footer"><div class="entry-meta"><span class="edit-link">', '</span></div></footer>' ); ?>

		<?php
			// If comments are open or we have at least one comment, load up the comment template
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
		?>
	</div><!-- /.entry-inner -->
</article><!-- #post-## -->
