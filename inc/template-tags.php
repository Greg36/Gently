<?php
/**
 * Custom template tags for this theme.
 *
 * @package Gently
 */

if ( ! function_exists( 'gently_posted_on' ) ) :
	/**
	 * Displays meta information for the current post - post-date/time, author and comments count.
	 *
	 * @param string $location Where will be displayed.
	 */
	function gently_posted_on( $location = '' ) {

		$time_string = gently_entry_time();

		$author_avatar = get_avatar( get_the_author_meta( 'ID' ), '35' );

		$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';

		$byline = '<span class="author vcard">' . $author_avatar . '<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';

		$comments_count = gently_comments_count();

		if ( $location === 'search' ) {
			echo '<span class="posted-on">' . $posted_on . '</span>' . '<span class="byline"> ' . gently_get_author() . '</span>';
		} else if ( $location === 'archive' ) {
			echo '<span class="byline"> ' . gently_get_author() . '</span>' . '<span class="posted-on">' . $posted_on . '</span>';
		} else {
			echo '<span class="byline"> ' . $byline . '<br></span><span class="posted-on">' . $posted_on . '</span>' . $comments_count;
		}
	}
endif;

if ( ! function_exists( 'gently_entry_time' ) ) :
	/**
	 * Returns HTML with meta information for the current post-date/time.
	 *
	 * @return string Formatted post-date.
	 */
	function gently_entry_time() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		return $time_string;
	}
endif;

if ( ! function_exists( 'gently_comments_count' ) ) :
	/**
	 * Returns HTML with comments count if there are any.
	 *
	 * @return string Comments count.
	 */
	function gently_comments_count() {
		/* Display comments count only if the are available. */
		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			return sprintf(
				'<a class="comments-count" href="' . get_comments_link() . '"><span class="screen-reader-text">%s</span><i class="fa fa-comments"></i>&nbsp;' . get_comments_number() . '</a>',
				esc_html__( 'Comments count', 'gently' )
			);
		}

		return '';
	}
endif;

if ( ! function_exists( 'gently_comments_link' ) ) :
	/**
	 * Display comments link if there are any.
	 *
	 * @return string Comments count.
	 */
	function gently_comments_link() {
		/* Display comments count only if ther are any. */
		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( esc_html__( 'Leave a comment', 'gently' ), esc_html__( '1 Comment', 'gently' ), esc_html__( '% Comments', 'gently' ) );
			echo '</span>';
		}
	}
endif;

if ( ! function_exists( 'gently_list_categories' ) ) :
	/**
	 * Returns HTML list of categories.
	 *
	 * @return string List of categories.
	 */
	function gently_list_categories() {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'gently' ) );
		if ( $categories_list && gently_categorized_blog() ) {
			return '<div class="cat-links"><i class="fa fa-folder"></i><span class="screen-reader-text">' . __( 'Post categories', 'gently' ) . '</span>&nbsp;' . $categories_list . '</div>';
		}

		return '';
	}
endif;

if ( ! function_exists( 'gently_list_tags' ) ) :
	/**
	 * Returns HTML list of tags.
	 *
	 * @return string List of tags.
	 */
	function gently_list_tags() {
		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'gently' ) );
		if ( $tags_list ) {
			return '<span class="tags-links"><i class="fa fa-tag"></i><span class="screen-reader-text">' . __( 'Post tags', 'gently' ) . '</span>' . $tags_list . '</span>';
		}

		return '';
	}
endif;

if ( ! function_exists( 'gently_featured_image' ) ) :
	/**
	 * Prints HTML with post's featured image.
	 *
	 * @param bool $skip Skips the image wrapper class.
	 */
	function  gently_featured_image( $skip = false ) {
		if ( has_post_thumbnail() ) {
			if ( $skip ) {
				echo '<div>';
			} else if ( ! is_single() && ! is_page() ) {
				echo '<div class="entry-image">';
			} else {
				echo '<div class="featured-image">';
			}
			printf(
				'<a href="%s" title="%s">' . get_the_post_thumbnail() . '</a>',
				get_the_permalink(),
				the_title_attribute( 'echo=0' )
			);
			echo '</div>';
		}
	}
endif;

if ( ! function_exists( 'gently_get_author' ) ) :
	/**
	 * Returns link to author's posts page.
	 *
	 * @return string Formatted post author link.
	 */
	function gently_get_author() {
		return sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		);
	}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function gently_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'gently_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'gently_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so gently_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so gently_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in gently_categorized_blog.
 */
function gently_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	delete_transient( 'gently_categories' );
}

add_action( 'edit_category', 'gently_category_transient_flusher' );
add_action( 'save_post', 'gently_category_transient_flusher' );