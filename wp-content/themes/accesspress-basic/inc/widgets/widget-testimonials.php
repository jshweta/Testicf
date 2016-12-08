<?php
/**
 * Preview post/page widget
 *
 * @package Accesspress Basic
 */

/**
 * Adds accesspress_basic_Preview_Post widget.
 */
add_action( 'widgets_init', 'register_testimonial_widget' );
function register_testimonial_widget() {
    register_widget( 'accesspress_basic_testimonial_widget' );
}
class Accesspress_Basic_Testimonial_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'accesspress_basic_testimonial',
			'AP : Testimonial',
			array(
				'description' => __( 'A widget To Display Testimonial', 'accesspress-basic' )
			)
		);
	}

	/**
	 * Helper function that holds widget fields
	 * Array is used in update and form functions
	 */
	 private function widget_fields() {
		$fields = array(
			'client_image' => array(
                'apbasic_widgets_name' => 'client_image',
                'apbasic_widgets_title' => __('Clients Image','accesspress-basic'),
                'apbasic_widgets_field_type' => 'upload'
            ),
            'client_name' => array(
                'apbasic_widgets_name' => 'client_name',
                'apbasic_widgets_title' => __('Client Name','accesspress-basic'),
                'apbasic_widgets_field_type' => 'text'
            ),
            'client_designation' => array(
                'apbasic_widgets_name' => 'client_designation',
                'apbasic_widgets_title' => __('Designation','accesspress-basic'),
                'apbasic_widgets_field_type' => 'text'
            ),
            'client_testimonial' => array(
                'apbasic_widgets_name' => 'client_testimonial',
                'apbasic_widgets_title' => __('Testimonial','accesspress-basic'),
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
        $client_image = empty($instance['client_image']) ? false : $instance['client_image'];
        $client_name = empty($instance['client_name']) ? false : $instance['client_name'];
        $client_designation = empty($instance['client_designation']) ? false : $instance['client_designation'];
        $client_testimonial = empty($instance['client_testimonial']) ? false : $instance['client_testimonial'];
        
        $img_id = attachment_url_to_postid($client_image);
        $image = wp_get_attachment_image_src($img_id,'accesspress-basic-testimonial-thumbnail');
        
        echo $before_widget;
            ?>
                <div class="testimonials-wrap clearfix">
                    <figure class="testimonial-image-wrap">
                        <div class="testimonial-img">
                            <?php if(!empty($image[0])) : ?>
                                <img src="<?php echo $image[0]; ?>" />
                            <?php else : ?>
                                <img src="<?php echo get_template_directory_uri().'/images/no-testimonial-thumbnail.png'; ?>" />
                            <?php endif; ?>
                        </div>
                        <span class="client-name"><?php echo esc_attr($client_name); ?></span>
                        <span class="client-designation"><?php echo esc_attr($client_designation); ?></span>                            
                    </figure>
                    <div class="testimonial">
                        <?php echo esc_textarea($client_testimonial); ?>
                    </div>
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