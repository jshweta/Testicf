jQuery(document).ready(function ($){
    var formfield;
    jQuery('.image_upload_button').click(function() {
        jQuery('html').addClass('Image');
        
        formfield = jQuery(this).prev().attr('name');
        
        tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
        return false;
    });
    
        window.original_send_to_editor = window.send_to_editor;
    
        window.send_to_editor = function(html){
            if (formfield) {
                fileurl = jQuery('img',html).attr('src');
                jQuery('#'+formfield).val(fileurl);
                tb_remove();
                jQuery('html').removeClass('Image');
            }
            else {
                window.original_send_to_editor(html);
            }   
        };
    
    $('.apbasic-color').wpColorPicker();
    
    $('.group').hide();
    $('#options-group-1').show();
    
    $('.nav-tab').click(function (){
        var group_id = $(this).attr('disp');
        
        $('.nav-tab').removeClass('nav-tab-active');
        $(this).addClass('nav-tab-active');
                    
        $(".group").hide();
        $(group_id).fadeIn();
    });
    
    // Removing the Slide Preview Image
    $('.remove_slide_preview').click(function (){
        $(this).parent().fadeOut();
        $(this).parent().prev().prev('.slide-image-url').val('');
    });
    
    // Removing the Logo Preview Image
    $('.remove_logo_preview').click(function (){
        $(this).parent().fadeOut();
        $(this).parent().prev().prev('#header_logo').val('');
    });
    
    // Removing the Favicon Preview Image
    $('.remove_favicon_preview').click(function (){
        $(this).parent().fadeOut();
        $(this).parent().prev().prev('#favicon').val('');
    });
    
    if($('#full_width').is(':checked')){
       $("#bk_pattern_tr").hide(); 
    }
    
    // Display Background Pattern optin in boxed layout only
    $("#boxed").change(function (){
       $("#bk_pattern_tr").slideDown(); 
    });
    
    $("#full_width").change(function (){
       $("#bk_pattern_tr").slideUp(); 
    });

    $('label.inline-block').click(function(){
        $('.pattern-img').removeClass('active');
        $(this).parent('div').addClass('active');
    });

    $(".pattern-img input:radio:checked").parent('div').addClass("active");

    
});