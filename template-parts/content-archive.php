<?php
/**
 * The template part for displaying archive pages.
 *
 * @package Gently
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">

		<?php if ( 'post' == get_post_type() ) : ?>

			<div class="entry-meta">
				<?php
				if ( is_author() ) {
					echo '<span class="posted-on"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . gently_entry_time() . '</a></span>' . gently_list_categories();
				} else {
					gently_posted_on( 'archive' );
				}
				?>
			</div><!-- .entry-meta -->

		<?php endif; ?>

		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

	</header>
	<!-- .entry-header -->

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>
	<!-- .entry-summary -->

</article><!-- #post-## -->
