<?php
/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'theme-textdomain'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {
    
    $imagepath =  get_template_directory_uri() . '/inc/option-framework/images/';
     
	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
        $options_categories[]= __( 'Select category', 'accesspress-mag' );
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->slug] = $category->cat_name;
	}

	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}
    
        //Pull all menus into an array
        $options_menus = array();
        $options_menus_obj = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
        $options_menus[] = __( 'Select Menu', 'accesspress-mag' );
        foreach($options_menus_obj as $menu) {
            $options_menus[$menu->slug] = $menu->name;
        }
        
        //Slide options for homepage slider
        $options_slides = array();
        $options_slides[0] = __( 'Select no.of slides', 'accesspress-mag' );
        for($i=1;$i<=6;$i++)
        {
            $options_slides[$i] = $i ;
        }
        
        //No.of posts for homepage blocks
        $options_block_posts = array();
        $options_block_posts[-1]= __( '-- All posts --', 'accesspress-mag' );
        for($i=4;$i<=10;$i++)
        {
            $options_block_posts[$i] = $i ;
        }
    
    
    //Footer Pattern
	$footer_pattern = array(
        'column4' => $imagepath . 'footers/footer-4.png',
        'column3' => $imagepath . 'footers/footer-3.png',
		'column2' => $imagepath . 'footers/footer-2.png', 
        'column1' => $imagepath . 'footers/footer-1.png',
		   
		);
        
    //Post Templates
    $post_template = array(
        'default-template' => $imagepath.'post_template/post-templates-icons-0.png',
        'style1-template' => $imagepath.'post_template/post-templates-icons-1.png', 
        );
    
    //Post sidebar
    $post_sidebar = array(
        'right-sidebar'=>$imagepath.'right-sidebar.png',
        'left-sidebar'=>$imagepath.'left-sidebar.png',
        'no-sidebar'=>$imagepath.'no-sidebar.png',
        );
    
    
	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages( 'sort_column=post_parent,menu_order' );
	$options_pages[''] = __( 'Select a page', 'accesspress-mag' );
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}
    
    // Logo settings
    $logo_options = array(
            		'image' => __( 'Image', 'accesspress-mag' ),
            		'text' => __( 'Text', 'accesspress-mag' ),
            		'image_text' => __( 'Image & Text', 'accesspress-mag' ),
            		);

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';
    
    //Traslations Array
    $translation_name = array(
                            __( "You are here", "accesspess-mag" ),__( "Editor Pick`s", "accesspess-mag" ),__( "Home", "accesspess-mag" ),__( "Review overview", "accesspess-mag" ),__( "Summary", "accesspess-mag" ),
                            __( "Search results for", "accesspess-mag" ),__( "Tagged", "accesspess-mag" ),__( "Next article", "accesspess-mag" ),__( "Previous article", "accesspess-mag" ),__( "Via", "accesspess-mag" ),__( "Source", "accesspess-mag" ),__( "Advertisement", "accesspress-mag" ),__( "Top arrow", "accesspress-mag" ),
                            __( "Copyright", "accesspress-mag" )
                            );
    $translation_id = array(
                            'you_are_here','editor_picks','home','review_overview','summary','search_results_for','tagged','next_article','previous_article','via','source','advertisement','top_arrow','copyright'
                            );
    $trans_count = count($translation_id);

	$options = array();

