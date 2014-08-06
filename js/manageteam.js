var seriesId;
var eleven;
var appendedData;
var splitedData;
var playersIDs;
var playersTeam;
var copyplayersIDs;
var copyappendedData;
var styleIDs;
var splitCaptain=new Array();
var transferVar;
var budgetVar;
var TRANSFER_CONST;
var BUDGET_CONT;
var captain;
var copyCaptain;
var dataOfElevenPlayer;
$(document).ready(function()
{

    seriesId=$('#seriesId_hidden').val();
    if( $('#transfer_left').text() != "UNLIMITED")
     {
        TRANSFER_CONST=parseInt($('#transfer_left').text());
     }
     else if($('#transfer_left').text() == "UNLIMITED")
     {
         TRANSFER_CONST="UNLIMITED";
     }
    BUDGET_CONT=parseFloat($('#budget_left').text());
    set_back_gorund_of_Budget_div(BUDGET_CONT);
    initialize_data();
});

function initialize_data()
{
    appendedData = new Array();
    splitedData = new Array();
    playersIDs = new Array();
    playersTeam = new Array();
    copyplayersIDs=new Array();
    styleIDs = new Array();
    copyappendedData=new Array();
    transferVar=TRANSFER_CONST;
    if(transferVar!="UNLIMITED")
    {
        $('#transfer_left').text(transferVar);
    }

    budgetVar=BUDGET_CONT;

    $('#budget_left').text(budgetVar);
    set_back_gorund_of_Budget_div(budgetVar);

   // $.post('PHP/initial_eleven_player.php?seriesId='+seriesId,
      //  function(data){
            dataOfElevenPlayer=data;
            if(data=='NOTHING')
            {
                $('#final_eleven_selection').empty();
                $('#final_eleven_selection').append("<center>SELECT 11 PLAYERS</center>");
            }
            else
            {
                eleven=data;
                appendedData=data.split("......");
                copyappendedData=data.split("......");
                appendedData.pop();
                copyappendedData.pop();
                appendedData.sort();
                copyappendedData.sort();
                $('#final_eleven_selection').empty();
                $('#final_eleven_selection').append("<tr><th width='13%'></th><th width='47%'>PLAYER</th><th width='11%'>TEAM</th><th width='11%'>POINTS</th><th width='11%'>PRICE</th><th width='8%'></th></tr>");
                for(var index=0;index<appendedData.length;index++)
                {
                    splitedData=appendedData[index].split("@#@");
                    var image="photos/style/style"+splitedData[0]+".png";
                    var teamImage="photos/teamsFlags/"+splitedData[2]+".png";
                    $('#final_eleven_selection').append("<tr align='center' id="+splitedData[5]+">\n\
                            <td><font style='visibility: hidden'>"+splitedData[0]+"</font><img src='"+image+"'></td>\n\
                            <td>"+splitedData[1]+"</td>\n\
                            <td>"+splitedData[2]+"</td>\n\
                            <td>"+splitedData[3]+"</td>\n\
                            <td>"+splitedData[4]+"</td>\n\
                            <td><img id='removeplayer' style='cursor:pointer' class='removeplayer' src='photos/cross.png' height='20px' width='20px'></td>\n\
                            </tr>");
                    styleIDs.push(splitedData[0]);
                    playersIDs.push(splitedData[5]);
                    copyplayersIDs.push(splitedData[5]);
                    playersTeam.push(splitedData[2]);

                }
                //alert("Before team balance");
                captain=parseInt($('#captain').text());
                copyCaptain=captain;
                enter_in_captian_list(appendedData);
                countCountryPlyaer(playersTeam);

                 $('#captain_player option[value='+captain+']').attr("selected", "selected");

                team_balance(styleIDs);
                //alert("After team balance");
		hidePlayer(playersIDs);
            }
       // })
        //copyappendedData = appendedData.slice(0);
}

