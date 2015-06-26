<?php
/**
 * Gently Theme Customizer
 *
 * @package Gently
 */

/**
 * Check if Kirki plugin is installed. If not load function with default settings.
 */
function gently_is_kirki_installed() {
	if ( ! function_exists( 'kirki_get_option' ) ) {
		function kirki_get_option( $setting ) {

			$defaults = array(
				'logo_image'                  => get_stylesheet_directory_uri() . '/img/logo.png',
				'logo_image_retina'           => get_stylesheet_directory_uri() . '/img/logo2x.png',
				'logo_font_family'            => 'Playfair Display',
				'logo_font_size'              => 43,
				'logo_font_color'             => '#2d2d2d',
				'favicon'                     => get_stylesheet_directory_uri() . '/img/favicon.png',
				'body_text_font'              => 'Open Sans',
				'body_text_color'             => '#575757',
				'headings_font'               => 'Playfair Display',
				'headings_color'              => '#2D2D2D',
				'accent_color'                => '#147BB2',
				'meta_color'                  => '#AAAAAA',
				'details_color'               => '#EEEEEE',
				'sidebar_bg'                  => '#fdfdfd',
				'sidebar_border'              => '#f1f2f4',
				'sidebar_position'            => 'right',
				'sidebar_collapse'            => array( 'single, home' ),
				'header_bg'                   => '#f8f9fa',
				'header_border'               => '#e7e7e7',
				'header_features'             => array( 'social', 'search' ),
				'header_icon_size'            => 14,
				'header_icons_color'          => '#147bb2',
				'header_icons_color_original' => false,
				'header_font_color'           => '#909699',
				'header_font_size'            => 13,
				'footer_bg'                   => '#ffffff',
				'footer_border'               => '#ffffff',
				'footer_text'                 => '<a href="http://wordpress.org/">Proudly powered by WordPress</a><span class="sep"> | </span>Theme: Gently by <a href="http://muster-themes.net/" rel="designer">MusterThemes</a>.',
				'share_buttons'               => array( 'facebook', 'twitter', 'google' ),
				'social_links'                => '',
				'header_image_height'         => 150,
				'newsletter_use'              => true,
				'newsletter_bg'               => '#F7F8F9',
				'newsletter_border'           => '#DDE2E6',
			);

			return $defaults[ $setting ];
		}

		/* Get 2 default Google fonts */
		function gently_get_default_fonts() {
			wp_enqueue_style( 'default-google-fonts', 'http://fonts.googleapis.com/css?family=Playfair+Display:400,700|Open+Sans:400' );
		}

		add_action( 'wp_enqueue_scripts', 'gently_get_default_fonts' );
	}
}
if ( ! is_admin() ) {
	add_action( 'init', 'gently_is_kirki_installed' );
}
add_action( 'customize_preview_init', 'gently_is_kirki_installed' );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function gently_customize_register( $wp_customize ) {
	if ( class_exists( 'Kirki' ) ) {
		$wp_customize->add_section( 'color', array(
			'title'    => __( 'Color', 'gently' ),
			'priority' => 81
		) );
		$wp_customize->add_section( 'typography', array(
			'title'    => __( 'Typography', 'gently' ),
			'priority' => 82
		) );
		$wp_customize->add_section( 'header', array(
			'title'    => __( 'Top bar', 'gently' ),
			'priority' => 91
		) );
		$wp_customize->add_section( 'sidebar', array(
			'title'    => __( 'Sidebar', 'gently' ),
			'priority' => 101
		) );
		$wp_customize->add_section( 'footer', array(
			'title'    => __( 'Footer', 'gently' ),
			'priority' => 111
		) );
		$wp_customize->add_section( 'social', array(
			'title'       => __( 'Social Media', 'gently' ),
			'priority'    => 112,
			'description' => __( 'Share buttons will be displayed under each single post.', 'gently' ),
		) );
		if ( function_exists( 'mc4wp_form' ) ) {
			$wp_customize->add_section( 'newsletter', array(
				'title'    => __( 'Newsletter', 'gently' ),
				'priority' => 113
			) );
		}

		// Change settings of default sections
		$branding_section = $wp_customize->get_section( 'title_tagline' );
		$branding_section->title = __( 'Site Branding', 'gently' );

		$background_section = $wp_customize->get_section( 'background_image' );
		$background_section->title = __( 'Background', 'gently' );

		// Move background color to custom section
		$background_color_control = $wp_customize->get_control( 'background_color' );
		$background_color_control->section = 'background_image';

		// Change blogname setting transport to post, description and title
		$blogname_setting = $wp_customize->get_setting( 'blogname' );
		$blogname_setting->transport = 'postMessage';

		$blogname_controll = $wp_customize->get_control( 'blogname' );
		$blogname_controll->description = __( 'If you want to use text version of logo remove images above.', 'gently' );
		$blogname_controll->label = __( 'Logo text', 'gently' );

		// Change Header image section order
		$header_image_section = $wp_customize->get_section( 'header_image' );
		$header_image_section->priority = 99;


		// Remove unused header text and text color controls
		$wp_customize->remove_control( 'display_header_text' );
		$wp_customize->remove_control( 'header_textcolor' );

		// Remove colors panel
		$wp_customize->remove_panel( 'colors' );

		// Remove tagline field
		$wp_customize->remove_setting( 'blogdescription' );
		$wp_customize->remove_control( 'blogdescription' );

	} else {
		// Convert default section to a notice that inform user about more options in customzier when they install Kirki plugin.
		$wp_customize->add_section( 'notice', array(
			'title'       => __( 'Install Kirki for more options.', 'gently' ),
			'priority'    => 1,
			'description' => __( 'This theme uses free plugin from wordpress.org - Kirki. Install it to use many customizer options that comes with this theme.', 'gently' ),
		) );
		$wp_customize->add_setting(
			'install_notice',
			array(
				'default'           => '',
				'sanitize_callback' => 'esc_url_raw'
			)
		);
		$wp_customize->add_control(
			'install_notice',
			array(
				'section' => 'notice',
				'label'   => '',
				'type'    => ''
			)
		);

		$wp_customize->remove_section( 'title_tagline' );
		$wp_customize->remove_section( 'colors' );
		$wp_customize->remove_section( 'header_image' );
		$wp_customize->remove_section( 'background_image' );
		$wp_customize->remove_section( 'static_front_page' );
		$wp_customize->remove_panel( 'widgets' );

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
 * Add styles to Theme Customizer controls
 */
function gently_customize_preview_style() {
	wp_enqueue_style( 'gently_customizer_style', get_template_directory_uri() . '/css/customizer-style.css' );
}

add_action( 'customize_controls_print_styles', 'gently_customize_preview_style' );

/**
 * Configuration of the Kirki Customizer
 */
function gently_kirki_configuration() {

	$strings = array(
		'background-color'      => __( 'Background Color', 'gently' ),
		'background-image'      => __( 'Background Image', 'gently' ),
		'no-repeat'             => __( 'No Repeat', 'gently' ),
		'repeat-all'            => __( 'Repeat All', 'gently' ),
		'repeat-x'              => __( 'Repeat Horizontally', 'gently' ),
		'repeat-y'              => __( 'Repeat Vertically', 'gently' ),
		'inherit'               => __( 'Inherit', 'gently' ),
		'background-repeat'     => __( 'Background Repeat', 'gently' ),
		'cover'                 => __( 'Cover', 'gently' ),
		'contain'               => __( 'Contain', 'gently' ),
		'background-size'       => __( 'Background Size', 'gently' ),
		'fixed'                 => __( 'Fixed', 'gently' ),
		'scroll'                => __( 'Scroll', 'gently' ),
		'background-attachment' => __( 'Background Attachment', 'gently' ),
		'left-top'              => __( 'Left Top', 'gently' ),
		'left-center'           => __( 'Left Center', 'gently' ),
		'left-bottom'           => __( 'Left Bottom', 'gently' ),
		'right-top'             => __( 'Right Top', 'gently' ),
		'right-center'          => __( 'Right Center', 'gently' ),
		'right-bottom'          => __( 'Right Bottom', 'gently' ),
		'center-top'            => __( 'Center Top', 'gently' ),
		'center-center'         => __( 'Center Center', 'gently' ),
		'center-bottom'         => __( 'Center Bottom', 'gently' ),
		'background-position'   => __( 'Background Position', 'gently' ),
		'background-opacity'    => __( 'Background Opacity', 'gently' ),
		'ON'                    => __( 'ON', 'gently' ),
		'OFF'                   => __( 'OFF', 'gently' ),
		'all'                   => __( 'All', 'gently' ),
	);

	$args = array(
		'logo_image'   => get_stylesheet_directory_uri() . '/img/logo_white.png',
		'description'  => __( 'The theme description.', 'gently' ),
		'color_accent' => '#147bb2',
		'color_back'   => '#2e2e2e',
		'textdomain'   => 'gently',
		'i18n'         => $strings,
	);

	return $args;

}

add_filter( 'kirki/config', 'gently_kirki_configuration' );

/**
 * Define all settings that will be used with Kirki in customizer
 */
function gently_kirki_fields( $fields ) {

	/* Branding fields */
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
		'description' => __( '2 times bigger image for high resolution retina displays.', 'gently' ),
		'section'     => 'title_tagline',
		'default'     => get_stylesheet_directory_uri() . '/img/logo2x.png',
		'priority'    => 9,
	);
	$fields[] = array(
		'type'      => 'select',
		'setting'   => 'logo_font_family',
		'label'     => __( 'Logo font', 'gently' ),
		'section'   => 'title_tagline',
		'default'   => 'Playfair Display',
		'priority'  => 21,
		'transport' => 'postMessage',
		'choices'   => Kirki_Fonts::get_font_choices(),
		'output'    => array(
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
			'min'  => 12,
			'max'  => 50,
			'step' => 1,
		)
	);
	$fields[] = array(
		'type'      => 'color',
		'setting'   => 'logo_font_color',
		'label'     => __( 'Logo font color', 'gently' ),
		'section'   => 'title_tagline',
		'default'   => '#2d2d2d',
		'priority'  => 23,
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.site-title',
				'function' => 'css',
				'property' => 'color',
			)
		)
	);
	$fields[] = array(
		'type'        => 'image',
		'setting'     => 'favicon',
		'label'       => __( 'Favicon', 'gently' ),
		'description' => __( '32px by 32px', 'gently' ),
		'section'     => 'title_tagline',
		'default'     => get_stylesheet_directory_uri() . '/img/favicon.png',
		'priority'    => 24,
	);

	/* Typography fields */
	$fields[] = array(
		'type'     => 'select',
		'setting'  => 'body_text_font',
		'label'    => __( 'Body text font', 'gently' ),
		'section'  => 'typography',
		'default'  => 'Open Sans',
		'priority' => 20,
		'choices'  => Kirki_Fonts::get_font_choices(),
		'output'   => array(
			'element'  => 'body, button, input, select, textarea',
			'property' => 'font-family',
		),
	);
	$fields[] = array(
		'type'      => 'color',
		'setting'   => 'body_text_color',
		'label'     => __( 'Body text color', 'gently' ),
		'section'   => 'typography',
		'default'   => '#575757',
		'priority'  => 21,
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => 'body, button, input, select, textarea',
				'function' => 'css',
				'property' => 'color',
			)
		)
	);
	$fields[] = array(
		'type'     => 'select',
		'setting'  => 'headings_font',
		'label'    => __( 'Headings font', 'gently' ),
		'section'  => 'typography',
		'default'  => 'Playfair Display',
		'priority' => 22,
		'choices'  => Kirki_Fonts::get_font_choices(),
		'output'   => array(
			'element'  => 'h1, h2, h3, h4, h5, h6',
			'property' => 'font-family',
		),
	);
	$fields[] = array(
		'type'      => 'color',
		'setting'   => 'headings_color',
		'label'     => __( 'Headings color', 'gently' ),
		'section'   => 'typography',
		'default'   => '#2D2D2D',
		'priority'  => 23,
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => 'h1, h2, h3, h4, h5, h6',
				'function' => 'css',
				'property' => 'color',
			)
		)
	);

	/* Color fields */
	$fields[] = array(
		'type'     => 'color',
		'setting'  => 'accent_color',
		'label'    => __( 'Links and accent color', 'gently' ),
		'section'  => 'color',
		'default'  => '#147BB2',
		'priority' => 11
	);
	$fields[] = array(
		'type'      => 'color',
		'setting'   => 'meta_color',
		'label'     => __( 'Metadata color', 'gently' ),
		'section'   => 'color',
		'default'   => '#AAAAAA',
		'priority'  => 12,
		'transport' => 'postMessage'
	);
	$fields[] = array(
		'type'      => 'color',
		'setting'   => 'details_color',
		'label'     => __( 'Details color', 'gently' ),
		'section'   => 'color',
		'default'   => '#EEEEEE',
		'priority'  => 13,
		'transport' => 'postMessage'
	);

	/* Sidebar fields */
	$fields[] = array(
		'type'      => 'color',
		'setting'   => 'sidebar_bg',
		'label'     => __( 'Sidebar background color', 'gently' ),
		'section'   => 'sidebar',
		'default'   => '#fdfdfd',
		'priority'  => 10,
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.main-sidebar',
				'function' => 'css',
				'property' => 'background-color',
			)
		)
	);
	$fields[] = array(
		'type'      => 'color',
		'setting'   => 'sidebar_border',
		'label'     => __( 'Sidebar border color', 'gently' ),
		'section'   => 'sidebar',
		'default'   => '#f1f2f4',
		'priority'  => 11,
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.main-sidebar',
				'function' => 'css',
				'property' => 'border-color',
			)
		)
	);
	$fields[] = array(
		'type'      => 'radio-image',
		'setting'   => 'sidebar_position',
		'label'     => __( 'Sidebar position', 'gently' ),
		'section'   => 'sidebar',
		'default'   => 'right',
		'transport' => 'postMessage',
		'priority'  => 12,
		'choices'   => array(
			'left'  => get_stylesheet_directory_uri() . '/img/sidebar_left.png',
			'right' => get_stylesheet_directory_uri() . '/img/sidebar_right.png',
		)
	);
	$fields[] = array(
		'type'        => 'multicheck',
		'setting'     => 'sidebar_collapse',
		'label'       => __( 'Collapse sidebar by default', 'gently' ),
		'description' => __( 'Check on what type of pages sidebar will be collapsed by default.', 'genly' ),
		'section'     => 'sidebar',
		'default'     => array( 'single, home' ),
		'priority'    => 13,
		'choices'     => array(
			'home'    => __( 'Home page', 'gently' ),
			'single'  => __( 'Single post', 'gently' ),
			'archive' => __( 'Archive', 'gently' ),
		),
	);

	/* Top bar fields */
	$fields[] = array(
		'type'      => 'color',
		'setting'   => 'header_bg',
		'label'     => __( 'Top bar background color', 'gently' ),
		'section'   => 'header',
		'default'   => '#f8f9fa',
		'priority'  => 10,
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.site-header, .main-navigation .sub-menu',
				'function' => 'css',
				'property' => 'background-color',
			)
		)
	);
	$fields[] = array(
		'type'      => 'color',
		'setting'   => 'header_border',
		'label'     => __( 'Top bar border color', 'gently' ),
		'section'   => 'header',
		'default'   => '#e7e7e7',
		'priority'  => 11,
		'transport' => 'postMessage',
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
		'default'     => array( 'social', 'search' ),
		'priority'    => 12,
		'choices'     => array(
			'social' => __( 'Social icons', 'gently' ),
			'search' => __( 'Search', 'gently' ),
		),
	);
	$fields[] = array(
		'type'        => 'slider',
		'setting'     => 'header_icon_size',
		'label'       => __( 'Social icons size', 'gently' ),
		'description' => __( 'You can set with icons to display in Social Media section below.', 'gently' ),
		'section'     => 'header',
		'default'     => 14,
		'priority'    => 13,
		'transport'   => 'postMessage',
		'choices'     => array(
			'min'  => 8,
			'max'  => 30,
			'step' => 1,
		)
	);
	$fields[] = array(
		'type'      => 'color',
		'setting'   => 'header_icons_color',
		'label'     => __( 'Social icons color', 'gently' ),
		'section'   => 'header',
		'default'   => '#147bb2',
		'priority'  => 14,
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.top-bar .social-links a',
				'function' => 'css',
				'property' => 'color',
			)
		)
	);
	$fields[] = array(
		'type'      => 'checkbox',
		'setting'   => 'header_icons_color_original',
		'label'     => __( 'Use original icons color', 'gently' ),
		'section'   => 'header',
		'default'   => false,
		'priority'  => 15,
		'transport' => 'postMessage'
	);

	/* Navigation fields */
	$fields[] = array(
		'type'      => 'color',
		'setting'   => 'header_font_color',
		'label'     => __( 'Navigation color', 'gently' ),
		'section'   => 'nav',
		'default'   => '#909699',
		'priority'  => 13,
		'transport' => 'postMessage',
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
		'default'   => 13,
		'priority'  => 14,
		'transport' => 'postMessage',
		'choices'   => array(
			'min'  => 10,
			'max'  => 30,
			'step' => 1,
		)
	);

	/* Footer fields */
	$fields[] = array(
		'type'      => 'color',
		'setting'   => 'footer_bg',
		'label'     => __( 'Footer background color', 'gently' ),
		'section'   => 'footer',
		'default'   => '#ffffff',
		'priority'  => 10,
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.site-footer',
				'function' => 'css',
				'property' => 'background-color',
			)
		)
	);
	$fields[] = array(
		'type'      => 'color',
		'setting'   => 'footer_border',
		'label'     => __( 'Footer border color', 'gently' ),
		'section'   => 'footer',
		'default'   => '#ffffff',
		'priority'  => 11,
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.site-footer',
				'function' => 'css',
				'property' => 'border-color',
			)
		)
	);
	$fields[] = array(
		'type'     => 'textarea',
		'setting'  => 'footer_text',
		'label'    => __( 'Footer content', 'gently' ),
		'section'  => 'footer',
		'default'  => '<a href="http://wordpress.org/">Proudly powered by WordPress</a><span class="sep"> | </span>Theme: Gently by <a href="http://muster-themes.net/" rel="designer">MusterThemes</a>.',
		'priority' => 11,
	);

	/* Social media fields */
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
		'label'       => __( 'Top bar social icons', 'gently' ),
		'description' => __( 'Enter each link in new line', 'genly' ),
		'section'     => 'social',
		'default'     => '',
		'priority'    => 11,
	);

	/* Header image fields */
	$fields[] = array(
		'type'      => 'slider',
		'setting'   => 'header_image_height',
		'label'     => __( 'Header image height', 'gently' ),
		'section'   => 'header_image',
		'default'   => 150,
		'priority'  => 70,
		'transport' => 'postMessage',
		'choices'   => array(
			'min'  => 50,
			'max'  => 500,
			'step' => 1,
		)
	);

	/* Newsletter fields */
	$fields[] = array(
		'type'     => 'checkbox',
		'setting'  => 'newsletter_use',
		'label'    => __( 'Display newsletter under each post', 'gently' ),
		'section'  => 'newsletter',
		'default'  => true,
		'priority' => 10
	);
	$fields[] = array(
		'type'      => 'color',
		'setting'   => 'newsletter_bg',
		'label'     => __( 'Newsletter background color', 'gently' ),
		'section'   => 'newsletter',
		'default'   => '#F7F8F9',
		'priority'  => 20,
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => 'div.mc4wp-form',
				'function' => 'css',
				'property' => 'background-color',
			)
		)
	);
	$fields[] = array(
		'type'      => 'color',
		'setting'   => 'newsletter_border',
		'label'     => __( 'Newsletter border color', 'gently' ),
		'section'   => 'newsletter',
		'default'   => '#DDE2E6',
		'priority'  => 21,
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => 'div.mc4wp-form',
				'function' => 'css',
				'property' => 'border-color',
			)
		)
	);

	return $fields;

}

add_filter( 'kirki/fields', 'gently_kirki_fields' );