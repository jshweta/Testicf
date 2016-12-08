<?php
/**
 * The template for displaying all pages.
 * Template Name: Home Page
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Accesspress Basic
 */

get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
            
			<?php if(is_active_sidebar('apbasic_featured_section')) : ?>
                <div id="featured-post-container" class="clearfix">
                    <?php dynamic_sidebar('apbasic_featured_section'); ?>
                </div>
            <?php endif; ?>
                
            <?php if(is_active_sidebar('apbasic_cta_section')) : ?>
                <div id="cta-container">
                    <?php dynamic_sidebar('apbasic_cta_section'); ?>
                </div>
            <?php endif; ?>
            
            <?php if(is_active_sidebar('icon_text_block_section')) : ?>
                <div id="icon-text-block-container" class="clearfix">
                    <div class="ap-container">
                        <div class="icon-text-block-wrapper clearfix">
                            <?php dynamic_sidebar('icon_text_block_section'); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php if(is_active_sidebar('apbasic_toggle_section') || is_active_sidebar('apbasic_featured_page_section')) : ?>
                <div id="toggle-feat-page-container" class='clearfix'>
                    <div class="ap-container">
                        <?php if(is_active_sidebar('apbasic_toggle_section')) : ?>
                            <div id="toggle-container">
                                <?php dynamic_sidebar('apbasic_toggle_section'); ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if(is_active_sidebar('apbasic_featured_page_section')) : ?>
                            <div id="featured-page-container">
                                <?php dynamic_sidebar('apbasic_featured_page_section'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php if(is_active_sidebar('apbasic_testimonial_section') || is_active_sidebar('apbasic_services_section')) : ?>
                <div id="test-services-container">
                    <div class="ap-container">
                        <?php if(is_active_sidebar('apbasic_testimonial_section')) : ?>
                            <div id="testimonial-container">
                                <?php dynamic_sidebar('apbasic_testimonial_section'); ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if(is_active_sidebar('apbasic_services_section')) : ?>
                            <div id="services-container">
                                <?php dynamic_sidebar('apbasic_services_section'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