/*-----------------------Basic Setting------------------------*/
	$options[] = array(
            'name' => __( 'Basic Settings', 'accesspress-mag' ),
            'type' => 'heading'
            );
   /*---------------------Background Settings----------------------*/
    $options[] = array(
            'name' => __( 'Background Settings', 'accesspress-mag' ),
            'id'   => 'background_settings',
            'type' => 'groupstart'
            );
    $options[] = array(
            'name' => __( 'Site Background', 'accesspress-mag' ),
            'desc' => __( 'Upload a image for background', 'accesspress-mag' ),
            'id' => 'site_background',
            'class' =>'sub-option',
            'type' => 'upload', 
            );
    $options[] = array(
            'name' => __( 'Site Background Color', 'accesspress-mag' ),
            'desc' => __( 'Choose color for site background', 'accesspress-mag' ),
            'id' => 'site_background_color',
            'class' =>'sub-option-color',
            'type' =>'color'
            );
    $options[] = array(
            'name' => __( 'Repeat', 'accesspress-mag' ),
            'desc' => __( 'Define - how the site background image will be displayed here', 'accesspress-mag' ),
            'id' => 'repeat_background',            
            'options' => array(
                    ' ' => __( 'No Repeat', 'accesspress-mag' ),
                    'repeat' => __( 'Tile', 'accesspress-mag' ),
                    'repeat-x' => __( 'Tile Horizontally', 'accesspress-mag' ),
                    'repeat-y' => __( 'Tile Vertically', 'accesspress-mag' ),
                    ),
            'type' => 'radio',
            'std' => ' ' 
            );
    $options[] = array(
            'name' => __( 'Position', 'accesspress-mag' ),
            'desc' => __( 'Define - Position your background image here', 'accesspress-mag' ),
            'id' => 'position_background',            
            'options' => array(
                    ' ' => 'Left',
                    'center' => __( 'Center', 'accesspress-mag' ),
                    'right' => __( 'Right', 'accesspress-mag' ),
                    ),
            'type' => 'radio',
            'std' => ' ' 
            );
    $options[] = array(
            'name' => __( 'Background Attachment', 'accesspress-mag' ),
            'desc' => __( 'Define - Background attachment option here', 'accesspress-mag' ),
            'id' => 'attached_background',            
            'options' => array(
                    'fixed' => __( 'Fixed', 'accesspress-mag' ),
                    ' '     => __( 'Scroll', 'accesspress-mag' ),
                    ),
            'type' => 'radio',
            'std' => ' ' 
            );
    $options[] = array(
            'name' => __( 'Stretch Background', 'accesspress-mag' ),                
            'desc' => __( 'Switch - Background image stretching', 'accesspress-mag' ),
            'id' => 'stretch_background',
            'on' => __( 'Yes', 'accesspress-mag'),
            'off' => __( 'No', 'accesspress-mag'),
            'std' => '0',
            'type' => 'switch'
            );
    $options[] = array(
            'type' => 'groupend'
            );
            
    /*-------------------Website layout------------------------*/
    $options[] = array(
            'name' => __( 'Website Layout', 'accesspress-mag' ),
            'id'   => 'website_layout',
            'type' => 'groupstart'
            );
    $options[] = array(
            'name' => __( 'Website layout', 'accesspress-mag' ),
            'id' => 'website_layout_option',            
            'options' => array(
                    ' ' => __( 'Fullwidth', 'accesspress-mag' ),
                    'boxed' => __( 'Boxed', 'accesspress-mag' ),
                    ),
            'type' => 'radio',
            'std' => ' ' 
            );
    $options[] = array(
            'type' => 'groupend'
            );
    
    
/*-----------------------Header Setting------------------------*/

	$options[] = array(
		    'name' => __( 'Header', 'accesspress-mag' ),
            'type' => 'heading'
	        );
    
    $options[] = array(
            'name' => __( 'Top Menu (black one)', 'accesspress-mag' ),
            'id'   => 'top_menu',
            'type' => 'groupstart'
            );
            
    $options[] = array(
            'name' => __( 'Top Menu Option', 'accesspress-mag' ),                
            'desc' => __( 'Hide or show the top menu', 'accesspress-mag' ),
            'id' => 'top_menu_switch',
            'on' => __( 'Yes', 'accesspress-mag'),
            'off' => __( 'No', 'accesspress-mag'),
            'std' => '1',
            'type' => 'switch'
            );	
	
    $options[] = array(
            'name' => __( 'Select Top Menu', 'accesspress-mag' ),
            'desc' => __( 'Select a menu for the top section', 'accesspress-mag' ),    
            'id' => 'top_menu_select',
            'type' => 'select',
            'options' => $options_menus
            );
    $options[] = array(
            'name' => __( 'Top Menu (right)', 'accesspress-mag' ),
            'desc' => __( 'Select a menu for the top section on right side. It`s optional menu.', 'accesspress-mag' ),    
            'id' => 'top_right_menu_select',
            'type' => 'select',
            'options' => $options_menus
            );		

    $options[] = array(
            'type' => 'groupend'
            );
    
    $options[] = array(
            'name' => __( 'Logo Settings', 'accesspress-mag' ),
            'id'   => 'logo',
            'type' => 'groupstart'
            );
    
    $options[] = array(
            'name' => __( 'Logo Type', 'accesspress-mag' ),
            'desc' => __( 'Select option for site logo settings', 'accesspress-mag' ),    
            'id' => 'logo_setting',
            'std' => 'text',
            'type' => 'select',
            'options' => $logo_options
            );
    $options[] = array(
            'name' => __( 'Header Logo', 'accesspress-mag' ),
            'desc' => __( 'Upload your header logo', 'accesspress-mag' ),
            'id' => 'logo_upload',
            'class' =>'sub-option',
            'type' => 'upload', 
            );	
            
     $options[] = array(
            'name' => __( 'Favicon', 'accesspress-mag' ),
            'desc' => __( 'Upload a favicon image (Standard size of the favicon is 16 x 16px)', 'accesspress-mag' ),
            'id' => 'favicon_upload',
            'class' =>'sub-option',
            'type' => 'upload', 
            ); 
    
    $options[] = array(
            'name' => __( 'Logo Alt Attribute', 'accesspress-mag' ),
            'desc' => __( 'Write ALT attribute for the logo', 'accesspress-mag' ),
            'id' => 'logo_alt',
            'type' => 'text', 
            );
    
    $options[] = array(
            'name' => __( 'Logo Title Attribute', 'accesspress-mag' ),
            'desc' => __( 'Write TITLE attribute for the logo', 'accesspress-mag' ),
            'id' => 'logo_title',
            'type' => 'text', 
            );
    
    $options[] = array(
            'type' => 'groupend'
            );

