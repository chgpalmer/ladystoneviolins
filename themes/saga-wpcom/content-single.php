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
			$content = str_replace( $video_html, '', $content );
	?>
			<div class="entry-video jetpack-video-wrapper">
				<?php printf( '%1$s', $video_html ); ?>
			</div><!-- .entry-video.jetpack-video-wrapper -->
	<?php
			} // endforeach
		} // endif !empty ( $media )
	} // endif $video == $format
	?>

	<?php
	if ( 'audio' == $format ) {
		$audio = get_media_embedded_in_content( $content, array( 'audio' ) );

		if ( ! empty( $audio ) ) {
			foreach( $audio as $audio_html ) {
				$content = str_replace( $audio_html, '', $content );
	?>
				<div class="entry-audio">
					<?php printf( '%1$s', $audio_html ); ?>
				</div><!-- .entry-audio -->
	<?php
			} // endforeach
		} // endif !empty ( $media )
	} // endif $audio == $format
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
			<?php the_post_thumbnail( 'saga-featured' ); ?>
		</figure>
<?php
	} elseif ( 'image' == $format ) { // ! has_post_thumbnail()
?>
		<figure class="entry-thumbnail">
			<?php saga_the_first_image( 'saga-featured' ); ?>
		</figure>
<?php
	} // endif ( 'image' == $format )
?>


	<div class="entry-inner">
		<header class="entry-header singular-header">
			<?php the_title( '<h1 class="entry-title singular-title">', '</h1>' ); ?>

			<?php if ( 'post' == get_post_type() ) { ?>
				<div class="entry-meta">
					<?php saga_meta_above(); ?>
				</div><!-- .entry-meta -->
			<?php } // endif 'post' == get_post_type() ?>
		</header><!-- .entry-header.singular-header -->

		<div class="entry-content">

		<?php
		if ( ( 'video' || 'audio' ) == $format ) {
			echo $content;

		} elseif ( 'status' === $format ) {

			// store author info
			$author_id = get_the_author_meta( 'ID' );
			$author_name = esc_html( get_the_author_meta( 'display_name' ) );
			$author_posts_url = esc_url( get_author_posts_url( $author_id ) );

			// display author avatar if enabled
			if ( get_option( 'show_avatars' ) ) {
				echo get_avatar( $author_id, 60 );
			}

			the_content( $content_text );

		} elseif ( 'quote' === $format ) {
		?>
			<blockquote class="format-quote-blockquote">
				<?php the_content( $content_text ); ?>
			</blockquote>
		<?php
		} else {
			the_content( $content_text );

		} // endif 'quote' == $format
		?>

		<?php
		wp_link_pages( array(
			'before'      => '<div class="page-links">' . __( 'Pages:', 'saga' ),
			'after'       => '</div>',
			'link_before' => '<span class="active-link">',
			'link_after'  => '</span>'
		) );
		?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<div class="entry-meta">
				<?php saga_meta_below(); ?>
			</div><!-- .entry-meta -->
		</footer><!-- .entry-footer -->

		<?php
			// If comments are open or we have at least one comment, load up the comment template
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
		?>
	</div><!-- .entry-inner -->
</article><!-- #post-## -->
