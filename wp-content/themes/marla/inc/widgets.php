<?php
/**
 * Register widgetized area and update sidebar with default widgets
 */
function marla_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Home', 'marla' ),
		'id'            => 'sidebar-home',
		'before_widget' => '<div class="anuncioshome"><aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside></div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Single Post After Content', 'marla' ),
		'id'            => 'sidebar-after-content',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Single Post Before Content', 'marla' ),
		'id'            => 'sidebar-before-content',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Right sidebar Single Posts (need activation)', 'marla' ),
		'id'            => 'sidebar-right-single',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'marla_widgets_init' );
?>