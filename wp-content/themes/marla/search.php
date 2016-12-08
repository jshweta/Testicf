<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package marla
 */
get_header(); ?>
	<section id="primary" class="content-area">
		<div class="todocontenido">
		<?php if ( have_posts() ) : ?>
			<div class="anuncioshome"><header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'marla' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header></div><!-- .page-header -->
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content-scroll', 'search' ); ?>
			<?php endwhile; ?>
			<?php marla_content_nav( 'nav-below' ); ?>
		<?php else : ?>
			<?php get_template_part( 'no-results', 'search' ); ?>
		<?php endif; ?>
		</div><!-- #content -->
	</section><!-- #primary -->
<?php get_footer(); ?>