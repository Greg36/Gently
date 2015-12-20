<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * @package Gently
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function gently_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}

add_filter( 'body_class', 'gently_body_classes' );

/**
 * Add sidebar position classes to body.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function genlty_sidebar_position( $classes ) {
	$sidebar_pos = kirki_get_option( 'sidebar_position' );

	if ( $sidebar_pos == 'left' ) {
		$classes[] = 'sidebar-left';
	} else {
		$classes[] = 'sidebar-right';
	}

	$sidebar_collapse = kirki_get_option( 'sidebar_collapse' );
	$sidebar_collapse = explode( ',', $sidebar_collapse[0] );

	if ( is_home() && in_array( 'home', $sidebar_collapse ) ) {
		$classes[] = 'sidebar-closed';
	} else if ( is_single() && in_array( 'single', $sidebar_collapse ) ) {
		$classes[] = 'sidebar-closed';
	} else if ( is_archive() && in_array( 'archive', $sidebar_collapse ) ) {
		$classes[] = 'sidebar-closed';
	}

	return $classes;
}

add_filter( 'body_class', 'genlty_sidebar_position' );


if ( ! function_exists( 'gently_excerpt_more' ) ) :
	/**
	 * Set custom excerpt 'read more' link
	 *
	 * @return string
	 */
	function gently_excerpt_more( $more ) {
		return sprintf(
			'... <div class="excerpt-read-more"><a href="%s" title="%s">%s</a></div>',
			get_permalink( get_the_ID() ),
			esc_html__( 'Read ', 'gently' ) . esc_attr( get_the_title( get_the_ID() ) ),
			__( 'Continue reading', 'gently' )
		);
	}

	add_filter( 'excerpt_more', 'gently_excerpt_more' );
endif;

/**
 * Set custom excerpt length.
 *
 * @return int New excerpt length
 */
function gently_custom_excerpt_length( $length ) {
	return 30;
}

add_filter( 'excerpt_length', 'gently_custom_excerpt_length', 999 );

/**
 * Remove 'You may use these HTML tags...' from under comments form
 *
 * @return array
 */
function gently_comment_form_defaults( $defaults ) {
	$defaults['comment_notes_after'] = '';

	return $defaults;
}

add_filter( 'comment_form_defaults', 'gently_comment_form_defaults' );

/**
 * Adds span tag around taxonomies in archive title
 *
 * @return string
 */
function gently_custom_archive_title( $title ) {
	$new_title = explode( ':', $title );
	$title     = $new_title[0] . ':<span>' . $new_title[1] . '</span>';

	return $title;
}

add_filter( 'get_the_archive_title', 'gently_custom_archive_title' );

/**
 * Adds icons to archive title.
 *
 * @return string
 */
function gently_archive_title_icons( $title ) {
	if ( is_tag() ) {
		$title = '<i class="fa fa-tag" aria-hidden="true"></i>' . $title;
		return $title;

	} else if ( is_category() ) {
		$title = '<i class="fa fa-folder" aria-hidden="true"></i>' . $title;
		return $title;

	} else if ( is_date() ) {
		$title = '<i class="fa fa-calendar-o" aria-hidden="true"></i>' . $title;
		return $title;
	}

	return $title;
}

add_filter( 'get_the_archive_title', 'gently_archive_title_icons' );

/**
 * Display related posts.
 *
 * @return string Formatted related posts.
 */
function gently_related_posts() {
	$args = array(
		'post__not_in'        => array( get_the_ID() ),
		'posts_per_page'      => 3,
		'ignore_sticky_posts' => 1
	);
	$tags = wp_get_post_tags( get_the_ID() );
	$categories = wp_get_post_categories( get_the_ID() );

	/* Prior search with tags, if there aren't any use categories */
	if ( $tags ) {
		$args['tag__in'] = $tags[0]->term_id;
	} elseif ( $categories ) {
		$args['category__in'] = $categories[0];
	} else {
		return;
	}

	/* Query posts */
	$related = new WP_Query( $args );

	if ( $related->have_posts() ) {
		printf( '<h2>%s</h2>', esc_html__( 'Related posts:', 'gently' ) );
		while ( $related->have_posts() ) {
			$related->the_post();

			/* Display related post */
			get_template_part( 'template-parts/post', 'related' );
		}
	}

	wp_reset_postdata();
}

/**
 * Class Gently_Menu_Walker_Mobile
 *
 * Custom menu walker with added icons that are used to toggle nested levels of navigation in small screen version.
 */
class Gently_Menu_Walker extends Walker_Nav_Menu {
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth + 1 );
		$output .= "\t<button class='nav-sub-icon' aria-expanded='false'><i class='fa fa-chevron-down' aria-hidden='true'></i><span class='screen-reader-text'>" . __( "Open sub menu", "gently" ) . "</span></button>\n$indent\t<ul class='sub-menu'>\n";
	}

	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth + 1 );
		$output .= "$indent\t</ul>\n";
	}
}

/**
 * Add ARIA landmark to search form.
 *
 * @return string $form The search form HTML output.
 */
function gently_search_form_aria( $html ){
	return preg_replace( "/(role=[\"']search[\"'])/", "$0 aria-expanded='false'", $html );
}
add_filter( 'get_search_form', 'gently_search_form_aria' );