<?php
/**
 * Call To Action
 *
 * @package Accesspress Basic
 */

/**
 * Adds accesspress_basic_Preview_Post widget.
 */
add_action( 'widgets_init', 'register_featured_page_widget' );
function register_featured_page_widget() {
    register_widget( 'accesspress_basic_featured_page_widget' );
}
class Accesspress_Basic_Featured_Page_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'accesspress_basic_featured_page',
			'AP : Featured Page',
			array(
				'description'	=> __( 'A widget To Display Featured Page', 'accesspress-basic' )
			)
		);
	}

	/**
	 * Helper function that holds widget fields
	 * Array is used in update and form functions
	 */
	 private function widget_fields() {
		$fields = array(
			'feat_page_title' => array(
                'apbasic_widgets_name' => 'feat_page_title',
                'apbasic_widgets_title' => __('Page Title','accesspress-basic'),
                'apbasic_widgets_field_type' => 'text',
                'apbasic_widgets_description' => __('Displays the Page Title if left empty','accesspress-basic'),
            ),
            'feat_page_id' => array(
                'apbasic_widgets_name' => 'feat_page_id',
                'apbasic_widgets_title' => __('Feature Page','accesspress-basic'),
                'apbasic_widgets_field_type' => 'selectpage'
            ),
            'feat_readmore_text' => array(
                'apbasic_widgets_name' => 'feat_readmore_text',
                'apbasic_widgets_title' => __('Read More Text','accesspress-basic'),
                'apbasic_widgets_field_type' => 'text'
            ),
            'feat_readmore_link' => array(
                'apbasic_widgets_name' => 'feat_readmore_link',
                'apbasic_widgets_title' => __('Read More Link','accesspress-basic'),
                'apbasic_widgets_field_type' => 'text'
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
        extract($args);
        $feat_page_id = empty($instance['feat_page_id']) ? false : $instance['feat_page_id']; 
        $feat_page_query = new WP_Query('page_id='.$feat_page_id);
        
        $feat_page_title = empty($instance['feat_page_title']) ? false : $instance['feat_page_title'];
        $feat_readmore_text = empty($instance['feat_readmore_text']) ? false : $instance['feat_readmore_text'];
        $feat_readmore_link = empty($instance['feat_readmore_link']) ? false : $instance['feat_readmore_link'];

        echo $before_widget;
            ?>
            <?php if($feat_page_query->have_posts()) : ?>
                <?php while($feat_page_query->have_posts()) : $feat_page_query->the_post(); ?> 
                <div class="feat-page-wrap">
                    <?php if(!empty($feat_page_title)) : ?>
                        <h2 class="feat-page-title"><?php echo esc_attr($feat_page_title); ?></h2>
                    <?php else : ?>
                        <h2 class="feat-page-title"><?php the_title(); ?></h2>
                    <?php endif; ?>
                    <div class="feat-page-content">
                        <?php the_content(); ?>
                    </div>
                    <?php if(!empty($feat_readmore_text) && !(empty($feat_readmore_link))) : ?>
                        <a class="button feat-page_readmore_btn" href="<?php echo esc_url($feat_readmore_link); ?>"><?php echo esc_attr($feat_readmore_text); ?></a>
                    <?php endif; ?>
                </div>
                <?php endwhile; ?>
            <?php endif; ?>
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