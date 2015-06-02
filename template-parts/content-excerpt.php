<?php
/**
 * @package Gently
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

			<div class="entry-image">
				<?php gently_featured_image(); ?>
			</div>

			<div class="entry-meta">
				<?php gently_posted_on(); ?>
			</div><!-- .entry-meta -->

	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_excerpt(); ?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php gently_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->