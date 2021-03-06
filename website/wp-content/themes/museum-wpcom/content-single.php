<?php
/**
 * @package Museum
 */
?>

<?php if ( has_post_thumbnail() ): ?>
<div class="entry-image">
	<?php the_post_thumbnail( 'museum-single' ); ?>
</div><!-- .entry-image -->
<?php endif; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'museum' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-meta clear">
		<?php edit_post_link( __( 'Edit Post', 'museum' ), '<p class="edit-post">', '</p>' ); ?>

		<div class="entry-author"><?php museum_posted_on(); ?></div>

		<div class="entry-taxes">
			<?php museum_entry_taxonomies(); ?>
		</div>
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
