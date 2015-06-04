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
		$wp_customize->add_section( 'typography', array(
			'title'    => __( 'Typography', 'gently' ),
			'priority' => 41
		) );
		$wp_customize->add_section( 'header', array(
			'title'    => __( 'Top bar', 'gently' ),
			'priority' => 91
		) );
		$wp_customize->add_section( 'social', array(
			'title'    => __( 'Social Media', 'gently' ),
			'priority' => 101,
			'description' => __( 'Share buttons will be displayed under each single post.', 'gently' ),
		) );
		$wp_customize->add_section( 'sidebar', array(
			'title'    => __( 'Sidebar', 'gently' ),
			'priority' => 102
		) );

		// Change settings of default sections
		$branding_section = $wp_customize->get_section( 'title_tagline' );
		$branding_section->title = __( 'Site Branding', 'gently' );
		$branding_section->description = __( 'Choose logo image or use text version.' );

		$background_section = $wp_customize->get_section( 'background_image' );
		$background_section->title = __( 'Background' );

		// Move background color to custom section
		$background_color_control = $wp_customize->get_control( 'background_color' );
		$background_color_control->section = 'background_image';

		// Change blogname setting transport to post
		$blogname_setting = $wp_customize->get_setting( 'blogname' );
		$blogname_setting->transport = 'postMessage';

		// Remove tagline field
		$wp_customize->remove_setting( 'blogdescription' );
		$wp_customize->remove_control( 'blogdescription' );
	}
}
add_action( 'customize_register', 'gently_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function gently_customize_preview_js() {
	wp_enqueue_script( 'gently_customizer', get_template_directory_uri() . '/js/admin/customizer.js', array( 'customize-preview' ), '20150604', true );
}
add_action( 'customize_preview_init', 'gently_customize_preview_js' );

