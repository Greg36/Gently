<?php
/**
 * @package Gently
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>



			<div class="entry-meta">
				<?php gently_posted_on(); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		/* translators: %s: Name of current post */
//		the_content( sprintf(
//			wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'gently' ), array( 'span' => array( 'class' => array() ) ) ),
//			the_title( '<span class="screen-reader-text">"', '"</span>', false )
//		) );
		the_excerpt();
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php gently_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->