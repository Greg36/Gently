<?php
/**
 * The template for displaying all single posts.
 *
 * @package Gently
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/content', 'single' ); ?>

			<div class="related-posts">
				<?php gently_related_posts(); ?>
			</div>

			<?php
			/**
			 * Display newsletter when 'Mailchimp for WordPress' plugin is installed
			 * and it's set to display in customizer.
			 */
			if ( function_exists( 'mc4wp_show_form' ) && kirki_get_option( 'newsletter_use' ) ) {
				mc4wp_show_form( 0 );
			}
			?>

			<?php
			// If comments are open or we have at least one comment, load up the comment template
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
			?>

		<?php endwhile; // end of the loop. ?>

	</main>
	<!-- #main -->
</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
