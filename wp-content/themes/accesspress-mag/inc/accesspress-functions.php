<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package AccessPress Mag
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
 
if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ) :
	
	/**
	 * Title shim for sites older than WordPress 4.1.
	 *
	 * @link https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
	 * @todo Remove this function when WordPress 4.3 is released.
	 */
	function accesspress_mag_render_title() {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}
	add_action( 'wp_head', 'accesspress_mag_render_title' );
endif;

function accesspress_mag_header_scripts(){
    
    $accesspress_mag_favicon = of_get_option('favicon_upload');
    if (!empty($accesspress_mag_favicon)) {
        echo '<link rel="icon" type="image/png" href="' . esc_url( $accesspress_mag_favicon ) . '">';
    }
}

add_action('wp_head', 'accesspress_mag_header_scripts');

/*---------Enqueue custom admin panel JS---------------*/
function accesspress_mag_admin_scripts(){
    wp_enqueue_script('accesspress-mag-custom-admin', get_template_directory_uri(). '/inc/option-framework/js/custom-admin.js', array( 'jquery'));    
 }
add_action('admin_enqueue_scripts','accesspress_mag_admin_scripts');

/*---------Enqueue admin css---------------*/
function accesspress_mag_admin_css(){
    wp_enqueue_style('accesspress-mag-admin', get_template_directory_uri(). '/inc/option-framework/css/accesspress-mag-admin.css');    
}
add_action('admin_head','accesspress_mag_admin_css');

/*-----------------------Homepage slider--------------------------*/
function accesspress_mag_slider_cb(){
        $slider_category = of_get_option( 'homepage_slider_category' );
        if(empty($slider_category)){
            $slider_category=''; }    
        $slide_count = of_get_option( 'count_slides' );
        $slide_info = of_get_option( 'slider_info' );
        $posts_perpage_value = $slide_count*4;
        $slider_args = array(
                    'category_name'=>$slider_category,
                    'post_type'=>'post',
                    'post_status'=>'publish',
                    'posts_per_page'=>$posts_perpage_value,
                    'order'=>'DESC',
                    'meta_query' => array(
                                        array(
                                            'key' => '_thumbnail_id',
                                            'compare' => '!=',
                                            'value' => null
                                        )
                                    )
                        );
        $slider_query = new WP_Query($slider_args);
        $slide_counter = 0; 
        if($slider_query->have_posts())
        {
            echo '<div id="homeslider">';
            while($slider_query->have_posts())
            {
                $slide_counter++;                                                            
                $slider_query->the_post();
                $post_image_id = get_post_thumbnail_id();
                $post_big_image_path = wp_get_attachment_image_src( $post_image_id, 'accesspress-mag-slider-big-thumb', true );
                $post_small_image_path = wp_get_attachment_image_src( $post_image_id, 'accesspress-mag-slider-small-thumb', true );
                $post_image_alt = get_post_meta( $post_image_id, '_wp_attachment_image_alt', true );
                if($slide_counter%4==1):
            ?>                        
                    <div class="slider">
            <?php 
                endif ;
                if($slide_counter%4==1):
            ?>
                        <a href="<?php echo the_permalink();?>">
                        <div class="big_slide wow fadeInLeft">
                            <div class="big-cat-box">
                                <span class="cat-name"><?php $cat_name = get_the_category(); echo esc_attr( $cat_name[0]->name ); ?></span>
                                <?php do_action('accesspress_mag_post_meta');?>
                            </div>
                            <div class="slide-image"><img src="<?php echo esc_url( $post_big_image_path[0] );?>" alt="<?php echo esc_attr($post_image_alt);?>" /></div>
                            <?php if($slide_info==1):?>
                            <div class="mag-slider-caption">
                              <h3 class="slide-title"><?php the_title();?></h3>
                            </div>
                            <?php endif;?>
                        </div>
                        </a>
            <?php else : if($slide_counter%4==2){echo '<div class="small-slider-wrapper wow fadeInRight">';}?>                
                       <a href="<?php echo the_permalink();?>">
                        <div class="small_slide">
                            <span class="cat-name"><?php $cat_name = get_the_category(); echo esc_attr( $cat_name[0]->name ); ?></span>
                            <div class="slide-image"><img src="<?php echo esc_url( $post_small_image_path[0] );?>" alt="<?php echo esc_attr($post_image_alt);?>" /></div>
                            <div class="mag-small-slider-caption">
                              <?php if($slide_info==1):?><h3 class="slide-title"><?php the_title();?></h3><?php endif; ?>
                            </div>                            
                        </div>
                       </a>
            <?php 
                 endif;
                 if($slide_counter%4==0):
            ?>
                    </div>
                    </div>
            <?php endif;
                
                }
            echo '</div>';
            }
            else {
                get_template_part( 'demo-content/demo-slider-content');
            }
 }
