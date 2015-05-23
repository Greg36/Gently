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
			<div class="small-6 columns">
				<div class="entry-author">
					<div class="author-info">
						<?php the_author(); ?>
						<?php gently_author_social_icons(); ?>
					</div>
					<div class="author-bio">
						<?php echo get_avatar( get_the_author_meta( 'ID' ) ); ?>
						<?php echo get_the_author_meta( 'description' ); ?>
					</div>
				</div>
				<div class="entry-tags">
					<?php echo gently_list_tags(); ?>
				</div>
			</div>
			<div class="small-6 columns">
				<div>
					<?php echo gently_comments_count(); ?>
				</div>
				<div>
<!--					--><?php //if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ) { ADDTOANY_SHARE_SAVE_KIT(); } ?>
					<?php gently_share_buttons(); ?>

				</div>
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
