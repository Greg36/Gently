<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Gently
 */

if ( ! function_exists( 'the_posts_navigation' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function the_posts_navigation() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation posts-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Posts navigation', 'gently' ); ?></h2>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( esc_html__( 'Older posts', 'gently' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( esc_html__( 'Newer posts', 'gently' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'the_post_navigation' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function the_post_navigation() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'gently' ); ?></h2>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', '%title' );
				next_post_link( '<div class="nav-next">%link</div>', '%title' );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'gently_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time, author and comments count.
 * @todo Add multiple author option.
 */
function gently_posted_on() {

	$time_string = gently_entry_time();

	$author_avatar = get_avatar( get_the_author_meta( 'ID' ), '35' );

	$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';

	$byline = '<span class="author vcard">' . $author_avatar . '<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';

	$comments_count = gently_comments_count();

	echo '<span class="byline"> ' . $byline . '</span><br><span class="posted-on">' . $posted_on . '</span>' . $comments_count; // WPCS: XSS OK
}
endif;

if ( ! function_exists( 'gently_entry_time' ) ) :
	/**
	 * Returns HTML with meta information for the current post-date/time.
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
	 * @return string Comments count.
	 */
	function gently_comments_count() {
		/* Display comments count only if the are available. */
		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			return  sprintf(
				'<a class="comments-count" href="' . get_comments_link() . '"><span class="screen-reader-text">%s</span><i class="fa fa-comments"></i>&nbsp;' . get_comments_number() . '</a>',
				esc_html__( 'Comments count', 'gently' )
			);
		}
		return '';
	}
endif;

if ( ! function_exists( 'gently_comments_link' ) ) :
	/**
	 * Prints HTML with comments link if there are available.
	 * @return string Comments count.
	 */
	function gently_comments_link() {
		/* Display comments count only if the are available. */
		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			printf (
				'<span class="comments-link">%s</span>',
				comments_popup_link( esc_html__( 'Leave a comment', 'gently' ), esc_html__( '1 Comment', 'gently' ), esc_html__( '% Comments', 'gently' ) )
			);
		}
	}
endif;

if ( ! function_exists( 'gently_list_categories' ) ) :
	/**
	 * Returns HTML list of categories.
	 * @return string List of categories.
	 */
	function gently_list_categories() {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'gently' ) );
		if ( $categories_list && gently_categorized_blog() ) {
			return '<i class="fa fa-folder"></i>&nbsp;<span class="cat-links">' . $categories_list . '</span>';
		}
		return '';
	}
endif;

if ( ! function_exists( 'gently_list_tags' ) ) :
	/**
	 * Returns HTML list of tags.
	 * @return string List of tags.
	 */
	function gently_list_tags() {
		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'gently' ) );
		if ( $tags_list ) {
			return '<span class="tags-links">' . $tags_list . '</span>';
		}
		return '';
	}
endif;

if ( ! function_exists( 'gently_featured_image' ) ) :
/**
 * Prints HTML with post's featured image.
 * @todo Add caption from native attachment or add metabox to back-end post.
 */