add_action( 'accesspress_mag_slider', 'accesspress_mag_slider_cb', 10 );


function accesspress_mag_slider_script(){
    $slider_controls = ( of_get_option( 'slider_controls' ) == "1" ) ? "true" : "false";
    $slider_auto_transaction = ( of_get_option( 'slider_auto_transition' ) == "1" ) ? "true" : "false";
    $slider_pager = ( of_get_option( 'slider_pager' ) == "1" ) ? "true" : "false";
    ?>
    <script type="text/javascript">
        jQuery(function($){
            $("#homeslider").bxSlider({
                controls:<?php echo esc_attr($slider_controls); ?>,
                pager:<?php echo esc_attr($slider_pager);?>,
                auto:<?php echo esc_attr($slider_auto_transaction);?>
                                        
            });
            });
    </script>
    <?php
}
add_action( 'wp_head', 'accesspress_mag_slider_script' );

/*--------------------- Post Views-------------------*/

function accesspress_mag_getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count;
}

function accesspress_mag_setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

// Remove issues with prefetching adding extra views
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0); 

/*-----------------Dynamic Css-------------------*/

function accesspress_mag_custom_css(){
    $accesspress_mag_bg_image = of_get_option( 'site_background' );
    $accesspress_mag_bg_color = of_get_option( 'site_background_color' );
    $accesspress_mag_bg_reapet = of_get_option( 'repeat_background' );
    $accesspress_mag_bg_position = of_get_option( 'position_background' );
    $accesspress_mag_bg_attachment = of_get_option( 'attached_background' );
    $accesspress_mag_bg_size = of_get_option( 'stretch_background' );
		echo '<style type="text/css">';
            if( !empty ( $accesspress_mag_bg_image )){
                echo "body{background:url(".esc_url( $accesspress_mag_bg_image) .") ".esc_html( $accesspress_mag_bg_reapet )." ".esc_html( $accesspress_mag_bg_attachment )." ".esc_html( $accesspress_mag_bg_position )."}";    
            } elseif( !empty ( $accesspress_mag_bg_color ) ) {
                echo "body{background-color:".esc_html( $accesspress_mag_bg_color )." !important}";
            } else {
                
            }
            if($accesspress_mag_bg_size==1){
                echo "body{background-size:cover}";
            }  
		echo '</style>';
	}
	add_action('wp_head','accesspress_mag_custom_css');

/*--------------Sidebar layout for post & pages----------------------*/
function accesspress_mag_sidebar_layout_class($classes){
    global $post;
    	if( is_404()){
    	$classes[] = ' ';
    	}elseif(is_singular()){
 	    $global_sidebar= of_get_option( 'global_post_sidebar' );
    	$post_sidebar = get_post_meta( $post -> ID, 'accesspress_mag_sidebar_layout', true );        
        $page_sidebar = get_post_meta( $post -> ID, 'accesspress_mag_page_sidebar_layout', true );
        if('post'==get_post_type()){
            if($post_sidebar=='global-sidebar'){
                $post_class = $global_sidebar;
            } else {
                $post_class = $post_sidebar;
            }
        	$classes[] = 'single-post-'.$post_class;
        } else {
            $classes[] = 'page-'.$page_sidebar;
        }
    	} elseif(is_archive()){
    	   $archive_sidebar = of_get_option( 'global_archive_sidebar' );
            $classes[] = 'archive-'.$archive_sidebar;
        } elseif(is_search()){
            $archive_sidebar = of_get_option( 'global_archive_sidebar' );
            $classes[] = 'archive-'.$archive_sidebar;
        }else{
    	$classes[] = 'page-right-sidebar';	
    	}
    	return $classes;
    }
add_filter( 'body_class', 'accesspress_mag_sidebar_layout_class' );

/*--------------Template style layout for post & pages----------------------*/

