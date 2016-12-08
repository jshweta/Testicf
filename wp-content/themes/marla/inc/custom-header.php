<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * You can add an optional custom header image to header.php like so ...
	<?php $header_image = get_header_image();
	if ( ! empty( $header_image ) ) { ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
			<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
		</a>
	<?php } // if ( ! empty( $header_image ) ) ?>
 *
 * @package marla
 */
/**
 * Setup the WordPress core custom header feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for previous versions.
 * Use feature detection of wp_get_theme() which was introduced
 * in WordPress 3.4.
 *
 * @todo Rework this function to remove WordPress 3.4 support when WordPress 3.6 is released.
 *
 * @uses marla_header_style()
 * @uses marla_admin_header_style()
 * @uses marla_admin_header_image()
 *
 * @package marla
 */
function marla_custom_header_setup() {
	$args = array(
		// Text color and image (empty to use none).
		'default-text-color'     => '0791b3',
		'default-image'          => get_template_directory_uri().'/images/logo.png',
		'header-text'            => false,
		// Set height and width, with a maximum value for the width.
		'flex-height'            => true,
		'flex-height'            => true,
		// Callbacks for styling the header and the admin preview.
		'wp-head-callback'       => 'marla_header_style',
		'admin-head-callback'    => 'marla_admin_header_style',
		'admin-preview-callback' => 'marla_admin_header_image',
	);
	add_theme_support( 'custom-header', $args );
	/*
	 * Default custom headers packaged with the theme.
	 * %s is a placeholder for the theme template directory URI.
	 */
	register_default_headers( array(
		'logo' => array(
			'url'           => get_template_directory_uri().'/images/logo.png',
			'thumbnail_url' => get_template_directory_uri().'/images/logo.png',
			'description'   => _x( 'Marla', 'header image description', 'marla' )
		),
		
	) );
}
add_action( 'after_setup_theme', 'marla_custom_header_setup' );
/**
 * Styles the header image and text displayed on the blog
 *
 * @see marla_custom_header_setup().
 */
function marla_header_style() {
	$header_text_color = get_header_textcolor();
	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == $header_text_color )
		return;
	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css" id="custom-header-css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == $header_text_color ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		#header h2, #header h2 a, #header h2 a:visited, #header h2 a:hover  {
			color: #<?php echo $header_text_color; ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see marla_custom_header_setup().
 */
function marla_admin_header_style() {
?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		border: none;
	}
	#headimg h1,
	#desc {
	}
	#headimg h1 {
	}
	#headimg h1 a {
	}
	#desc {
	}
	#headimg img {
	}
	</style>
<?php
}
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see marla_custom_header_setup().
 */
function marla_admin_header_image() {
	
	$header_image = get_header_image();
?>
	
		<?php if ( ! empty( $header_image ) ) : ?>
			<?php if (!is_home() ) { ?><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php } ?><img class="logo" data-pin-no-hover="true" src="<?php echo esc_url( $header_image ); ?>"  alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" /><?php if (!is_home() ) { ?></a><?php } ?>
		<?php endif; ?>
	<?php if( get_theme_mod( 'title_marla' ) != marla_default_settings('title_marla') )   { ?>	
<h2><?php if (!is_home() ) { ?><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php } ?>
<?php bloginfo( 'name' ); ?><?php if( get_theme_mod( 'tagline_marla' ) != marla_default_settings('tagline_marla') )   { ?><span class="chico"><?php bloginfo( 'description' ); ?></span><?php }?><?php if (!is_home() ) { ?></a><?php } ?></h2><?php } ?>
<?php if( (get_theme_mod( 'title_marla' ) == marla_default_settings('title_marla')) && ( get_theme_mod( 'tagline_marla' ) != marla_default_settings('tagline_marla') ))  { ?>	
<h2><?php if (!is_home() ) { ?><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php } ?>
<span class="chico"><?php bloginfo( 'description' ); ?></span><?php if (!is_home() ) { ?></a><?php } ?></h2><?php }?>
<?php
}
?>