<?php
/**
 * The template for displaying VIDEOS pages.
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
                                    <a href="/archives/">Archives</a>
                                </li>
                                <li>
                                    <a href="/videos/" style="color: grey;">Videos</a>
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
<!-- Internal Resource Video Page Starts -->
        <h2 class="videos-head">VIDEOS</h2><div class="rline-videos"> <div class="rline"><hr></div> </div>

                    	 <?php query_posts('cat=1071&showposts=1'); while (have_posts()) : the_post(); ?>
                                   
                         <p class="videopage-main"><?php the_field('custom-video', get_option('page_for_posts')); ?> <h4 class="videopage-title"> <?php the_title(); ?> </h4></p> 
                         <?php endwhile; ?>

                         <?php wp_reset_query(); ?>




	<ul class="nav-video">
		<!-- <li><a>OUR VIDEOS</a></li>  -->
		<li><a href="/videos/">ALL VIDEOS</a></li>
		<li><a href="/culture/">culture</a></li>
		<li><a href="/interviews/">interviews</a></li>
		<li><a href="/lectures/">lectures</a></li>
		<li><a href="/seminar/">seminar</a></li>
		<li><a href="/testimonies/">testimonies</a></li>
	</ul>

                           <ul class="youtube-video-gallery" style="padding-top:50px;">
                                        <?php
                                                $num_cols = 2; // set the number of columns here
                                                //the query section is only neccessary if the code is used in a page template//
                                                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // for pagination
                                                $args = array(
                                                  'posts_per_page' => -1, // optional to overwrite the dashboard setting
                                                  'cat' => 1071, // add any other query parameter to this array
                                                  'paged' => $paged,
						  'offset' => 1
                                                );
                                                query_posts($args);
                                                //end of query section
                                                if (have_posts()) :
                                                      for ( $i=1 ; $i <= $num_cols; $i++ ) :
                                                            echo '<div id="col-'.$i.'" class="resourcepage-col">';
                                                            $counter = $num_cols + 1 - $i;
                                                            while (have_posts()) : the_post();
                                                                  if( $counter%$num_cols == 0 ) : ?>
             <li> <?php if(get_post_meta($post->ID, "custom-video", true)): { ?> 

           		 <?php $field_name="custom-video"; $field_value = get_post_meta($post->ID, $field_name, true); ?> <a href="<?php echo $field_value; ?>"> 
		<?php
		$url = $field_value;
		parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
		?> 


	<?php ; } endif ?> <h4 class="resourcepage-title"> <?php the_title(); ?></h4> </a> <li> 
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

<!-- Internal Resource Video Page Ends -->


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
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/custom-css/youtube-video-gallery.css" type="text/css"/>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/custom-css/jquery.fancybox.css" type="text/css" media="screen" />
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/custom-js/jquery.fancybox.pack.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/custom-js/jquery.fancybox-media.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/custom-js/jquery.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/custom-js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/custom-js/jquery.youtubevideogallery.js"></script>

    <script>
        $(document).ready(function(){
            $("ul.youtube-video-gallery").youtubeVideoGallery({assetFolder:'<?php bloginfo('template_url'); ?>/js/custom-js'});
        });
    </script>


