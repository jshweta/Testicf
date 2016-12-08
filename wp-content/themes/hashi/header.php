<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>
	<meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<title><?php wp_title(); ?></title>
	<link href="<?php print(get_stylesheet_uri()); ?>" rel="stylesheet" type="text/css" />

	<?php
		wp_head();
	?>
	
</head>

<body <?php body_class(); ?>>


	<header id="header-main" 
		<?php
			$hashi_headerImageUrl = get_header_image();
			if(!empty($hashi_headerImageUrl)) {
				print('style="background-image: url('. $hashi_headerImageUrl .');"');
			}
		?>
		>
		<?php
			$hashi_headerTextColor = get_header_textcolor();
			if($hashi_headerTextColor != 'blank') :
			if(is_singular()) :
		?>
			<p id="blog-title" style="color: #<?php print($hashi_headerTextColor); ?>;"><?php bloginfo('name'); ?></p>
			<p id="blog-tagline" style="color: #<?php print($hashi_headerTextColor); ?>;"><?php bloginfo( 'description' ); ?></p>
		<?php else: ?>
			<h1 id="blog-title" style="color: #<?php print($hashi_headerTextColor); ?>;"><?php bloginfo('name'); ?></h1>
			<p id="blog-tagline" style="color: #<?php print($hashi_headerTextColor); ?>;"><?php bloginfo( 'description' ); ?></p>
		<?php endif; endif; ?>
		<a id="home-link" href="<?php print(esc_url(home_url())); ?>"></a>
	</header>

	<nav id="lcol">
		
		<span id="m1" style="display: none;"></span>
		<span id="m2" style="display: none;"></span>
	
		<a class="menu-toggle" id="menu-toggle-open" href="#m1"><?php print ( __( 'Menu' ) ) ?></a>		
		<a class="menu-toggle" id="menu-toggle-close" href="#m2"><?php print ( __( 'Menu' ) ) ?></a>

		<?php if(has_nav_menu('hashi_nav_menu')) :
		
			$hashi_menuArgs = array(
				'theme_location'  => 'hashi_nav_menu',
				'container'       => false,
				'container_class' => '',
				'container_id'    => '',
				'menu_class'      => '',
				'menu_id'         => 'mainnav',
				'echo'            => true,
				'fallback_cb'     => false,
				'before'          => '',
				'after'           => '',
				'link_before'     => '',
				'link_after'      => '',
				'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				'depth'           => 0,
				'walker'          => ''
			);
		
			wp_nav_menu($hashi_menuArgs);
			
		else : ?>
	
		<ul id="mainnav">

			<?php if ( 'page' != get_option( 'show_on_front' ) ) : ?>
			<li><a href="<?php print(esc_url(home_url())); ?>"><?php
				$hashi_customHomeLinkName = get_theme_mod('custom_home_link_title');
				if(!empty($hashi_customHomeLinkName)) {
					print($hashi_customHomeLinkName);
				} else  {
					print(__('Home'));
				}
			?></a></li>
			<?php
				endif;
				
				$hashi_listPagesArgs = array(
					'sort_order' => 'ASC',
					'sort_column' => 'menu_order',
					'depth' => 0,
					'post_type' => 'page',
					'post_status' => 'publish',
					'title_li' => null
				);
				wp_list_pages($hashi_listPagesArgs);
			
			?>
		</ul>
		
		<?php endif;
		
		$hashi_additionalContent = get_theme_mod('custom_html_below_menu');
		if(!empty($hashi_additionalContent)) {
			print($hashi_additionalContent);
		}

		?>
		
	</nav>