//******************** RESET BUTTON CLIKED**************************************************************************
$('#rester_eleven').click(function(){
    //initialize_data();

	for(var i=0;i<playersIDs.length;i++)
    	{
        	showPlayer(playersIDs[i]);
    	}

    appendedData = new Array();
    splitedData = new Array();
    playersIDs = new Array();
    playersTeam = new Array();
    copyplayersIDs=new Array();
    styleIDs = new Array();
    copyappendedData=new Array();
    transferVar=TRANSFER_CONST;
    if(transferVar!="UNLIMITED")
    {
        $('#transfer_left').text(transferVar);
    }

    budgetVar=BUDGET_CONT;

    $('#budget_left').text(budgetVar);
    set_back_gorund_of_Budget_div(budgetVar);

            if(dataOfElevenPlayer=='NOTHING')
            {
                $('#final_eleven_selection').empty();
                $('#final_eleven_selection').append("<center>SELECT 11 PLAYERS</center>");
            }
            else
            {
                eleven=dataOfElevenPlayer;
                appendedData=dataOfElevenPlayer.split("......");
                copyappendedData=dataOfElevenPlayer.split("......");
                appendedData.pop();
                copyappendedData.pop();
                appendedData.sort();
                copyappendedData.sort();
                $('#final_eleven_selection').empty();
                $('#final_eleven_selection').append("<tr><th width='13%'></th><th width='47%'>PLAYER</th><th width='11%'>TEAM</th><th width='11%'>POINTS</th><th width='11%'>PRICE</th><th width='8%'></th></tr>");
                for(var index=0;index<appendedData.length;index++)
                {
                    splitedData=appendedData[index].split("@#@");
                     var image="photos/style/style"+splitedData[0]+".png";
                    $('#final_eleven_selection').append("<tr align='center' id="+splitedData[5]+"><td><font style='visibility: hidden'>"+splitedData[0]+"</font><img src='"+image+"'></td><td>"+splitedData[1]+"</td><td>"+splitedData[2]+"</td><td>"+splitedData[3]+"</td><td>"+splitedData[4]+"</td><td><img id='removeplayer' class='removeplayer' style='cursor:pointer' src='photos/cross.png' height='20px' width='20px'></td></td></tr>");
                    styleIDs.push(splitedData[0]);
                    playersIDs.push(splitedData[5]);
                    copyplayersIDs.push(splitedData[5]);
                    playersTeam.push(splitedData[2]);

                }
                //alert("Before team balance");
                captain=parseInt($('#captain').text());
                copyCaptain=captain;
                enter_in_captian_list(appendedData);
                countCountryPlyaer(playersTeam);

                 $('#captain_player option[value='+captain+']').attr("selected", "selected");

                team_balance(styleIDs);
		hidePlayer(playersIDs);
                //alert("After team balance");
            }
});
//*****************************************************************************************************************


// ********************** ALERT if TRANSFER LEFT is less then 0***************************************************
$('.save_modalID').click(function(){
    if(transferVar<0)
        alert("Now for "+(transferVar*-1)+" transfer(s) your "+(transferVar*100)+" points will be deducted from your total points");

});

//*********************************************************************************************************


//********************** SAVE BUTTON CLIKED ***********************************************************************
$('#save_eleven').click(function(){


    var validating_team=team_balance(styleIDs);
    var captain=$('#captain_player').val();     //CAPTAIN
    if(validating_team &&  budgetVar>=0)
    {
        $('#save_eleven').css('opacity','0.5');
        $('#save_eleven').attr("disabled", "disabled");
        $.post('PHP/Save_eleven_in_database.php?seriesId='+seriesId,
        {
            input1:playersIDs[0],
            input2:playersIDs[1],
            input3:playersIDs[2],
            input4:playersIDs[3],
            input5:playersIDs[4],
            input6:playersIDs[5],
            input7:playersIDs[6],
            input8:playersIDs[7],
            input9:playersIDs[8],
            input10:playersIDs[9],
            input11:playersIDs[10],
            input12:budgetVar,
            input13:transferVar,
            input14:captain

        },
        function(data){
            alert(data);
            playerStatsUpdate();   // TO INCREASE and DECREAS PLAYERS COUNT.....
            window.location = "ManageTeam.php?seriesId="+seriesId;
         }) ;
    }
    else
    {
        if(!validating_team && budgetVar<0)
        {
            alert("YOUR TEAM IS NOT BALANCED and YOUR TEAM VALUE IS MORE THAN 100m$");
        }
        else if(!validating_team)
            alert("YOUR TEAM IS NOT BALANCED");
        else if(budgetVar<0)
            alert("YOUR TEAM VALUE IS MORE THAN 100m$");
    }

});
// ***************************************************************************************************************


