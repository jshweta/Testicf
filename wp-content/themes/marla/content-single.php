<?php
/**
 * @package marla
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->
<?php if ( dynamic_sidebar('sidebar-before-content') ) : else : endif; ?>
	<div class="entry-content"><?php edit_post_link( __( 'Edit', 'marla' ), '<span class="edit-link">', '</span>' ); ?>
		<?php the_content(); ?></div><div class="clear"><?php get_template_part( 'social' );   if( get_theme_mod( 'slider_related_posts' ) == marla_default_settings('slider_related_posts') ) { get_template_part( 'slider-related-posts' );} ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'marla' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<footer class="entry-meta">
		
<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'marla' ) );
				if ( $categories_list && marla_categorized_blog() ) :
			?>
			<span class="cat-links">
				<?php printf( __( 'Posted in %1$s', 'marla' ), $categories_list ); ?>
			</span>
			<?php endif; // End if categories ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'marla' ) );
				if ( $tags_list ) :
			?>
			<span class="sep"> | </span>
			<span class="tags-links">
				<?php printf( __( 'Tagged %1$s', 'marla' ), $tags_list ); ?>
			</span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>
		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="sep"> | </span>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'marla' ), __( '1 Comment', 'marla' ), __( '% Comments', 'marla' ) ); ?></span>
		<?php endif; ?>
		<?php edit_post_link( __( 'Edit', 'marla' ), '<span class="sep"> | </span><span class="edit-link">', '</span>' ); ?>
		
	</footer><?php if( get_theme_mod( 'author_bio' ) == marla_default_settings('author_bio') ) { get_template_part( 'author-bio' ); } ?><!-- .entry-meta -->
</article><!-- #post-## -->
