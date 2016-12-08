<?php
/**
 * Accesspress Basic functions and definitions
 *
 * @package Accesspress Basic
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'accesspress_basic_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function accesspress_basic_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Accesspress Basic, use a find and replace
	 * to change 'accesspress-basic' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'accesspress-basic', get_template_directory() . '/languages' );

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
     *
     * Add Feature Image Support to the Pages
     *
     */
    add_theme_support( 'post-thumbnails', array( 'page','post' ) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'accesspress-basic' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'accesspress_basic_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // accesspress_basic_setup
add_action( 'after_setup_theme', 'accesspress_basic_setup' );

/**
 * Enqueue scripts and styles.
 */
function accesspress_basic_scripts() {
	wp_enqueue_style( 'accesspress-basic-superfish-css', get_template_directory_uri() . '/css/superfish.css');
	wp_enqueue_style( 'accesspress-basic-lato-font', '//fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic' );
	wp_enqueue_style( 'accesspress-basic-style', get_stylesheet_uri() );
	wp_enqueue_style( 'accesspress-basic-responsive-css', get_template_directory_uri() . '/css/responsive.css');
	

	wp_enqueue_script( 'accesspress-basic-superfish', get_template_directory_uri() . '/js/superfish.js', array('jquery','hoverIntent'));
	wp_enqueue_script( 'accesspress-basic-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '20120206', true );

	wp_enqueue_script( 'accesspress-basic-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array('jquery'), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'accesspress_basic_scripts' );

/**
 * Custom Image Sizes
 */
 add_image_size('accesspress-basic-features-post-thumbnail',375,250,true);
 add_image_size('accesspress-basic-testimonial-thumbnail', 125, 125, true);
 add_image_size('accesspress-basic-services-thumbnail', 233, 156, true);
 add_image_size('accesspress-basic-blog-medium-thumbnail', 380, 252, true);
 add_image_size('accesspress-basic-blog-large-thumbnail', 840, 370, true);

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/apbasic-functions.php';

/**
 * Load Accesspress Basic Metaboxes
 */
require get_template_directory() . '/inc/apbasic-custom-metabox.php';

/**
 * Load Theme Options
 */
require get_template_directory() . '/inc/admin-panel/theme-options.php';

/**
 * Load Accesspress Basic Widgets
 */
require get_template_directory() . '/inc/apbasic-widgets.php';

/**
 * Load TGM_Plugin_Activation class.
 */
require get_template_directory() . '/inc/class-tgm-plugin-activation.php';


function filter_media_comment_status( $open, $post_id ) {
$post = get_post( $post_id );
if( $post->post_type == 'attachment' ) {
return false;
}
return $open;
}
add_filter( 'comments_open', 'filter_media_comment_status', 10 , 2 );





/********* Specific Post Single post for specific category ********/


add_action('template_include', 'load_single_template');
  function load_single_template($template) {
    $new_template = '';

    // single post template
    if( is_single() ) {
      global $post;
      // 'cat-1' and 'cat-2' are category slugs

      if( has_term('bookslibrary', 'category', $post) ) {
        // use template file single-template-cat-1.php
        $new_template = locate_template(array('single-template-bookslibrary.php' ));
      }
      if( has_term('reportslibrary', 'category', $post) ) {
        // use template file single-template-cat-1.php
        $new_template = locate_template(array('single-template-reportslibrary.php' ));
      }
      if( has_term('archiveslibrary', 'category', $post) ) {
        // use template file single-template-cat-1.php
        $new_template = locate_template(array('single-template-archiveslibrary.php' ));
      }
      if( has_term('feature', 'category', $post) ) {
        // use template file single-template-cat-1.php
        $new_template = locate_template(array('single-template-feature.php' ));
      }
	if( has_term('response', 'category', $post) ) {
        // use template file single-template-cat-1.php
        $new_template = locate_template(array('single-template-response.php' ));
      }
	if( has_term('cultural', 'category', $post) ) {
        // use template file single-template-cat-1.php
        $new_template = locate_template(array('single-template-cultural.php' ));
      }

    }
    return ('' != $new_template) ? $new_template : $template;
  }










