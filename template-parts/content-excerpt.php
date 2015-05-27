<?php
/**
 * @package Gently
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>



			<div class="entry-meta">
				<?php gently_posted_on(); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_excerpt(); ?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php gently_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->