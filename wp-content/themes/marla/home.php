<?php get_header(); ?>
<div id="primary" class="content-area">
		
<div class="todocontenido">
<?php if ( dynamic_sidebar('sidebar-home') ) : else : endif; ?>
		<?php if ( have_posts() ) : ?>
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to overload this in a child theme then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content-scroll', get_post_format() );
				?>
			<?php endwhile; ?>
			<?php marla_content_nav( 'nav-below' ); ?></div>
		<?php else : ?>
			<?php get_template_part( 'no-results', 'index' ); ?>
		<?php endif; ?>
		</div><!-- #content -->
	</div><!-- #primary -->
<?php get_footer(); ?>