<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Accesspress Basic
 */

global $apbasic_options;
$apbasic_settings = get_option('apbasic_options', $apbasic_options);
if ( is_array( $apbasic_settings ) && ! empty( $apbasic_settings )) {
    extract($apbasic_settings);
}
get_header(); ?>

<?php 
    $single_default_page_layout = get_post_meta( $post->ID, 'apbasic_page_layout', true);
    $default_page_layout = ($single_default_page_layout == 'default_layout') ? $default_page_layout : $single_default_page_layout;
    
    // Dynamically Generating Classes for #primary on the basis of page layout
    $content_class = '';
    switch($default_page_layout){
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
        <?php if($default_page_layout == 'both_sidebar') : ?>
            <div id="primary-wrap" class="clearfix">
        <?php endif; ?> 
        
            <div id="primary" class="content-area">
                
				<?php get_template_part( 'content', 'page' ); ?>
                
                <?php if($enable_comments_page == 1) : ?>
				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>
                <?php endif; ?>
                
            </div><!-- #primary -->
            
            <?php if($default_page_layout == 'left_sidebar' || $default_page_layout == 'both_sidebar') : ?>
                <?php get_sidebar('left'); ?>
            <?php endif; ?>
            
        <?php if($default_page_layout == 'both_sidebar') : ?>
            </div> <!-- #primary-wrap -->
        <?php endif; ?>
        
        <?php if($default_page_layout == 'right_sidebar' || $default_page_layout == 'both_sidebar') : ?>
            <?php get_sidebar('right'); ?>
        <?php endif; ?>
    </div>
	</main><!-- #main -->
<?php endwhile; // end of the loop. ?>  	
<?php get_footer(); ?>
