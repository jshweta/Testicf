<?php
/**
 * Call To Action
 *
 * @package Accesspress Basic
 */

/**
 * Adds accesspress_basic_Preview_Post widget.
 */
add_action( 'widgets_init', 'register_cta_widget' );
function register_cta_widget() {
    register_widget( 'accesspress_basic_cta_widget' );
}
class Accesspress_Basic_Cta_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'accesspress_basic_cta',
			'AP : Call To Action',
			array(
				'description'	=> __( 'A widget To Display Call To Action', 'accesspress-basic' )
			)
		);
	}

	/**
	 * Helper function that holds widget fields
	 * Array is used in update and form functions
	 */
	 private function widget_fields() {
		$fields = array(
			'cta_title' => array(
                'apbasic_widgets_name' => 'cta_title',
                'apbasic_widgets_title' => __('Title','accesspress-basic'),
                'apbasic_widgets_field_type' => 'text'
            ),
            'cta_descr' => array(
                'apbasic_widgets_name' => 'cta_descr',
                'apbasic_widgets_title' => __('Description','accesspress-basic'),
                'apbasic_widgets_field_type' => 'textarea'
            ),
            'cta_readmore_text' => array(
                'apbasic_widgets_name' => 'cta_readmore_text',
                'apbasic_widgets_title' => __('Read More Text','accesspress-basic'),
                'apbasic_widgets_field_type' => 'text'
            ),
            'cta_readmore_link' => array(
                'apbasic_widgets_name' => 'cta_readmore_link',
                'apbasic_widgets_title' => __('Read More Link','accesspress-basic'),
                'apbasic_widgets_field_type' => 'text'
            ),
            'cta_fa_icon' => array(
                'apbasic_widgets_name' => 'cta_fa_icon',
                'apbasic_widgets_title' => __('Read More Button Icon','accesspress-basic'),
                'apbasic_widgets_field_type' => 'text',
                'apbasic_widgets_description' => 'e.g. fa-diamond <a href="'.esc_url('http://fortawesome.github.io/Font-Awesome/icons/').'" target="_blank">get featured icon class</a>'
            ),
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
        extract($args);
        
        $cta_title = empty($instance['cta_title']) ? false : $instance['cta_title'];
        $cta_descr = empty($instance['cta_descr']) ? false : $instance['cta_descr'];
        $cta_readmore_link = empty($instance['cta_readmore_link']) ? false : $instance['cta_readmore_link'];
        $cta_readmore_text = empty($instance['cta_readmore_text']) ? false : $instance['cta_readmore_text'];
        $cta_fa_icon = empty($instance['cta_fa_icon']) ? false : $instance['cta_fa_icon'];
        
        echo $before_widget;
            ?>
            <div class="cta-wrap clearfix">
                <div class="ap-container">
                	<div class="cta-desc-wrap">
                    <h2 class="cta_title">
                        <?php echo esc_attr($cta_title); ?>
                    </h2>
                    <div class="cta_descr">
                        <?php echo esc_textarea($cta_descr); ?>
                    </div>
                	</div>
                    <div class="cta-btn-wrap">
                    	<a href="<?php echo esc_url($cta_readmore_link); ?>" target="_blank">
                            <?php if(!empty($cta_fa_icon)) : ?>
                                <i class="fa <?php echo esc_attr($cta_fa_icon); ?>"></i>
                            <?php endif; ?>
                            <?php echo esc_attr($cta_readmore_text); ?>
                        </a>
               	 	</div>
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