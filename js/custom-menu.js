function setCookie(name,value,days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}
function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}
function eraseCookie(name) {   
    document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}


jQuery('#hamburger').on('click',function(){
    jQuery('#et-main-area').hide();
    jQuery('.full-menu').slideDown();
    jQuery(this).hide();
});

jQuery('.menu-close').on('click',function(){
    jQuery('#et-main-area').show();
    jQuery('.full-menu').slideUp();
    jQuery('#hamburger').show();
});

if (window.matchMedia("(max-width: 1025px)").matches) {
    jQuery('.custom-menu-link').on('click',function(){
      var title = jQuery(this).text();
        var target = jQuery(this).data('target');
        
        eraseCookie('menuTarget');
        if (jQuery(target).length != 0){
          event.preventDefault();  
        }
        
        var level = jQuery(this).data('level');
        setCookie('menuLevel',level,7);
        if(level == 1){
            jQuery('.mobile-title-2').text(title);
            jQuery('.sub-menu-wrapper').hide();
            jQuery('.third-menu-wrapper').hide();
            jQuery('.main-menu-wrapper').hide(); 
            jQuery('.mobile-back-wrapper').show();
            jQuery('.mobile-back-wrapper').attr('data-target', target);
            jQuery('.mobile-back-wrapper').attr('data-id', level);
        }else if(level == 2){
            jQuery('.mobile-title-3').text(jQuery(this).text());
            jQuery('.main-menu-wrapper').hide();
            //jQuery('.sub-menu-wrapper').hide();
            jQuery('.third-menu-wrapper').hide();
            jQuery('.mobile-back-wrapper').show();
        }
        console.log(jQuery(this).text());
        
        console.log(target);
        if(level == 1){console.log(level);
        jQuery(target).fadeIn(500);
        }
    });
  } else {
    var menutarget1 =  getCookie('menuTarget1');
    var menutarget2 =  getCookie('menuTarget2');
    var activate = `*[data-target="${getCookie('activate')}"]`;
    var target1 = `*[data-target="${getCookie('menuTarget1')}"]`;
    var target2 = `*[data-target="${getCookie('menuTarget2')}"]`;
        jQuery(menutarget1).show();
        jQuery(menutarget2).show();
        jQuery(target1).closest('li').addClass('current-active');
        jQuery(target2).closest('li').addClass('current-active');

    jQuery('.custom-menu-link').on('click',function(){
        
        jQuery('.custom-menu-link').closest('li').removeClass('current-active');
        var target = jQuery(this).data('target');
        setCookie('activate',target,7);
        
        jQuery(this).closest('li').addClass('current-active');
        //eraseCookie('menuTarget1');
        if (jQuery(target).length != 0){
          event.preventDefault();
        }
        var level = jQuery(this).data('level');

        if(level == 1){
            jQuery('.sub-menu-wrapper').hide();
            jQuery('.third-menu-wrapper').hide(); 
            setCookie('menuTarget1',target,7);   
            eraseCookie('menuTarget2');    
        }else if(level == 2){
            jQuery('.third-menu-wrapper').hide();
            setCookie('menuTarget2',target,7); 
        }
    
        jQuery(target).fadeIn(500);
    });
  }
jQuery('.mobile-back-wrapper').on('click',function(){
    event.preventDefault(); 
    var pointer = jQuery(this).data('target');
    var part = jQuery(this).data('id');
    if(part > 0 && jQuery('.third-menu-wrapper').is(':visible')){
        jQuery('.menu-wrap').hide();
        jQuery(pointer).fadeIn(500);
        jQuery('.mobile-back-wrapper').show();
    }
    else{
        jQuery('.menu-wrap').hide();
        jQuery('.main-menu-wrapper').fadeIn(500); 
        jQuery('.mobile-back-wrapper').hide();
    }
    console.log(pointer);
    console.log(part);

});
jQuery('.mobile-search-icon').on('click',function(){
    jQuery('.mobile-search-f-wrapper').toggle();
});

jQuery('a , span').on('click',function(){
    var d = jQuery(this).data('level');
   if(d>0){
  console.log('leave');
   } else {
    eraseCookie('menuTarget1');
    eraseCookie('menuTarget2');
    eraseCookie('activate');
    console.log('erased');
   }
});