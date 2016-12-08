<?php 
function marla_head()
{
	echo '<script type="text/javascript">document.documentElement.className = document.documentElement.className.replace("no-js","js");</script><style type="text/css">';
	$webfonts = str_replace("+", " ", get_theme_mod( 'google_web_fonts'));
	
	?>
	@import url(http://fonts.googleapis.com/css?family=<?php echo get_theme_mod( 'google_web_fonts', marla_default_settings('google_web_fonts')  ); ?>);
	body {
	background-image: <?php echo get_theme_mod( 'bg_styles', marla_default_settings('bg_styles')  ); ?>;
    font-family: '<?php echo $webfonts ?>', sans-serif;
}
<?php if( get_theme_mod( 'marla_styles' ) == 'light' ) {
?>
#metadatos span {color:#444; text-shadow:none} 
body { background-image:none}
.site-footer, #content .widget  {
	background: #ffffff; background:none;
}
.site-footer {
	background: #ffffff; 
}
.site-footer, .site-footer a, .site-footer a:hover, .site-footer a:visited {
	color: #444444;
}
body.custom-background { background-color: #ffffff; }
#content, .author-bio, #content .widget , .site-footer {-moz-box-shadow: none;
-webkit-box-shadow: none;
box-shadow: none}
<?php } if( get_theme_mod( 'marla_styles' ) == 'dark' ) {
?>
#site-navigation div > ul > li, .blog .entry-title, .archive .entry-title, #site-navigation, #site-navigation ul, .search .entry-title, .site-footer {background:#0e1120; color:#FFF}
 #site-navigation li:hover {
background-color: #000;
}
.logo h2 {color:#FFF}
#header {background-color:transparent}
body.custom-background { background-color: #000; background:url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0naHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmcnIHhtbG5zOnhsaW5rPSdodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rJyB3aWR0aD0nMTAwJScgaGVpZ2h0PScxMDAlJz4KCTxkZWZzPgoJCTxnIGlkPSdhJz4KCQkJPHBhdGggZD0nTTUgNmwtNiAtNiB2LTIgbDYgNicgZmlsbC1vcGFjaXR5PScwJyBzdHJva2U9JyMyYjNhNzUnIC8+CgkJCTxwYXRoIGQ9J001IDVsNiAtNiB2LTIgbC02IDYnIGZpbGwtb3BhY2l0eT0nMCcgc3Ryb2tlPScjMzE0MTdkJyAvPgoJCTwvZz4KCQk8cGF0dGVybiBwYXR0ZXJuVW5pdHM9J3VzZXJTcGFjZU9uVXNlJyB4PScwJyB5PScwJyBpZD0ncCcgd2lkdGg9JzIwJyBoZWlnaHQ9JzIwJyB2aWV3Qm94PScwIDAgMTAgMTAnPgoJCQk8dXNlIHhsaW5rOmhyZWY9JyNhJy8+ICAKCQkJPHVzZSB4bGluazpocmVmPScjYScgeT0nLTQnLz4KCQkJPHVzZSB4bGluazpocmVmPScjYScgeT0nNCcvPgoJCQk8dXNlIHhsaW5rOmhyZWY9JyNhJyB5PSc4Jy8+CgkJCTx1c2UgeGxpbms6aHJlZj0nI2EnIHk9JzEyJy8+CgkJPC9wYXR0ZXJuPgoJCTxyYWRpYWxHcmFkaWVudCBncmFkaWVudFVuaXRzPSd1c2VyU3BhY2VPblVzZScgaWQ9J2cnIGN4PSc1MCUnIGN5PSc1MCUnIGZ4PSczMCUnIGZ5PSczMCUnIHI9JzYwJSc+CgkJCTxzdG9wIG9mZnNldD0nMCUnIHN0b3AtY29sb3I9JyNhYWFhYWEnIHN0b3Atb3BhY2l0eT0nLjUnIC8+CgkJCTxzdG9wIG9mZnNldD0nMTAwJScgc3RvcC1jb2xvcj0nIzAwMDAwMCcgc3RvcC1vcGFjaXR5PScuNycgLz4KCQkJPC9yYWRpYWxHcmFkaWVudD4KCTwvZGVmcz4KCTxyZWN0IHg9Jy01JScgeT0nLTUlJyB3aWR0aD0nMTEwJScgaGVpZ2h0PScxMTAlJyBmaWxsPScjMDAwMDIyJy8+Cgk8cmVjdCB3aWR0aD0nMTEwJScgaGVpZ2h0PScxMTAlJyBmaWxsPSd1cmwoI3ApJy8+Cgk8cmVjdCB4PSctNSUnIHk9Jy01JScgd2lkdGg9JzExMCUnIGhlaWdodD0nMTEwJScgZmlsbD0ndXJsKCNnKScvPgo8L3N2Zz4=") }
<?php }	if ( is_admin_bar_showing() ) { ?> #site-navigation.fixed {top: 28px; }<?php } 
if( get_theme_mod( 'header_background' ) != marla_default_settings('header_background') ) {
?>
#header {background-image:url('<?php echo get_theme_mod( 'header_background' ); ?>'); background-position:center center;}
<?php } 
if( get_theme_mod( 'height_header' ) != marla_default_settings('height_header') ) {
?>
#header {height:<?php echo get_theme_mod( 'height_header' ); ?>px;}
<?php } 
if( get_theme_mod( 'font_size' ) != marla_default_settings('font_size') ) {
?>
body {font-size:<?php echo get_theme_mod( 'font_size' ); ?>%;}
<?php } 
if( get_theme_mod( 'nav_color_bg' ) != marla_default_settings('nav_color_bg') ) {
?>
#site-navigation, #site-navigation ul {background:<?php echo get_theme_mod( 'nav_color_bg' ); ?>;}
#site-navigation  li:hover {background:<?php echo get_theme_mod( 'nav_color_bg' ); ?>;}
<?php } 
if( get_theme_mod( 'nav_color_item' ) != marla_default_settings('nav_color_item') ) {
?>
#site-navigation div > ul > li, .blog .entry-title, .archive .entry-title, .search .entry-title,  #site-navigation .sub-menu, #site-navigation .children,  #sidebar .widget-title, .todocontenido .widget-title {background:<?php echo get_theme_mod( 'nav_color_item' ); ?>;}
<?php } 
if( get_theme_mod( 'nav_color_text' ) != marla_default_settings('nav_color_text') ) {
?>
#site-navigation ul > li > a {color:<?php echo get_theme_mod( 'nav_color_text' ); ?>;}
<?php		
	}
	if( get_theme_mod( 'header_background_color' )!= marla_default_settings('header_background_color') ) {
?>
#header {
	background-color: <?php echo get_theme_mod( 'header_background_color', marla_default_settings('header_background_color') ); ?>; 
}
<?php		
	}
	if( get_theme_mod( 'headings_color' )!= marla_default_settings('headings_color') ) {
?>
h1,h2,h3 {
	color: <?php echo get_theme_mod( 'headings_color', marla_default_settings('headings_color') ); ?>; 
}
<?php		
	}
	
	if( get_theme_mod( 'bg_cover' ) != marla_default_settings('bg_cover') ) {
?>
body, body.custom-background { background-size:cover; -moz-background-size: cover;-webkit-background-size: cover;
-o-background-size: cover;background-attachment:fixed !important; height:100%;}
<?php		
	}
	
	
	
	
	
	if( get_theme_mod( 'footer_background_color' ) != marla_default_settings('footer_background_color') ) {
?>
.site-footer {
	background: <?php echo get_theme_mod( 'footer_background_color', marla_default_settings('footer_background_color')  ); ?>;
}
<?php		
	}
	if( get_theme_mod( 'header_fixed' ) != marla_default_settings('header_fixed') ) {
?>
#header {position: fixed;
left: 0px;
top: 37px;
	background-color: <?php echo get_theme_mod( 'header_background_color' ); ?>; 
    box-shadow: 0 0 10px #222;
-webkit-box-shadow: 0 0 10px #222;
-moz-box-shadow: 0 0 10px #222;
}
* html #header {
    position: absolute;
    top: expression((0-(footer.offsetHeight)+(document.documentElement.clientHeight ? document.documentElement.clientHeight : document.body.clientHeight)+(ignoreMe = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop))+'px');
}
 @media only screen 
and (max-width : 600px) {
#header {position: static}
}
<?php } if ( is_admin_bar_showing() ) { ?>#header { top: 65px; }
<?php		
	}
	if( get_theme_mod( 'footer_fixed' ) != marla_default_settings('footer_fixed') ) {
?>
.site-footer  {position: fixed; bottom:0}
* html .site-footer  {
    position: absolute;
    top: expression((0-(footer.offsetHeight)+(document.documentElement.clientHeight ? document.documentElement.clientHeight : document.body.clientHeight)+(ignoreMe = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop))+'px');
}
<?php		
	}
	if( get_theme_mod( 'link_color' ) != marla_default_settings('link_color') ) {
?>
a, a:visited {
	color: <?php echo get_theme_mod( 'link_color',  marla_default_settings('hover_color') ); ?>;
}
<?php		
	}
	if( get_theme_mod( 'hover_color' ) != marla_default_settings('hover_color') ) {
?>
a:hover  {
	color: <?php echo get_theme_mod( 'hover_color', marla_default_settings('hover_color') ); ?>;
}
<?php		
	}
	if( get_theme_mod( 'marla_right_sidebar' ) != marla_default_settings('marla_right_sidebar') ) {
?>
@media only screen and (min-width : 1000px) {
#sidebar {display:block; padding:25px; background-color:#FFF; overflow:hidden; float:right;width:300px}
.single-post #pagina {float:left; margin-left:10%}}
<?php		
	}
	if( get_theme_mod( 'footer_color' ) != marla_default_settings('footer_color') ) {
?>
.site-footer, .site-footer a, .site-footer a:hover, .site-footer a:visited {
	color: <?php echo get_theme_mod( 'footer_color' ); ?>;
}
<?php		
	}
	if( get_theme_mod( 'marla_custom_css' ) != marla_default_settings('marla_custom_css') ) {
 echo get_theme_mod( 'marla_custom_css' );} ?>
<?php echo '</style>';
if( get_theme_mod( 'code_header' ) != marla_default_settings('code_header') ) {
echo get_theme_mod( 'code_header' ); } 
	
}
add_action( 'wp_head', 'marla_head' );?>