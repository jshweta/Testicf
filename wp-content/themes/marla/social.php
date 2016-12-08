<div id="metadatos"><span><?php the_date(); ?></span>  

<?php if( get_theme_mod( 'marla_metadata' ) == 'categories' ) {

$categories_list = get_the_category_list( '</span><span>');?>

			<span>

				<?php printf(( '%1$s'), $categories_list ); ?>

			</span>

<?php } if( get_theme_mod( 'marla_metadata' ) == 'tags' ) { the_tags('<span>', '</span>  <span>', '</span>'); } ?></div>

<div id="sidebarcompartir" class="fleft"><div id="fb-root"></div><fb:like href="<?php the_permalink(); ?>" layout="button_count" send="false" width="80" show_faces="false" font=""></fb:like>

<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>" data-via="<?php echo get_theme_mod( 'marla_social1', marla_default_settings('marla_social1') ) ?>" data-size="small">Tweet</a><div>

<div class="g-plusone" data-size="medium" data-href="<?php the_permalink(); ?>"></div></div>

<?php if( (get_theme_mod( 'marla_jetpack_subscription' ) == marla_default_settings('marla_jetpack_subscription')) && (get_theme_mod( 'marla_social4' ) != marla_default_settings('marla_social4')) && (get_theme_mod( 'marla_email_code' ) == marla_default_settings('marla_email_code'))  ) {

?><a target="_blank"  href="http://feeds.feedburner.com/<?php echo get_theme_mod( 'marla_social4', marla_default_settings('marla_social4') ) ?>"><img src="http://feeds.feedburner.com/~fc/<?php echo get_theme_mod( 'marla_social4', marla_default_settings('marla_social4') ) ?>?bg=00CCFF&amp;fg=000000&amp;anim=1" height="26" width="88" style="border:0" alt="" /></a><div>

<form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo get_theme_mod( 'marla_social4', marla_default_settings('marla_social4') ) ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true"><input type="text" name="email" onfocus="if (this.value=='<?php _e( 'Subscribe via email', 'marla' ); ?>') this.value='';" placeholder="<?php _e( 'Subscribe via email', 'marla' ); ?>" /><input type="hidden" value="<?php echo get_theme_mod( 'marla_social4', marla_default_settings('marla_social4') ) ?>" name="uri"/><input type="hidden" name="loc" value="<?php bloginfo( 'language' ); ?>"/><input type="submit" value="<?php _e( 'Subscribe', 'marla' ); ?>" class="boton"/></form></div>

<?php } if( (get_theme_mod( 'marla_jetpack_subscription' ) != marla_default_settings('marla_jetpack_subscription')) && (get_theme_mod( 'marla_social4' ) == marla_default_settings('marla_social4')) && (get_theme_mod( 'marla_email_code' ) == marla_default_settings('marla_email_code')) ) { echo '<div id="marla-jetpack">'. do_shortcode('[jetpack_subscription_form]'). '</div>'; }?>

<?php if( (get_theme_mod( 'marla_jetpack_subscription' ) == marla_default_settings('marla_jetpack_subscription')) && (get_theme_mod( 'marla_social4' ) == marla_default_settings('marla_social4')) && (get_theme_mod( 'marla_email_code' ) != marla_default_settings('marla_email_code')) ) { echo '<div id="marla-email-form">'. get_theme_mod( 'marla_email_code', marla_default_settings('marla_email_code') ). '</div>'; }?>

</div>