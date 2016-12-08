<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Accesspress Basic
 */
 
 global $apbasic_options;
 $apbasic_settings = get_option('apbasic_options',$apbasic_options);
 $default_layout = $apbasic_settings['default_layout'];
 
 $blog_display_type = $apbasic_settings['blog_post_display_type'];
 
 $blog_display_class = '';
 switch($blog_display_type){
    case 'blog_image_large' :
        $blog_display_class = 'blog-image-large';       
        break;
    case 'blog_image_medium' :
        $blog_display_class = 'blog-image-medium';       
        break;
    case 'blog_image_alternate_medium' :
        $blog_display_class = 'blog-image-alternate-medium';       
        break;
    case 'blog_full_content' :
        $blog_display_class = 'blog-full-content';       
        break;
 }
 
 // Dynamically Generating Classes for #primary on the basis of page layout
 $content_class = '';
    switch($default_layout){
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
 
get_header(); ?>
<?php if ( have_posts() ) : ?>
	<header class="page-header">
		<div class="ap-container">
           <!-- <?php
    			the_archive_title( '<h1 class="page-title">', '</h1>' );
    			the_archive_description( '<div class="taxonomy-description">', '</div>' );
    		?>-->
        </div>
	</header><!-- .page-header -->
<?php endif; ?>
	<main id="main" class="site-main <?php echo $content_class.' '.$blog_display_class; ?>" role="main">
        <div class="ap-container">
        <?php if($default_layout == 'both_sidebar') : ?>
            <div id="primary-wrap" class="clearfix">
        <?php endif; ?>
            <div id="primary" class="content-area">
        
        			<?php /* Start the Loop */ ?>
        			<?php while ( have_posts() ) : the_post(); ?>
        
        				<?php
        					/* Include the Post-Format-specific template for the content.
        					 * If you want to override this in a child theme, then include a file
        					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
        					 */
        					get_template_part( 'content', get_post_format() );
        				?>
        
        			<?php endwhile; ?>
        
        			<?php //the_posts_navigation(); ?>
        
        		<?php if ( !have_posts() ) : ?>
        
        			<?php get_template_part( 'content', 'none' ); ?>
        
        		<?php endif; ?>
            </div><!-- #primary -->
            <?php if($default_layout == 'left_sidebar' || $default_layout == 'both_sidebar') : ?>
                <?php get_sidebar('left'); ?>
            <?php endif; ?>
        <?php if($default_layout == 'both_sidebar') : ?>
            </div>
        <?php endif; ?>
        <?php if($default_layout == 'right_sidebar' || $default_layout == 'both_sidebar') : ?>
            <?php get_sidebar('right'); ?>
        <?php endif; ?>
        </div>
	</main><!-- #main -->
<?php get_footer(); ?>
