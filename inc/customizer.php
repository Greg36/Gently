<?php
/**
 * Gently Theme Customizer
 *
 * @package Gently
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function gently_customize_register( $wp_customize ) {
	if ( class_exists( 'Kirki' ) ) {
		$wp_customize->add_section( 'base_typography', array(
			'title'    => __( 'Base typography', 'gently' ),
			'priority' => 30,
		) );
		$wp_customize->add_section( 'social', array(
			'title'    => __( 'Social media', 'gently' ),
			'priority' => 31,
		) );
	}
}
add_action( 'customize_register', 'gently_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function gently_customize_preview_js() {
	wp_enqueue_script( 'gently_customizer', get_template_directory_uri() . '/js/admin/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'gently_customize_preview_js' );

/**
 * Configuration of the Kirki Customizer 
 */
function gently_kirki_configuration() {

	$strings = array(
		'background-color' => __( 'Background Color', 'gently' ),
		'background-image' => __( 'Background Image', 'gently' ),
		'no-repeat' => __( 'No Repeat', 'gently' ),
		'repeat-all' => __( 'Repeat All', 'gently' ),
		'repeat-x' => __( 'Repeat Horizontally', 'gently' ),
		'repeat-y' => __( 'Repeat Vertically', 'gently' ),
		'inherit' => __( 'Inherit', 'gently' ),
		'background-repeat' => __( 'Background Repeat', 'gently' ),
		'cover' => __( 'Cover', 'gently' ),
		'contain' => __( 'Contain', 'gently' ),
		'background-size' => __( 'Background Size', 'gently' ),
		'fixed' => __( 'Fixed', 'gently' ),
		'scroll' => __( 'Scroll', 'gently' ),
		'background-attachment' => __( 'Background Attachment', 'gently' ),
		'left-top' => __( 'Left Top', 'gently' ),
		'left-center' => __( 'Left Center', 'gently' ),
		'left-bottom' => __( 'Left Bottom', 'gently' ),
		'right-top' => __( 'Right Top', 'gently' ),
		'right-center' => __( 'Right Center', 'gently' ),
		'right-bottom' => __( 'Right Bottom', 'gently' ),
		'center-top' => __( 'Center Top', 'gently' ),
		'center-center' => __( 'Center Center', 'gently' ),
		'center-bottom' => __( 'Center Bottom', 'gently' ),
		'background-position' => __( 'Background Position', 'gently' ),
		'background-opacity' => __( 'Background Opacity', 'gently' ),
		'ON' => __( 'ON', 'gently' ),
		'OFF' => __( 'OFF', 'gently' ),
		'all' => __( 'All', 'gently' ),
		'cyrillic' => __( 'Cyrillic', 'gently' ),
		'cyrillic-ext' => __( 'Cyrillic Extended', 'gently' ),
		'devanagari' => __( 'Devanagari', 'gently' ),
		'greek' => __( 'Greek', 'gently' ),
		'greek-ext' => __( 'Greek Extended', 'gently' ),
		'khmer' => __( 'Khmer', 'gently' ),
		'latin' => __( 'Latin', 'gently' ),
		'latin-ext' => __( 'Latin Extended', 'gently' ),
		'vietnamese' => __( 'Vietnamese', 'gently' ),
		'serif' => _x( 'Serif', 'font style', 'gently' ),
		'sans-serif' => _x( 'Sans Serif', 'font style', 'gently' ),
		'monospace' => _x( 'Monospace', 'font style', 'gently' ),
	);

	$args = array(
		'logo_image'   => 'http://kirki.org/images/logo.png',
		'description'  => __( 'The theme description.', 'gently' ),
		'color_accent' => '#147bb2',
		'color_back'   => '#2e2e2e',
		'textdomain'   => 'gently',
		'i18n'         => $strings,
	);

	return $args;

}
add_filter( 'kirki/config', 'gently_kirki_configuration' );

