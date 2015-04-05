<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Museum
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<a href="<?php the_permalink(); ?>" rel="bookmark" class="post-link">
		<header class="entry-header">
			<span class="read-more"><?php echo __( 'Read Post', 'museum' ); ?> &rsaquo;</span>
			<?php if ( get_the_title() ) : ?>
				<h2 class="entry-title"><?php the_title(); ?></h2>
				<div class="entry-excerpt"><?php the_excerpt(); ?></div>
			<?php else: ?>
				<div class="entry-excerpt no-title"><?php the_excerpt(); ?></div>
			<?php endif; ?>
		</header><!-- .entry-header -->
	</a>
</article><!-- #post-## -->