function accesspress_mag_template_layout_class($classes){
    global $post;
    	if( is_404()){
    	$classes[] = ' ';
    	}elseif(is_singular()){
 	    $global_template= of_get_option( 'global_post_template' );
    	$post_template = get_post_meta( $post -> ID, 'accesspress_mag_post_template_layout', true );
        if('post'==get_post_type()){
            if($post_template=='global-template'){
                $post_template_class = $global_template;
            } else {
                $post_template_class = $post_template;
            }
        	$classes[] = 'single-post-'.$post_template_class;
        }       
    	} elseif(is_archive()){
            $archive_template = of_get_option( 'global_archive_template' );
            $classes[] = 'archive-page-'.$archive_template;
        } elseif(is_search()){
            $archive_template = of_get_option( 'global_archive_template' );
            $classes[] = 'archive-page-'.$archive_template;
        }else{
    	$classes[] = 'page-default-template';	
    	}
    	return $classes;
    }
add_filter( 'body_class', 'accesspress_mag_template_layout_class' );

/*---------------------Website layout---------------------------------*/

function accesspress_mag_website_layout_class( $classes ){
    $website_layout = of_get_option( 'website_layout_option' );
    if($website_layout == 'boxed' ){
        $classes[] = 'boxed-layout';
    } else {
        $classes[] = 'fullwidth-layout';
    }
    return $classes;
}
add_filter( 'body_class', 'accesspress_mag_website_layout_class' );

/*----------------------Meta post on -----------------------------------*/
function accesspress_mag_post_meta_cb(){
    global $post;
    $show_post_views = of_get_option('show_post_views');
    $show_comment_count = of_get_option('show_comment_count');
    if($show_comment_count==1){
        $post_comment_count = get_comments_number( $post->ID );
        echo '<span class="comment_count"><i class="fa fa-comments"></i>'.esc_attr( $post_comment_count ).'</span>';
    }
    if($show_post_views==1){
        echo '<span class="apmag-post-views"><i class="fa fa-eye"></i>'.esc_html( accesspress_mag_getPostViews(get_the_ID()) ).'</span>';
    }
}
add_action( 'accesspress_mag_post_meta', 'accesspress_mag_post_meta_cb', 10 );

function accesspress_mag_home_posted_on_cb(){
    global $post;
    $show_post_views = of_get_option('show_post_views');
    $show_comment_count = of_get_option('show_comment_count');
    $show_post_date = of_get_option('post_show_date');
    
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);
    
    if($show_post_date==1){
	  $posted_on = sprintf(
    		_x( '%s', 'post date', 'accesspress-mag' ),
    		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
    	);	   
	} else {
        $posted_on = '';
    }
    echo '<span class="posted-on">' . $posted_on . '</span>';
    if($show_comment_count==1){
        $post_comment_count = get_comments_number( $post->ID );
        echo '<span class="comment_count"><i class="fa fa-comments"></i>'.esc_attr( $post_comment_count ).'</span>';
    }
    if($show_post_views==1){
        echo '<span class="apmag-post-views"><i class="fa fa-eye"></i>'.esc_html( accesspress_mag_getPostViews(get_the_ID()) ).'</span>';
    }
}
add_action( 'accesspress_mag_home_posted_on', 'accesspress_mag_home_posted_on_cb', 10 );

/*-------------------Excerpt length---------------------*/

function accesspress_mag_customize_excerpt_more( $more ) {
	return '...';
}
add_filter( 'excerpt_more', 'accesspress_mag_customize_excerpt_more' );

function accesspress_mag_word_count( $string, $limit ) {
	$words = explode( ' ', $string );
	return implode( ' ', array_slice( $words, 0, $limit ));
}

function accesspress_mag_letter_count( $content, $limit ) {
	$striped_content = strip_tags( $content );
	$striped_content = strip_shortcodes( $striped_content );
	$limit_content = mb_substr( $striped_content, 0 , $limit );
	if( $limit_content < $content ){
		$limit_content .= "..."; 
	}
	return $limit_content;
}

/*---------------Get excerpt content-------------------*/

function accesspress_mag_excerpt(){
    global $post;
    $excerpt_type = of_get_option( 'excerpt_type' );
    $excerpt_length = of_get_option( 'excerpt_lenght' );
    $excerpt_content = get_the_content($post -> ID);
    //$excerpt_content = get_post_field('post_content', $post -> ID);
    if( $excerpt_type == 'letters' ){
        $excerpt_content = accesspress_mag_letter_count( $excerpt_content, $excerpt_length );
    } else {
        $excerpt_content = accesspress_mag_word_count( $excerpt_content, $excerpt_length );
    }
    echo '<p>'. $excerpt_content .'</p>';
}

