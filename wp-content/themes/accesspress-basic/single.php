<?php
/**
 * The template for displaying all single posts.
 *
 * @package Accesspress Basic
 */
 
 global $apbasic_options;
 $apbasic_settings = get_option('apbasic_options',$apbasic_options);
 if ( is_array( $apbasic_settings ) && ! empty( $apbasic_settings )) {
    extract($apbasic_settings);
}

get_header(); ?>
<?php
    $single_post_layout = get_post_meta($post->ID,'apbasic_page_layout', true);
    $default_post_layout = ($single_post_layout == 'default_layout') ? $default_post_layout : $single_post_layout;
    
    // Dynamically Generating Classes for #primary on the basis of page layout
    $content_class = '';
    switch($default_post_layout){
        case 'left_sidebar':
            $content_class = 'left-sidebar';
            break;
        case 'right_sidebar':
            $content_class = 'right-sidebar';
            break;
        case 'both_sidebar':
            $content_class = 'both-sidebar';
            break;
        case 'no_sidebar_wide':
            $content_class = 'no-sidebar-wide';
            break;
        case 'no_sidebar_narrow':
            $content_class = 'no-sidebar-narraow';
            break;
    }
?>	
<?php while ( have_posts() ) : the_post(); ?>
	<main id="main" class="site-main <?php echo $content_class; ?>" role="main">
        <div class="ap-container">
            <?php if($default_post_layout == 'both_sidebar') : ?>
                <div id="primary-wrap" class="clearfix">
            <?php endif; ?>
                <div id="primary" class="content-area">
            
            			<?php get_template_part( 'content', 'single' ); ?>
            
            			<?php //the_post_navigation(); ?>
            
                        <?php if($enable_comments_post == 1) : ?>
            			<?php
            				// If comments are open or we have at least one comment, load up the comment template
            				if ( comments_open() || get_comments_number() ) :
            					comments_template();
            				endif;
            			?>
                        <?php endif; ?>
            
                </div><!-- #primary -->
                <?php if($default_post_layout == 'left_sidebar' || $default_post_layout == 'both_sidebar') : ?>
                    <?php get_sidebar('left'); ?>
                <?php endif; ?>
            <?php if($default_post_layout == 'both_sidebar') : ?>
                </div> <!-- #primary-wrap -->
            <?php endif; ?>
            
            <?php if($default_post_layout == 'right_sidebar' || $default_post_layout == 'both_sidebar') : ?>
                <?php get_sidebar('right'); ?>
            <?php endif; ?>
        </div><!-- ap-container -->
	</main><!-- #main -->
<?php endwhile; // end of the loop. ?>    
<?php get_footer(); ?>