// ************** FUNCTION to ++ and -- player count(SELECTED BY) users
function playerStatsUpdate(){
    var playerStatsUpdateIN="";   // PLAYER WHO ARE IN IN TREANSFER
    var playerStatsUpdateOUT="";   // PLAYER WHO ARE IN IN TREANSFER
    for(var i=0;i<playersIDs.length-1;i++)
    {
        playerStatsUpdateIN+=playersIDs[i]+"#@#";
        playerStatsUpdateOUT+=copyplayersIDs[i]+"#@#";
    }
    playerStatsUpdateIN+=playersIDs[i];
    playerStatsUpdateOUT+=copyplayersIDs[i];
    $.post('PHP/playerData_statsUpdate_SELECTEDBY.php?seriesId='+seriesId,
        {
            input1:playerStatsUpdateIN,
            input2:playerStatsUpdateOUT
        }) ;
    }


//   PLAYER SELECTION   FUNCTION **********************************************************************
$("body").on("click", ".select_eleven", function()
{
    var id1=$(this).parents("tr").attr("id");  //alert("id is...."+id1);
    var value1=$("#"+id1).find('td').eq(1).text();  //alert("val1"+value1); //type
    var value2=$("#"+id1).find('td').eq(2).text();   //name
    var value3=$("#"+id1).find('td').eq(3).text();   //team
    var value4=$("#"+id1).find('td').eq(4).text();   //point
    var value5=$("#"+id1).find('td').eq(5).text();   //price

    var data=jQuery.trim(value1)+"@#@"+jQuery.trim(value2)+"@#@"+jQuery.trim(value3)+"@#@"+jQuery.trim(value4)
    +"@#@"+jQuery.trim(value5)+"@#@"+jQuery.trim(id1);

    var compare_player_id=playersIDs.indexOf(jQuery.trim(id1));
    if(playersIDs.length<11)
    {
        if(compare_player_id==-1)
        {
            appendedData.push(data);
            appendedData.sort();
            $('#final_eleven_selection').empty();
            $('#final_eleven_selection').append("<tr><th width='13%'></th><th width='47%'>PLAYER</th><th width='11%'>TEAM</th><th width='11%'>POINTS</th><th width='11%'>PRICE</th><th width='8%'></th></tr>");
            for(var index=0;index<appendedData.length;index++)
            {
                splitedData=appendedData[index].split("@#@");
                 var image="photos/style/style"+splitedData[0]+".png";
                $('#final_eleven_selection').append("<tr align='center' id="+splitedData[5]+"><td><font style='visibility: hidden'>"+splitedData[0]+"</font><img src='"+image+"'></td><td>"+splitedData[1]+"</td><td>"+splitedData[2]+"</td><td>"+splitedData[3]+"</td><td>"+splitedData[4]+"</td><td><img id='removeplayer' class='removeplayer' style='cursor:pointer' src='photos/cross.png' height='20px' width='20px'></td></td></tr>");

            }
             $('#'+id1).hide().fadeIn(400);


            // CODE for budget AND transfer change****************************************************************
            var left=parseFloat(value5);
            budgetVar-=left;
            $('#budget_left').text(budgetVar);
            set_back_gorund_of_Budget_div(budgetVar);

            if(copyplayersIDs.indexOf(id1) == -1 && transferVar!="UNLIMITED")
            {
                transferVar-=1;
                $('#transfer_left').text(transferVar);
            }

            //*****************************************************************************************************


            playersIDs.push(jQuery.trim(id1));
            playersTeam.push(jQuery.trim(value3));
            styleIDs.push(jQuery.trim(value1));
            enter_in_captian_list(appendedData);   //Append player in captiain SELECT
            countCountryPlyaer(playersTeam);
            $('#captain_player option[value='+captain+']').attr("selected", "selected");
            team_balance(styleIDs);     //to check balance of team
	     hidePlayer(playersIDs);

        }
        else
        {
            alert("Player is already selected");
        }
    }else
    {
        alert("11 Players are selected");
    }

});
// *********************************************************************************************************


