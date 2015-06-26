<?php
/**
 * Gently functions and definitions
 *
 * @package Gently
 */

if ( ! function_exists( 'gently_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function gently_setup() {

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Gently, use a find and replace
		 * to change 'gently' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'gently', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary'   => esc_html__( 'Primary Menu', 'gently' ),
			'secondary' => esc_html__( 'Secondary Menu', 'gently' )
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
		 * Set content width if it's not set already
		 */
		if ( ! isset( $content_width ) ) {
			$content_width = 700;
		}

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'gently_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		add_theme_support( 'custom-header', array(
			'default-image' => '',
			'width'         => 1920,
			'height'        => 500,
		) );
	}
endif; // gently_setup
add_action( 'after_setup_theme', 'gently_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function gently_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'gently_content_width', 700 );
}

add_action( 'after_setup_theme', 'gently_content_width', 0 );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function gently_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'gently' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}

add_action( 'widgets_init', 'gently_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function gently_scripts() {

	wp_enqueue_style( 'gently-style', get_template_directory_uri() . '/css/style.min.css' );

	wp_enqueue_script( 'gently-app', get_template_directory_uri() . '/js/app.min.js', array( 'jquery' ), '', true );

	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/vendor/font-awesome.min.css', array(), '05202015' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'gently_scripts' );

/**
 * Add editor stylesheet
 */
function gently_add_editor_styles() {
	add_editor_style( get_template_directory_uri() . '/css/custom-editor-style.css' );
}

add_action( 'admin_init', 'gently_add_editor_styles' );


/**
 * TGM Plugin Activation class
 */
require get_template_directory() . '/inc/class-tgm-plugin-activation.php';

/**
 * TGM Plugin Activation config
 */
require get_template_directory() . '/inc/tgm-plugin-activation.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Generating dynamic sytles.
 */
require get_template_directory() . '/inc/dynamic-styles.php';

/**
 * Share buttons.
 */
require get_template_directory() . '/inc/social-media.php';