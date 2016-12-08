jQuery(document).ready(function($){ 
$(function(){
	$('.todocontenido > div').hover(
	function () {
    $('.todocontenido > div').not(this).addClass('focus-post');
  },
  function () {
    $('.todocontenido > div').not(this).removeClass('focus-post');
  }
	);
	
	var header = $('#header'),
		hheight = header.height();
		$('#metadatos,#sidebarcompartir').css('top', hheight+40);
	if( header.css('position') == 'fixed') {
	$('#pagina').css('margin-top', hheight+10);
	$('#metadatos,#sidebarcompartir').css('top', hheight+100);
	}
	$('#metadatos,#sidebarcompartir').hide();
	wiconsociales = $('.site-footer .icons');
	var counticons = $('.site-footer .icons li').length;
	wiconsociales.css('width', (counticons*35));
	
	
	
	
	var menu = $('#site-navigation'),
		pos = menu.offset();
		
		$(window).scroll(function(){
			if ( $(this).width()> 681){
			if($(this).scrollTop() > pos.top+menu.height() && menu.hasClass('navigation-main')){
				menu.fadeOut('fast', function(){
					$(this).removeClass('navigation-main').addClass('fixed').fadeIn('fast');
					$('#metadatos,#sidebarcompartir').fadeIn('fast');
				});
			} else if($(this).scrollTop() <= pos.top && menu.hasClass('fixed')){
				menu.fadeOut('fast', function(){
					$(this).removeClass('fixed').addClass('navigation-main').fadeIn('fast');
					$('#metadatos,#sidebarcompartir').fadeOut('fast');
				});
			}}
		});
});
$('#content object').attr('class', 'videoelastico');
$('#content p > iframe').parent().attr('class', 'videoelastico');
$('#content p > object').parent().attr('class', 'videoelastico');
$('#content p > embed').parent().attr('class', 'videoelastico');
$('#content div > object').parent().attr('class', 'videoelastico');
/*$('#content p > img:not([align])').parent().attr('class', 'imgelastico');
$('#content p > a > img:not([align])').parents('p').attr('class', 'imgelastico');
$('.entry-attachment img').parents('a').attr('class', 'imgelastico');*/
 });