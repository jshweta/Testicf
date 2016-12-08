<?php
/**
 * Content wrappers
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
 global $apbasic_options;
 $apbasic_settings = get_option('apbasic_options', $apbasic_options);
 $default_page_layout = $apbasic_settings['default_page_layout'];
 $shop_page  = get_post( wc_get_page_id( 'shop' ) );
 $single_default_page_layout = $shop_page->apbasic_page_layout;
 $default_page_layout = ($single_default_page_layout == 'default_layout') ? $default_page_layout : $single_default_page_layout;
 
    $content_class = '';
    switch($default_page_layout){
        case 'left_sidebar':
            $content_class = 'left-sidebar';
            break;
        case 'right_sidebar':
            $content_class = 'right-sidebar';
            break;
        case 'both_sidebar':
            $content_class = 'both-sidebar';
            break;
        case 'no_sidebar_wide':
            $content_class = 'no-sidebar-wide';
            break;
        case 'no_sidebar_narrow':
            $content_class = 'no-sidebar-narraow';
            break;
    } 

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$template = get_option( 'template' );

switch( $template ) {
	case 'twentyeleven' :
		echo '<div id="primary"><div id="content" role="main">';
		break;
	case 'twentytwelve' :
		echo '<div id="primary" class="site-content"><div id="content" role="main">';
		break;
	case 'twentythirteen' :
		echo '<div id="primary" class="site-content"><div id="content" role="main" class="entry-content twentythirteen">';
		break;
	case 'twentyfourteen' :
		echo '<div id="primary" class="content-area"><div id="content" role="main" class="site-content twentyfourteen"><div class="tfwc">';
		break;
	default :
        ?>
            <main id="main" class="site-main <?php echo $content_class; ?>" role="main">
            <div class="ap-container">
            <?php if($default_page_layout == 'both_sidebar') : ?>
                <div id="primary-wrap" class="clearfix">
            <?php endif; ?>
                <div id="primary" class="content-area">
        <?php
		break;
}