/*---------------- BreadCrumb --------------------------*/

	function accesspress_mag_breadcrumbs() {
	  global $post;
      $trans_here = of_get_option( 'trans_you_are_here' );
      if( empty( $trans_here ) ){ $trans_here = __( 'You are here', 'accesspress-mag' ); }
      $trans_home = of_get_option( 'trans_home' );
      if( empty( $trans_home ) ){ $trans_home = __( 'Home', 'accesspress-mag' ); }
      $trans_search = of_get_option( '' );
      //if( empty() )

        $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
        $delimiter = '<span class="bread_arrow"> > </span>'; // delimiter between crumbs
        $home = $trans_home; // text for the 'Home' link
        $showHomeLink = of_get_option( 'show_home_link_breadcrumbs' );

	  $showCurrent = of_get_option( 'show_article_breadcrumbs' ); // 1 - show current post/page title in breadcrumbs, 0 - don't show
	  $before = '<span class="current">'; // tag before the current crumb
	  $after = '</span>'; // tag after the current crumb
	  
	  $homeLink = home_url();
	  
	  if (is_home() || is_front_page()) {
	  
	    if ($showOnHome == 1) echo '<div id="accesspres-mag-breadcrumbs"><div class="ak-container"><a href="' . $homeLink . '">' . $home . '</a></div></div>';
	  
	  } else {
	       if($showHomeLink == 1){ 
	           echo '<div id="accesspres-mag-breadcrumbs" class="clearfix"><span class="bread-you">'.esc_attr( $trans_here ).'</span><div class="ak-container"><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
             } else {
	           echo '<div id="accesspres-mag-breadcrumbs" class="clearfix"><span class="bread-you">'.esc_attr( $trans_here ).'</span><div class="ak-container">' . $home . ' ' . $delimiter . ' ';
            }
	  
	    if ( is_category() ) {
	      $thisCat = get_category(get_query_var('cat'), false);
	      if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
	      echo $before .  single_cat_title('', false) . $after;
	  
	    } elseif ( is_search() ) {
	      echo $before . __( "Search results for", "accesspress-mag" ).' "' . get_search_query() . '"' . $after;
	  
	    } elseif ( is_day() ) {
	      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
	      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
	      echo $before . get_the_time('d') . $after;
	  
	    } elseif ( is_month() ) {
	      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
	      echo $before . get_the_time('F') . $after;
	  
	    } elseif ( is_year() ) {
	      echo $before . get_the_time('Y') . $after;
	  
	    } elseif ( is_single() && !is_attachment() ) {
	      if ( get_post_type() != 'post' ) {
	        $post_type = get_post_type_object(get_post_type());
	        $slug = $post_type->rewrite;
	        echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
	        if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
	      } else {
	        $cat = get_the_category(); $cat = $cat[0];
	        $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
	        if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
	        echo $cats;
	        if ($showCurrent == 1) echo $before . get_the_title() . $after;
	      }
	  
	    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
	      $post_type = get_post_type_object(get_post_type());
	      echo $before . $post_type->labels->singular_name . $after;
	  
	    } elseif ( is_attachment() ) {
	      $parent = get_post($post->post_parent);
	      $cat = get_the_category($parent->ID); $cat = $cat[0];
	      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
	      echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
	      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
	  
	    } elseif ( is_page() && !$post->post_parent ) {
	      if ($showCurrent == 1) echo $before . get_the_title() . $after;
	  
	    } elseif ( is_page() && $post->post_parent ) {
	      $parent_id  = $post->post_parent;
	      $breadcrumbs = array();
	      while ($parent_id) {
	        $page = get_page($parent_id);
	        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
	        $parent_id  = $page->post_parent;
	      }
	      $breadcrumbs = array_reverse($breadcrumbs);
	      for ($i = 0; $i < count($breadcrumbs); $i++) {
	        echo $breadcrumbs[$i];
	        if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
	      }
	      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
	  
	    } elseif ( is_tag() ) {
	      echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
	  
	    } elseif ( is_author() ) {
	       global $author;
	      $userdata = get_userdata($author);
	      echo $before . 'Author: ' . $userdata->display_name . $after;
	  
	    } elseif ( is_404() ) {
	      echo $before . 'Error 404' . $after;
	    }
        else
        {
            
        }
	  
	    if ( get_query_var('paged') ) {
	      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
	      echo __('Page' , 'accesspress-mag') . ' ' . get_query_var('paged');
	      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
	    }	  
	    echo '</div></div>';	  
	  }
	}
    
