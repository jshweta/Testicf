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
            
                <!--*************************************************************************  
                    *******************************Custom Edit Starts ************************  
                    ************************************************************************* -->




<!--------------------------Navigation Starts ----------------->

<!-- Navigation -->
                <nav class="navbar" role="navigation">
                    <div class="container">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                             
                                <h2 class="nav-resource"><a href="/resource/">RESOURCES</a></h2>
                            </a>
                        </div>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li>
                                    <a href="/books/">Books</a>
                                </li>
                                <li>
                                    <a href="/reports-2/" style="color: grey;">Reports</a>
                                </li>
                                <li>
                                    <a href="/archives/">Archives</a>
                                </li>
                                <li>
                                    <a href="/videos/">Videos</a>
                                </li>
                                <li>
                                    <a href="/gallery/">Gallery</a>
                                </li>

                            </ul>
                        </div>
                        <!-- /.navbar-collapse -->
                    </div>
                    <!-- /.container -->
                </nav>

                <!-- Page Content -->
                <div class="nav-div">
                    <div class="row">
			<hr>
                    </div>
                </div>
                <!-- /.container -->

<!----------------------- Navigation Ends ----------------------------->
<!-- Internal Resource Books Page Starts -->
                          <h2 class="books-head">REPORTS</h2><div class="rline-book"> <div class="rline"><hr></div> </div>


                <div class="row">
                    <div class="col-sm-9">
                        <div class="books-inner-main"> 
                                <ul class="book-main">
                                   <li><h4 class="book-main-title"><?php the_title(); ?> </h4> 
                                      <?php if( get_field('book-main-author') ): ?>
					 <p class="book-main-author"><?php the_field('author_name', get_option('page_for_posts')); ?> </p> 
					<?php endif; ?>

				
		<!-- Custom Image Field -->

					<?php 

					$image = get_field('image');

					if( !empty($image) ): ?>
					        <img src="<?php echo $image['url']; ?>">
					        <p class="custom-image-caption"><?php echo $image['caption']; ?><p>

					<?php endif; ?>


		<!-- Custom Image Field -->


                                       <p> <?php  the_content() ?> </p> 

					
					<div class="video-container">  
				<?php if( get_field('custom-video') ): ?>
					 <?php the_field('custom-video'); ?>    
					<?php endif; ?>
					</div>


					<?php if( get_field('download_pdf') ): ?>
                      			<p><iframe height="480" src="<?php the_field('download_pdf', get_option('page_for_posts')); ?>" width="640"></iframe></p>
					<?php endif; ?>


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

                    <div class="col-sm-3">

                        <div class="books-sidebar"> 
				<ul class="book-sidebar">
				    <?php query_posts('cat=864&showposts=3'); while (have_posts()) : the_post(); ?>
                                  
                                       <li> 
					       <a href='<?php the_permalink() ?>'><?php the_post_thumbnail('');?></a>
				    	       <h4 class="book-sidebar-title"> <a href='<?php the_permalink() ?>'> <?php the_title(); ?></a> </h4> 
					       <p class="book-sidebar-author"><?php the_field('author_name', get_option('page_for_posts')); ?></p>
					   <?php if( get_field('excerpt_custom') ): ?>
   					       <p class="book-sidebar-excerpt"><?php the_field('excerpt_custom', get_option('page_for_posts')); ?></p>
				           <?php endif; ?>
                                       </li>
                                    
                                    <?php endwhile; ?>

                                    <?php wp_reset_query(); ?>
                                </ul>
                        </div>
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


<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/custom-css/bootstrap.min.css" type="text/css" media="screen" />
<script src="<?php bloginfo('template_url'); ?>/js/custom-js/jquery.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/custom-js/bootstrap.min.js"></script>

