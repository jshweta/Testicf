<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Accesspress Basic
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<div class="ap-container">
			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><span class="oops"><?php _e( 'Oops! ', 'accesspress-basic' ); ?></span><span class="pg-cannot"><?php _e( 'That page can&rsquo;t be found.', 'accesspress-basic' ); ?></span></h1>
				</header><!-- .page-header -->

				<div class="page-content">
                    <h2 class="err"><span class="err-404"><?php _e('404','accesspress-basic'); ?></span>
                    <span class="error"><?php _e('ERROR','accesspress-basic'); ?></span></h2>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->
			</div><!--.ap-container  -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
