<?php
/**
 * Styles generated based on customizer options.
 */

/**
 * Make an array that is [selector][property] = value and parse it to CSS syntax
 */
function gently_dynamic_styles() {


	/* Accent color */
	$accent_color = kirki_get_option( 'accent_color' );
	$css['a']['color'] = $accent_color;
	$css['a:visited']['color'] = $accent_color;
	$css['a:hover, a:focus, a:active']['color'] = gently_adjust_brightness( $accent_color, 35 );
	$css['.main-navigation li:hover > a, .main-navigation li.focus > a']['color'] = $accent_color;
	$css['.header-search i']['color'] = $accent_color;
	$css['button:active, button:focus, button:hover, input[type="button"]:active, input[type="button"]:focus, input[type="button"]:hover, input[type="reset"]:active, input[type="reset"]:focus, input[type="reset"]:hover, input[type="submit"]:active, input[type="submit"]:focus, input[type="submit"]:hover, a.btn:active, a.btn:focus, a.btn:hover, i.btn:active, i.btn:focus, i.btn:hover']['background'] = gently_adjust_brightness( $accent_color, -20 );
	$css['button:active, button:focus, button:hover, input[type="button"]:active, input[type="button"]:focus, input[type="button"]:hover, input[type="reset"]:active, input[type="reset"]:focus, input[type="reset"]:hover, input[type="submit"]:active, input[type="submit"]:focus, input[type="submit"]:hover, a.btn:active, a.btn:focus, a.btn:hover, i.btn:active, i.btn:focus, i.btn:hover']['color'] = gently_adjust_brightness( $accent_color, 170 );
	$css['button, input[type="button"], input[type="reset"], input[type="submit"], a.btn, i.btn']['background'] = gently_adjust_brightness( $accent_color, 20 );
	$css['.toggle-sidebar']['border-color'] = $accent_color;
	$css['.toggle-sidebar']['color'] = $accent_color;
	$css['.single .cat-links i']['color'] = $accent_color;
	$css['.archive .cat-links i']['color'] =
	$css['.tags-links i']['color'] = $accent_color;
	$css['.widget_pages li a:before, .widget_meta li a:before, .widget_nav_menu li a:before, .widget_recent_entries li a:before']['border-color'] = 'transparent ' . $accent_color . ' transparent transparent';
	$css['button, input[type="button"], input[type="reset"], input[type="submit"], a.btn, i.btn']['border-color'] = sprintf( '%1$s %1$s %2$s %2$s',
		gently_adjust_brightness( $accent_color, 30 ),
		gently_adjust_brightness( $accent_color, -30 )
	);

	/* Metadata color */
	$meta_color = kirki_get_option( 'meta_color' );
	$css['.group-blog .posted-on a']['color'] = $meta_color;
	$css['.search-results .page-title .fa, .archive .page-title .fa']['color'] = $meta_color;
	$css['.single .nav-links span']['border-color'] = $meta_color;
	$css['.rss-date']['color'] = $meta_color;
	$css['.secondary-navigation li a']['color'] = $meta_color;

	/* Details color */
	$details_color = kirki_get_option( 'details_color' );
	$css['td']['border-color'] = $details_color;
	$css['.single .post-navigation']['border-color'] = $details_color;
	$css['.hentry:not(:last-child)']['border-color'] = $details_color;
	$css['.comment-body']['border-color'] = $details_color;
	$css['.comment-body:before']['border-color'] = 'transparent ' . $details_color . ' transparent transparent';
	$css['.widget_archive ul li']['border-color'] = $details_color;
	$css['input[type="text"], input[type="email"], input[type="url"], input[type="password"], input[type="search"], input[type="number"], select, textarea']['border-color'] = $details_color;
	$css['.widget_categories > ul > li']['border-color'] = $details_color;
	$css['.widget-title']['border-color'] = $details_color;
	$css['.main-navigation .sub-menu']['border-top-color'] = $details_color;

	/* Body text color */
	$body_text_color = kirki_get_option( 'body_text_color' );
	$css['blockquote, p.pullquote']['border-color'] = gently_adjust_brightness( $body_text_color, 35 );
	$css['blockquote, p.pullquote']['color'] = gently_adjust_brightness( $body_text_color, 20 );

	/* Page background color */
	$css['.comment-body']['background'] = gently_adjust_brightness( get_theme_mod( 'background_color', '#fff' ), -1 );
	$css['.comment-list .children .comment-body']['background'] = gently_adjust_brightness( get_theme_mod( 'background_color', '#fff' ), -2 );

	/* Sidebar border color */
	$css['body.sidebar-right .main-sidebar, body.sidebar-left .main-sidebar']['border-color'] = kirki_get_option( 'sidebar_border' );


	// Parse array to CSS syntax string
	$final_css = '';
	foreach ( $css as $style => $style_array ) {
		$final_css .= $style . '{';
		foreach ( $style_array as $property => $value ) {
			$final_css .= $property . ':' . $value . ';';
		}
		$final_css .= '}';
	}

	echo '<style type="text/css">' . $final_css . '</style>';
}
add_action( 'wp_head', 'gently_dynamic_styles', 99 );


function gently_adjust_brightness( $hex, $steps ) {
	// Steps should be between -255 and 255. Negative = darker, positive = lighter
	$steps = max(-255, min(255, $steps));

	// Normalize into a six character long hex string
	$hex = str_replace('#', '', $hex);
	if (strlen($hex) == 3) {
		$hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
	}

	// Split into three parts: R, G and B
	$color_parts = str_split($hex, 2);
	$output = '#';

	foreach ($color_parts as $color) {
		$color   = hexdec($color); // Convert to decimal
		$color   = max(0,min(255,$color + $steps)); // Adjust color
		$output .= str_pad(dechex($color), 2, '0', STR_PAD_LEFT); // Make two char hex code
	}

	return $output;
}