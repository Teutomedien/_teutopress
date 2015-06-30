<?php
/**
 * Teutopress functions and definitions
 *
 * @package Teutopress
 */


define('DISABLE_RSS', true);
define('DISABLE_UPDATE_NOTICE_FOR_NON_ADMINS', true);
define('DISABLE_THEME_UPDATES', true);
define('DISABLE_COMMENTS', true);
define('DEV_VERSION', true);


if ( ! function_exists( '_teutopress_setup' ) ) :

function _teutopress_setup() {

	load_theme_textdomain( '_teutopress', get_template_directory() . '/languages' );


	add_theme_support( 'title-tag' );

	add_theme_support( 'post-thumbnails' );

	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', '_teutopress' ),
	) );


	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
}
endif; // _teutopress_setup
add_action( 'after_setup_theme', '_teutopress_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function _teutopress_content_width() {
	$GLOBALS['content_width'] = apply_filters( '_teutopress_content_width', 640 );
}
add_action( 'after_setup_theme', '_teutopress_content_width', 0 );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function _teutopress_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', '_teutopress' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', '_teutopress_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function _teutopress_scripts() {
	wp_enqueue_style( '_teutopress-style', get_stylesheet_uri() );

	wp_enqueue_script( '_teutopress-scripts', get_template_directory_uri() . '/js/scripts.js', array('jQuery'), '20120206', true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', '_teutopress_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Custom Post Types
 */
require get_template_directory() . '/inc/cpt.php';

/**
 * Include the AWESOME ACF Plugin in the Theme. BEWARE! You need to Copy Over your pto Version to the Directory
 * Works with the free plugin to.
 */
require get_template_directory() . '/inc/acf.php';




