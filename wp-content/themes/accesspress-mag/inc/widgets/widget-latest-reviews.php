<?php

/**
 * Review Posts Widgets
 *
 * @package Accesspress Mag
 */
/**
 * Adds accesspress_mag_latest_review_posts widget.
 */
add_action('widgets_init', 'register_latest_review_posts_widget');

function register_latest_review_posts_widget() {
    register_widget('accesspress_mag_latest_review_posts');
}

class Accesspress_mag_latest_review_posts extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'accesspress_mag_latest_review_posts', 'AP-Mag :  Review Posts', array(
            'description' => __('A widget that shows latest review posts', 'accesspress-mag')
                )
        );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        $fields = array(
            'latest_review_post_title' => array(
                'accesspress_mag_widgets_name' => 'latest_review_post_title',
                'accesspress_mag_widgets_title' => __('Title', 'accesspress-mag'),
                'accesspress_mag_widgets_field_type' => 'title',
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
    public function widget($args, $instance) {
        extract($args);
        $latest_review_posts_title = $instance['latest_review_post_title'];
        echo $before_widget; ?>
        <div class="latest-review-posts clearfix">
           <h1 class="widget-title"><span><?php echo esc_attr($latest_review_posts_title); ?></span></h1>     
           <div class="review-posts-wrapper">
              <?php 
                    $review_args = array(
                    	'posts_per_page'   => 3,
                    	'offset'           => 0,
                    	'category'         => '',
                    	'category_name'    => '',
                    	'orderby'          => 'post_date',
                    	'order'            => 'DESC',
                    	'include'          => '',
                    	'exclude'          => '',
                    	'meta_key'         => 'product_review_option',
                    	'meta_value'       => 'rate_stars',
                    	'post_type'        => 'post',
                    	'post_mime_type'   => '',
                    	'post_parent'      => '',
                    	'post_status'      => 'publish',
                    	'suppress_filters' => true 
                    );
                    $review_array = new WP_Query( $review_args );
                    //echo '<pre>';
//                    	print_r($review_array);
//                    echo '</pre>';
                    $p_count = 0;
                    if($review_array->have_posts()){
                        while($review_array->have_posts()){
                            $review_array->the_post();
                            $p_count++;
                            $review_image_id = get_post_thumbnail_id();
                            $review_big_image_path = wp_get_attachment_image_src($review_image_id,'block-big-thumb',true);
                            $review_small_image_path = wp_get_attachment_image_src($review_image_id,'block-small-thumb',true);
                            $review_image_alt = get_post_meta($review_image_id,'_wp_attachment_image_alt',true); 
                            if($p_count==1):
                    ?>
                        <div class="single-review top-post non-zoomin clearfix">
                                <div class="post-image">
                                    <?php if(has_post_thumbnail()):?>
                                    <img src="<?php echo $review_big_image_path[0];?>" alt="<?php echo esc_attr($review_image_alt);?>" />
                                    <?php else :?>
                                    <img src="<?php echo get_template_directory_uri();?>/images/no-image-medium.jpg" alt="<?php _e( 'No image', 'accesspress-mag' );?>" />
                                    <?php endif ;?>
                                    <span class="big-image-overlay"><a href="<?php the_permalink();?>"><i class="fa fa-external-link"></i></a></span>
                                </div>
                                
                                    <h1 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                                    <div class="stars-ratings"><?php do_action('accesspress_mag_post_review');?></div>
                            
                                <div class="block-poston"><?php do_action('accesspress_mag_home_posted_on');?></div>
                                <div class="post-content"><?php echo '<p>'. accesspress_mag_word_count(get_the_content(),25) .'</p>' ;?></div>
                        </div>
                    <?php else:?>
                        <div class="single-review clearfix">
                                <div class="post-image"><a href="<?php the_permalink();?>">
                                    <?php if(has_post_thumbnail()):?>
                                    <img src="<?php echo $review_small_image_path[0];?>" alt="<?php echo esc_attr($review_image_alt);?>" />
                                    <?php else: ?>
                                    <img src="<?php echo get_template_directory_uri();?>/images/no-image-small.jpg" alt="<?php _e( 'No image', 'accesspress-mag' );?>" />
                                    <?php endif ;?>
                                    </a></div>
                                <div class="post-desc-wrapper">
                                    <h1 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                                    <div class="stars-ratings"><?php do_action('accesspress_mag_post_review');?></div>
                                </div>
                        </div>
                    <?php endif;?>
                <?php
                        }
                    }
                ?>
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
    public function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ($widget_fields as $widget_field) {

            extract($widget_field);

            // Use helper function to get updated field values
            $instance[$accesspress_mag_widgets_name] = accesspress_mag_widgets_updated_field_value($widget_field, $new_instance[$accesspress_mag_widgets_name]);
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
    public function form($instance) {
        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ($widget_fields as $widget_field) {

            // Make array elements available as variables
            extract($widget_field);
            $accesspress_mag_widgets_field_value = !empty($instance[$accesspress_mag_widgets_name]) ? esc_attr($instance[$accesspress_mag_widgets_name]) : '';
            accesspress_mag_widgets_show_widget_field($this, $widget_field, $accesspress_mag_widgets_field_value);
        }
    }

}