/*-----------------------Footer Setting------------------------*/
    $options[] = array(
            'name' => __( 'Footer', 'accesspress-mag' ),
		    'type' => 'heading'
	       );
    
    $options[] = array(
            'name' => __( 'Footer Setting', 'accesspress-mag' ),
            'id'   => 'footer_setting',
            'type' => 'groupstart'
            );
            
    $options[] = array(
            'name' => __( 'Footer Widget Option', 'accesspress-mag' ),                
            'desc' => __( 'Hide or show the footer widter area', 'accesspress-mag' ),
            'id' => 'footer_switch',
            'on' => __( 'Yes', 'accesspress-mag'),
            'off' => __( 'No', 'accesspress-mag'),
            'std' => '1',
            'type' => 'switch'
            );
    
    $options[] = array(
            'name' => __( 'Footer Layout', 'accesspress-mag' ),
            'desc' => __( 'Choose footer widget layout', 'accesspress-mag' ),
            'id' => 'footer_layout',
            'std' => 'column4',
            'type' => 'images',
            'options' => $footer_pattern
            );
    
    $options[] = array(
            'type' => 'groupend'
            );
    
    $options[] = array(
            'name' => __( 'Sub-footer Setting', 'accesspress-mag' ),
            'id'   => 'sub_footer_setting',
            'type' => 'groupstart'
            );    
            
    $options[] = array(
            'name' => __( 'Sub Footer Option', 'accesspress-mag' ),                
            'desc' => __( 'Hide or show copy right and footer menu section', 'accesspress-mag' ),
            'id' => 'sub_footer_switch',
            'on' => __( 'Yes', 'accesspress-mag'),
            'off' => __( 'No', 'accesspress-mag'),
            'std' => '1',
            'type' => 'switch'
            );
    
    $options[] = array(
            'name' => __( 'Copyright text', 'accesspress-mag' ),
            'desc' => __( 'Set footer copyright text', 'accesspress-mag' ),
            'id' => 'mag_footer_copyright',
            'std' => __('AccessPress Mag', 'accesspress-mag'),
            'type' => 'text' 
            );
    
    $options[] = array(
            'name' => __( 'Copyright Option', 'accesspress-mag' ),                
            'desc' => __( 'Show or hide the footer copyright example( Copyright &copy; current year )', 'accesspress-mag' ),
            'id' => 'copyright_symbol',
            'on' => __( 'Yes', 'accesspress-mag'),
            'off' => __( 'No', 'accesspress-mag'),
            'std' => '1',
            'type' => 'switch'
            );
    $options[] = array(
            'name' => __( 'Footer Menu', 'accesspress-mag' ),
            'desc' => __( 'Select a menu for the footer section', 'accesspress-mag' ),    
            'id' => 'footer_menu_select',
            'type' => 'select',
            'options' => $options_menus
            );
    $options[] = array(
            'type' => 'groupend'
            );
    
