<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Accesspress Mag
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'accesspress-mag' ); ?></a>
    <?php 
        $accesspress_mag_transparent_header = of_get_option( 'logo_upload' );
        $accesspress_mag_logo = of_get_option( 'logo_upload' );
        $accesspress_mag_logo_setting = of_get_option( 'logo_setting' );
        $branding_class = '';
        $accesspress_mag_top_menu_switch = of_get_option( 'top_menu_switch' );
        $accesspress_mag_top_menu = of_get_option( 'top_menu_select' );
        $accesspress_mag_top_menu_right = of_get_option( 'top_right_menu_select' );
        $accesspress_mag_logo_alt = of_get_option( 'logo_alt' );
        $accesspress_mag_logo_title = of_get_option( 'logo_title' );
        switch($accesspress_mag_logo_setting){
            case 'image':
            $branding_class = 'logo_only';
            break;
            
            case 'text':
            $branding_class = 'text_only';
            break;
            
            case 'image_text':
            $branding_class = "logo_with_text";
            break;
        }
        //var_dump($accesspress_mag_top_menu); 
    ?>  
	
    <header id="masthead" class="site-header" role="banner">
    
            <?php if ($accesspress_mag_top_menu_switch=='1'):?> 
            <?php if(empty($accesspress_mag_top_menu)):?>
                <div class="top-header-menu"> 
                <div class="apmag-container">
                    <ul class="">
                        <li class="menu-item-first">
                            <a href="<?php echo esc_url( home_url( '/' ) );?>/wp-admin/nav-menus.php?action=locations"><?php _e( 'Click here - to select or create a menu', 'accesspress-mag' );?></a>
                        </li>
                    </ul>
                </div>
                </div>
            <?php else: ?>  
            <div class="top-menu-wrapper clearfix">
                <div class="apmag-container">     
                    <nav id="top-navigation" class="top-main-navigation" role="navigation">
                                <button class="menu-toggle hide" aria-controls="menu" aria-expanded="false"><?php _e( 'Top Menu', 'accesspress-mag' ); ?></button>
                                <?php wp_nav_menu( array( 'menu' => $accesspress_mag_top_menu ) ); ?>
                    </nav><!-- #site-navigation -->
               
                <?php if(!empty($accesspress_mag_top_menu_right)): ?>
                    <nav id="top-right-navigation" class="top-right-main-navigation" role="navigation">
                                <button class="menu-toggle hide" aria-controls="menu" aria-expanded="false"><?php _e( 'Top Menu Right', 'accesspress-mag' ); ?></button>
                                <?php wp_nav_menu( array( 'menu' => $accesspress_mag_top_menu_right ) ); ?>
                    </nav><!-- #site-navigation -->
                <?php endif ;?>           
                
                </div>
            </div>
             <?php endif;?> 
             <?php endif ;?>
        <div class="logo-ad-wrapper clearfix">
            <div class="apmag-container">
        		<div class="site-branding <?php echo esc_attr( $branding_class ) ;?>">
                            <?php 
                                if( $accesspress_mag_logo_setting == 'image' || $accesspress_mag_logo_setting == 'image_text') :
                                if (!empty($accesspress_mag_logo)): ?>
                                  <div class="sitelogo-wrap">  
                                    <a itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $accesspress_mag_logo ) ;?>" alt="<?php echo esc_attr( $accesspress_mag_logo_alt ); ?>" title="<?php echo esc_attr( $accesspress_mag_logo_title ); ?>" /></a>
                                    <meta itemprop="name" content="<?php bloginfo( 'name' )?>" />
                                  </div>
                            <?php endif; endif;
                                if( $accesspress_mag_logo_setting == 'text' || $accesspress_mag_logo_setting == 'image_text' ):
                            ?> 
                                 <div class="sitetext-wrap">  
                                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                        			<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
                        			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
                                    </a>
                                </div>
                            <?php endif;?>
                            <?php 
                                $accesspress_mag_theme_option = get_option( 'accesspress-mag-theme' );
                                if( empty( $accesspress_mag_theme_option )){
                            ?>
                                <div class="sitetext-wrap">  
                                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                        			<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
                        			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
                                    </a>
                                </div>
                            <?php } ?>
                 </div><!-- .site-branding -->
        		
                
                
                <?php if ( is_active_sidebar( 'accesspress-mag-header-ad' ) ) : ?>
                    <div class="header-ad">
                        <?php dynamic_sidebar( 'accesspress-mag-header-ad' ); ?> 
                    </div><!--header ad-->
                <?php elseif( empty( $accesspress_mag_theme_option ) ) :?>
                    <div class="header-ad">
                        <img src="<?php echo esc_url( get_template_directory_uri().'/images/demo-images/728-90.png' );?>" />
                    </div>
                <?php endif; ?>
                
                
            </div>
        </div>

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<div class="apmag-container">
                <div class="nav-wrapper">
                    <div class="nav-toggle hide">
                        <span> </span>
                        <span> </span>
                        <span> </span>
                    </div>
        			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container_class' => 'mag-primary-menu' ) ); ?>
                </div>

                <?php get_search_form(); ?> 
            </div>
		</nav><!-- #site-navigation -->
        
	</header><!-- #masthead -->

	<div id="content" class="site-content">