function gently_kirki_fields( $fields ) {

	$fields[] = array(
		'type'        => 'color',
		'setting'     => 'color_headings',
		'label'       => __( 'Headings color.', 'gently' ),
		'section'     => 'colors',
		'default'     => '#2D2D2D',
		'priority'    => 11,
//		'transport'   => 'postMessage',
		'output'      => array(
			array(
				'element'  => 'h1, h2, h3, h4, h5, h6',
				'property' => 'color'
			),
		)
	);
	$fields[] = array(
		'type'        => 'color',
		'setting'     => 'color_bodytext',
		'label'       => __( 'Body text color.', 'gently' ),
		'section'     => 'colors',
		'default'     => '#404040',
		'priority'    => 12,
//		'transport'   => 'postMessage',
		'output'      => array(
			array(
				'element'  => 'body, button, input, select, textarea',
				'property' => 'color'
			),
		)
	);
	$fields[] = array(
		'type'        => 'color',
		'setting'     => 'color_sidebar_bg',
		'label'       => __( 'Sidebar background color.', 'gently' ),
		'section'     => 'colors',
		'default'     => '#F7F8F9',
		'priority'    => 13,
		'transport'   => 'postMessage',
		'output'      => array(
			array(
				'element'  => '.variable-top-border',
				'property' => 'color'
			),
		)
	);
	$fields[] = array(
		'type'        => 'color',
		'setting'     => 'color_sidebar_border',
		'label'       => __( 'Sidebar border color.', 'gently' ),
		'section'     => 'colors',
		'default'     => '#DDE2E6',
		'priority'    => 14,
		'transport'   => 'postMessage',
		'output'      => array(
			array(
				'element'  => '.variable-top-border',
				'property' => 'color'
			),
		)
	);
	$fields[] = array(
		'type'        => 'color',
		'setting'     => 'color_accent',
		'label'       => __( 'Link and accent color.', 'gently' ),
		'section'     => 'colors',
		'default'     => '#147BB2',
		'priority'    => 15,
		'transport'   => 'postMessage',
		'output'      => array(
			array(
				'element'  => '.variable-top-border',
				'property' => 'color'
			),
		)
	);
	$fields[] = array(
		'type'        => 'color',
		'setting'     => 'color_nav_bg',
		'label'       => __( 'Navigation bar background color.', 'gently' ),
		'section'     => 'colors',
		'default'     => '#FFFFFF',
		'priority'    => 16,
		'transport'   => 'postMessage',
		'output'      => array(
			array(
				'element'  => '.variable-top-border',
				'property' => 'color'
			),
		)
	);
	$fields[] = array(
		'type'        => 'color',
		'setting'     => 'color_nav_border',
		'label'       => __( 'Navigation bar border color.', 'gently' ),
		'section'     => 'colors',
		'default'     => '#D7D7D7',
		'priority'    => 17,
		'transport'   => 'postMessage',
		'output'      => array(
			array(
				'element'  => '.variable-top-border',
				'property' => 'color'
			),
		)
	);


	$fields[] = array(
		'type'        => 'sortable',
		'setting'     => 'share_buttons',
		'label'       => __( 'Share buttons', 'kirki' ),
		'description' => __( 'This is the control description', 'kirki' ),
		'help'        => __( 'This is some extra help. You can use this to add some additional instructions for users. The main description should go in the "description" of the field, this is only to be used for help tips.', 'kirki' ),
		'section'     => 'social',
		'default'     => array(
			'facebook',
			'twitter',
			'google'
		),
		'priority'    => 10,
		'choices'     => array(
			'facebook'    => __( 'Facebook', 'gently' ),
			'twitter'     => __( 'Twitter', 'gently' ),
			'google'      => __( 'Google+', 'gently' ),
			'reddit'      => __( 'Reddit', 'gently' ),
			'linkedin'    => __( 'LinkedIn', 'gently' ),
			'stumbleupon' => __( 'StumbleUpon', 'gently' ),
			'pinterest'   => __( 'Pinterest', 'gently' )
		),
	);

	return $fields;

}
add_filter( 'kirki/fields', 'gently_kirki_fields' );