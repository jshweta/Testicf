<?php
/**
 * The template for displaying all In Focus posts.
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
            
                <!--*************************************************************************  
                    *******************************Custom Edit Starts ************************  
                    ************************************************************************* -->

<!-- Internal Resource Books Page Starts -->


                <div class="row">
                   
                        <div class="feature-inner-main"> 
                                <ul class="feature-main">
                                   <li><h4 class="feature-main-title"><?php the_title(); ?> </h4> 
                                       
					<?php if( get_field('author_name') ): ?>
					<p class="feature-main-author"><?php the_field('author_name', get_option('page_for_posts')); ?> </p> 
					<?php endif; ?>

					<?php if( get_field('sub_title') ): ?>
					<p class="feature-main-subtitle"><?php the_field('sub_title', get_option('page_for_posts')); ?> </p> 
					<?php endif; ?>
					
	         <!-- Custom Image Field -->

					<?php 

					$image = get_field('image');

					if( !empty($image) ): ?>
					        <img src="<?php echo $image['url']; ?>">
					        <p class="custom-image-caption"><?php echo $image['caption']; ?><p>

					<?php endif; ?>


		<!-- Custom Image Field -->

                                         <div class="feature-main-content"> <?php  the_content() ?> </div>
					
					<div class="video-container">  
				<?php if( get_field('custom-video') ): ?>
					 <?php the_field('custom-video'); ?>    
					<?php endif; ?>
					</div>
<div class="pdf-container">					
<?php if( get_field('download_pdf') ): ?>
                      			<p><iframe height="480" src="<?php the_field('download_pdf', get_option('page_for_posts')); ?>" width="640"></iframe></p>
					<?php endif; ?>
</div>


					<?php if( get_field('author_bio') ): ?>
					<p class="feature-main-authorbio"><?php the_field('author_bio', get_option('page_for_posts')); ?> </p>
					<?php endif; ?>

 					<?php if( get_field('acknowledgements') ): ?>
					<p class="feature-main-acknowledgements"><?php the_field('acknowledgements', get_option('page_for_posts')); ?> </p> 
					<?php endif; ?>

					<?php if( get_field('notes') ): ?>
					<p class="feature-main-notes"><?php the_field('notes', get_option('page_for_posts')); ?> </p> 
					<?php endif; ?>

					<?php if( get_field('copyright') ): ?>
					<p class="feature-main-copyright"><?php the_field('copyright', get_option('page_for_posts')); ?> </p> 
					<?php endif; ?>

<p class="disclaimer">
	<span style="color:#800000;"><strong><a href="contribute-to-icf" target="_blank"><span style="color:#0033cc;">Donate </a>to the Indian Writers' Forum, a public trust that belongs to all of us.</strong></span>
</p>		

 				   </li> 
                        
                                    <?php wp_reset_query(); ?>
                                </ul>
                       
                    </div>

                  
                </div>



                <!--*************************************************************************  
                    *******************************Custom Edit Ends ************************  
                    ************************************************************************* -->
            
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

<div class="social-icons--fixed">
<div class="share-icons">
        



    <a class="facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink() ?>" target="_blank" rel="noopener noreferrer">
        <img src="/wp-content/uploads/2016/08/facebook.png">
    </a>
    <a class="twitter" href="https://www.twitter.com/home?status=<?php the_title(); ?>+<?php the_permalink() ?>" target="_blank" rel="noopener noreferrer">
        <img src="/wp-content/uploads/2016/08/twitter.png">
    </a>
    <a class="mail" href="mailto:?subject=<?php the_title(); ?>&body=Indian Cultural Forum - <?php the_permalink() ?>" >
        <img src="/wp-content/uploads/2016/08/mail.png">
    </a>
</div>
</div>    
<?php get_footer(); ?>


<!--<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/custom-css/bootstrap.min.css" type="text/css" media="screen" />-->
<script src="<?php bloginfo('template_url'); ?>/js/custom-js/jquery.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/custom-js/bootstrap.min.js"></script>
