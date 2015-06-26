<?php
/**
 * The template part for displaying related posts.
 *
 * @package Gently
 */
?>

<div class="row collapse">

	<?php
	/* Add columns only if there is a featured image to display. */
	if ( has_post_thumbnail() ) : ?>
	<div class="small-12 medium-3 columns related-post-img">
		<?php gently_featured_image( true ); ?>
	</div>

	<div class="small-12 medium-9 columns">
	<?php endif; ?>

	<?php
		gently_entry_time();
		gently_comments_count();
		the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
		echo '<p>' . wp_trim_words( get_the_excerpt(), 27 ) . '</p>';

	if ( has_post_thumbnail() ) echo '</div>';

	?>
</div>