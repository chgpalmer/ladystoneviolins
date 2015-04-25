<?php
/**
 * @package Fontfolio
 */

global $fontfolio_count;

if ( 1 == $fontfolio_count )
	$postclass = 'first';
else
	$postclass = '';

$format = get_post_format();
$formats = get_theme_support( 'post-formats' );

$fontfolio_image = fontfolio_get_image( get_the_ID() );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $postclass ); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		<?php if ( is_search() ) : //Display post thumbs for search ?>
		<?php
			if ( '' != $fontfolio_image )
				echo fontfolio_get_image( get_the_ID(), 'featured-search' );
		?>
		<?php endif; ?>
		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php edit_post_link( __( 'Edit', 'fontfolio' ), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->
	<?php if ( is_search() ) : //Only display excerpts and post thumbs for search ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div>
	<?php else : ?>
		<div class="entry-thumbnail">
			<a href="<?php the_permalink(); ?>" rel="bookmark">
				<?php if ( $format && in_array( $format, $formats[0] ) ): ?>
					<span class="entry-format"><span class="screen-reader-text"><?php echo get_post_format_string( $format ); ?></span></span>
				<?php endif; ?>
				<?php
					if ( '' != $fontfolio_image && 'first' == $postclass ) :
						echo fontfolio_get_image( get_the_ID(), 'featured-home-big' );
					elseif ( '' != $fontfolio_image && '' == $postclass ) :
						echo fontfolio_get_image( get_the_ID(), 'featured-home-small' );
					else :
						echo "<span class='no-thumbnail'></span>";
					endif;
				?>
			</a>
		</div>
	<?php endif; ?>
</article><!-- #post-## -->
