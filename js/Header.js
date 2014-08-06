/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){

    function adjust_window(){
    var winW = $(window).width();
    var padding=winW-1000;
    if(winW >= 1000)
    {
        //$('#header-container').css('left', padding/2);
    }else{
         $('#header-container').css('left', 0);
    }

    }
    adjust_window();
    $(window).resize(function(){
         adjust_window();
    });
});