/*-----------------------Ads Setting------------------------*/

    $options[] = array(
            'name' => __( 'ADS', 'accesspress-mag' ),
            'type' => 'heading'
            ); 
    
    $options[] = array(
            'name' => __( 'Heder ad', 'accesspress-mag' ),
            'id'   => 'header_ad',
            'type' => 'groupstart'
            );

    $options[] = array(
            'name' => __( 'Your Header Ad', 'accesspress-mag' ),
            'desc' => sprintf(__( 'Go to <a href="%s" target="_blank">Widget Page</a> to add Header Ads <br> Ads Size : 728x90px <br> Sidebar Name: Header Ad ', 'accesspress-mag' ), esc_url(admin_url('/widgets.php'))),
            'id' => 'value_header_ad',
            'type' => 'info' 
            );
            
    $options[] = array(
            'type' => 'groupend'
            );
    
    $options[] = array(
            'name' => __( 'Article ad', 'accesspress-mag' ),
            'id'   => 'article_ad',
            'type' => 'groupstart'
            );
    $options[] = array(
            'name' => __( 'Your Article Ad', 'accesspress-mag' ),
            'desc' => sprintf(__( 'Go to <a href="%s" target="_blank">Widget Page</a> to add Article Ad <br> Ads Size : 728x90px <br> Sidebar Name: Article Ad ', 'accesspress-mag' ), esc_url(admin_url('/widgets.php'))),
            'id' => 'value_article_ad',
            'type' => 'info' 
            );            
    $options[] = array(
            'type' => 'groupend'
            );
    $options[] = array(
            'name' => __( 'Homepage ad', 'accesspress-mag' ),
            'id'   => 'homepage_ad',
            'type' => 'groupstart'
            );
    $options[] = array(
            'name' => __( 'Your Homepage Inline Ad', 'accesspress-mag' ),
            'desc' => sprintf(__( 'Go to <a href="%s" target="_blank">Widget Page</a> to add Homepage Inline Ad <br> Ads Size : 728x90px <br> Sidebar Name: Homepage Inline Ad ', 'accesspress-mag' ), esc_url(admin_url('/widgets.php'))),
            'id' => 'value_homepage_inline_ad',
            'type' => 'info' 
            );
    $options[] = array(
            'name' => __( 'Your Homepage Sidebar Top Ad', 'accesspress-mag' ),
            'desc' => sprintf(__( 'Go to <a href="%s" target="_blank">Widget Page</a> to add Homepage Sidebar Top Ad <br> Ads Size : 300x250px <br> Sidebar Name: Homepage Sidebar Top Ad ', 'accesspress-mag' ), esc_url(admin_url('/widgets.php'))),
            'id' => 'value_sidebar_top_ad',
            'type' => 'info' 
            );
    $options[] = array(
            'name' => __( 'Your Homepage Sidebar Middle Ad', 'accesspress-mag' ),
            'desc' => sprintf(__( 'Go to <a href="%s" target="_blank">Widget Page</a> to add Homepage Sidebar Middle Ad <br> Ads Size : 300x250px <br> Sidebar Name: Homepage Sidebar Middle Ad ', 'accesspress-mag' ), esc_url(admin_url('/widgets.php'))),
            'id' => 'value_sidebar_middle_ad',
            'type' => 'info' 
            );
    $options[] = array(
            'type' => 'groupend'
            );

    
/*-----------------------Layout Setting------------------------*/
    $options[] = array(
            'name' => __( 'Layout Settings', 'accesspress-mag' ),
            'type' => 'heading',
            'static_text' =>'static',
            'id'=>'layout-settings'
	        );

