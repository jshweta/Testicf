<?php
/**
 * marla functions and definitions
 *
 * @package marla
 */
/**
 * Set the content width based on the theme's design and stylesheet.
 */
// Set content width value based on the theme's design
if ( ! isset( $content_width ) )
	$content_width = 510;
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function marla_setup() {
	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on marla, use a find and replace
	 * to change 'marla' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'marla', get_template_directory() . '/languages' );
	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );
	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 300, 300, true ); // Post thumbnail size for excerpts and search results
	add_image_size( 'home-thumb', 330 ); 
	add_image_size( 'full-width', 530, 9999 ); // Post thumbnail size for full post displays
	$custom_background_args = array(
			'default-color' => 'FFF',
		'default-image' => '',
	);
	add_theme_support( 'custom-background', $custom_background_args );
	/**
	 * This theme styles the visual editor with editor-style.css to match the theme style.
	 */
	if( get_theme_mod( 'marla_editor' ) != marla_default_settings('marla_editor') ) {add_editor_style();}
	
	/**
	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'marla' ),
	) );
	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
}
add_action( 'after_setup_theme', 'marla_setup' );
/**
 * Setup the WordPress core custom background feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for WordPress 3.3
 * using feature detection of wp_get_theme() which was introduced
 * in WordPress 3.4.
 *
 * @todo Remove the 3.3 support when WordPress 3.6 is released.
 *
 * Hooks into the after_setup_theme action.
 */
/**
 * Implement the Custom Header feature*/
 
 
require get_template_directory() . '/inc/custom-header.php';
/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';
/**
 * Add social networks inputs to profile.
 */
require get_template_directory() . '/inc/author-inputs.php';
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
/** marla*/
require get_template_directory() . '/inc/widgets.php';
require get_template_directory() . '/inc/scripts.php';
require get_template_directory() . '/inc/defaults.php';
require get_template_directory() . '/inc/styles.php';
function marla_remove_version() {
return '';
}
add_filter('the_generator', 'marla_remove_version');
function marla_add_pages() {
    add_theme_page('custom menu title', 'Marla Theme', 'add_users','customize.php');
}
add_action('admin_menu', 'marla_add_pages');
function marla_admin_bar_render() {
	global $wp_admin_bar;
	$wp_admin_bar->add_menu( array(
		'parent' => false, // use 'false' for a root menu, or pass the ID of the parent menu
		'id' => 'marla_theme', // link ID, defaults to a sanitized title value
		'title' => __('Marla Theme', 'marla'), // link title
		'href' => admin_url( 'customize.php'), // name of file
		'meta' => false 
	));
}
add_action( 'wp_before_admin_bar_render', 'marla_admin_bar_render' );
function marla_embed_defaults($embed_size){
    if( is_single() ){ 
        $embed_size['width'] = 510; 
        /* $embed_size['height'] = auto;*/
    }
     
    return $embed_size; 
}
 
add_filter('embed_defaults', 'marla_embed_defaults');
update_option('large_size_w', 510);
function marla_fb_language () {
	$wplang = get_bloginfo( 'language' );
	$marlafblang = str_replace("-", "_", $wplang);
	echo $marlafblang;
	}
function marla_twitter_language () {
	$wplang = get_bloginfo( 'language' );
	$longlanguage = array("-ES", "-EN");
	$marlatwlang = str_replace($longlanguage, "", $wplang);
	echo $marlatwlang;
	}
add_filter('widget_text', 'do_shortcode');
?>