//   PLAYER REMOVE FUNCTION ********************************************************************************
$("body").on("click", "#removeplayer", function()
{
    //playersIDs.sort();
    var id2=$(this).parents('tr').attr("id");
    //alert(id2);//alert("id is...."+id1);
    var playerstyle=$("#"+id2).find('td').eq(0).first('font').text();  //alert("val1"+value1); //type
    var playername=$("#"+id2).find('td').eq(1).text();   //name
    var playercountry=$("#"+id2).find('td').eq(2).text();   //team
    var playerpoint=$("#"+id2).find('td').eq(3).text();   //point
    var playerprice=$("#"+id2).find('td').eq(4).text();   //price
    var playerdata=jQuery.trim(playerstyle)+"@#@"+jQuery.trim(playername)+"@#@"+jQuery.trim(playercountry)+"@#@"+jQuery.trim(playerpoint)
    +"@#@"+jQuery.trim(playerprice)+"@#@"+jQuery.trim(id2);
    var playerindex=appendedData.indexOf(playerdata);
    appendedData.splice(playerindex, 1);
    var pidindex=playersIDs.indexOf(id2);
    playersIDs.splice(pidindex, 1);
    styleIDs.splice(pidindex, 1);
    playersTeam.splice(pidindex, 1);
    $('#'+id2).remove();
    //$('#'+id2).fadeOut(400,function() {$(this).remove();});


    // CODE for budget AND transfer change***************************************************************
    budgetVar+=parseFloat(playerprice);
    $('#budget_left').text(budgetVar);
     set_back_gorund_of_Budget_div(budgetVar);
     if(copyplayersIDs.indexOf(id2) == -1 && transferVar!="UNLIMITED")
            {
                transferVar+=1;
                $('#transfer_left').text(transferVar);
            }
     //*******************************************************************************************************

     enter_in_captian_list(appendedData);
     countCountryPlyaer(playersTeam);
     $('#captain_player option[value='+captain+']').attr("selected", "selected");
     team_balance(styleIDs);
	showPlayer(id2);
    });
//******************************************************************************************************************



//var bat=0,bowl=0,wekeet1=0,wekeet2=0,all=0;
var BATSMEN = 1;
var BATSMEN_WICKETKEEPER = 2;
var WICKETKEEPER = 3;
var ALLROUNDER = 4;
var BOWLLER = 5;
var BAT_LOWER_LIMIT = 4;
//var BAT_UPPER_LIMIT = 5;
var BOL_LOWER_LIMIT = 2;
//var BOL_UPPER_LIMIT = 4;
var ALL_LOWER_LIMIT = 2;
//var ALL_UPPER_LIMIT = 2;
//var BOWL_ALLROUNDER_LIMIT = 5;
var WIC_LIMIT = 1;

function  team_balance(styleIDs)
{
    bat=0;bowl=0;wekeet1=0;wekeet2=0;all=0;
    for(var i=0;i<styleIDs.length;i++)
    {
        if(styleIDs[i] == BATSMEN)
            bat=bat+1;                    // bat   >4  AND <6
        else if(styleIDs[i]==BATSMEN_WICKETKEEPER)
        {
            if(wekeet2 == 0 && wekeet1 == 0){
                wekeet1=wekeet1+1;
            }
            else{
                bat=bat+1;
            }
        }
        else if(styleIDs[i] == WICKETKEEPER)
        {
            if(wekeet1 > 0){
                wekeet1 = 0;
                bat += 1;
            }
            wekeet2 += 1;
        }
        else if(styleIDs[i] == ALLROUNDER)   // >1   <2
        {
            all += 1;
        }
        else if(styleIDs[i] == BOWLLER)   //  >3    <4
        {
            bowl += 1;
        }
    }

    if((styleIDs.length != 11) || (bat < BAT_LOWER_LIMIT ) ||
        (wekeet2 > WIC_LIMIT || (wekeet1 == 0 && wekeet2 == 0)) ||
        (bowl < BOL_LOWER_LIMIT) ||
        (all < ALL_LOWER_LIMIT))
        {
        $('#error_message').css("background-color","#0D066A");
        //$('#error_message').empty().append("<center>Minimum 4 Batsmen,1 Keeper,Minimum 2 Allrounders,Minimum 2 Bowlers</center>");
         $('#error_message').empty().append("<table width='100%' style='font-size:10px;font-weight: bold;color: white'>"+
            "<tr><th>Batsmen</th><th>Keeper</th><th>All-rounders</th><th>Bowlers</th></tr> "+
            "<tr>"+
                "<td align='center'><img src='photos/jerseys/Jred.png' class='jB1' width='17px' height='22px'>"+
                "<img src='photos/jerseys/Jred.png' width='17px' class='jB2' height='22px'>"+
                "<img src='photos/jerseys/Jred.png' width='17px' class='jB3' height='22px'>"+
                "<img src='photos/jerseys/Jred.png' width='17px' class='jB4' height='22px'>"+
                "<img src='photos/jerseys/Jwhite.png' width='17px' class='jB5' height='22px'>"+
                "<img src='photos/jerseys/Jwhite.png' width='17px' class='jB6' height='22px'></td>"+

                "<td align='center'><img src='photos/jerseys/Jred.png' class='jW' width='17px' height='22px'></td>"+

                "<td align='center'><img src='photos/jerseys/Jred.png' class='jA1' width='17px' height='22px'>"+
                "<img src='photos/jerseys/Jred.png' width='17px' class='jA2' height='22px'>"+
                "<img src='photos/jerseys/Jwhite.png' width='17px' class='jA3' height='22px'>"+
                "<img src='photos/jerseys/Jwhite.png' width='17px' class='jA4' height='22px'></td>"+

                "<td align='center'><img src='photos/jerseys/Jred.png' class='jO1' width='17px' height='22px'>"+
                "<img src='photos/jerseys/Jred.png' class='jO2' width='17px' height='22px'>"+
                "<img src='photos/jerseys/Jwhite.png' class='jO3' width='17px' height='22px'>"+
                "<img src='photos/jerseys/Jwhite.png' class='jO4' width='17px' height='22px'></td>"+
            "</tr>"+
            "</table>");

            if(wekeet2 == 1 || wekeet1 == 1)
                $('.jW').attr("src","photos/jerseys/Jgreen.png");

            for(var batJ=1;batJ<=bat;batJ++)
                $('.jB'+batJ).attr("src","photos/jerseys/Jgreen.png");

            for(var batJ=1;batJ<=all;batJ++)
                $('.jA'+batJ).attr("src","photos/jerseys/Jgreen.png");

            for(var batJ=1;batJ<=bowl;batJ++)
                $('.jO'+batJ).attr("src","photos/jerseys/Jgreen.png");



        return false;
    }
    else{
        $('#error_message').css("background-color","green").fadeIn();
        $('#error_message').empty().append("<center>YOUR TEAM LOOKS PERFECT</center>");

        return true;

    }
}




