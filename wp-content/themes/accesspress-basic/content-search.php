<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Accesspress Basic
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>
		<!--<div class="entry-meta">
			<?php accesspress_basic_posted_on(); ?>
		</div> .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

	<footer class="entry-footer">
        <span class="entry-footer-wrapper">
            <span class="author user-wrapper"><i class="fa fa-user"></i><a href="<?php ?>"><?php echo get_the_author_meta('display_name'); ?></a></span>
            <span class="posted-date user-wrapper"><i class="fa fa-calendar"></i><a href="<?php ?>"><?php echo the_time('F y, j'); ?></a></span>
            <?php if(has_category()) : ?>
                <span class="category user-wrapper"><i class="fa fa-folder"></i><?php the_category(', '); ?></span>
            <?php endif; ?>
        </span>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->