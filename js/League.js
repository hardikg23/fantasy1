var seriesId;
$(document).ready(function(){
    seriesId=$('#seriesId_hidden').val();
    //alert(seriesId);

});


// LEAGUE CREATION *********************************************************************************
$('#creatLeagueButton').click(function(){
    var name=$('#createLeague_name').val();
    var code=$('#createLeague_code').val();
    //alert(name.length);
    if(name.length <=5 && code.length <=5)
        alert("League Name AND Code Should be more then 5 Cheracter!!!");
    else if(name.length <=5)
        alert("League Name Should be more then 5 Cheracter!!!");
    else if(code.length <=5)
        alert("League Code Should be more then 5 Cheracter!!!");
    else{

        $.post("PHP/createLeague_INSERT.php?seriesId="+seriesId, {cname:name,ccode:code},
        function(data){

            alert(data);
            window.location = "League.php?seriesId="+seriesId;
        });
    }
});


// JOIN LEAGUE *********************************************************************************
$('#joinLeagueButton').click(function(){
    var name=$('#joinLeague_name').val();
    var code=$('#joinLeague_code').val();
    if(name.length <=5 && code.length <=5)
        alert("League Name AND Code Should be more then 5 Cheracter!!!");
    else if(name.length <=5)
        alert("League Name Should be more then 5 Cheracter!!!");
    else if(code.length <=5)
        alert("League Code Should be more then 5 Cheracter!!!");
    else{

        $.post("PHP/createLeague_INSERT.php?seriesId="+seriesId, {jname:name,jcode:code},
        function(data){

            alert(data);
            window.location = "League.php?seriesId="+seriesId;

        });
    }

});



//JOIN IN PUBLIC LEAGUE
$('.joinPublicLeague').click(function(){
   var id=$(this).parents("tr").attr("id");
   ///var value1=$("#"+id).find('td').eq(3).text();
  $.post("PHP/joinORleavePublicLeague.php?seriesId="+seriesId, {action:'join',leagueID:id},
        function(data){
            alert(data);
            window.location = "League.php?seriesId="+seriesId;
    });

});

//LEAVE PUBLIC LEAGUE
$('.leavePublicLeague').click(function(){
   var id=$(this).parents("tr").attr("id");
   ///var value1=$("#"+id).find('td').eq(3).text();
   $.post("PHP/joinORleavePublicLeague.php?seriesId="+seriesId, {action:'leave',leagueID:id},
        function(data){
            alert(data);
            window.location = "League.php?seriesId="+seriesId;
    });
});