/*-----------------------Homepage Settings------------------------*/
    $options[] = array(
            'name' => __( 'Homepage Settings', 'accesspress-mag' ),
		    'type' => 'heading'
	       );
    
     $options[] = array(
            'name' => __( 'Slider Settings', 'accesspress-mag' ),
            'id'   => 'slider_settings',
            'type' => 'groupstart'
            );            
    $options[] = array(
            'name' => __( 'Select Category', 'accesspress-mag' ),
            'desc' => __( 'Select a category for homepage slider', 'accesspress-mag' ),    
            'id' => 'homepage_slider_category',
            'type' => 'select',
            'options' => $options_categories
            );   
    $options[] = array(
            'name' => __( 'Show Pager', 'accesspress-mag' ),                
            'desc' => __( 'Hide or show the slider pager', 'accesspress-mag' ),
            'id' => 'slider_pager',
            'on' => __( 'Yes', 'accesspress-mag'),
            'off' => __( 'No', 'accesspress-mag'),
            'std' => '0',
            'type' => 'switch'
            );
    $options[] = array(
            'name' => __( 'Show Controls', 'accesspress-mag' ),                
            'desc' => __( 'Hide or show the slider controls', 'accesspress-mag' ),
            'id' => 'slider_controls',
            'on' => __( 'Yes', 'accesspress-mag'),
            'off' => __( 'No', 'accesspress-mag'),
            'std' => '1',
            'type' => 'switch'
            );
    $options[] = array(
            'name' => __( 'Auto Transition', 'accesspress-mag' ),                
            'desc' => __( 'On or off the slider auto transition', 'accesspress-mag' ),
            'id' => 'slider_auto_transition',
            'on' => __( 'Yes', 'accesspress-mag'),
            'off' => __( 'No', 'accesspress-mag'),
            'std' => '1',
            'type' => 'switch'
            );
    $options[] = array(
            'name' => __( 'Show Title', 'accesspress-mag' ),                
            'desc' => __( 'Show or hide slider`s Title/info', 'accesspress-mag' ),
            'id' => 'slider_info',
            'on' => __( 'Yes', 'accesspress-mag'),
            'off' => __( 'No', 'accesspress-mag'),
            'std' => '1',
            'type' => 'switch'
            );
    $options[] = array(
            'name' => __( 'Number of slides', 'accesspress-mag' ),
            'desc' => __( 'Choose number of slides', 'accesspress-mag' ),
            'id' => 'count_slides', 
            'type' => 'select',
            'options' => $options_slides
            );
    $options[] = array(
            'type' => 'groupend'
            );
            
    $options[] = array(
            'name' => __( 'Blocks settings', 'accesspress-mag' ),
            'id'   => 'blocks_settings',
            'type' => 'groupstart'
            );
    $options[] = array(
            'name' => __( 'Featured Block (First)', 'accesspress-mag' ),
            'desc' => __( 'Select a category for first block in homepage', 'accesspress-mag' ),    
            'id' => 'featured_block_1',
            'type' => 'select',
            'options' => $options_categories
            );
    $options[] = array(
            'name' => __( 'Number of posts', 'accesspress-mag' ),
            'desc' => __( 'Choose number of posts for block (first)', 'accesspress-mag' ),
            'id' => 'posts_for_block1', 
            'type' => 'select',
            'options' => $options_block_posts
            );
    $options[] = array(
            'name' => __( 'Featured Block (Second)', 'accesspress-mag' ),
            'desc' => __( 'Select a category for second block in homepage', 'accesspress-mag' ),    
            'id' => 'featured_block_2',
            'type' => 'select',
            'options' => $options_categories
            );
    $options[] = array(
            'name' => __( 'Number of posts', 'accesspress-mag' ),
            'desc' => __( 'Choose number of posts for block (second)', 'accesspress-mag' ),
            'id' => 'posts_for_block2', 
            'type' => 'select',
            'options' => $options_block_posts
            );
    $options[] = array(
            'name' => __( 'Featured Block (Third)', 'accesspress-mag' ),
            'desc' => __( 'Select a category for third block in homepage', 'accesspress-mag' ),    
            'id' => 'featured_block_3',
            'type' => 'select',
            'options' => $options_categories
            );
    $options[] = array(
            'name' => __( 'Number of posts', 'accesspress-mag' ),
            'desc' => __( 'Choose number of posts for block (third)', 'accesspress-mag' ),
            'id' => 'posts_for_block3', 
            'type' => 'select',
            'options' => $options_block_posts
            );
    $options[] = array(
            'name' => __( 'Featured Block (Fourth)', 'accesspress-mag' ),
            'desc' => __( 'Select a category for fourth block in homepage', 'accesspress-mag' ),    
            'id' => 'featured_block_4',
            'type' => 'select',
            'options' => $options_categories
            );
    $options[] = array(
            'name' => __( 'Number of posts', 'accesspress-mag' ),
            'desc' => __( 'Choose number of posts for block (fourth)', 'accesspress-mag' ),
            'id' => 'posts_for_block4', 
            'type' => 'select',
            'options' => $options_block_posts
            );
    $options[] = array(
            'type' => 'groupend'
            );
            
    $options[] = array(
            'name' => __( 'Editor pick settings', 'accesspress-mag' ),
            'id'   => 'editor_pick_setting',
            'type' => 'groupstart'
            );
    $options[] = array(
            'name' => __( 'Select Category', 'accesspress-mag' ),
            'desc' => __( 'Select a category for editor pick in homepage sidebar', 'accesspress-mag' ),    
            'id' => 'editor_pick_category',
            'type' => 'select',
            'options' => $options_categories
            );
    $options[] = array(
            'name' => __( 'Number of posts', 'accesspress-mag' ),
            'desc' => __( 'Choose number of posts for editor pick section', 'accesspress-mag' ),
            'id' => 'posts_for_editor_pick', 
            'type' => 'select',
            'options' => $options_block_posts
            );
    $options[] = array(
            'type' => 'groupend'
            );
              