function set_back_gorund_of_Budget_div(budgetVar)
{
    if(budgetVar < 0)
        $('#budget_left').css('background-color','red');
    else
        $('#budget_left').css('background-color','green');

}


function enter_in_captian_list(appendedData)
{
     // ************   To add DATA in CAPTION SELECTION *******************************************
       //  $('#captain_player').empty();

       $('#captain_player').empty();
        for(var index=0;index<appendedData.length;index++)
        {
            splitCaptain=appendedData[index].split("@#@");
            //alert(splitedData[5]);

            $('#captain_player').append("<option value="+splitCaptain[5]+">"+splitCaptain[1]+"</option>");
        }



        // *************************************************************************************************
}



// ***************** CHANGEING CAPTAIN ******************************************************************************
$('#captain_player').change(function(){
    captain=$('#captain_player').val();
});
// ******************************************************************************************************************


//************  HIDE and SHOW PLAYERS FROM LIST ***********
function hidePlayer(playersIDs){
    for(var i=0;i<playersIDs.length;i++){
        $('#selection_process #'+playersIDs[i]+'').css('opacity','0.5');
        //$('#selection_process #'+playersIDs[i]+'').hide();
    }
}
function showPlayer(id){

    $('#selection_process #'+id+'').css('opacity','1');
    //$('#selection_process #'+id+'').show();

}
//*******************************************


//************  count county players ***********
function countCountryPlyaer(playersTeam){
   //divs = jQuery.unique( playersTeam );
   //$('.count-country').append(divs);
   var count=new Array();
   var countIndex=new Array();
   for(var i=0;i<playersTeam.length;i++){
       if(count.indexOf(playersTeam[i], 0) == -1)
       {
           count.push(playersTeam[i]);
       }
   }

   for(var i=0;i<count.length;i++){
       countIndex.push(0);
   }

   for(var i=0;i<playersTeam.length;i++){
       var index=count.indexOf(playersTeam[i], 0);
       countIndex[index] += 1;
   }

   $('.count-country-table').empty();
   $('.count-country-table').append('<tr>');
   for(var i=0;i<count.length;i++){
       var img='<img src=\'photos/teamsFlags/min/'+ count[i] + '.jpg\' border=1px width=24px height=18px alt='+count[i]+'>';
    $('.count-country-table').append('<td align="center" style="padding-top:2px;padding-botton:3px;border-left: 1px solid #929292;border-right: 1px solid #929292;border-top: 1px solid #929292;border-bottom: 1px solid #929292;"><b>'+ countIndex[i]+'</b>&nbsp;'+img+'</td>');
   }
   $('.count-country-table').append('</tr>');


}
//*******************************************