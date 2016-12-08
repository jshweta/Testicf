<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Accesspress Basic
 */
 
 global $apbasic_options;
 $apbasic_settings = get_option('apbasic_options',$apbasic_options);
 $show_footer_featured_section = $apbasic_settings['show_footer_featured_section'];
?>

	</div><!-- #content -->
	<footer id="colophon" class="site-footer" role="contentinfo">
        <?php if($show_footer_featured_section == 1) : ?>
            <div class="footer-featured-section">
                <div class="ap-container clearfix">
                    <div class="featured-footer-wrap">
                        <?php if(is_active_sidebar('apbasic_footer_one')) : ?>
                            <div class="featured-footer-1 featured-footer">
                                <?php dynamic_sidebar('apbasic_footer_one'); ?>
                            </div>
                        <?php endif; ?>
                        <?php if(is_active_sidebar('apbasic_footer_two')) : ?>
                            <div class="featured-footer-2 featured-footer">
                                <?php dynamic_sidebar('apbasic_footer_two'); ?>
                            </div>
                        <?php endif; ?>
                        <?php if(is_active_sidebar('apbasic_footer_three')) : ?>
                            <div class="featured-footer-3 featured-footer">
                                <?php dynamic_sidebar('apbasic_footer_three'); ?>
                            </div>
                        <?php endif; ?>
                        <?php if(is_active_sidebar('apbasic_footer_four')) : ?>
                            <div class="featured-footer-4 featured-footer">
                                <?php dynamic_sidebar('apbasic_footer_four'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>  
        <?php endif; ?>
        
		<div class="site-info">
            <div class="ap-container clearfix">
                <div class="copyright-info">
                    Copyright &copy; 2016 <a href="<?php get_home_url(); ?>">
                        <?php 
                        if(!empty($apbasic_settings['footer_text'])){
                            echo esc_attr__($apbasic_settings['footer_text']);                              
                        }else{
                            echo bloginfo('name');
                        }
                        ?>
                    </a>
                    <span class="sep"> | </span>
                     <a target="_self" href="<?php echo esc_url( __( 'http://indianculturalforum.in/tnc/', 'accesspress-basic' ) ); ?>"><?php printf( __( 'Copyright, Terms & Conditions', 'accesspres-basic' ), 'WordPress' ); ?></a>
<span class="sep"> | </span> 
<a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/"><img alt="Creative Commons License" style="border-width:0" src="https://i.creativecommons.org/l/by-nc-nd/4.0/88x31.png" /></a>&nbsp;&nbsp;This work is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/">Creative Commons Attribution-NonCommercial-NoDerivatives 4.0 International License</a>        	
<!--		<span class="sep"> | </span></a>
                        <?php _e( '', 'accesspress-basic' ); ?><a href="<?php esc_url(' http://indianculturalforum.in/tnc/'); ?>" target="_blank" rel="designer">Copyright, Terms & Conditions</a>-->
                </div>
                <?php if(is_active_sidebar('apbasic_footer_social_links')) : ?>
                <div class="footer-socials">
                    <?php dynamic_sidebar('apbasic_footer_social_links'); ?>
                </div>
                <?php endif; ?>    
            </div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->
<div id="go-top"><a href="#page"><i class="fa fa-caret-up"></i></a></div>
<?php wp_footer(); ?>
</body>
</html>