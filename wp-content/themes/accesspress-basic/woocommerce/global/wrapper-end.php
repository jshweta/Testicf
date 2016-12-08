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

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$template = get_option( 'template' );

switch( $template ) {
	case 'twentyeleven' :
		echo '</div></div>';
		break;
	case 'twentytwelve' :
		echo '</div></div>';
		break;
	case 'twentythirteen' :
		echo '</div></div>';
		break;
	case 'twentyfourteen' :
		echo '</div></div></div>';
		get_sidebar( 'content' );
		break;
	default :
		?>
            </div> <!-- #primary -->
            <?php if($default_page_layout == 'left_sidebar' || $default_page_layout == 'both_sidebar') : ?>
                <?php get_sidebar('left'); ?>
            <?php endif; ?>
            <?php if($default_page_layout == 'both_sidebar') : ?>
                </div> <!-- #primary-wrap -->
            <?php endif; ?>
            <?php if($default_page_layout == 'right_sidebar' || $default_page_layout == 'both_sidebar') : ?>
                <?php get_sidebar('right'); ?>
            <?php endif; ?>
            </div> <!-- ap-contianer -->
            </main>
        <?php
		break;
}