/**
 * Configuration of the Kirki Customizer
 * @todo Add good logo.
 * @todo Change descriptions of options.
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
		'logo_image'   => get_stylesheet_directory_uri() . '/img/logo.png',
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

	/* Branding fields
	 * @todo Add retina logo as default option.
	**/
	$fields[] = array(
		'type'        => 'image',
		'setting'     => 'logo_image',
		'label'       => __( 'Logo image', 'gently' ),
		'description' => __( 'Normal size version of your logo.', 'gently' ),
		'help'        => __( 'If you want to use text instead, just remove the image.', 'gently' ),
		'section'     => 'title_tagline',
		'default'     => get_stylesheet_directory_uri() . '/img/logo.png',
		'priority'    => 8,
	);
	$fields[] = array(
		'type'        => 'image',
		'setting'     => 'logo_image_retina',
		'label'       => __( 'Logo image retina version', 'gently' ),
		'description' => __( 'Two times bigger than normal for high resolution retina displays.', 'gently' ),
		'section'     => 'title_tagline',
		'default'     => get_stylesheet_directory_uri() . '/img/logo.png',
		'priority'    => 9,
	);
	$fields[] =  array(
		'type'     => 'select',
		'setting'  => 'logo_font_family',
		'label'    => __( 'Logo font', 'gently' ),
		'section'  => 'title_tagline',
		'default'  => 'Playfair Display',
		'priority' => 21,
		'transport' => 'postMessage',
		'choices'  => Kirki_Fonts::get_font_choices(),
		'output' => array(
			'element'  => '.site-title',
			'property' => 'font-family',
		)
	);
	$fields[] = array(
		'type'      => 'slider',
		'setting'   => 'logo_font_size',
		'label'     => __( 'Logo font size', 'gently' ),
		'section'   => 'title_tagline',
		'default'   => 43,
		'priority'  => 22,
		'transport' => 'postMessage',
		'choices'   => array(
			'min'   => 12,
			'max'   => 50,
			'step'  => 1,
		),
		'output'    => array(
			'element'  => '.site-title',
			'property' => 'font-size',
			'units'    => 'px',
		)
	);
	$fields[] = array(
		'type'        => 'color',
		'setting'     => 'logo_font_color',
		'label'       => __( 'Logo font color', 'gently' ),
		'section'     => 'title_tagline',
		'default'     => '#2d2d2d',
		'priority'    => 23,
		'transport'   => 'postMessage',
		'output'      => array(
			'element'  => '.site-title',
			'property' => 'color'
		),
		'js_vars'   => array(
			array(
				'element'  => '.site-title',
				'function' => 'css',
				'property' => 'color',
			)
		)
	);

	/* Typography fields */
	$fields[] =  array(
		'type'     => 'select',
		'setting'  => 'body_text_font',
		'label'    => __( 'Body text font', 'gently' ),
		'section'  => 'typography',
		'default'  => 'PT Serif',
		'priority' => 20,
		'choices'  => Kirki_Fonts::get_font_choices(),
		'output' => array(
			'element'  => 'body, button, input, select, textarea',
			'property' => 'font-family',
		),
	);
	$fields[] = array(
		'type'        => 'color',
		'setting'     => 'body_text_color',
		'label'       => __( 'Body text color', 'gently' ),
		'section'     => 'typography',
		'default'     => '#404040',
		'priority'    => 21,
		'transport'   => 'postMessage',
		'output'      => array(
			'element'  => 'body, button, input, select, textarea',
			'property' => 'color'
		),
		'js_vars'   => array(
			array(
				'element'  => 'body, button, input, select, textarea',
				'function' => 'css',
				'property' => 'color',
			)
		)
	);
	$fields[] =  array(
		'type'     => 'select',
		'setting'  => 'headings_font',
		'label'    => __( 'Headings font', 'gently' ),
		'section'  => 'typography',
		'default'  => 'Playfair Display',
		'priority' => 22,
		'choices'  => Kirki_Fonts::get_font_choices(),
		'output' => array(
			'element'  => 'h1, h2, h3, h4, h5, h6',
			'property' => 'font-family',
		),
	);
	$fields[] = array(
		'type'        => 'color',
		'setting'     => 'headings_color',
		'label'       => __( 'Headings color', 'gently' ),
		'section'     => 'typography',
		'default'     => '#2D2D2D',
		'priority'    => 23,
		'transport'   => 'postMessage',
		'output'      => array(
			'element'  => 'h1, h2, h3, h4, h5, h6',
			'property' => 'color'
		),
		'js_vars'   => array(
			array(
				'element'  => 'h1, h2, h3, h4, h5, h6',
				'function' => 'css',
				'property' => 'color',
			)
		)
	);
	$fields[] = array(
		'type'        => 'color',
		'setting'     => 'accent_color',
		'label'       => __( 'Links and accent color', 'gently' ),
		'section'     => 'typography',
		'default'     => '#147BB2',
		'priority'    => 24,
		'transport'   => 'postMessage',
		'output'      => array(
			array(
				'element'  => '.variable-top-border',
				'property' => 'color'
			),
		),
		'js_vars'   => array(
			array(
				'element'  => 'a',
				'function' => 'css',
				'property' => 'color',
			)
		)
	);

	/* Sidebar fields
	 * @todo Add correct graphics to image select.
	**/
	$fields[] = array(
		'type'        => 'color',
		'setting'     => 'sidebar_bg',
		'label'       => __( 'Sidebar background color', 'gently' ),
		'section'     => 'sidebar',
		'default'     => '#F7F8F9',
		'priority'    => 10,
		'transport'   => 'postMessage',
		'output'      => array(
			array(
				'element'  => '.main-sidebar',
				'property' => 'background-color'
			)
		),
		'js_vars'   => array(
			array(
				'element'  => '.main-sidebar',
				'function' => 'css',
				'property' => 'background-color',
			)
		)
	);
	$fields[] = array(
		'type'        => 'color',
		'setting'     => 'sidebar_border',
		'label'       => __( 'Sidebar border color', 'gently' ),
		'section'     => 'sidebar',
		'default'     => '#DDE2E6',
		'priority'    => 11,
		'transport'   => 'postMessage',
		'output'      => array(
			array(
				'element'  => '.site-content',
				'property' => 'border-color'
			)
		),
		'js_vars'   => array(
			array(
				'element'  => '.site-content',
				'function' => 'css',
				'property' => 'border-color',
			)
		)
	);
	$fields[] = array(
		'type'        => 'radio-image',
		'setting'     => 'sidebar_position',
		'label'       => __( 'Sidebar position', 'gently' ),
		'section'     => 'sidebar',
		'default'     => 'left',
		'transport'   => 'postMessage',
		'priority'    => 12,
		'choices'     => array(
			'left' => admin_url() . '/images/align-left-2x.png',
			'right' => admin_url() . '/images/align-right-2x.png',
		)
	);
	$fields[] = array(
		'type'        => 'multicheck',
		'setting'     => 'sidebar_collapse',
		'label'       => __( 'Collapse sidebar by default', 'gently' ),
		'description' => __( 'Check on what type of pages sidebar will be collapsed by default.', 'genly' ),
		'section'     => 'sidebar',
		'default'     => array('single, home'),
		'priority'    => 13,
		'choices'     => array(
			'home'    => __( 'Home page', 'gently' ),
			'single'  => __( 'Single post', 'gently' ),
			'archive' => __( 'Archive', 'gently' ),
		),
	);

	/* Top bar fields
	 * @todo Add js_vars when header is ready.
	**/
	$fields[] = array(
		'type'        => 'color',
		'setting'     => 'header_bg',
		'label'       => __( 'Top bar background color', 'gently' ),
		'section'     => 'header',
		'default'     => '#FFFFFF',
		'priority'    => 10,
		'transport'   => 'postMessage',
		'output'      => array(
			array(
				'element'  => '.site-header, .main-navigation .sub-menu',
				'property' => 'background-color'
			),
		),
		'js_vars'   => array(
			array(
				'element'  => '.site-header, .main-navigation .sub-menu',
				'function' => 'css',
				'property' => 'background-color',
			)
		)
	);
	$fields[] = array(
		'type'        => 'color',
		'setting'     => 'header_border',
		'label'       => __( 'Top bar border color', 'gently' ),
		'section'     => 'header',
		'default'     => '#FFFFFF',
		'priority'    => 11,
		'transport'   => 'postMessage',
		'output'      => array(
			array(
				'element'  => '.site .site-header, #site-navigation ul, .main-navigation .sub-menu',
				'property' => 'border-color'
			),
		),
		'js_vars'   => array(
			array(
				'element'  => '.site .site-header',
				'function' => 'css',
				'property' => 'border-color',
			),
			array(
				'element'  => '#site-navigation ul',
				'function' => 'css',
				'property' => 'border-color',
			),
			array(
				'element'  => '.main-navigation .sub-menu',
				'function' => 'css',
				'property' => 'border-color',
			)
		)
	);
	$fields[] = array(
		'type'        => 'multicheck',
		'setting'     => 'header_features',
		'label'       => __( 'Top bar features', 'gently' ),
		'description' => __( 'Check what features you want to display in header.', 'genly' ),
		'section'     => 'header',
		'default'     => array('social', 'search'),
		'priority'    => 12,
		'choices'     => array(
			'social' => __( 'Social icons', 'gently' ),
			'search' => __( 'Search', 'gently' ),
		),
	);
	$fields[] = array(
		'type'      => 'slider',
		'setting'   => 'header_icon_size',
		'label'     => __( 'Social icons size', 'gently' ),
		'section'   => 'header',
		'default'   => 14,
		'priority'  => 13,
		'transport' => 'postMessage',
		'choices'   => array(
			'min'   => 8,
			'max'   => 30,
			'step'  => 1,
		),
		'output'    => array(
			'element'  => '.top-bar .social-links',
			'property' => 'font-size',
			'units'    => 'px',
		)
	);
	$fields[] = array(
		'type'        => 'color',
		'setting'     => 'header_icons_color',
		'label'       => __( 'Social icons color', 'gently' ),
		'section'     => 'header',
		'default'     => '#147bb2',
		'priority'    => 14,
		'transport'   => 'postMessage',
		'output'      => array(
			array(
				'element'  => '.top-bar .social-links a',
				'property' => 'color'
			),
		),
		'js_vars'   => array(
			array(
				'element'  => '.top-bar .social-links a',
				'function' => 'css',
				'property' => 'color',
			)
		)
	);
	$fields[] = array(
		'type'        => 'checkbox',
		'setting'     => 'header_icons_color_original',
		'label'       => __( 'Use original icons color', 'gently' ),
		'section'     => 'header',
		'default'     => false,
		'priority'    => 15,
		'transport'   => 'postMessage'
	);

	/* Navigation fields */
	$fields[] = array(
		'type'        => 'color',
		'setting'     => 'header_font_color',
		'label'       => __( 'Navigation color', 'gently' ),
		'section'     => 'nav',
		'default'     => '#969696',
		'priority'    => 13,
		'transport'   => 'postMessage',
		'output'      => array(
			array(
				'element'  => '#primary-menu',
				'property' => 'color'
			),
		),
		'js_vars'   => array(
			array(
				'element'  => '#primary-menu',
				'function' => 'css',
				'property' => 'color',
			)
		)
	);
	$fields[] = array(
		'type'      => 'slider',
		'setting'   => 'header_font_size',
		'label'     => __( 'Navigation font size', 'gently' ),
		'section'   => 'nav',
		'default'   => 16,
		'priority'  => 14,
		'transport' => 'postMessage',
		'choices'   => array(
			'min'   => 10,
			'max'   => 30,
			'step'  => 1,
		),
		'output'    => array(
			'element'  => '#primary-menu',
			'property' => 'font-size',
			'units'    => 'px',
		)
	);

	/**
	 * Social media fields
	 * @todo Add social icons to header.
	**/
	$fields[] = array(
		'type'        => 'sortable',
		'setting'     => 'share_buttons',
		'label'       => __( 'Share buttons', 'gently' ),
		'description' => __( 'Choose and reorder buttons.', 'gently' ),
		'help'        => __( 'To turn on/off a service click on the eye icon. To reorder simply drag and drop.', 'gently' ),
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
	$fields[] = array(
		'type'        => 'textarea',
		'setting'     => 'social_links',
		'label'       => __( 'Header social icons', 'gently' ),
		'description' => __( 'Enter each link in new line', 'genly' ),
		'section'     => 'social',
		'default'     => '',
		'priority'    => 11,
	);

	/* Header image fields */
	$fields[] = array(
		'type'      => 'slider',
		'setting'   => 'header_image_height',
		'label'     => __( 'Header height', 'gently' ),
		'section'   => 'header_image',
		'default'   => 150,
		'priority'  => 70,
		'transport' => 'postMessage',
		'choices'   => array(
			'min'   => 50,
			'max'   => 500,
			'step'  => 1,
		),
		'output'    => array(
			'element'  => '.header-image',
			'property' => 'max-height',
			'units'    => 'px',
		)
	);

	return $fields;

}
add_filter( 'kirki/fields', 'gently_kirki_fields' );