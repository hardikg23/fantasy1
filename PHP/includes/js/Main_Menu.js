 /* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){
    seriesId=$('#seriesId_hidden').val();
    $('#series'+seriesId).addClass('MainElement');
    var loc = window.location.href;
    /*var dailyIndex=loc.indexOf('DailyChallenge');
    if(dailyIndex!=-1)
    {
            $('#dailychallenge').addClass('SubElement');
            for(var i=1;i<10;i++)
            {
                 $('#series'+i).removeClass('MainElement');   
            }
    }*/
   
});
