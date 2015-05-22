<?php
/**
 * @package Gently
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">

		<div class="entry-meta">
			<div class="row">
				<div class="small-8 large-9 columns">
					<?php echo gently_entry_time(); ?>
					<?php echo gently_list_categories(); ?>
				</div>
				<div class="small-4 large-3 columns">
					<?php echo gently_comments_link(); ?>
				</div>
			</div>
		</div><!-- .entry-meta -->

		<?php gently_featured_image(); ?>

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'gently' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<div class="row">
			<div class="medium-6 columns">
				<div class="row">
					<div class="small-6 columns">
						about author
					</div>
					<div class="small-6 columns">
						author social
					</div>
				</div>
				tags
			</div>
			<div class="medium-6 columns">
				c.cout <br>
				share
			</div>
		</div>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

<?php
	the_post_navigation( array(
		'prev_text' => '<i class="fa fa-chevron-left"></i> %title',
		'next_text' => '%title <i class="fa fa-chevron-right"></i>'
	) );
?>
