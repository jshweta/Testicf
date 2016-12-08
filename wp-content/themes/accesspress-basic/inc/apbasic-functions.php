<?php
    /**
     * 
     * AccessPress Basic Function 
     * 
     */
     global $apbasic_options;
     $apbasic_settings = get_option('apbasic_options',$apbasic_options);
     
     function accesspress_basic_additional_scripts() {
    	wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/css/fawesome/css/font-awesome.css' );
        wp_enqueue_script('accesspress-basic-custom-js', get_template_directory_uri().'/js/custom.js', array('jquery'));
    	wp_enqueue_script( 'jquery-bxslider-js', get_template_directory_uri() . '/js/jquery.bxslider.js', array('jquery') );
    }
    add_action( 'wp_enqueue_scripts', 'accesspress_basic_additional_scripts' );

    add_action( 'admin_enqueue_scripts', 'accesspress_basic_media_uploader' );

    function accesspress_basic_media_uploader( $hook )
    {
        if( 'widgets.php' != $hook )
            return;
    
        wp_enqueue_script( 
                'uploader-script', 
                get_template_directory_uri().'/inc/admin-panel/js/media-uploader.js', 
                array(), // dependencies
                false, // version
                true // on footer
        );
        wp_enqueue_media();
        
        
    }
    
    // add classes for alternate posts left and right
    function accesspress_basic_assign_alt_classes( $classes ) {
    	global $post;
    	
        static $flag = true;
        
        if($flag){
            $classes[] = 'alt-left';
            $flag = false;
        }else{
            $classes[] = 'alt-right';
            $flag = true;
        }
        
    	return $classes;
    }
    if($apbasic_settings['blog_post_display_type'] == 'blog_image_alternate_medium'){
        add_filter( 'post_class', 'accesspress_basic_assign_alt_classes' );
    }
    //add_filter( 'body_class', 'category_id_class' );
    
    // Adding custom dynamic styles to the site
    function accesspress_basic_custom_dynamic_styles(){
        global $apbasic_options;
        $apbasic_settings = get_option('apbasic_options',$apbasic_options);
        $background_image = $apbasic_settings['background_image'];
        $bg_img = get_template_directory_uri().'/inc/admin-panel/images/'.$background_image.'.png';
        
        if($apbasic_settings['site_layout'] == 'boxed') :
        ?>
            <style type="text/css" rel="stylesheet">
                <?php if($background_image == 'pattern0') : ?>
                    body{
                        background: none;
                    }
                <?php else : ?>
                    body{
                        background: url(<?php echo $bg_img; ?>);
                    }
                <?php endif; ?>                
            </style>
        <?php
        endif;
    }
    add_action('wp_head','accesspress_basic_custom_dynamic_styles');
    
    // Filter for excerpt read more
    function custom_excerpt_more( $more ) {
    	return '...';
    }
    add_filter( 'excerpt_more', 'custom_excerpt_more' );
    
    function accesspress_root_register_required_plugins() {

    $plugins = array(
        array(
            'name'      => 'AccessPress Custom CSS',
            'slug'      => 'accesspress-custom-css',
            'required'  => false,
        ),
        array(
            'name'      => 'AccessPress Twitter Feed',
            'slug'      => 'accesspress-twitter-feed',
            'required'  => false,
        ),
        array(
            'name'      => 'AccessPress Social Icons',
            'slug'      => 'accesspress-social-icons',
            'required'  => false,
        ),
        array(
            'name'      => 'AccessPress Social Counter',
            'slug'      => 'accesspress-social-counter',
            'required'  => false,
        ),
        array(
            'name'      => 'AccessPress Social Share',
            'slug'      => 'accesspress-social-share',
            'required'  => false,
        ),
        array(
            'name'      => 'Contact Form 7',
            'slug'      => 'contact-form-7',
            'required'  => false,
        ),
        array(
            'name'      => 'Newsletter',
            'slug'      => 'newsletter',
            'required'  => false,
        )
    );

    $config = array(
        'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'parent_slug'  => 'themes.php',            // Parent menu slug.
        'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => true,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __( 'Install Required Plugins', 'accesspress-basic' ),
            'menu_title'                      => __( 'Install Plugins', 'accesspress-basic' ),
            'installing'                      => __( 'Installing Plugin: %s', 'accesspress-basic' ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'accesspress-basic' ),
            'notice_can_install_required'     => _n_noop(
                'This theme requires the following plugin: %1$s.',
                'This theme requires the following plugins: %1$s.',
                'accesspress-basic'
            ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop(
                'This theme recommends the following plugin: %1$s.',
                'This theme recommends the following plugins: %1$s.',
                'accesspress-basic'
            ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop(
                'Sorry, but you do not have the correct permissions to install the %1$s plugin.',
                'Sorry, but you do not have the correct permissions to install the %1$s plugins.',
                'accesspress-basic'
            ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop(
                'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
                'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
                'accesspress-basic'
            ), // %1$s = plugin name(s).
            'notice_ask_to_update_maybe'      => _n_noop(
                'There is an update available for: %1$s.',
                'There are updates available for the following plugins: %1$s.',
                'accesspress-basic'
            ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop(
                'Sorry, but you do not have the correct permissions to update the %1$s plugin.',
                'Sorry, but you do not have the correct permissions to update the %1$s plugins.',
                'accesspress-basic'
            ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop(
                'The following required plugin is currently inactive: %1$s.',
                'The following required plugins are currently inactive: %1$s.',
                'accesspress-basic'
            ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop(
                'The following recommended plugin is currently inactive: %1$s.',
                'The following recommended plugins are currently inactive: %1$s.',
                'accesspress-basic'
            ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop(
                'Sorry, but you do not have the correct permissions to activate the %1$s plugin.',
                'Sorry, but you do not have the correct permissions to activate the %1$s plugins.',
                'accesspress-basic'
            ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop(
                'Begin installing plugin',
                'Begin installing plugins',
                'accesspress-basic'
            ),
            'update_link'                     => _n_noop(
                'Begin updating plugin',
                'Begin updating plugins',
                'accesspress-basic'
            ),
            'activate_link'                   => _n_noop(
                'Begin activating plugin',
                'Begin activating plugins',
                'accesspress-basic'
            ),
            'return'                          => __( 'Return to Required Plugins Installer', 'accesspress-basic' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'accesspress-basic' ),
            'activated_successfully'          => __( 'The following plugin was activated successfully:', 'accesspress-basic' ),
            'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'accesspress-basic' ),  // %1$s = plugin name(s).
            'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'accesspress-basic' ),  // %1$s = plugin name(s).
            'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'accesspress-basic' ), // %s = dashboard link.
            'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'tgmpa' ),

            'nag_type'                        => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );

    tgmpa( $plugins, $config );
}

add_action( 'tgmpa_register', 'accesspress_root_register_required_plugins' );