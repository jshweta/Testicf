<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="pagina">
 *
 * @package marla
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>><head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); ?>
</head>
    <body <?php body_class('homeinfinto'); ?>>
    <div id="wrapper">
<div id="header" class="clearfix centrar"> <?php if( get_theme_mod( 'social_header' ) == marla_default_settings('social_header') ) {
?>
<?php if( get_theme_mod( 'marla_social2' ) != marla_default_settings('marla_social2') ) {
?><div class="fleft" id="fb-root"><fb:like href="http://www.facebook.com/<?php echo get_theme_mod( 'marla_social2', marla_default_settings('marla_social2') ) ?>" layout="button_count" send="false" width="80" show_faces="false" font=""></fb:like></div>
<?php	}
	
if( get_theme_mod( 'marla_social1' ) != marla_default_settings('marla_social1') ) { ?><div class="fright"><a href="http://twitter.com/<?php echo get_theme_mod( 'marla_social1', marla_default_settings('marla_social1') ) ?>" class="twitter-follow-button" data-button="grey" data-text-color="#FFFFFF" data-link-color="#FFFFFF" data-lang="<?php marla_twitter_language ()?>">Follow @<?php echo get_theme_mod( 'marla_social1', marla_default_settings('marla_social1') ) ?></a></div>
<?php }}?>
<div class="logo centrar ">
<?php marla_admin_header_image() ?>
			
            
            
        	</div>
</div>
<nav id="site-navigation" class="navigation-main clearfix" role="navigation">
			
			<div class="screen-reader-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'marla' ); ?>"><?php _e( 'Skip to content', 'marla' ); ?></a></div>
			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?><div class="fright clearfix"><form method="get" class="searchform fright clear"  action="<?php echo esc_url( home_url( '/' ) ); ?>"><input  name="s" id="topsearch" type="search" placeholder="<?php _e( 'search...', 'marla' ); ?>"/></form></div>
		</nav>
		
<div id="pagina" class="clear">
