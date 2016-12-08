(function ($) {
    $(function () {
        $('.apccss-top-button').click(function(){
            $('body').animate({
                scrollTop:0
            },200);
        });

	    $( '.apccss-tabs-trigger' ).click(function(){
		    $( '.apccss-tabs-trigger' ).removeClass( 'nav-tab-active' );
		    $(this).addClass( 'nav-tab-active' );
		    var board_id = 'tab-'+$(this).attr('id');
		    $('.apccss-tab-contents').hide();
		    $('#'+board_id).show();
	   	});
       
        });
}(jQuery));