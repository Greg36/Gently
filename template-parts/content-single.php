<?php
/**
 * The template part for displaying single post content.
 *
 * @package Gently
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">


		<div class="entry-meta">
			<div class="row collapse">

				<?php if ( gently_list_categories() ) : ?>

					<div class="small-6 medium-12 columns">
						<?php echo gently_entry_time(); ?>
					</div>
					<div class="small-6 medium-push-6 columns">
						<?php echo gently_comments_link(); ?>
					</div>
					<div class="small-12 medium-6 medium-pull-6 columns">
						<?php echo gently_list_categories(); ?>
					</div>

				<?php else: ?>

					<div class="small-6 columns">
						<?php echo gently_entry_time(); ?>
					</div>
					<div class="small-6 columns">
						<?php echo gently_comments_link(); ?>
					</div>

				<?php endif; ?>

			</div>
		</div>
		<!-- .entry-meta -->

		<?php gently_featured_image(); ?>

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

	</header>
	<!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'gently' ),
			'after'  => '</div>',
		) );
		?>
	</div>
	<!-- .entry-content -->

	<footer class="entry-footer">
		<div class="row collapse">
			<div class="small-12 medium-6 columns">
				<div class="entry-author">
					<div class="author-info">
						<?php echo gently_get_author(); ?>
						<?php gently_author_social_icons(); ?>
					</div>
					<div class="author-bio clear">
						<?php echo get_avatar( get_the_author_meta( 'ID' ), 50 ); ?>
						<p>
							<?php echo get_the_author_meta( 'description' ); ?>
						</p>
					</div>
					<?php if ( gently_list_tags() ) : ?>
						<div class="entry-tags">
							<?php echo gently_list_tags(); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
			<div class="small-12 medium-6 columns">
				<div class="comments-link-cont">
					<?php echo gently_comments_link(); ?>
				</div>
				<div class="share-buttons">
					<?php gently_share_buttons(); ?>
				</div>
			</div>

		</div>
	</footer>
	<!-- .entry-footer -->
</article><!-- #post-## -->

<?php
the_post_navigation( array(
	'prev_text' => '<span>' . esc_html__( 'Previous post', 'gently' ) . '</span>%title',
	'next_text' => '<span>' . esc_html__( 'Next post', 'gently' ) . '</span>%title',
) );
?>