/*--------------WooCommerce breadcrumbs---------------------*/
add_filter( 'woocommerce_breadcrumb_defaults', 'accesspress_mag_woocommerce_breadcrumbs' ); 

function accesspress_mag_woocommerce_breadcrumbs() { 
$seperator = ' <span class="bread_arrow"> > </span> ';    
//$seperator =of_get_option( 'breadcrumb_seperator' ); 
$trans_home = of_get_option( 'trans_home' );
if( empty( $trans_home ) ){ $trans_home = __( 'Home', 'accesspress-mag' ); }
$home_text = $trans_home ;

$trans_here = of_get_option( 'trans_you_are_here' );
if( empty( $trans_here ) ){ $trans_here = __( 'You are here', 'accesspress-mag' ); }
//$home_text =of_get_option( 'breadcrumb_home' ); 
return array( 
'delimiter' => " ".$seperator." ", 
'before' => '', 
'after' => '', 
'wrap_before' => '<nav class="woocommerce-breadcrumb" itemprop="breadcrumb"><span class="bread-you">'.$trans_here.'</span><div class="ak-container">', 
'wrap_after' => '</div></nav>', 
'home' => _x( $home_text, 'breadcrumb', 'woocommerce' ), 
); 
} 

add_action( 'init', 'accesspress_mag_remove_wc_breadcrumbs' ); 
function accesspress_mag_remove_wc_breadcrumbs() { 
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 ); 
} 

$accesspress_show_breadcrumb = of_get_option( 'show_hide_breadcrumbs' ); 
if((function_exists('accesspress_mag_woocommerce_breadcrumbs') && $accesspress_show_breadcrumb == 1)) { 
add_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 10, 0 ); 
} 

/*------------Remove bbpress breadcrumbs-----------------------*/

function accesspress_mag_bbp_no_breadcrumb ($arg){
    return true ;
}
add_filter('bbp_no_breadcrumb', 'accesspress_mag_bbp_no_breadcrumb' );

/*--------------Install Required Plugins----------------------*/

function accesspress_mag_required_plugins() {
    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

        // This is an example of how to include a plugin pre-packaged with a theme.
        
         array(
            'name'      => __( 'Newsletter', 'accesspress-mag' ), //The plugin name
            'slug'      => 'newsletter',  // The plugin slug (typically the folder name)
            'required'  => true,  // If false, the plugin is only 'recommended' instead of required.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            ),
         array(
            'name'      => __( 'AccessPress Social Icons', 'accesspress-mag' ), //The plugin name
            'slug'      => 'accesspress-social-icons',  // The plugin slug (typically the folder name)
            'required'  => true,  // If false, the plugin is only 'recommended' instead of required.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            ),
         array(
            'name'      => __( 'AccessPress Social Counter', 'accesspress-mag' ), //The plugin name
            'slug'      => 'accesspress-social-counter',  // The plugin slug (typically the folder name)
            'required'  => true,  // If false, the plugin is only 'recommended' instead of required.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            ),
         array(
            'name'      => __( 'AccessPress Social Share', 'accesspress-mag' ), //The plugin name
            'slug'      => 'accesspress-social-share',  // The plugin slug (typically the folder name)
            'required'  => true,  // If false, the plugin is only 'recommended' instead of required.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            ),         
    );

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
            'default_path' => '',                      // Default absolute path to pre-packaged plugins.
            'menu'         => 'accesspress-install-plugins', // Menu slug.
            'has_notices'  => true,                    // Show admin notices or not.
            'dismissable'  => false,                    // If false, a user cannot dismiss the nag message.
            'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
            'is_automatic' => true,                   // Automatically activate plugins after installation or not.
            'message'      => '',                      // Message to output right before the plugins table.
            'strings'      => array(
            'page_title'                      => __( 'Install Required Plugins', 'accesspress-mag' ),
            'menu_title'                      => __( 'Install Plugins', 'accesspress-mag' ),
            'installing'                      => __( 'Installing Plugin: %s', 'accesspress-mag' ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'accesspress-mag' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins' ),
            'return'                          => __( 'Return to Required Plugins Installer', 'accesspress-mag' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'accesspress-mag' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'accesspress-mag' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );
    tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'accesspress_mag_required_plugins' );