function  gently_featured_image() {
	if ( has_post_thumbnail() ) {
		if ( !is_single() ){
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

if ( ! function_exists( 'gently_entry_footer' ) ) :
/**
 * Prints HTML with meta information.
 * @todo Delete or use as base of single post footer.
 */
function gently_entry_footer() {
//	edit_post_link( esc_html__( 'Edit', 'gently' ), '<span class="edit-link">', '</span>' );
}
endif;

if ( ! function_exists( 'the_archive_title' ) ) :
/**
 * Shim for `the_archive_title()`.
 *
 * Display the archive title based on the queried object.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the title. Default empty.
 * @param string $after  Optional. Content to append to the title. Default empty.
 */
function the_archive_title( $before = '', $after = '' ) {
	if ( is_category() ) {
		$title = sprintf( esc_html__( 'Category: %s', 'gently' ), single_cat_title( '', false ) );
	} elseif ( is_tag() ) {
		$title = sprintf( esc_html__( 'Tag: %s', 'gently' ), single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		$title = sprintf( esc_html__( 'Author: %s', 'gently' ), '<span class="vcard">' . get_the_author() . '</span>' );
	} elseif ( is_year() ) {
		$title = sprintf( esc_html__( 'Year: %s', 'gently' ), get_the_date( esc_html_x( 'Y', 'yearly archives date format', 'gently' ) ) );
	} elseif ( is_month() ) {
		$title = sprintf( esc_html__( 'Month: %s', 'gently' ), get_the_date( esc_html_x( 'F Y', 'monthly archives date format', 'gently' ) ) );
	} elseif ( is_day() ) {
		$title = sprintf( esc_html__( 'Day: %s', 'gently' ), get_the_date( esc_html_x( 'F j, Y', 'daily archives date format', 'gently' ) ) );
	} elseif ( is_tax( 'post_format' ) ) {
		if ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = esc_html_x( 'Asides', 'post format archive title', 'gently' );
		} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			$title = esc_html_x( 'Galleries', 'post format archive title', 'gently' );
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			$title = esc_html_x( 'Images', 'post format archive title', 'gently' );
		} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
			$title = esc_html_x( 'Videos', 'post format archive title', 'gently' );
		} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
			$title = esc_html_x( 'Quotes', 'post format archive title', 'gently' );
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = esc_html_x( 'Links', 'post format archive title', 'gently' );
		} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
			$title = esc_html_x( 'Statuses', 'post format archive title', 'gently' );
		} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
			$title = esc_html_x( 'Audio', 'post format archive title', 'gently' );
		} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
			$title = esc_html_x( 'Chats', 'post format archive title', 'gently' );
		}
	} elseif ( is_post_type_archive() ) {
		$title = sprintf( esc_html__( 'Archives: %s', 'gently' ), post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf( esc_html__( '%1$s: %2$s', 'gently' ), $tax->labels->singular_name, single_term_title( '', false ) );
	} else {
		$title = esc_html__( 'Archives', 'gently' );
	}

	/**
	 * Filter the archive title.
	 *
	 * @param string $title Archive title to be displayed.
	 */
	$title = apply_filters( 'get_the_archive_title', $title );

	if ( ! empty( $title ) ) {
		echo $before . $title . $after;  // WPCS: XSS OK
	}
}
endif;

if ( ! function_exists( 'the_archive_description' ) ) :
/**
 * Shim for `the_archive_description()`.
 *
 * Display category, tag, or term description.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the description. Default empty.
 * @param string $after  Optional. Content to append to the description. Default empty.
 */
function the_archive_description( $before = '', $after = '' ) {
	$description = apply_filters( 'get_the_archive_description', term_description() );

	if ( ! empty( $description ) ) {
		/**
		 * Filter the archive description.
		 *
		 * @see term_description()
		 *
		 * @param string $description Archive description to be displayed.
		 */
		echo $before . $description . $after;  // WPCS: XSS OK
	}
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
	// Like, beat it. Dig?
	delete_transient( 'gently_categories' );
}
add_action( 'edit_category', 'gently_category_transient_flusher' );
add_action( 'save_post',     'gently_category_transient_flusher' );


/**
 * Prints related posts based on first tag.
 * @return string Formatted related posts.
 * @todo Test Jetpack related posts for this function.
 */
function gently_related_posts() {
	$args = array(
		'post__not_in'     => array( get_the_ID() ),
		'posts_per_page'   => 3,
		'ignore_sticky_posts' => 1
	);
	$tags = wp_get_post_tags( get_the_ID() );
	$categories = wp_get_post_categories( get_the_ID() );

	if ( $tags ) {
		$args['tag__in'] = $tags[0]->term_id;
	} elseif ( $categories ) {
		$args['category__in'] = $categories[0];
	} else {
		return;
	}

	/* Query posts */
	$related  = new WP_Query( $args );

	if ( $related->have_posts() ) {
		sprintf( '<h3>%s</h3>', esc_html__( 'Related posts:' ) );
		while ( $related->have_posts() ) {
			$related->the_post();
			echo gently_related_post();
		}
	}

	wp_reset_postdata();
}

/**
 * Returns formatted post for use in related posts.
 * @todo Remove conditional and add default image?
 */
function gently_related_post() {
	?>
	<div class="row">
		<?php if ( has_post_thumbnail() ) { ?>
			<div class="small-12 medium-3 columns">
				<?php gently_featured_image(); ?>
			</div>
			<div class="small-12 medium-9 columns">
		<?php } ?>
			<?php gently_entry_time(); ?>
			<?php gently_comments_count(); ?>
			<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
			<?php echo wp_trim_words( get_the_excerpt() ); ?>
		<?php if ( has_post_thumbnail() ) echo '</div>'; ?>
	</div>
	<?php
}