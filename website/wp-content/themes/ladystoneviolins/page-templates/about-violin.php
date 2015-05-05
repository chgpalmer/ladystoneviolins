<?php
/**
 * Template Name: About Violin
 * @package Ladystoneviolins
 */
?>

<!-- header -->
<?php get_header(); ?>

<!-- main content -->
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

		<h2><?php echo get_the_title( $ID ); ?></h2> 

		<!-- 'the loop' -->
		<!-- if there are posts : while there are still posts : increment the post index; get post content; -->
        <?php if ( have_posts() ) : ?>

            <?php while ( have_posts() ) : the_post(); ?>

                <?php //get_template_part( 'content', get_post_format() ); ?>
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'sela' ) ); ?>
				<?php include (TEMPLATEPATH . '/exploding_violin/violin.php'); ?>

            <?php endwhile; ?>

        <?php else : ?>

            <?php get_template_part( 'content', 'none' ); ?>

        <?php endif; ?>

        </main><!-- #main -->
    </div><!-- #primary -->

<!-- footer -->
<?php get_footer(); ?>
