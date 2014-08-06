/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

var seriesId;

$(document).ready(function(){
    seriesId=$('#seriesId_hidden').val();
     $('#content_player_stats').load('PHP/filter_player_data.php?seriesId='+seriesId);

});

$('#filter_stats1,#filter_stats2,#filter_stats3').change(function(){
    var item1=$('#filter_stats1').val();
    var item2=$('#filter_stats2').val();
    var item3=$('#filter_stats3').val();
    $.post('PHP/filter_player_data.php?seriesId='+seriesId,{item1:item1,item2:item2,item3:item3},
         function(data){
                $('#content_player_stats').empty().html(data);
         });

});