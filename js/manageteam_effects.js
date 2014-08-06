/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

var teamname;
$(document).ready(function(){
    teamname=$('.text-team-name').val();
    var transfer_text_len=$('.transfer-left').text().length;
    if(transfer_text_len>5)
    {
        $('.transfer-left').css('font-size','18px');
    }
    $('#'+captain).addClass('final-eleven-table-captain');
    //$('#'+captain).css('font-weight','bold');
    
    //$('.final-eleven-table-captain').removeClass('final-eleven-table-captain');
});

$('#rester_eleven').click(function(){
    $('.final-eleven-table-captain').removeClass('final-eleven-table-captain');
    $('#'+copyCaptain).addClass('final-eleven-table-captain');
});

$('#captain_player').change(function(){
    $('.final-eleven-table-captain').removeClass('final-eleven-table-captain');
    $('#'+captain).addClass('final-eleven-table-captain');
});

$("body").on("click", ".select_eleven", function() {
    $('#'+captain).addClass('final-eleven-table-captain');
});


$('.button-team-name').click(function(){
   var teamname_change=$('.text-team-name').val();

   if(teamname_change != teamname )
    {
        $.post('PHP/updateTeamName.php', {teamname:teamname_change});
        $('.text-team-name').css('border','1px solid green');
        $('.text-team-name').css('box-shadow', '0px 0px 5px green');
    }
    
});
