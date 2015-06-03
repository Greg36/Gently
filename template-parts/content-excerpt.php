<?php
/**
 * @package Gently
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">

		<div class="entry-meta">
			<?php gently_posted_on(); ?>
		</div><!-- .entry-meta -->

			<?php gently_featured_image(); ?>

			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_excerpt(); ?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">



		<?php gently_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->