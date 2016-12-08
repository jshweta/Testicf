	
	<?php get_header(); ?>
	
	<main<?php if(is_active_sidebar(1)) { print(' class="with-sidebar"'); } ?>>
	
	<?php while(have_posts()) : the_post(); ?>

		<?php
			print( '<article><h1 ');
			post_class('post-title');
			print('><a href="'.get_permalink().'">');
			the_title();
			print('</a></h1>');
			
			print('<span class="date"><a class="secondary-permalink" href="'.get_permalink().'">');
			if(!get_theme_mod('hide_author')) {
				the_author();
				print(', ');
			}
			print('<time datetime="' . get_the_date('Y-m-d') . '">');
			print(get_the_date());
			print('</time>');
			print('</a>');
			if(has_category() && !get_theme_mod('hide_categories')) {
				print(' &middot; '.__( 'Categories' ).': ');
				the_category(", ");
			}
			if(has_tag() && !get_theme_mod('hide_tags')) {
				print(' &middot; '.__( 'Tags' ).': ');
				the_tags("", ", ");
			}
			print('</span>');

			$hashi_customMoreLinkText = get_theme_mod('custom_more_link_title');
			if(empty($hashi_customMoreLinkText)) {
				$hashi_customMoreLinkText = __( '(more&hellip;)' );
			}
			the_content($hashi_customMoreLinkText, false );
			
			$hashi_pos = strpos($post->post_content, '<!--more-->');
			
			if($numpages > 1 && !($hashi_pos)) {
				print('<p><a class="more-link" href="'.get_permalink().'">'.$hashi_customMoreLinkText.'</a></p>');
			}
			
			$hashi_num_comments = get_comments_number();
			if((comments_open() || $hashi_num_comments > 0) && !($hashi_pos)) {
				print('<p class="link-to-comments">');
				comments_popup_link();
				print('</p>');
			}
			
			print('</article>');
		?>
	
	<?php endwhile; ?>
	
	<?php if(get_next_posts_link() != null || get_previous_posts_link() != null) : ?>
	
		<nav class="page-switcher"><p><?php posts_nav_link(); ?></p></nav>
		
	<?php endif; ?>
	
	</main>
	
	<?php if(is_active_sidebar(1)) : ?>
	<aside id="rcol">
		<?php dynamic_sidebar(); ?> 
	</aside>
	<?php endif; ?>
	
	<?php get_footer(); ?>
