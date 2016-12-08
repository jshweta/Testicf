<?php

/********************************************************************/
/***************Internal Resource Archives page*********************/
/********************************************************************/

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
                
					
                <!--*************************************************************************  
                    *******************************Custom Edit Starts ************************  
                    ************************************************************************* -->
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
                                    <a href="/reports-2/">Reports</a>
                                </li>
                                <li>
                                    <a href="/archives/" style="color: grey;">Archives</a>
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

<!-- Internal Resource Archives Page Starts -->
                            <h2 class="archives-head">ARCHIVES</h2><div class="rline-archives"> <div class="rline"><hr></div> </div>
                                <ul>

                                        <?php
                                                $num_cols = 3; // set the number of columns here
                                                //the query section is only neccessary if the code is used in a page template//
                                                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // for pagination
                                                $args = array(
                                                  'posts_per_page' => -1, // optional to overwrite the dashboard setting
                                                  'cat' => 865, // add any other query parameter to this array
                                                  'paged' => $paged
                                                );
                                                query_posts($args);
                                                //end of query section
                                                if (have_posts()) :
                                                      for ( $i=1 ; $i <= $num_cols; $i++ ) :
                                                            echo '<div id="col-'.$i.'" class="resourcepage-col">';
                                                            $counter = $num_cols + 1 - $i;
                                                            while (have_posts()) : the_post();
                                                                  if( $counter%$num_cols == 0 ) : ?>
                                                                       <li><p><a href='<?php the_permalink() ?>'><?php the_post_thumbnail('');?></a></p> <h4 class="resourcepage-title"> <a href='<?php the_permalink() ?>'> <?php the_title(); ?></a> </h4> <p class="resourcepage-author"> <?php the_field('author_name', get_option('page_for_posts')); ?> </p> <p class="resourcepage-excerpt">  <?php the_field('Excerpt', get_option('page_for_posts')); ?> </p> </li>

                                                                  <?php endif;
                                                                  $counter++;
                                                            endwhile;
                                                            rewind_posts();
                                                            echo '</div>'; //closes the column div
                                                      endfor;

                                                endif;
                                                wp_reset_query();
                                        ?>
                                </ul>

<!-- Internal Resource Archives Page Ends -->



                <!--*************************************************************************  
                    *******************************Custom Edit Starts ************************  
                    ************************************************************************* -->
                
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

<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/custom-css/bootstrap.min.css" type="text/css" media="screen" />
<script src="<?php bloginfo('template_url'); ?>/js/custom-js/jquery.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/custom-js/bootstrap.min.js"></script>
