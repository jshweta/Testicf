<?php
/**
 * Feature Posts
 *
 * @package Accesspress Basic
 */

/**
 * Adds accesspress_basic_Preview_Post widget.
 */
add_action( 'widgets_init', 'register_features_widget' );
function register_features_widget() {
    register_widget( 'accesspress_basic_features_widget' );
}
class Accesspress_Basic_Features_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'accesspress_basic_features',
			'AP : Features',
			array(
				'description'	=> __( 'A widget To Display Feature Posts', 'accesspress-basic' )
			)
		);
	}

	/**
	 * Helper function that holds widget fields
	 * Array is used in update and form functions
	 */
	 private function widget_fields() {
		$fields = array(
			'feature_post_1' => array(
                'apbasic_widgets_name' => 'feature_post_1',
                'apbasic_widgets_title' => __('Page','accesspress-basic'),
                'apbasic_widgets_field_type' => 'selectpage'
            ),
            'feature_post_2' => array(
                'apbasic_widgets_name' => 'feature_post_2',
                'apbasic_widgets_title' => __('Page','accesspress-basic'),
                'apbasic_widgets_field_type' => 'selectpage'
            ),
            'feature_post_3' => array(
                'apbasic_widgets_name' => 'feature_post_3',
                'apbasic_widgets_title' => __('Page','accesspress-basic'),
                'apbasic_widgets_field_type' => 'selectpage'
            ),
            'feature_post_4' => array(
                'apbasic_widgets_name' => 'feature_post_4',
                'apbasic_widgets_title' => __('Page','accesspress-basic'),
                'apbasic_widgets_field_type' => 'selectpage'
            ),
            'feature_post_5' => array(
                'apbasic_widgets_name' => 'feature_post_5',
                'apbasic_widgets_title' => __('Page','accesspress-basic'),
                'apbasic_widgets_field_type' => 'selectpage'
            ),
            'feature_post_6' => array(
                'apbasic_widgets_name' => 'feature_post_6',
                'apbasic_widgets_title' => __('Page','accesspress-basic'),
                'apbasic_widgets_field_type' => 'selectpage'
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
        //print_r($args);
		extract( $args );
        global $apbasic_options;
        $apbasic_settings = get_option('apbasic_options',$apbasic_options);
        $features_readmore_text = $apbasic_settings['features_readmore_text'];

		$feature_posts = array_values($instance);

        if(!empty($feature_posts)) :
            
            echo $before_widget;
            
            $args = array(
                'posts_per_page' => -1,
                'post_type' => array('page'),
                'post__in' => $feature_posts,
                'orderby' => 'post__in'
            );
            
            $feat_query = new WP_Query($args);
            $count = 1;
            if($feat_query->have_posts()) :
                ?>
                <div class="ap-container clearfix">
                <div class="feature-post-wrap-block clearfix">
                <?php
                while($feat_query->have_posts()) : $feat_query->the_post();
                    $img = wp_get_attachment_image_src(get_post_thumbnail_id(),'accesspress-basic-features-post-thumbnail');
                    $img_src = $img[0];
                    ?>
                    <div class="feature-post-wrap">
                        <figure class="feature-post-thumbnail">
                            <a href="<?php the_permalink(); ?>">
                                <?php if(has_post_thumbnail()) : ?>
                                    <img src="<?php echo $img_src; ?>" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" />
                                <?php else : ?>
                                    <img src="<?php echo get_template_directory_uri().'/images/no-feature-post-thumbnail.png'; ?>" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" />
                                <?php endif; ?>
                            </a>
                            <figcaption> 
                                 <a href="<?php the_permalink(); ?>"><i class="fa fa-external-link"></i></a>
                            </figcaption>
                        </figure>
                        <a href="<?php the_permalink(); ?>">
                            <h2><?php echo get_the_title(); ?></h2>
                        </a>
                        <div class="feature-post-excerpt">
                            <?php echo wp_trim_words(get_the_content(),35,'...'); ?>
                        </div>
                        <a class="feat_readmore-button readmore-button" href="<?php the_permalink(); ?>">
                            <?php if(empty($features_readmore_text)) : ?>
                                <?php _e('Read More...','accesspress-basic'); ?>
                            <?php else : ?>
                                <?php echo esc_attr($features_readmore_text); ?>
                            <?php endif; ?>
                        </a>
                    </div>
                    <?php if($count%3 == 0) : ?>
                        <div class="clearfix"></div>
                    <?php endif; ?>
                    <?php
                    $count++;
                endwhile;
                ?>
                </div>
            </div>
                <?php
            endif; // if feature query has posts
            
            echo $after_widget;
            
        endif; // Feature posts empty
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