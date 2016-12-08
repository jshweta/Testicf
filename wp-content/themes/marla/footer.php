<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package marla
 */
?>
	</div> <?php if( get_theme_mod( 'marla_right_sidebar' ) != marla_default_settings('marla_right_sidebar') ) { if (is_single()) {get_sidebar('optional');} }?></div><!-- #wrapper -->
	<footer id="colophon" class="site-footer" role="contentinfo">
    <?php if( get_theme_mod( 'social_footer' ) == marla_default_settings('social_footer') ) {
?> <ul class="icons clear">
     
     <?php if( get_theme_mod( 'marla_social1' ) != marla_default_settings('marla_social1') ) {
?><li class="twitter"><a href="http://www.twitter.com/<?php echo get_theme_mod( 'marla_social1', marla_default_settings('marla_social1') ) ?>"></a></li>
					
	  <?php } if( get_theme_mod( 'marla_social2' ) != marla_default_settings('marla_social2') ) {
?><li class="facebook"><a href="http://www.facebook.com/<?php echo get_theme_mod( 'marla_social2', marla_default_settings('marla_social2') ) ?>"></a></li>
<?php } if( get_theme_mod( 'marla_social3' ) != marla_default_settings('marla_social3') ) {
?><li class="google"><a href="<?php echo get_theme_mod( 'marla_social3', marla_default_settings('marla_social3') ) ?>?rel=author"></a></li>
<?php } if( get_theme_mod( 'marla_social4' ) != marla_default_settings('marla_social4') ) {
?><li class="rss"><a href="http://feeds.feedburner.com/<?php echo get_theme_mod( 'marla_social4', marla_default_settings('marla_social4') ) ?>"></a></li>
<?php } if( get_theme_mod( 'marla_rss_url' ) != marla_default_settings('marla_rss_url') ) {
?><li class="rss"><a href="<?php echo get_theme_mod( 'marla_rss_url', marla_default_settings('marla_rss_url') ) ?>"></a></li>
<?php } if( get_theme_mod( 'marla_default_RSS_URL' ) != marla_default_settings('marla_default_RSS_URL') ) {
?><li class="rss"><a href="<?php echo get_bloginfo('rss2_url'); ?>"></a></li>
<?php } if( get_theme_mod( 'marla_social_pinterest' ) != marla_default_settings('marla_social_pinterest') ) {
?><li class="pinterest"><a href="http://pinterest.com/<?php echo get_theme_mod( 'marla_social_pinterest', marla_default_settings('marla_social_pinterest') ) ?>"></a></li>
<?php } if( get_theme_mod( 'marla_social_instagram' ) != marla_default_settings('marla_social_instagram') ) {
?><li class="instagram"><a href="http://instagram.com/<?php echo get_theme_mod( 'marla_social_instagram', marla_default_settings('marla_social_instagram') ) ?>"></a></li>
<?php } if( get_theme_mod( 'marla_social_youtube' ) != marla_default_settings('marla_social_youtube') ) {
?><li class="youtube"><a href="http://youtube.com/<?php echo get_theme_mod( 'marla_social_youtube', marla_default_settings('marla_social_youtube') ) ?>"></a></li>
<?php } if( get_theme_mod( 'marla_social_linkedin' ) != marla_default_settings('marla_social_linkedin') ) {
?><li class="linkedin"><a href="<?php echo get_theme_mod( 'marla_social_linkedin', marla_default_settings('marla_social_linkedin') ) ?>"></a></li>
<?php } if( get_theme_mod( 'marla_social_vimeo' ) != marla_default_settings('marla_social_vimeo') ) {
?><li class="vimeo"><a href="http://vimeo.com/<?php echo get_theme_mod( 'marla_social_vimeo', marla_default_settings('marla_social_vimeo') ) ?>"></a></li>
<?php } if( get_theme_mod( 'marla_social_email' ) != marla_default_settings('marla_social_email') ) {
?><li class="email"><a href="mailto:<?php echo get_theme_mod( 'marla_social_email', marla_default_settings('marla_social_email') ) ?>"></a></li>
<?php } ?>
</ul><?php }?>
    
		<div class="site-info clear"><?php echo get_theme_mod( 'footer_text', marla_default_settings('footer_text') ) ?>
			<?php do_action( 'marla_credits' ); ?>
			<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'marla' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'marla' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Marla WP Theme by %1$s.', 'marla' ), '<a href="http://ceslava.com" rel="designer">ceslava</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
<!-- #page -->
<?php wp_footer(); ?>
</body>
</html>