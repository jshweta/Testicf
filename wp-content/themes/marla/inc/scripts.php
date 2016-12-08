<?php 
/**
 * Enqueue scripts and styles
 */
function marla_scripts() {
	wp_enqueue_style( 'marla-style', get_stylesheet_uri() );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
 if (is_home() || is_archive() || is_search()) {	 
	 
	 
	 wp_enqueue_script( 'marla-infinite-scroll', get_template_directory_uri() . '/js/jquery.infinitescroll.min.js', array( 'jquery' ) );
	 
	 wp_deregister_script('jquery-masonry');
    wp_enqueue_script('marla-imagesLoaded', get_template_directory_uri().'/js/imagesloaded.js', false, null, true);
    wp_enqueue_script('jquery-masonry', get_template_directory_uri().'/js/float.js', array( 'marla-imagesLoaded'), null, true );
	
	 wp_enqueue_script( 'marla-custom-float', get_template_directory_uri() . '/js/custom-float.js', array( 'jquery' )  ); }
     
	 wp_enqueue_script( 'marla-custom', get_template_directory_uri() . '/js/custom.js', array( 'jquery' )  );
	 
	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'marla-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'marla_scripts' ); 
add_action('wp_footer', 'marla_wp_footer');
function marla_wp_footer() { ?>
<script type="text/javascript">
	  window.___gcfg = {lang: 'en'};
	
	  (function() {
	    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
	    po.src = 'http://connect.facebook.net/<?php marla_fb_language(); ?>/all.js#xfbml=1';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
	  })();
	</script>
<script type="text/javascript">
	  window.___gcfg = {lang: 'en'};
	
	  (function() {
	    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
	    po.src = 'http://platform.twitter.com/widgets.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
	  })();
	</script>
<script type="text/javascript">
	  window.___gcfg = {lang: 'en'};
	
	  (function() {
	    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
	    po.src = 'https://apis.google.com/js/plusone.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
	  })();
	</script>
<?php if( get_theme_mod( 'pinterest_button' ) == marla_default_settings('pinterest_button') ) {
?><script type="text/javascript">
(function(d){
    var f = d.getElementsByTagName('SCRIPT')[0], p = d.createElement('SCRIPT');
    p.type = 'text/javascript';
    p.async = true;
    p.src = '//assets.pinterest.com/js/pinit.js';
    f.parentNode.insertBefore(p, f);
	p.setAttribute('data-pin-hover', true);
}(document));
</script>
<?php }} ?>