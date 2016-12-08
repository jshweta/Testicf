<?php
    /**
    * This fucntion is for creating the metaboxes
    *
    */
    
    add_action( 'add_meta_boxes', 'accesspress_basic_add_custom_box' );
    /**
    * Add Meta Boxes.
    */ 
    
    function accesspress_basic_add_custom_box(){
    // Adding layout meta box for page
        add_meta_box( 'page-layout', __('Select Layout','accesspress-basic'),'accesspress_basic_page_layout','page','normal','default');
        add_meta_box( 'page-layout', __('Select Layout','accesspress-basic'),'accesspress_basic_page_layout','post','normal','default');
    }
 
    global $accesspress_basic_page_layout;
    
    $accesspress_basic_page_layout = array(
        'default-layout' => array(
            'id' => 'apbasic_page_layout',
            'value' => 'default_layout',
            'label' => __('Default Layout', 'accesspress-basic'),
            'img' => 'default.png'
        ),
        'right-sidebar-layout' => array(    
            'id' => 'apbasic_page_layout',
            'value' => 'right_sidebar',
            'label' => __('Right Sidebar','accesspress-basic'),
            'img' => 'right-sidebar.png'
        ),
        'left-sidebar-layout' => array(
            'id' => 'apbasic_page_layout',
            'value' => 'left_sidebar',
            'label' => __('Left Sidebar','accesspress-basic'),
            'img' => 'left-sidebar.png'
        ),
        'both-sidebar-layout' => array(
            'id' => 'apbasic_page_layout',
            'value' => 'both_sidebar',
            'label' => __('Both Sidebar','accesspress-basic'),
            'img' => 'both-sidebar.png'
        ),
        'no-sidebar-wide-layout' => array(
            'id' => 'apbasic_page_layout',
            'value' => 'no_sidebar_wide',
            'label' => __('No Sidebar Wide','accesspress-basic'),
            'img' => 'no-sidebar-wide.png'
        ),
        'no-sidebar-narrow-layout' => array(
            'id' => 'apbasic_page_layout',
            'value' => 'no_sidebar_narrow',
            'label' => __('No Sidebar Narrow','accesspress-basic'),
            'img' => 'no-sidebar-narrow.png'
        )
    );
    
    /**
     * Displays option to select Page Layout
     */
     function accesspress_basic_page_layout(){
        global $accesspress_basic_page_layout, $post;
        wp_nonce_field( basename( __FILE__ ), 'custom_meta_box_nonce' );

    	foreach ($accesspress_basic_page_layout as $field) :  
    		$layout_meta = get_post_meta( $post->ID, $field['id'], true );
    		if( empty( $layout_meta ) ) { $layout_meta = 'default_layout'; }
    		?>
            <div class="pplayout">
                <img src="<?php echo esc_url(get_template_directory_uri().'/inc/admin-panel/images/'.$field['img']); ?>" />
    			<input id="<?php echo $field['value']; ?>" class="post-format" type="radio" name="<?php echo $field['id']; ?>" value="<?php echo esc_attr($field['value']); ?>" <?php checked( $field['value'], $layout_meta ); ?>/>
    			<label for="<?php echo $field['value']; ?>" class="post-format-icon"><?php echo $field['label']; ?></label><br/>
            </div>
    		<?php
        endforeach;
     }
     
     add_action('save_post','accesspress_basic_save_sidebar_layout');
     
     /**
      * Save the custom metabox data
      * @hooked to save_post hook
      */
      
      function accesspress_basic_save_sidebar_layout($post_id){
        global $accesspress_basic_page_layout, $post;
        
        // Verify the nonce before proceeding.
        if ( !isset( $_POST[ 'custom_meta_box_nonce' ] ) || !wp_verify_nonce( $_POST[ 'custom_meta_box_nonce' ], basename( __FILE__ ) ) )
            return;
        
        // Stop WP from clearing custom fields on autosave
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE)  
            return;
        
        if ('page' == $_POST['post_type']) {  
            if (!current_user_can( 'edit_page', $post_id ) )  
                return $post_id;  
            } 
            elseif (!current_user_can( 'edit_post', $post_id ) ) {  
                return $post_id;  
            }  
        
        foreach ($accesspress_basic_page_layout as $field) {  
            //Execute this saving function
            $old = get_post_meta( $post_id, $field['id'], true); 
            $new = sanitize_text_field($_POST[$field['id']]);
            
            if ($new && $new != $old) {  
            	update_post_meta($post_id, $field['id'], $new);  
            }
            elseif ('' == $new && $old) {  
            	delete_post_meta($post_id, $field['id'], $old);  
            } 
        } // end foreach 
      }
     