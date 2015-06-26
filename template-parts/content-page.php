<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Gently
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header>
	<!-- .entry-header -->

	<div class="entry-content">
		<?php gently_featured_image(); ?>
		<?php the_content(); ?>
		<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'gently' ),
			'after'  => '</div>',
		) );
		?>
	</div>
	<!-- .entry-content -->

</article><!-- #post-## -->
