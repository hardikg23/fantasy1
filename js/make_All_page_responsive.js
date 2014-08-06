$(document).ready(function(){

    function adjust_window(){
    var winW = $(window).width();
    var padding=winW-1000;
    if(winW >= 1100)
    {
        $('.main-body-container').css('left', padding/2);
        $('#header-container').css('left', padding/2);
        $('#footer-container').css('left', padding/2);
        $('.filler').css('left', padding/2);

    }else{
         $('.main-body-container').css('left', 50);
         $('#header-container').css('left', 50);
         $('#footer-container').css('left', 50);
         $('.filler').css('left', 50);
    }

    }
    adjust_window();
    $(window).resize(function(){
         adjust_window();
    });
});



