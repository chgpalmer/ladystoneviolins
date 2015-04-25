<?php
/**
 * @package Saga
 */
?>

<?php
	$format = get_post_format();
	$formats = get_theme_support( 'post-formats' );

	/* translators: %s: Name of current post */
	$content_text = sprintf(
		__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'saga' ),
		the_title( '<span class="screen-reader-text">"', '"</span>', false )
	);

	if ( ( 'video' || 'audio' ) == $format ) {
		$content = apply_filters( 'the_content', get_the_content( $content_text ) );
	} else {
		$content = '';
	}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
		if ( 'video' == $format ) {
			$video = get_media_embedded_in_content( $content, array( 'video', 'object', 'embed', 'iframe' ) );

		if ( ! empty( $video ) ) {
		    foreach( $video as $video_html ) {
	?>
  	<div class="entry-video jetpack-video-wrapper">
		<?php printf( '%1$s', $video_html ); ?>
    </div><!-- .entry-video.jetpack-video-wrapper -->
	<?php
		    } // endforeach
		} // endif !empty ( $media )
	} // endif video == $format
	?>

	<?php
	  if ( 'audio' == $format ) {
		  $audio = get_media_embedded_in_content( $content, array( 'audio' ) );

      if ( ! empty( $audio ) ) {
		    foreach( $audio as $audio_html ) {
	?>
  	<div class="entry-audio">
		<?php printf( '%1$s', $audio_html ); ?>
    </div><!-- .entry-audio -->
	<?php
			} // endforeach
		} // endif !empty ( $media )
	} // endif audio == $format
	?>
	
	<?php
	if ( 'gallery' == $format ) {
		if ( get_post_gallery() ) { ?>
			<div class="entry-gallery">
				<?php echo get_post_gallery(); ?>
			</div><!-- .entry-gallery -->
		<?php
		} // endif get_post_gallery()
	} // endif gallery == $format
	?>

<?php
	if ( has_post_thumbnail() && 'gallery' !== $format && 'audio' !== $format && 'video' !== $format ) {
  ?>
		<figure class="entry-thumbnail">
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'saga-featured' ); ?></a>
		</figure>
	<?php
	} elseif ( 'image' == $format ) { // but ! has_post_thumbnail()
  ?>
		<figure class="entry-thumbnail">
			<a href="<?php the_permalink(); ?>"><?php saga_the_first_image( 'saga-featured' ); ?></a>
		</figure>
  <?php
	} // endif ( 'image' == $format )
  ?>


  <div class="entry-inner">
  	<header class="entry-header">
  		<?php
			if ( 'link' == $format ) {
				the_title( '<h1 class="entry-title"><a href="' . esc_url( saga_get_link_url() ) . '">', '<span class="icon-link-external"></span></a></h1>' );
			} else {
				the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
			} ?>

		<?php if ( 'post' == get_post_type() && 'quote' !== $format && 'status' !== $format ) : ?>
    		<div class="entry-meta">
    			<?php saga_meta_below(); ?>
    		</div><!-- .entry-meta -->
  		<?php endif; ?>
  	</header><!-- .entry-header -->

	<?php if ( 'link' !== $format ) { ?>
		<div class="entry-content">
			<?php
			
			if ( 'status' === $format ) {

				// store author info
				$author_id = get_the_author_meta( 'ID' );
				$author_name = esc_html( get_the_author_meta( 'display_name' ) );
				$author_posts_url = esc_url( get_author_posts_url( $author_id ) );

				// display author avatar if enabled
				if ( get_option( 'show_avatars' ) ) {
					echo get_avatar( $author_id, 60 );
				}

				the_content( $content_text );
				
				echo '<div class="entry-meta">';
				
				saga_meta_below();
				
				echo '</div><!-- .entry-meta -->';

			} elseif ( 'quote' === $format ) { ?>
				<blockquote class="format-quote-blockquote">
					<?php the_content( $content_text ); ?>
				</blockquote>
				<div class="entry-meta">
					<?php saga_meta_below(); ?>
				</div><!-- .entry-meta -->
			<?php
			} elseif ( has_post_thumbnail() || 'image' == $format || 'video' == $format ) {
				the_excerpt();
			} else {
				the_content();

			} // endif
	?>
		</div><!-- .entry-content -->
  		<?php } // endif 'link' !== $format ?>

	</div><!-- .entry-inner -->
</article><!-- #post-## -->
