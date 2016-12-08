<?php
/**
 * 
 * AccessPress Basic Custom Sidebar
 *  For Widgets
 * 
 */ 
 add_action('widgets_init','accesspress_basic_additional_widgets');
 
 function accesspress_basic_additional_widgets(){
    // Registering main right sidebar
	register_sidebar( array(
		'name' 				=> __( 'Right Sidebar', 'accesspress-basic' ),
		'id' 					=> 'apbasic_right_sidebar',
		'description'   	=> __( 'Shows widgets at Right side.', 'accesspress-basic' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h3 class="widget-title"><span>',
		'after_title'   	=> '</span></h3>'
	) );
    
    // Registering main left sidebar
	register_sidebar( array(
		'name' 				=> __( 'Left Sidebar', 'accesspress-basic' ),
		'id' 					=> 'apbasic_left_sidebar',
		'description'   	=> __( 'Shows widgets at Left side.', 'accesspress-basic' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h3 class="widget-title"><span>',
		'after_title'   	=> '</span></h3>'
	) );
    
    // Registering featured section
	register_sidebar( array(
		'name' 				=> __( 'Featured Section', 'accesspress-basic' ),
		'id' 					=> 'apbasic_featured_section',
		'description'   	=> __( 'Shows widgets at Featured Post.', 'accesspress-basic' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h3 class="widget-title"><span>',
		'after_title'   	=> '</span></h3>'
	) );
    
    // Registering call to action section
	register_sidebar( array(
		'name' 				=> __( 'Call To Action Section', 'accesspress-basic' ),
		'id' 					=> 'apbasic_cta_section',
		'description'   	=> __( 'Shows widgets at Call To Action.', 'accesspress-basic' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h3 class="widget-title"><span>',
		'after_title'   	=> '</span></h3>'
	) );
    
    // Registering testimonial section
	register_sidebar( array(
		'name' 				=> __( 'Icon Text Block Section', 'accesspress-basic' ),
		'id' 					=> 'icon_text_block_section',
		'description'   	=> __( 'Shows widgets at Icon Text Block Section.', 'accesspress-basic' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h3 class="widget-title"><span>',
		'after_title'   	=> '</span></h3>'
	) );
    
    // Registering toggle section
	register_sidebar( array(
		'name' 				=> __( 'Toggle Section', 'accesspress-basic' ),
		'id' 					=> 'apbasic_toggle_section',
		'description'   	=> __( 'Shows Toggles at Toggle Section.', 'accesspress-basic' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h3 class="widget-title"><span>',
		'after_title'   	=> '</span></h3>'
	) );
    
    // Registering toggle section
	register_sidebar( array(
		'name' 				=> __( 'Featured Page Section', 'accesspress-basic' ),
		'id' 					=> 'apbasic_featured_page_section',
		'description'   	=> __( 'Shows Featured Page In Featured Page Section.', 'accesspress-basic' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h3 class="widget-title"><span>',
		'after_title'   	=> '</span></h3>'
	) );
    
    // Registering testimonial section
	register_sidebar( array(
		'name' 				=> __( 'Testimonials Section', 'accesspress-basic' ),
		'id' 					=> 'apbasic_testimonial_section',
		'description'   	=> __( 'Shows widgets at Testimonialss.', 'accesspress-basic' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h3 class="widget-title"><span>',
		'after_title'   	=> '</span></h3>'
	) );
    
    // Registering services section
	register_sidebar( array(
		'name' 				=> __( 'Services Section', 'accesspress-basic' ),
		'id' 					=> 'apbasic_services_section',
		'description'   	=> __( 'Shows widgets at Services.', 'accesspress-basic' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h3 class="widget-title"><span>',
		'after_title'   	=> '</span></h3>'
	) );
    
    // Registering Header Text Widget
	register_sidebar( array(
		'name' 				=> __( 'Header Text Section', 'accesspress-basic' ),
		'id' 					=> 'apbasic_header_text',
		'description'   	=> __( 'Shows widgets at Header Text Section.', 'accesspress-basic' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h3 class="widget-title"><span>',
		'after_title'   	=> '</span></h3>'
	) );
    
    // Registering Header Social Links Widget
	register_sidebar( array(
		'name' 				=> __( 'Header Social Links Section', 'accesspress-basic' ),
		'id' 					=> 'apbasic_header_social_links',
		'description'   	=> __( 'Shows widgets at Header Text Section.', 'accesspress-basic' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h3 class="widget-title"><span>',
		'after_title'   	=> '</span></h3>'
	) );
    
    // Registering Footer Social Links Widget
	register_sidebar( array(
		'name' 				=> __( 'Footer Social Links Section', 'accesspress-basic' ),
		'id' 					=> 'apbasic_footer_social_links',
		'description'   	=> __( 'Shows widgets at Footer.', 'accesspress-basic' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h3 class="widget-title"><span>',
		'after_title'   	=> '</span></h3>'
	) );
    
    // Registering footer one section
	register_sidebar( array(
		'name' 				=> __( 'Footer One', 'accesspress-basic' ),
		'id' 					=> 'apbasic_footer_one',
		'description'   	=> __( 'Shows widgets at Footer First Section .', 'accesspress-basic' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h3 class="widget-title"><span>',
		'after_title'   	=> '</span></h3>'
	) );
    
    // Registering footer two section
	register_sidebar( array(
		'name' 				=> __( 'Footer Two', 'accesspress-basic' ),
		'id' 					=> 'apbasic_footer_two',
		'description'   	=> __( 'Shows widgets at Footer Second Section.', 'accesspress-basic' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h3 class="widget-title"><span>',
		'after_title'   	=> '</span></h3>'
	) );
    
    // Registering footer three section
	register_sidebar( array(
		'name' 				=> __( 'Footer Three', 'accesspress-basic' ),
		'id' 					=> 'apbasic_footer_three',
		'description'   	=> __( 'Shows widgets at Footer Third Section.', 'accesspress-basic' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h3 class="widget-title"><span>',
		'after_title'   	=> '</span></h3>'
	) ); 
    
    // Registering footer four section
	register_sidebar( array(
		'name' 				=> __( 'Footer Four', 'accesspress-basic' ),
		'id' 					=> 'apbasic_footer_four',
		'description'   	=> __( 'Shows widgets at Footer Fourth Section.', 'accesspress-basic' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h3 class="widget-title"><span>',
		'after_title'   	=> '</span></h3>'
	) );
    
 } // END OF ACCESSPRESS BASIC REGISTER SIDEBAR FUNCTION

/**
 * AccessPress Basic Custom Widgets
 *
 * @package Accesspress Basic
 */

function accesspress_basic_widgets_updated_field_value( $widget_field, $new_field_value ) {

	extract( $widget_field );
	
	// Allow only integers in number fields
	if( $apbasic_widgets_field_type == 'number' ) {
		return absint( $new_field_value );
		
	// Allow some tags in textareas
	} elseif( $apbasic_widgets_field_type == 'textarea' ) {
		// Check if field array specifed allowed tags
		if( !isset( $apbasic_widgets_allowed_tags ) ) {
			// If not, fallback to default tags
			$apbasic_widgets_allowed_tags = '<p><strong><em><a>';
		}
		return strip_tags( $new_field_value, $apbasic_widgets_allowed_tags );
		
	// No allowed tags for all other fields
	} else {
		return strip_tags( $new_field_value );
	}

}

/**
 * Include helper functions that display widget fields in the dashboard
 *
 * @since Accesspress Widget Pack 1.0
 */
require get_template_directory() . '/inc/widgets/widget-fields.php';

/**
 * Register Post Preview Widget
 *
 * @since accesspress Widget Pack 1.0
 */
require get_template_directory() . '/inc/widgets/widget-testimonials.php';

/**
 * Register Post Feature Posts
 *
 * @since accesspress Widget Pack 1.0
 */
require get_template_directory() . '/inc/widgets/wigets-features.php';

/**
 * Register Post Services Posts
 *
 * @since accesspress Widget Pack 1.0
 */
require get_template_directory() . '/inc/widgets/widgets-services.php';

/**
 * Register Post Services Posts
 *
 * @since accesspress Widget Pack 1.0
 */
require get_template_directory() . '/inc/widgets/widgets-cta.php';

/**
 * Register Icon Text Block
 *
 * @since accesspress Widget Pack 1.0
 */
require get_template_directory() . '/inc/widgets/widgets-icon-text-block.php';

/**
 * Register Toggle
 *
 * @since accesspress Widget Pack 1.0
 */
require get_template_directory() . '/inc/widgets/widgets-toggle.php';

/**
 * Register Featured Page
 *
 * @since accesspress Widget Pack 1.0
 */
require get_template_directory() . '/inc/widgets/widgets-featured-page.php';