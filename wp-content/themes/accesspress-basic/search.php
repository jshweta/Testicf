<?php
/**
 * The template for displaying search results pages.
 *
 * @package Accesspress Basic
 */
global $apbasic_options;
$apbasic_settings = get_option('apbasic_options',$apbasic_options);
$search_results_for_text = esc_attr($apbasic_settings['search_results_for_text']);
get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<div class="ap-container">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
                <?php if(empty($search_results_for_text)) : ?>
				    <h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'accesspress-basic' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
                <?php else : ?>
                    <h1 class="page-title"><?php echo $search_results_for_text . ': <span>' . get_search_query() . '</span>'; ?></h1>                    
                <?php endif; ?>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'content', 'search' );
				?>

			<?php endwhile; ?>

			<?php //the_posts_navigation(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>
		</div> <!--.ap-container -->
		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
