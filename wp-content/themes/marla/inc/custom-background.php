<?php function marla_register_custom_background() {
	$args = array(
		'default-color' => 'ffffff',
		'default-image' => get_theme_mod( 'bg_styles', marla_default_settings('bg_styles')  ),
	);
	$args = apply_filters( 'marla_custom_background_args', $args );
add_theme_support('custom-background', $args['wp-head-callback'], $args['admin-head-callback'], $args['admin-preview-callback'] );
	
}
add_action( 'after_setup_theme', 'marla_register_custom_background' ); ?>