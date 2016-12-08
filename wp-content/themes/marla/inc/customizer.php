<?php
/**
 * marla Theme Customizer
 *
 * @package marla
 */
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
 
function marla_sanitize_choices( $input, $setting ) {
    global $wp_customize;
 
    $control = $wp_customize->get_control( $setting->id );
 
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}
 
function marla_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
} 

function marla_sanitize_text( $input ) {
	
	return wp_kses_post( $input );
	
}
function marla_customize_register( $wp_customize ) {
	
	class marla_Custom_Text_Control extends WP_Customize_Control {
        public $type = 'customtext';
        public $extra = ''; // we add this for the extra description
        public function render_content() {
        ?>
        <label>
           
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <span style="color:#666; margin: 5px 0;"><?php echo esc_html( $this->extra ); ?></span>
            <input type="text" style="padding: 3px;color: #666;
border: 1px solid rgba(81, 203, 238, 1); margin:5px 0;
border-radius: 3px;-webkit-transition: all 0.30s ease-in-out;
-moz-transition: all 0.30s ease-in-out;
-ms-transition: all 0.30s ease-in-out;
-o-transition: all 0.30s ease-in-out;" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />
        </label>
        <?php
        }
    }
	

	class marla_Customize_Textarea_Control extends WP_Customize_Control {
    	public $type = 'textarea';
 		public $extra = '';
    	public function render_content() {
	        ?>
	        <label>
	        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	        <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
	        </label>
	        <?php
	    }
	}
	
	$wp_customize->add_section( 'styles', array(
		'title' => __( 'Skins', 'marla' ),
		'priority' => 10,
		)
	);
	
	
	
	$wp_customize->add_section( 'social_settings', array(
		'title' => __( 'Social', 'marla' ),
		'priority' => 90,
		)
	);
	
	$wp_customize->add_section( 'content_settings', array(
		'title' => __( 'Single Content', 'marla' ),
		'priority' => 100,
		)
	);
	
	$wp_customize->add_section( 'rss_settings', array(
		'title' => __( '3 options for email subscription', 'marla' ),
		'priority' => 110,
		)
	);
			
	$wp_customize->add_section( 'footer_settings', array(
		'title' => __( 'Footer', 'marla' ),
		'priority' => 122,
		)
	);
	
	$wp_customize->add_section( 'web_fonts', array(
		'title' => __( 'Typography', 'marla' ),
		'priority' => 200,
		)
	);
	$wp_customize->add_section( 'custom_css', array(
		'title' => __( 'Custom CSS & code', 'marla' ),
		'priority' => 250,
		)
	);
	
	/* content */
	
	
	$wp_customize->add_setting( 'slider_related_posts', array(
            'default' => marla_default_settings( 'slider_related_posts' ),
			
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'marla_sanitize_checkbox',
			
        ) );
       $wp_customize->add_control( 'slider_related_posts', array(
            'label'   => __( 'Show 3 related posts in slider at the end of a single post', 'marla' ),
            'section' => 'content_settings',
            'type'    => 'checkbox',
            
        ) );
		
	$wp_customize->add_setting( 'marla_right_sidebar', array(
            'default' => marla_default_settings( 'marla_right_sidebar' ),
			
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'marla_sanitize_checkbox',
			
        ) );
       $wp_customize->add_control( 'marla_right_sidebar', array(
            'label'   => __( 'Right sidebar on single posts when the screen is wider than 1000px', 'marla' ),
            'section' => 'content_settings',
            'type'    => 'checkbox',
            
        ) );
	
	
	$wp_customize->add_setting( 'marla_metadata', array(
            'default' => marla_default_settings( 'marla_metadata' ),
			
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'marla_sanitize_choices',
			
        ) );
       $wp_customize->add_control( 'marla_metadata', array(
            'label'   => __( 'Show metadata under the date on the left side of single post', 'marla' ),
            'section' => 'content_settings',
            'type'       => 'radio',
	'choices'    => array(
		  'tags' =>  __( 'Tags', 'marla' ),
		'categories' => __( 'Categories', 'marla' ),
		'none'   => __( 'None', 'marla' ),
    
        )) );
	
	
	
	/* Logo */
	
	$wp_customize->add_setting( 'author_bio', array(
            'default' => marla_default_settings( 'author_bio' ),
			'capability' => 'edit_theme_options',
			
			'sanitize_callback' => 'marla_sanitize_checkbox',
			
        ) );
       $wp_customize->add_control( 'author_bio', array(
            'label'   => __( 'Show Author Bio (must configure profile)', 'marla' ),
            'section' => 'content_settings',
            'type'    => 'checkbox',
            
        ) );
	
	
	
	$wp_customize->add_setting( 'header_background', array(
		'default' => marla_default_settings( 'header_background' ),
		
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'esc_url',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'marla_header_background', array(
		'label'   => __( 'header background', 'marla' ),
		'section' => 'header_image',
		'settings' => 'header_background',
		
	) ) );
	$wp_customize->add_setting( 'bg_cover', array(
            
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'marla_sanitize_checkbox',
			
        ) );
       $wp_customize->add_control( 'bg_cover', array(
            'label'   => __( 'Background NOT full screen', 'marla' ),
            'section' => 'background_image',
            'type'    => 'checkbox',
            
        ) );
	$wp_customize->add_setting( 'title_marla', array(
            'default' => marla_default_settings( 'title_marla' ),
			'capability' => 'edit_theme_options',
			
			'sanitize_callback' => 'marla_sanitize_checkbox',
			
        ) );
       $wp_customize->add_control( 'title_marla', array(
            'label'   => __( 'Show Title in Header', 'marla' ),
            'section' => 'title_tagline',
            'type'    => 'checkbox',
            
        ) );
		
	$wp_customize->add_setting( 'tagline_marla', array(
            'default' => marla_default_settings( 'tagline_marla' ),
			'capability' => 'edit_theme_options',
			
			'sanitize_callback' => 'marla_sanitize_checkbox',
			
        ) );
       $wp_customize->add_control( 'tagline_marla', array(
            'label'   => __( 'Show Tagline in Header', 'marla' ),
            'section' => 'title_tagline',
            'type'    => 'checkbox',
            
        ) );
		
	$wp_customize->add_setting( 'bg_styles', array(
            'default' => marla_default_settings( 'bg_styles' ),
			'capability' => 'edit_theme_options',
			
			'sanitize_callback' => 'marla_sanitize_choices',
			
        ) );
       $wp_customize->add_control( 'bg_styles', array(
            'label'   => __( 'Or choose one these backgrounds images', 'marla' ),
            'section' => 'background_image',
           'type'       => 'radio',
	'choices'    => array(
		  'url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0naHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmcnIHdpZHRoPScxMDAlJyBoZWlnaHQ9JzEwMCUnPgoJPHJhZGlhbEdyYWRpZW50IGlkPSdnJyBjeD0nNTAlJyBjeT0nNTAlJyByPSc1MCUnPgoJCTxzdG9wIG9mZnNldD0nMCUnIHN0eWxlPSdzdG9wLWNvbG9yOiNmZmZmZmY7JyAvPgoJCTxzdG9wIG9mZnNldD0nNTAlJyBzdHlsZT0nc3RvcC1jb2xvcjojNTJjNWZmOycgLz4KCQk8c3RvcCBvZmZzZXQ9JzEwMCUnIHN0eWxlPSdzdG9wLWNvbG9yOiMwNzkxYjM7JyAvPgoJPC9yYWRpYWxHcmFkaWVudD4KCTxyZWN0IHdpZHRoPScxMDAlJyBoZWlnaHQ9JzEwMCUnIGZpbGw9J3VybCgjZyknLz4KCTxzdmcgeD0nNTAlJyB5PSc1MCUnIG92ZXJmbG93PSd2aXNpYmxlJz4KCQk8cmVjdCB3aWR0aD0nMjAwMCUnIGhlaWdodD0nMjAwMCUnIGZpbGwtb3BhY2l0eT0nMC4xJyBmaWxsPScjZmZmZmZmJyB0cmFuc2Zvcm09J3JvdGF0ZSgyMCknLz4KCQk8cmVjdCB3aWR0aD0nMjAwMCUnIGhlaWdodD0nMjAwMCUnIGZpbGwtb3BhY2l0eT0nMC4xJyBmaWxsPScjZmZmZmZmJyB0cmFuc2Zvcm09J3JvdGF0ZSg0MCknLz4KCQk8cmVjdCB3aWR0aD0nMjAwMCUnIGhlaWdodD0nMjAwMCUnIGZpbGwtb3BhY2l0eT0nMC4xJyBmaWxsPScjZmZmZmZmJyB0cmFuc2Zvcm09J3JvdGF0ZSg2MCknLz4KCQk8cmVjdCB3aWR0aD0nMjAwMCUnIGhlaWdodD0nMjAwMCUnIGZpbGwtb3BhY2l0eT0nMC4xJyBmaWxsPScjZmZmZmZmJyB0cmFuc2Zvcm09J3JvdGF0ZSg4MCknLz4KCQk8cmVjdCB3aWR0aD0nMjAwMCUnIGhlaWdodD0nMjAwMCUnIGZpbGwtb3BhY2l0eT0nMC4xJyBmaWxsPScjZmZmZmZmJyB0cmFuc2Zvcm09J3JvdGF0ZSgxMDApJy8+CgkJPHJlY3Qgd2lkdGg9JzIwMDAlJyBoZWlnaHQ9JzIwMDAlJyBmaWxsLW9wYWNpdHk9JzAuMScgZmlsbD0nI2ZmZmZmZicgdHJhbnNmb3JtPSdyb3RhdGUoMTIwKScvPgoJCTxyZWN0IHdpZHRoPScyMDAwJScgaGVpZ2h0PScyMDAwJScgZmlsbC1vcGFjaXR5PScwLjEnIGZpbGw9JyNmZmZmZmYnIHRyYW5zZm9ybT0ncm90YXRlKDE0MCknLz4KCQk8cmVjdCB3aWR0aD0nMjAwMCUnIGhlaWdodD0nMjAwMCUnIGZpbGwtb3BhY2l0eT0nMC4xJyBmaWxsPScjZmZmZmZmJyB0cmFuc2Zvcm09J3JvdGF0ZSgxNjApJy8+CgkJPHJlY3Qgd2lkdGg9JzIwMDAlJyBoZWlnaHQ9JzIwMDAlJyBmaWxsLW9wYWNpdHk9JzAuMScgZmlsbD0nI2ZmZmZmZicgdHJhbnNmb3JtPSdyb3RhdGUoMTgwKScvPgoJCTxyZWN0IHdpZHRoPScyMDAwJScgaGVpZ2h0PScyMDAwJScgZmlsbC1vcGFjaXR5PScwLjEnIGZpbGw9JyNmZmZmZmYnIHRyYW5zZm9ybT0ncm90YXRlKDIwMCknLz4KCQk8cmVjdCB3aWR0aD0nMjAwMCUnIGhlaWdodD0nMjAwMCUnIGZpbGwtb3BhY2l0eT0nMC4xJyBmaWxsPScjZmZmZmZmJyB0cmFuc2Zvcm09J3JvdGF0ZSgyMjApJy8+CgkJPHJlY3Qgd2lkdGg9JzIwMDAlJyBoZWlnaHQ9JzIwMDAlJyBmaWxsLW9wYWNpdHk9JzAuMScgZmlsbD0nI2ZmZmZmZicgdHJhbnNmb3JtPSdyb3RhdGUoMjQwKScvPgoJCTxyZWN0IHdpZHRoPScyMDAwJScgaGVpZ2h0PScyMDAwJScgZmlsbC1vcGFjaXR5PScwLjEnIGZpbGw9JyNmZmZmZmYnIHRyYW5zZm9ybT0ncm90YXRlKDI2MCknLz4KCQk8cmVjdCB3aWR0aD0nMjAwMCUnIGhlaWdodD0nMjAwMCUnIGZpbGwtb3BhY2l0eT0nMC4xJyBmaWxsPScjZmZmZmZmJyB0cmFuc2Zvcm09J3JvdGF0ZSgyODApJy8+CgkJPHJlY3Qgd2lkdGg9JzIwMDAlJyBoZWlnaHQ9JzIwMDAlJyBmaWxsLW9wYWNpdHk9JzAuMScgZmlsbD0nI2ZmZmZmZicgdHJhbnNmb3JtPSdyb3RhdGUoMzAwKScvPgoJCTxyZWN0IHdpZHRoPScyMDAwJScgaGVpZ2h0PScyMDAwJScgZmlsbC1vcGFjaXR5PScwLjEnIGZpbGw9JyNmZmZmZmYnIHRyYW5zZm9ybT0ncm90YXRlKDMyMCknLz4KCQk8cmVjdCB3aWR0aD0nMjAwMCUnIGhlaWdodD0nMjAwMCUnIGZpbGwtb3BhY2l0eT0nMC4xJyBmaWxsPScjZmZmZmZmJyB0cmFuc2Zvcm09J3JvdGF0ZSgzNDApJy8+CgkJPHJlY3Qgd2lkdGg9JzIwMDAlJyBoZWlnaHQ9JzIwMDAlJyBmaWxsLW9wYWNpdHk9JzAuMScgZmlsbD0nI2ZmZmZmZicgdHJhbnNmb3JtPSdyb3RhdGUoMzYwKScvPgoJPC9zdmc+Cjwvc3ZnPg==")' => '1' ,
		'url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0naHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmcnIHhtbG5zOnhsaW5rPSdodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rJyB3aWR0aD0nMTAwJScgaGVpZ2h0PScxMDAlJz4KCTxkZWZzPgoJCTxnIGlkPSdhJz4KCQkJPHBhdGggZD0nTTUgNmwtNiAtNiB2LTIgbDYgNicgZmlsbC1vcGFjaXR5PScwJyBzdHJva2U9JyMyYjNhNzUnIC8+CgkJCTxwYXRoIGQ9J001IDVsNiAtNiB2LTIgbC02IDYnIGZpbGwtb3BhY2l0eT0nMCcgc3Ryb2tlPScjMzE0MTdkJyAvPgoJCTwvZz4KCQk8cGF0dGVybiBwYXR0ZXJuVW5pdHM9J3VzZXJTcGFjZU9uVXNlJyB4PScwJyB5PScwJyBpZD0ncCcgd2lkdGg9JzIwJyBoZWlnaHQ9JzIwJyB2aWV3Qm94PScwIDAgMTAgMTAnPgoJCQk8dXNlIHhsaW5rOmhyZWY9JyNhJy8+ICAKCQkJPHVzZSB4bGluazpocmVmPScjYScgeT0nLTQnLz4KCQkJPHVzZSB4bGluazpocmVmPScjYScgeT0nNCcvPgoJCQk8dXNlIHhsaW5rOmhyZWY9JyNhJyB5PSc4Jy8+CgkJCTx1c2UgeGxpbms6aHJlZj0nI2EnIHk9JzEyJy8+CgkJPC9wYXR0ZXJuPgoJCTxyYWRpYWxHcmFkaWVudCBncmFkaWVudFVuaXRzPSd1c2VyU3BhY2VPblVzZScgaWQ9J2cnIGN4PSc1MCUnIGN5PSc1MCUnIGZ4PSczMCUnIGZ5PSczMCUnIHI9JzYwJSc+CgkJCTxzdG9wIG9mZnNldD0nMCUnIHN0b3AtY29sb3I9JyNhYWFhYWEnIHN0b3Atb3BhY2l0eT0nLjUnIC8+CgkJCTxzdG9wIG9mZnNldD0nMTAwJScgc3RvcC1jb2xvcj0nIzAwMDAwMCcgc3RvcC1vcGFjaXR5PScuNycgLz4KCQkJPC9yYWRpYWxHcmFkaWVudD4KCTwvZGVmcz4KCTxyZWN0IHg9Jy01JScgeT0nLTUlJyB3aWR0aD0nMTEwJScgaGVpZ2h0PScxMTAlJyBmaWxsPScjMDAwMDIyJy8+Cgk8cmVjdCB3aWR0aD0nMTEwJScgaGVpZ2h0PScxMTAlJyBmaWxsPSd1cmwoI3ApJy8+Cgk8cmVjdCB4PSctNSUnIHk9Jy01JScgd2lkdGg9JzExMCUnIGhlaWdodD0nMTEwJScgZmlsbD0ndXJsKCNnKScvPgo8L3N2Zz4=")'  => '2' ,
		'url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0naHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmcnIHdpZHRoPScxMDAlJyBoZWlnaHQ9JzEwMCUnPgoJPGRlZnM+CgkJPHBhdHRlcm4gaWQ9J3RpbGUnIHBhdHRlcm5Vbml0cz0ndXNlclNwYWNlT25Vc2UnIHdpZHRoPSc3NScgaGVpZ2h0PSc3NScgdmlld0JveD0nMCAwIDUwIDUwJz4KCQkJPGxpbmUgeDE9JzEnIHkxPScwJyB4Mj0nNTEnIHkyPSc1MCcgc3Ryb2tlPScjMTkyMDNkJyBzdHJva2Utd2lkdGg9JzInLz4KCQkJPGxpbmUgeDE9JzQ5JyB5MT0nMCcgeDI9Jy0xJyB5Mj0nNTAnIHN0cm9rZT0nIzE5MjAzZCcgc3Ryb2tlLXdpZHRoPScyJy8+CgkJCTxsaW5lIHgxPSc1MCcgeTE9JzAnIHgyPScwJyB5Mj0nNTAnIHN0cm9rZT0nIzBmODE5ZScgc3Ryb2tlLXdpZHRoPScyJy8+CgkJCTxsaW5lIHgxPScwJyB5MT0nMCcgeDI9JzUwJyB5Mj0nNTAnIHN0cm9rZT0nIzBmODE5ZScgc3Ryb2tlLXdpZHRoPScyJy8+CgkJPC9wYXR0ZXJuPgoJCTxyYWRpYWxHcmFkaWVudCBpZD0nbCcgY3g9JzUwJScgY3k9JzIwMCUnIGZ5PScwJyByPScyMDElJz4KCQkJPHN0b3Agb2Zmc2V0PScwJScgc3R5bGU9J3N0b3AtY29sb3I6I2ZmZjsgc3RvcC1vcGFjaXR5Oi4xOycgLz4KCQkJPHN0b3Agb2Zmc2V0PScxMCUnIHN0eWxlPSdzdG9wLWNvbG9yOiMwMDA7IHN0b3Atb3BhY2l0eTowLjE7JyAvPgoJCQk8c3RvcCBvZmZzZXQ9JzMwJScgc3R5bGU9J3N0b3AtY29sb3I6IzAwMDsgc3RvcC1vcGFjaXR5OjAuMzsnIC8+CgkJCTxzdG9wIG9mZnNldD0nOTAlJyBzdHlsZT0nc3RvcC1jb2xvcjojMDAwOyBzdG9wLW9wYWNpdHk6MC41NTsnIC8+CgkJCTxzdG9wIG9mZnNldD0nMTAwJScgc3R5bGU9J3N0b3AtY29sb3I6IzAwMDsgc3RvcC1vcGFjaXR5Oi42JyAvPgoJCTwvcmFkaWFsR3JhZGllbnQ+Cgk8L2RlZnM+Cgk8cmVjdCBmaWxsPScjMDc5MWIzJyB3aWR0aD0nMTAwJScgaGVpZ2h0PScxMDAlJy8+Cgk8cmVjdCBmaWxsPSd1cmwoI3RpbGUpJyB3aWR0aD0nMTAwJScgaGVpZ2h0PScxMDAlJy8+Cgk8cmVjdCB3aWR0aD0nMTAwJScgaGVpZ2h0PScxMDAlJyBmaWxsPSd1cmwoI2wpJy8+Cjwvc3ZnPg==")'   => '3' ,
    
        )) );
	
	
	
	/* Custom CSS */
	$wp_customize->add_setting( 'marla_custom_css', array(
		'default' => marla_default_settings( 'marla_custom_css' ),
		'capability' => 'edit_theme_options',
		
		'sanitize_callback' => 'marla_sanitize_text',
	) );
	$wp_customize->add_control( new marla_Customize_Textarea_Control( $wp_customize, 'marla_mycustom_css', array(
		'label' => __( 'Custom CSS', 'marla' ),
		'section' => 'custom_css',
		'settings' => 'marla_custom_css',
	) ) );
	
	/* Custom code */
	$wp_customize->add_setting( 'code_header', array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'marla_sanitize_text',
		
	) );
	$wp_customize->add_control( new marla_Customize_Textarea_Control( $wp_customize, 'marla_code_header', array(
		'label' => __( 'Extra code in <head> like Google Analytics', 'marla' ),
		'section' => 'custom_css',
		'settings' => 'code_header',
	) ) );
	
	/* typography */
	
	$wp_customize->add_setting( 'google_web_fonts', array(
            'default' => marla_default_settings( 'google_web_fonts' ),
			'capability' => 'edit_theme_options',
			
			'sanitize_callback' => 'marla_sanitize_choices',
			
        ) );
       $wp_customize->add_control( 'google_web_fonts', array(
            'label'   => __( 'Choose a Google Web Fonts', 'marla' ),
            'section' => 'web_fonts',
           'type'       => 'radio',
	'choices'    => array(
	'Droid+Sans' => 'Droid Sans',
	'Lato' => 'Lato' ,
	'Arvo' => 'Arvo' ,
	'Vollkorn' => 'Vollkorn',
	'Ubuntu' => 'Ubuntu',
		 'Source+Sans+Pro' => 'Source Sans Pro',
		  'PT+Sans' => 'PT Sans',
		  'Droid+Sans' => 'Droid Sans',
		'Open+Sans'   => 'Open Sans' ,
		
		'Cabin' => 'Cabin',
		'Didac+Gothic' => 'Didac Gothic',
    
        )) );
	
	$wp_customize->add_setting( 'font_size', array(
		'default' => marla_default_settings( 'font_size' ),
		'capability' => 'edit_theme_options',
		
		'sanitize_callback' => 'marla_sanitize_text',
	) );
	$wp_customize->add_control(new marla_Custom_Text_Control( $wp_customize,'font_size', array(	
		'type'    => 'text',
		'label' => __( 'Font Size in %', 'marla' ),
		'section' => 'web_fonts',
		'settings' => 'font_size',
		'extra' => __( 'A number from 0 to 100', 'marla' ) 
	) ) );
	
	
	$wp_customize->add_setting( 'height_header', array(
            'default' => marla_default_settings( 'height_header' ),
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'marla_sanitize_text',
			
			
        ) );
      $wp_customize->add_control(new marla_Custom_Text_Control( $wp_customize,'height_header', array(	
		'type'    => 'text',
		'label' => __( 'Height in px', 'marla' ),
		'section' => 'header_image',
		'settings' => 'height_header',
		'extra' => __( 'Just the number, no need of px', 'marla' ) 
		
	) ) );
	
	/* typography */
	
	$wp_customize->add_setting( 'marla_styles', array(
            'default' => marla_default_settings( 'marla_styles' ),
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'marla_sanitize_choices',
			
        ) );
       $wp_customize->add_control( 'marla_styles', array(
            'label'   => __( 'Choose a starter style', 'marla' ),
            'section' => 'styles',
           'type'       => 'radio',
	'choices'    => array(
	'blue' => 'blue (default)',
	'light' => 'light' ,
	'dark' => 'dark' ,
	   
        )) );
	
	
	
	/* footer */
	
	$wp_customize->add_setting( 'footer_fixed', array(
            
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'marla_sanitize_checkbox',
			
        ) );
       $wp_customize->add_control( 'footer_fixed', array(
            'label'   => __( 'Footer fixed', 'marla' ),
            'section' => 'footer_settings',
            'type'    => 'checkbox',
            
        ) );
		
	$wp_customize->add_setting( 'footer_text', array(
		'default' => marla_default_settings( 'footer_text' ),
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage',
		'sanitize_callback' => 'marla_sanitize_text',
	) );
	
	
	$wp_customize->add_control( new marla_Customize_Textarea_Control( $wp_customize, 'marla_footer_text', array(
		'label' => __( 'Footer Text', 'marla' ),
		'section' => 'footer_settings',
		'settings' => 'footer_text',
	) ) );
	/* colores color */
	
	$wp_customize->add_setting( 'header_background_color', array(
		'default' => marla_default_settings( 'header_background_color' ),
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
		
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'marla_header_background_color', array(
	    'label'   => __( 'header background color', 'marla' ),
	    'section' => 'header_image',
	    'settings'   => 'header_background_color',
	) ) );
	
	$wp_customize->add_setting( 'footer_background_color', array(
		'default' => marla_default_settings( 'footer_background_color' ),
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
		
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'marla_footer_background_color', array(
	    'label'   => __( 'footer background color', 'marla' ),
	    'section' => 'colors',
	    'settings'   => 'footer_background_color',
	) ) );
	$wp_customize->add_setting( 'link_color', array(
		'default' => marla_default_settings( 'link_color' ),
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
		
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'marla_link_color', array(
	    'label'   => __( 'Link Color', 'marla' ),
	    'section' => 'colors',
	    'settings'   => 'link_color',
	) ) );
	
	$wp_customize->add_setting( 'hover_color', array(
		'default' => marla_default_settings( 'hover_color' ),
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
		
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'marla_hover_color', array(
	    'label'   => __( 'Hover Color', 'marla' ),
	    'section' => 'colors',
	    'settings'   => 'hover_color',
	) ) );
	
	
	
	$wp_customize->add_setting( 'headings_color', array(
		'default' => marla_default_settings( 'headings_color' ),
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
		
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'headings_color', array(
	    'label'   => __( 'Headings Color', 'marla' ),
	    'section' => 'colors',
	    'settings'   => 'headings_color',
	) ) );
	
	
	
	$wp_customize->add_setting( 'footer_color', array(
		'default' => marla_default_settings( 'footer_color' ),
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
		
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'marla_footer_color', array(
	    'label'   => __( 'Footer Text Color', 'marla' ),
	    'section' => 'colors',
	    'settings'   => 'footer_color',
	) ) );
	
	/* Social */
	
	
	
	
	$wp_customize->add_setting( 'marla_social1', array(
		'default' => marla_default_settings( 'marla_social1' ),
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'marla_sanitize_text',
		
	) );
	$wp_customize->add_control( new marla_Custom_Text_Control( $wp_customize, 'marla_social1', array(
	    'label'   => __( 'Twitter', 'marla' ),
	    'section' => 'social_settings',
	    'settings'   => 'marla_social1',
		'type'    => 'text',
		'extra' => __( 'eg: ceslava', 'marla' ) )
		
	) );
	$wp_customize->add_setting( 'marla_social2', array(
		'default' => marla_default_settings( 'marla_social2' ),
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'marla_sanitize_text',
		
		
	) );
	$wp_customize->add_control(new marla_Custom_Text_Control( $wp_customize, 'marla_social2', array(
	    'type'    => 'text',
		'label'   => __( 'Facebook Fanpage', 'marla' ),
	    'section' => 'social_settings',
	    'settings'   => 'marla_social2',
		'extra' => __( 'eg: ceslavacom', 'marla' ) )
	) );
	$wp_customize->add_setting( 'marla_social3', array(
		'default' => marla_default_settings( 'marla_social3' ),
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'marla_sanitize_text',
		
		
	) );
	$wp_customize->add_control(new marla_Custom_Text_Control( $wp_customize,'marla_social3', array(	
		'type'    => 'text',
	    'label'   => __( 'Google Plus', 'marla' ),
	    'section' => 'social_settings',
	    'settings'   => 'marla_social3',
		'extra' => __( 'Full URL', 'marla' ) )
	) );
	
	$wp_customize->add_setting( 'marla_social_pinterest', array(
		'default' => marla_default_settings( 'marla_social_pinterest' ),
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'marla_sanitize_text',
		
		
	) );
	$wp_customize->add_control(new marla_Custom_Text_Control( $wp_customize,'marla_social_pinterest', array(	
		'type'    => 'text',
	    'label'   => __( 'Pinterest user', 'marla' ),
	    'section' => 'social_settings',
	    'settings'   => 'marla_social_pinterest',
		 )
	) );
	
	$wp_customize->add_setting( 'pinterest_button', array(
		'default' => marla_default_settings( 'pinterest_button' ),
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'marla_sanitize_text',
		
		
	) );
	 $wp_customize->add_control( 'pinterest_button', array(
            'label'   => __( 'Show Pinterest button over images', 'marla' ),
            'section' => 'social_settings',
            'type'    => 'checkbox',
            
        ) );
	
	$wp_customize->add_setting( 'marla_social_instagram', array(
		'default' => marla_default_settings( 'marla_social_instagram' ),
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'marla_sanitize_text',
		
		
	) );
	$wp_customize->add_control(new marla_Custom_Text_Control( $wp_customize,'marla_social_instagram', array(	
		'type'    => 'text',
	    'label'   => __( 'Instagram user', 'marla' ),
	    'section' => 'social_settings',
	    'settings'   => 'marla_social_instagram',
		)
	) );
	
	$wp_customize->add_setting( 'marla_social_youtube', array(
		'default' => marla_default_settings( 'marla_social_youtube' ),
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'marla_sanitize_text',
		
		
	) );
	$wp_customize->add_control(new marla_Custom_Text_Control( $wp_customize,'marla_social_youtube', array(	
		'type'    => 'text',
	    'label'   => __( 'YouTube user', 'marla' ),
	    'section' => 'social_settings',
	    'settings'   => 'marla_social_youtube',
		 )
	) );
	
	$wp_customize->add_setting( 'marla_social_vimeo', array(
		'default' => marla_default_settings( 'marla_social_vimeo' ),
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'marla_sanitize_text',
		
		
	) );
	$wp_customize->add_control(new marla_Custom_Text_Control( $wp_customize,'marla_social_vimeo', array(	
		'type'    => 'text',
	    'label'   => __( 'Vimeo user', 'marla' ),
	    'section' => 'social_settings',
	    'settings'   => 'marla_social_vimeo',
		 )
	) );
	
	$wp_customize->add_setting( 'marla_social_linkedin', array(
		'default' => marla_default_settings( 'marla_social_linkedin' ),
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'marla_sanitize_text',
		
		
	) );
	$wp_customize->add_control(new marla_Custom_Text_Control( $wp_customize,'marla_social_linkedin', array(	
		'type'    => 'text',
	    'label'   => __( 'LinkedIn URL', 'marla' ),
	    'section' => 'social_settings',
	    'settings'   => 'marla_social_linkedin',
		 )
	) );
	
	$wp_customize->add_setting( 'marla_social_email', array(
		'default' => marla_default_settings( 'marla_social_email' ),
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'marla_sanitize_text',
		
		
	) );
	$wp_customize->add_control(new marla_Custom_Text_Control( $wp_customize,'marla_social_email', array(	
		'type'    => 'text',
	    'label'   => __( 'Email', 'marla' ),
	    'section' => 'social_settings',
	    'settings'   => 'marla_social_email',
		 )
	) );
	
	/* RSS and email subscriptions */
	
	
	
	$wp_customize->add_setting( 'marla_social4', array(
		'default' => marla_default_settings( 'marla_social4' ),
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'marla_sanitize_text',
		
		
	) );
	$wp_customize->add_control(new marla_Custom_Text_Control( $wp_customize,'marla_social4', array(	
		'type'    => 'text',
	    'label'   => __( 'FeedBurner user', 'marla' ),
	    'section' => 'rss_settings',
	    'settings'   => 'marla_social4',
		'extra' => __( 'Just the last part of your feedburner URL, displays a link in the footer if active and the subscription email form on single posts. Leave blank to show another option', 'marla' ) )
	) );
	
	
	
	$wp_customize->add_setting( 'marla_rss_url', array(
		'default' => marla_default_settings( 'marla_rss_url' ),
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'marla_sanitize_text',
		
		
	) );
	$wp_customize->add_control(new marla_Custom_Text_Control( $wp_customize,'marla_rss_url', array(	
		'type'    => 'text',
	    'label'   => __( 'RSS url', 'marla' ),
	    'section' => 'social_settings',
	    'settings'   => 'marla_rss_url',
		'extra' => __( 'Display just a link in the footer if active to your RSS different from FeedBurner', 'marla' ) )
	) );
	
	
	$wp_customize->add_setting( 'marla_default_RSS_URL', array(
            'default' => marla_default_settings( 'marla_default_RSS_URL' ),
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'marla_sanitize_checkbox',
			
        ) );
       $wp_customize->add_control( 'marla_default_RSS_URL', array(
            'label'   => __( 'Use the default RSS 2.0 feed URL from WordPress and display a link to it on footer', 'marla' ),
            'section' => 'social_settings',
            'type'    => 'checkbox',
            
        ) );
	
	
	
	
	
	
	
	$wp_customize->add_setting( 'marla_jetpack_subscription', array(
            'default' => marla_default_settings( 'marla_jetpack_subscription' ),
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'marla_sanitize_checkbox',
        ) );
       $wp_customize->add_control( 'marla_jetpack_subscription', array(
            'label'   => __( 'Jetpack: Display subscription email form on single posts. Only if you have installed the plugin Jetpack', 'marla' ),
            'section' => 'rss_settings',
            'type'    => 'checkbox',
            
        ) );
	
	
	/* Custom code */
	$wp_customize->add_setting( 'marla_email_code', array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'marla_sanitize_text',
	) );
	$wp_customize->add_control( new marla_Customize_Textarea_Control( $wp_customize, 'marla_email_custom_form', array(
		'label' => __( 'Email form subscription code different from Jetpack or FeedBurner. It will be wrapped with <div id="marla-email-form"> in case you need some extra CSS', 'marla' ),
		'section' => 'rss_settings',
		'settings' => 'marla_email_code',
	) ) );
	/*-----------------------------------*/
	
	
		
	$wp_customize->add_setting( 'social_header', array(
            'default' => marla_default_settings( 'social_header' ),
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'marla_sanitize_checkbox',
			
			
        ) );
		
	$wp_customize->add_setting( 'marla_editor', array(
            'default' => marla_default_settings( 'marla_editor' ),
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'marla_sanitize_checkbox',
			
        ) );
       $wp_customize->add_control( 'marla_editor', array(
            'label'   => __( 'Post/Page editor styles', 'marla' ),
            'section' => 'custom_css',
            'type'    => 'checkbox',
            
        ) );
      
	
	/* header fixed or static */
	
	$wp_customize->add_setting( 'header_fixed', array(
            'default' => marla_default_settings( 'header_fixed' ),
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'marla_sanitize_checkbox',
			
        ) );
       $wp_customize->add_control( 'header_fixed', array(
            'label'   => __( 'Header fixed and menu at the top', 'marla' ),
            'section' => 'header_image',
            'type'    => 'checkbox',
            
        ) );
	
	
 $wp_customize->add_control( 'social_header', array(
            'label'   => __( 'Display twitter & FB widgets in header', 'marla' ),
            'section' => 'header_image',
            'type'    => 'checkbox',
            
        ) );
	
	
	$wp_customize->add_setting( 'social_footer', array(
            'default' => marla_default_settings( 'social_footer' ),
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'marla_sanitize_checkbox',
			
			
        ) );
       $wp_customize->add_control( 'social_footer', array(
            'label'   => __( 'Display social icons in footer', 'marla' ),
            'section' => 'social_settings',
            'type'    => 'checkbox',
            
        ) );
	
	/*menu*/
	
	$wp_customize->add_setting( 'nav_color_bg', array(
		'default' => marla_default_settings( 'nav_color_bg' ),
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
		
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'marla_nav_color_bg', array(
	    'label'   => __( 'nav color background', 'marla' ),
	    'section' => 'nav',
	    'settings'   => 'nav_color_bg',
	) ) );
	
	$wp_customize->add_setting( 'nav_color_item', array(
		'default' => marla_default_settings( 'nav_color_item' ),
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
		
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'marla_nav_color_item', array(
	    'label'   => __( 'nav color background item', 'marla' ),
	    'section' => 'nav',
	    'settings'   => 'nav_color_item',
	) ) );
	
	$wp_customize->add_setting( 'nav_color_text', array(
		'default' => marla_default_settings( 'nav_color_text' ),
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
		
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'marla_nav_color_text', array(
	    'label'   => __( 'nav color text', 'marla' ),
	    'section' => 'nav',
	    'settings'   => 'nav_color_text',
	) ) );
	
}
add_action( 'customize_register', 'marla_customize_register' );
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function marla_customize_preview_js() {
	wp_enqueue_script( 'marla_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'marla_customize_preview_js' );
