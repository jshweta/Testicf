<?php
/**
 * Preview post/page widget
 *
 * @package Accesspress Basic
 */

/**
 * Adds accesspress_basic_Preview_Post widget.
 */
add_action( 'widgets_init', 'register_contact_widget' );
function register_contact_widget() {
    register_widget( 'accesspress_basic_contact_widget' );
}
class Accesspress_Basic_Contact_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'accesspress_basic_contact',
			'AP : Contact Info',
			array(
				'description'	=> __( 'A widget To Display Contact Info', 'accesspress-basic' )
			)
		);
	}

	/**
	 * Helper function that holds widget fields
	 * Array is used in update and form functions
	 */
	 private function widget_fields() {
		$fields = array(
			'contact_title' => array(
                'apbasic_widgets_name' => 'contact_title',
                'apbasic_widgets_title' => __('Title','accesspress-basic'),
                'apbasic_widgets_field_type' => 'text'
            ),
            'contact_phone' => array(
                'apbasic_widgets_name' => 'contact_phone',
                'apbasic_widgets_title' => __('Phone','accesspress-basic'),
                'apbasic_widgets_field_type' => 'text'
            ),
            'contact_email' => array(
                'apbasic_widgets_name' => 'contact_email',
                'apbasic_widgets_title' => __('Email','accesspress-basic'),
                'apbasic_widgets_field_type' => 'text'
            ),
            'contact_address' => array(
                'apbasic_widgets_name' => 'contact_address',
                'apbasic_widgets_title' => __('Address','accesspress-basic'),
                'apbasic_widgets_field_type' => 'textarea'
            )
		);
		
		return $fields;
	 }


	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		extract($instance);
        
        echo $before_widget;
        ?>
            <div class="contact-info">
                <?php if(!empty($contact_title)) : ?>
                    <?php echo $before_title.$contact_title.$after_title; ?>
                <?php endif; ?>
                <ul class="contact-info-wrapper">
                    <?php if(!empty($contact_phone)) : ?>
                        <li><i class="fa fa-phone"><?php echo esc_attr($contact_phone); ?></i></li>
                    <?php endif; ?>                    
                    <?php if(!empty($contact_email)) : ?>
                        <li><i class="fa fa-envelope"><?php echo esc_attr($contact_email); ?></i></li>
                    <?php endif; ?>
                    <?php if(!empty($contact_phone)) : ?>
                        <li><i class="fa fa-map-marker"><?php echo esc_attr(wpautop($contact_address)); ?></i></li>
                    <?php endif; ?>
                </ul>
            </div>
        <?php
        echo $after_widget;
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param	array	$new_instance	Values just sent to be saved.
	 * @param	array	$old_instance	Previously saved values from database.
	 *
	 * @uses	accesspress_pro_widgets_updated_field_value()		defined in widget-fields.php
	 *
	 * @return	array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$widget_fields = $this->widget_fields();

		// Loop through fields
		foreach( $widget_fields as $widget_field ) {

			extract( $widget_field );
	
			// Use helper function to get updated field values
			$instance[$apbasic_widgets_name] = accesspress_basic_widgets_updated_field_value( $widget_field, $new_instance[$apbasic_widgets_name] );
			echo $instance[$apbasic_widgets_name];
			
		}
				
		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param	array $instance Previously saved values from database.
	 *
	 * @uses	accesspress_pro_widgets_show_widget_field()		defined in widget-fields.php
	 */
	public function form( $instance ) {
		$widget_fields = $this->widget_fields();

		// Loop through fields
		foreach( $widget_fields as $widget_field ) {
		
			// Make array elements available as variables
			extract( $widget_field );
			$apbasic_widgets_field_value = isset( $instance[$apbasic_widgets_name] ) ? esc_attr( $instance[$apbasic_widgets_name] ) : '';
			accesspress_basic_widgets_show_widget_field( $this, $widget_field, $apbasic_widgets_field_value );
		
		}	
	}

}