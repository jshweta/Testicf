jQuery(document).ready(function ($){
    $('.ap_toggle_title').click(function(){
      $(this).next('.ap_toggle_content').slideToggle();
      $(this).toggleClass('active');
      
      if($(this).parent('.ap_toggle').hasClass('open')){
        $(this).parent('.ap_toggle').removeClass('open');
        $(this).parent('.ap_toggle').addClass('close');
      }else if($(this).parent('.ap_toggle').hasClass('close')){
        $(this).parent('.ap_toggle').removeClass('close');
        $(this).parent('.ap_toggle').addClass('open');
      }
  });

    $('.search-icon i.fa-search').click(function() {
    $('.search-icon .ak-search').toggleClass('active');
});

$('.ak-search .close').click(function() {
    $('.search-icon .ak-search').removeClass('active');
});

$('.overlay-search').click(function() {
    $('.search-icon .ak-search').removeClass('active');
});

/*Super Fish Menu*/
    $('#site-navigation .menu').superfish({
      animation:   {opacity:'show',height:'show'},  // fade-in and slide-down animation
      animationOut:{opacity:'hide',height:'hide'},  // fade-in and slide-down animation
      speed:       'fast',                          // faster animation speed
    });

// fade in #back-top
$(function() {
    $(window).scroll(function() {
        if ($(this).scrollTop() > 200) {
            $('#go-top').fadeIn();
        } else {
            $('#go-top').fadeOut();
        }
    });

    // scroll body to 0px on click
    $('#go-top').click(function() {
        $('body,html').animate({
            scrollTop: 0
        }, 800);
        return false;
    });
});

$('.menu-trigger').click(function(){
  $('.main-navigation-responsive').slideToggle('slow');

});

$('.main-navigation-responsive .menu-item-has-children').append('<span class="sub-toggle"> <i class="fa fa-angle-right"></i> </span>');

$('.main-navigation-responsive .sub-toggle').click(function() {
    $(this).parent('.menu-item-has-children').children('ul.sub-menu').first().slideToggle('slow');
    $(this).children('.fa-angle-right').first().toggleClass('fa-angle-down');
});
/*fixed sidebars start
leftBlock=jQuery('#secondary.secondary-left');
RightBlock=jQuery('#secondary.secondary-right');
//elementLeftOffset_begining = leftBlock.offset().top  ;
//elementRightOffset_begining = RightBlock.offset().top   ;
windowHeight=jQuery(window).height();
//console.log("elementRightOffset_begining: " + elementRightOffset_begining);
//console.log("elementLeftOffset_begining: " + elementLeftOffset_begining);
var first_scroll_flag=true;
jQuery(window).scroll(function() {
   if(first_scroll_flag){
  var elementLeftOffset_begining = leftBlock.offset().top  ;
  var elementRightOffset_begining = RightBlock.offset().top   ;
  first_scroll_flag =false;
  }
  var scrollTop     = jQuery(window).scrollTop(),
  elementLeftOffset = leftBlock.offset().top,
  elementRightOffset = RightBlock.offset().top,
  elementLeftHeight = leftBlock.height(),
  elementRightHeight = RightBlock.height(),
  //distance      = (elementOffset + elementHeight+20 - scrollTop);
  distance_left      =  (elementLeftOffset_begining - scrollTop );
  distance_right  =  (elementRightOffset_begining  - scrollTop );
  //console.log("distance_left: "+distance_left);
  //console.log("distance_right: "+distance_right);
  //console.log("scrollTop: "+ scrollTop);
  if(distance_left<=0 )
  {
	  if(!(leftBlock.hasClass("fixed-position"))){
            leftBlock.addClass("fixed-position");
	    leftBlock.height(jQuery(window).height()*.70);
           }  
   }   
  else
   {   
    leftBlock.removeClass("fixed-position");
    leftBlock.height("auto");
    }   
  if(distance_right<=0 )
  {
	  if(!(RightBlock.hasClass("fixed-position"))){
                 RightBlock.addClass("fixed-position");
		 RightBlock.height(jQuery(window).height()*.70);
	  }
   }   
  else
   {   
    RightBlock.removeClass("fixed-position");
    RightBlock.height("auto");
    }   
});

/*fixed sidebars end */

jQuery("p:contains('Responsive Portfolio Powered By')").css( "display", "none" );
});