/*------------------------Post Settings------------------------*/         
     $options[] = array(
            'name' => __( 'Post Settings', 'accesspress-mag' ),
            'type' => 'heading'
            ); 
            
    $options[] = array(
            'name' => __( 'Additional Settings', 'accesspress-mag' ),
            'id'   => 'post_settings',
            'type' => 'groupstart'
            );
            
    $options[] = array(
            'name' => __( 'Show Date', 'accesspress-mag' ),                
            'desc' => __( 'Enable or disable the post date', 'accesspress-mag' ),
            'id' => 'post_show_date',
            'on' => __( 'Yes', 'accesspress-mag'),
            'off' => __( 'No', 'accesspress-mag'),
            'std' => '1',
            'type' => 'switch'
            );
            
    $options[] = array(
            'name' => __( 'Show Post Views', 'accesspress-mag' ),                
            'desc' => __( 'Enable or disable the post views', 'accesspress-mag' ),
            'id' => 'show_post_views',
            'on' => __( 'Yes', 'accesspress-mag'),
            'off' => __( 'No', 'accesspress-mag'),
            'std' => '1',
            'type' => 'switch'
            );
    $options[] = array(
            'name' => __( 'Show Comment Count', 'accesspress-mag' ),                
            'desc' => __( 'Enable or disable comment number', 'accesspress-mag' ),
            'id' => 'show_comment_count',
            'on' => __( 'Yes', 'accesspress-mag'),
            'off' => __( 'No', 'accesspress-mag'),
            'std' => '1',
            'type' => 'switch'
            );
    $options[] = array(
            'name' => __( 'Show Author Under Title', 'accesspress-mag' ),                
            'desc' => __( 'Shows or hide the author under the post title', 'accesspress-mag' ),
            'id' => 'show_author_name',
            'on' => __( 'Yes', 'accesspress-mag'),
            'off' => __( 'No', 'accesspress-mag'),
            'std' => '1',
            'type' => 'switch'
            );
    $options[] = array(
            'name' => __( 'Show Tags on Site', 'accesspress-mag' ),                
            'desc' => __( 'Enable or disable the post tags', 'accesspress-mag' ),
            'id' => 'show_tags_post',
            'on' => __( 'Yes', 'accesspress-mag'),
            'off' => __( 'No', 'accesspress-mag'),
            'std' => '1',
            'type' => 'switch'
            );
    $options[] = array(
            'name' => __( 'Show Author Box', 'accesspress-mag' ),                
            'desc' => __( 'Enable or disable the author box', 'accesspress-mag' ),
            'id' => 'show_author_box',
            'on' => __( 'Yes', 'accesspress-mag'),
            'off' => __( 'No', 'accesspress-mag'),
            'std' => '1',
            'type' => 'switch'
            );
    $options[] = array(
            'name' => __( 'Show Navigation in Posts', 'accesspress-mag' ),                
            'desc' => __( 'Show or hide `next` and `previous` posts', 'accesspress-mag' ),
            'id' => 'show_post_nextprev',
            'on' => __( 'Yes', 'accesspress-mag'),
            'off' => __( 'No', 'accesspress-mag'),
            'std' => '1',
            'type' => 'switch'
            );
    $options[] = array(
            'type' => 'groupend'
            );
      /*------------------------Default site post template------------------------*/ 
    $options[] = array(
            'name' => __( 'Post Layout', 'accesspress-mag' ),
            'id'   => 'post_template',
            'type' => 'groupstart'
            );
    $options[] = array(
            'name' => __( 'Default Post Template', 'accesspress-mag' ),
            'desc' => __( "Setting this option will make all post pages, that don't have a post template associated to them, to be displayed using this template. This option is OVERWRITTEN by the `Post template` option from the backend - post add / edit page.", 'accesspress-mag' ),
            'id' => 'global_post_template',
            'class'=>'post_template_image',
            'std' => 'default-template',
            'type' => 'images',
            'options' => $post_template
            );
    $options[] = array(
            'name' => __( 'Default Post Sidebar', 'accesspress-mag' ),
            'desc' => __( "Setting this option will make all post pages, that don't have a post sidebar associated to them, to be displayed using this sidebar. This option is OVERWRITTEN by the `Post sidebar` option from the backend - post add / edit page.", 'accesspress-mag' ),
            'id' => 'global_post_sidebar',
            'class'=>'post_sidebar_image',
            'std' => 'right-sidebar',
            'type' => 'images',
            'options' => $post_sidebar
            );
    $options[] = array(
            'type' => 'groupend'
            );
      /*------------------------Breadcrumbs template------------------------*/ 
    $options[] = array(
            'name' => __( 'Breadcrumbs', 'accesspress-mag' ),
            'id'   => 'post_template',
            'type' => 'groupstart'
            );
    $options[] = array(
            'name' => __( 'Show/Hide Breadcrumb', 'accesspress-mag' ),                
            'desc' => __( 'Show or hide breadcrumbs on site', 'accesspress-mag' ),
            'id' => 'show_hide_breadcrumbs',
            'on' => __( 'Yes', 'accesspress-mag'),
            'off' => __( 'No', 'accesspress-mag'),
            'std' => '1',
            'type' => 'switch'
            );
    $options[] = array(
            'name' => __( 'Show Breadcrumb on Single Post', 'accesspress-mag' ),                
            'desc' => __( 'Show or hide the breadcrumbs in single post', 'accesspress-mag' ),
            'id' => 'show_post_breadcrumbs',
            'on' => __( 'Yes', 'accesspress-mag'),
            'off' => __( 'No', 'accesspress-mag'),
            'std' => '1',
            'type' => 'switch'
            );
    $options[] = array(
            'name' => __( 'Enable link on Home', 'accesspress-mag' ),                
            'desc' => __( 'Enable or disable homepage link at home in breadcrumbs', 'accesspress-mag' ),
            'id' => 'show_home_link_breadcrumbs',
            'on' => __( 'Yes', 'accesspress-mag'),
            'off' => __( 'No', 'accesspress-mag'),
            'std' => '0',
            'type' => 'switch'
            );    
    $options[] = array(
            'name' => __( 'Show Article Title on Single post', 'accesspress-mag' ),                
            'desc' => __( 'Show or hide article title on single post', 'accesspress-mag' ),
            'id' => 'show_article_breadcrumbs',
            'on' => __( 'Yes', 'accesspress-mag'),
            'off' => __( 'No', 'accesspress-mag'),
            'std' => '1',
            'type' => 'switch'
            );
    $options[] = array(
            'type' => 'groupend'
            );
      /*------------------------Featured image settings------------------------*/ 
    $options[] = array(
            'name' => __( 'Featured images', 'accesspress-mag' ),
            'id'   => 'featured_image',
            'type' => 'groupstart'
            );
    $options[] = array(
            'name' => __( 'Show Featured Image', 'accesspress-mag' ),                
            'desc' => __( 'Show or hide featured image in post`s single page', 'accesspress-mag' ),
            'id' => 'featured_image',
            'on' => __( 'Yes', 'accesspress-mag'),
            'off' => __( 'No', 'accesspress-mag'),
            'std' => '1',
            'type' => 'switch'
            ); 
            /*       
    $options[] = array(
            'name' => __( 'Featured Image Placeholder', 'accesspress-mag' ),                
            'desc' => __( 'Enable or disable featured image placeholder in single page for post', 'accesspress-mag' ),
            'id' => 'featured_image_placeholder',
            'on' => __( 'Yes', 'accesspress-mag'),
            'off' => __( 'No', 'accesspress-mag'),
            'std' => '0',
            'type' => 'switch'
            ); */      
    $options[] = array(
            'type' => 'groupend'
            );
      
