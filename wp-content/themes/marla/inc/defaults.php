<?php function marla_default_settings( $setting = '' )
{
$defaults = array(	
		'marla_email_code' => '',
		'height_header' => '50',
		'marla_styles' => '',
		'marla_rss_url' => '',
		'marla_default_RSS_URL' => 0, 
		'marla_jetpack_subscription' => 0,
		'marla_metadata' => 'tags',
		'marla_right_sidebar'         => 0,
		'marla_custom_css' => '',
		'code_header' => '',
		'footer_color' => '',	
		'footer_text'           => '&copy; '. date('Y') .' '. get_bloginfo('name').'.',
		'headings_color'			=> '#444444',
		'link_color'			=> '#0791b3',
		'hover_color'			=> '#0791b3',
		'nav_color_bg'			=> '#0791b3',
		'nav_color_item'			=> '#52c5ff',
		'nav_color_text'			=> '#FFFFFF',
		'pinterest_button'         => 1,
		'social_header'         => 1,
		'marla_editor'	=> 1,
		'social_footer'         => 1,
		'marla_social1'		=> '',
		'marla_social2'		=> '',
		'marla_social3'		=> '',
		'marla_social4'		=> '',
		'marla_social_pinterest'		=> '',
		'marla_social_instagram'		=> '',
		'marla_social_youtube'		=> '',
		'marla_social_vimeo'		=> '',
		'marla_social_linkedin'		=> '',
		'marla_social_email'		=> '',
		'header_fixed'		=> 0,
		'title_marla'		=> 0,
		'tagline_marla'		=> 0,
		'author_bio'		=> 1,
		'font_size' => '85',
		'google_web_fonts' => 'Open+Sans',
		'blogname'		=> 'marla',
		'footer_fixed'		=> 0,
		'slider_related_posts' => 1,
		'bg_cover'			=> 1,
		'bg_styles'			=> 'url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0naHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmcnIHdpZHRoPScxMDAlJyBoZWlnaHQ9JzEwMCUnPgoJPHJhZGlhbEdyYWRpZW50IGlkPSdnJyBjeD0nNTAlJyBjeT0nNTAlJyByPSc1MCUnPgoJCTxzdG9wIG9mZnNldD0nMCUnIHN0eWxlPSdzdG9wLWNvbG9yOiNmZmZmZmY7JyAvPgoJCTxzdG9wIG9mZnNldD0nNTAlJyBzdHlsZT0nc3RvcC1jb2xvcjojNTJjNWZmOycgLz4KCQk8c3RvcCBvZmZzZXQ9JzEwMCUnIHN0eWxlPSdzdG9wLWNvbG9yOiMwNzkxYjM7JyAvPgoJPC9yYWRpYWxHcmFkaWVudD4KCTxyZWN0IHdpZHRoPScxMDAlJyBoZWlnaHQ9JzEwMCUnIGZpbGw9J3VybCgjZyknLz4KCTxzdmcgeD0nNTAlJyB5PSc1MCUnIG92ZXJmbG93PSd2aXNpYmxlJz4KCQk8cmVjdCB3aWR0aD0nMjAwMCUnIGhlaWdodD0nMjAwMCUnIGZpbGwtb3BhY2l0eT0nMC4xJyBmaWxsPScjZmZmZmZmJyB0cmFuc2Zvcm09J3JvdGF0ZSgyMCknLz4KCQk8cmVjdCB3aWR0aD0nMjAwMCUnIGhlaWdodD0nMjAwMCUnIGZpbGwtb3BhY2l0eT0nMC4xJyBmaWxsPScjZmZmZmZmJyB0cmFuc2Zvcm09J3JvdGF0ZSg0MCknLz4KCQk8cmVjdCB3aWR0aD0nMjAwMCUnIGhlaWdodD0nMjAwMCUnIGZpbGwtb3BhY2l0eT0nMC4xJyBmaWxsPScjZmZmZmZmJyB0cmFuc2Zvcm09J3JvdGF0ZSg2MCknLz4KCQk8cmVjdCB3aWR0aD0nMjAwMCUnIGhlaWdodD0nMjAwMCUnIGZpbGwtb3BhY2l0eT0nMC4xJyBmaWxsPScjZmZmZmZmJyB0cmFuc2Zvcm09J3JvdGF0ZSg4MCknLz4KCQk8cmVjdCB3aWR0aD0nMjAwMCUnIGhlaWdodD0nMjAwMCUnIGZpbGwtb3BhY2l0eT0nMC4xJyBmaWxsPScjZmZmZmZmJyB0cmFuc2Zvcm09J3JvdGF0ZSgxMDApJy8+CgkJPHJlY3Qgd2lkdGg9JzIwMDAlJyBoZWlnaHQ9JzIwMDAlJyBmaWxsLW9wYWNpdHk9JzAuMScgZmlsbD0nI2ZmZmZmZicgdHJhbnNmb3JtPSdyb3RhdGUoMTIwKScvPgoJCTxyZWN0IHdpZHRoPScyMDAwJScgaGVpZ2h0PScyMDAwJScgZmlsbC1vcGFjaXR5PScwLjEnIGZpbGw9JyNmZmZmZmYnIHRyYW5zZm9ybT0ncm90YXRlKDE0MCknLz4KCQk8cmVjdCB3aWR0aD0nMjAwMCUnIGhlaWdodD0nMjAwMCUnIGZpbGwtb3BhY2l0eT0nMC4xJyBmaWxsPScjZmZmZmZmJyB0cmFuc2Zvcm09J3JvdGF0ZSgxNjApJy8+CgkJPHJlY3Qgd2lkdGg9JzIwMDAlJyBoZWlnaHQ9JzIwMDAlJyBmaWxsLW9wYWNpdHk9JzAuMScgZmlsbD0nI2ZmZmZmZicgdHJhbnNmb3JtPSdyb3RhdGUoMTgwKScvPgoJCTxyZWN0IHdpZHRoPScyMDAwJScgaGVpZ2h0PScyMDAwJScgZmlsbC1vcGFjaXR5PScwLjEnIGZpbGw9JyNmZmZmZmYnIHRyYW5zZm9ybT0ncm90YXRlKDIwMCknLz4KCQk8cmVjdCB3aWR0aD0nMjAwMCUnIGhlaWdodD0nMjAwMCUnIGZpbGwtb3BhY2l0eT0nMC4xJyBmaWxsPScjZmZmZmZmJyB0cmFuc2Zvcm09J3JvdGF0ZSgyMjApJy8+CgkJPHJlY3Qgd2lkdGg9JzIwMDAlJyBoZWlnaHQ9JzIwMDAlJyBmaWxsLW9wYWNpdHk9JzAuMScgZmlsbD0nI2ZmZmZmZicgdHJhbnNmb3JtPSdyb3RhdGUoMjQwKScvPgoJCTxyZWN0IHdpZHRoPScyMDAwJScgaGVpZ2h0PScyMDAwJScgZmlsbC1vcGFjaXR5PScwLjEnIGZpbGw9JyNmZmZmZmYnIHRyYW5zZm9ybT0ncm90YXRlKDI2MCknLz4KCQk8cmVjdCB3aWR0aD0nMjAwMCUnIGhlaWdodD0nMjAwMCUnIGZpbGwtb3BhY2l0eT0nMC4xJyBmaWxsPScjZmZmZmZmJyB0cmFuc2Zvcm09J3JvdGF0ZSgyODApJy8+CgkJPHJlY3Qgd2lkdGg9JzIwMDAlJyBoZWlnaHQ9JzIwMDAlJyBmaWxsLW9wYWNpdHk9JzAuMScgZmlsbD0nI2ZmZmZmZicgdHJhbnNmb3JtPSdyb3RhdGUoMzAwKScvPgoJCTxyZWN0IHdpZHRoPScyMDAwJScgaGVpZ2h0PScyMDAwJScgZmlsbC1vcGFjaXR5PScwLjEnIGZpbGw9JyNmZmZmZmYnIHRyYW5zZm9ybT0ncm90YXRlKDMyMCknLz4KCQk8cmVjdCB3aWR0aD0nMjAwMCUnIGhlaWdodD0nMjAwMCUnIGZpbGwtb3BhY2l0eT0nMC4xJyBmaWxsPScjZmZmZmZmJyB0cmFuc2Zvcm09J3JvdGF0ZSgzNDApJy8+CgkJPHJlY3Qgd2lkdGg9JzIwMDAlJyBoZWlnaHQ9JzIwMDAlJyBmaWxsLW9wYWNpdHk9JzAuMScgZmlsbD0nI2ZmZmZmZicgdHJhbnNmb3JtPSdyb3RhdGUoMzYwKScvPgoJPC9zdmc+Cjwvc3ZnPg==")',
		'header_background'      => '',
		'header_background_color'      => '#FFFFFF',
		'footer_background_color'      => '#0791b3',
		'header_image' => get_template_directory_uri().'/images/logo.png',
	);
	apply_filters( 'marla_default_settings', $defaults ); 	if($setting) return $defaults[$setting];
	else return $defaults;
}

add_action( 'after_setup_theme', 'marla_default_settings' ); ?>