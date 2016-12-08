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

                         <?php query_posts('cat=1201&showposts=1'); while (have_posts()) : the_post(); ?>
                                   
                                                        <?php if(get_post_meta($post->ID, "custom-video", true)): { ?> 

                                                      <?php $field_name="custom-video"; $field_value = get_post_meta($post->ID, $field_name, true); ?> 
                                        
                                                            <?php
                                                                $url = $field_value;
                                                                if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $url, $id)) {
                                                                      $values = $id[1];
                                                                    } else if (preg_match('/youtube\.com\/embed\/([^\&\?\/]+)/', $url, $id)) {
                                                                      $values = $id[1];
                                                                    } else if (preg_match('/youtube\.com\/v\/([^\&\?\/]+)/', $url, $id)) {
                                                                      $values = $id[1];
                                                                    } else if (preg_match('/youtu\.be\/([^\&\?\/]+)/', $url, $id)) {
                                                                      $values = $id[1];
                                                                    }
                                                                    else if (preg_match('/youtube\.com\/verify_age\?next_url=\/watch%3Fv%3D([^\&\?\/]+)/', $url, $id)) {
                                                                        $values = $id[1];
                                                                    } else {   
                                                                    // not an youtube video
                                                                    }
                                                            ?> 

                                                    <?php ; } endif ?> 

                                                     

                                        <div class="videopage-main">    
                                            <iframe src="http://www.youtube.com/embed/<?php echo $values; ?>" frameborder="0" allowfullscreen></iframe>
                                             <h4 id="videopage-title" class="videopage-title"> <?php the_title(); ?> </h4>
                                             <h4 id="videopage-description" class="videopage-description"> <?php the_field('Excerpt', get_option('page_for_posts')); ?> </h4>
                                        </div>
                                        <!-- Getting String From the Source -- Title -->
                                        <div class="videopage-main1 hide" id="videopage-main1">    
                                            <iframe src="h" frameborder="0" allowfullscreen></iframe>
                                        </div>
                                        <div class="videopage-description1 hide" id="videopage-description1">    
                                            <iframe src="h" frameborder="0" allowfullscreen></iframe>
                                        </div>
                                        <!-- Getting String From the Source -- Title -->


                         
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



                                <ul>


                                        <?php
                                                $num_cols = 2; // set the number of columns here
                                                //the query section is only neccessary if the code is used in a page template//
                                                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // for pagination
                                                $args = array(
                                                  'posts_per_page' => -1, // optional to overwrite the dashboard setting
                                                  'cat' => 1201, // add any other query parameter to this array
                                                  'paged' => $paged
                                                );
                                                query_posts($args);
                                                //end of query section
                                                if (have_posts()) :
                                                      for ( $i=1 ; $i <= $num_cols; $i++ ) :
                                                            echo '<div id="col-'.$i.'" class="video-col">';
                                                            $counter = $num_cols + 1 - $i;
                                                            while (have_posts()) : the_post();
                                                                  if( $counter%$num_cols == 0 ) : ?>
                                                                    
                                                    <li> 
                                                        <?php if(get_post_meta($post->ID, "custom-video", true)): { ?> 

                                                      <?php $field_name="custom-video"; $field_value = get_post_meta($post->ID, $field_name, true); ?> 
                                        
                                                            <?php
                                                                $url = $field_value;
                                                                if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $url, $id)) {
                                                                      $values = $id[1];
                                                                    } else if (preg_match('/youtube\.com\/embed\/([^\&\?\/]+)/', $url, $id)) {
                                                                      $values = $id[1];
                                                                    } else if (preg_match('/youtube\.com\/v\/([^\&\?\/]+)/', $url, $id)) {
                                                                      $values = $id[1];
                                                                    } else if (preg_match('/youtu\.be\/([^\&\?\/]+)/', $url, $id)) {
                                                                      $values = $id[1];
                                                                    }
                                                                    else if (preg_match('/youtube\.com\/verify_age\?next_url=\/watch%3Fv%3D([^\&\?\/]+)/', $url, $id)) {
                                                                        $values = $id[1];
                                                                    } else {   
                                                                    // not an youtube video
                                                                    }
                                                            ?> 

                                                    <?php ; } endif ?> 
                                                                                                      
                                                    <a href="http://www.youtube.com/embed/<?php echo $values; ?>?autoplay=1" class="video-grid">
						   <div style="position: relative; left: 0; top: 0;"> 
							 <img src="http://img.youtube.com/vi/<?php echo $values; ?>/0.jpg" id="video-thumb" class="video-thumb" alt1="<?php the_field('Excerpt', get_option('page_for_posts')); ?>" alt="<?php the_title(); ?>"/>
                                                         <img src="<?php bloginfo('template_url'); ?>/js/custom-js/play-button-red@40.png" class="video-icon"/> </a>
                                                   </div> 
                                                    <h4 id="video-col-title" class="video-col-title"> <?php the_title(); ?> </h4>
 

                                                    
                                                    <li>


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
<script src="<?php bloginfo('template_url'); ?>/js/custom-js/jquery.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/custom-js/bootstrap.min.js"></script>

<script type="text/javascript">

$(".video-grid").on("click", function(event) {
  event.preventDefault();
  $(".videopage-main iframe").prop("src", $(event.currentTarget).attr("href"));

});
</script>


<script type="text/javascript">
$(".video-thumb").click(function() {
    $('html, body').animate({
        scrollTop: $(".videopage-main").offset().top
    }, 2000);
});
</script>

<script type="text/javascript">

  $(".video-thumb").on("click", function(event){
    event.preventDefault();
     // $('#videopage-title').html($('#video-col-title').html());
     // $('h4.videopage-title').html($('h4.video-col-title'));
     $(".videopage-main1 iframe").prop("src", $(event.currentTarget).attr("alt"));
     $('#videopage-title').text($('.videopage-main1 iframe').attr("src"));
  });
   
</script>

<script type="text/javascript">

  $(".video-thumb").on("click", function(event){
    event.preventDefault();
     // $('#videopage-title').html($('#video-col-title').html());
     // $('h4.videopage-title').html($('h4.video-col-title'));
     $(".videopage-description1 iframe").prop("src", $(event.currentTarget).attr("alt1"));
     $('#videopage-description').text($('.videopage-description1 iframe').attr("src"));
  });
   
</script>