/*------------------Archive Page Settings---------------------*/
    $options[] = array(
            'name' => __( 'Archive Settings', 'accesspress-mag' ),
            'type' => 'heading'
            ); 
            
    $options[] = array(
            'name' => __( 'Archive Style', 'accesspress-mag' ),
            'id'   => 'archive_style',
            'type' => 'groupstart'
            );
    $options[] = array(
            'name' => __( 'Archive page template', 'accesspress-mag' ),
            'desc' => __( "Define - Choose template for all archive pages", 'accesspress-mag' ),
            'id' => 'global_archive_template',
            'class'=>'archive_post_template_image',
            'std' => 'default-template',
            'type' => 'images',
            'options' => $post_template
            );
    $options[] = array(
            'name' => __( 'Archive page sidebar', 'accesspress-mag' ),
            'desc' => __( "Define - Choose sidebar for all archive pages", 'accesspress-mag' ),
            'id' => 'global_archive_sidebar',
            'class'=>'archive_page_sidebar_image',
            'std' => 'right-sidebar',
            'type' => 'images',
            'options' => $post_sidebar
            );    
    $options[] = array(
            'type' => 'groupend'
            );

            
/*--------------------------MISC--------------------------*/        
    $options[] = array(
            'name' => __( 'MISC', 'accesspress-mag' ),
            'type' => 'heading',
            'static_text' =>'static',
            'id'=>'misc'
	        );
    
    /*------------------------Excerpts Settings------------------------*/
    $options[] = array(
            'name' => __( 'Excerpts', 'accesspress-mag' ),
            'type' => 'heading'
            );
    $options[] = array(
            'name' => __( 'Excerpts', 'accesspress-mag' ),
            'id'   => 'excerpts',
            'type' => 'groupstart'
            );
    $options[] = array(
            'name' => __( 'Notice:', 'accesspress-mag' ),
            'desc' => __( 'Adding a text as excerpt on post edit page (Excerpt box), will overwrite the theme excerpts', 'accesspress-mag' ),
            'id' => 'excerpt_notice',
            'type' => 'info', 
            );
    $options[] = array(
            'name' => __( 'Excerpts Type', 'accesspress-mag' ),
            'desc' => __( 'Define - type of excerpt for archives pages', 'accesspress-mag' ),
            'id' => 'excerpt_type',            
            'options' => array(
                    ' '     => __( 'On Words', 'accesspress-mag' ),
                    'letters' => __( 'On Letters', 'accesspress-mag' ),                    
                    ),
            'type' => 'radio',
            'std' => ' ' 
            );
    
    $options[] = array(
            'name' => __( 'Excerpt Length', 'accesspress-mag' ),
            'desc' => __( 'Define - Excerpt length of words/letters for archive pages', 'accesspress-mag' ),
            'id' => 'excerpt_lenght',
            'type' => 'text',
            'std' => 50, 
            );
    $options[] = array(
            'type' => 'groupend'
            );

/*------------------------Translations------------------------*/
    $options[] = array(
            'name' => __( 'Translations', 'accesspress-mag' ),
            'type' => 'heading'
            );
    $options[] = array(
            'name' => __( 'Translations', 'accesspress-mag' ),
            'id'   => 'translations',
            'type' => 'groupstart'
            );
    $options[] = array(
            'name' => __( 'Translate Your Theme', 'accesspress-mag' ),
            'desc' => __( 'Translate your frontend easily without any external plugins. While you leave the box empty and the theme will load the default string', 'accesspress-mag' ),
            'id' => 'translate_notice',
            'type' => 'info', 
            );
     for($i=0;$i<$trans_count;$i++)
     {
        $options[] = array(
            'name' => $translation_name[$i],
            'desc' => __( '', 'accesspress-mag' ),
            'id' => 'trans_'.$translation_id[$i],
            'type' => 'text', 
            );
     }       
    $options[] = array(
            'type' => 'groupend'
            );
            
/*----------------------------------------------------------*/
	return $options;
}