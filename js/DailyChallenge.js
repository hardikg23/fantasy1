// COPYING all data (perform opration on this data)******************************************************
var copyPlayerIDs;
var copyPlayerStyles;
var copyPlayerNames;
var copyPlayerPrices;
var copyPlayerTeams;
var flagPosition;
var NoOfPlayers;
var copyDailyCaptain;
var arrayX=new Array(10,124,238,352,466,580,65,179,293,407,521);
var arrayY=new Array(25,25,25,25,25,25,175,175,175,175,175);
var BUDGET_CONT;
var dailyBudgetVar;


$(document).ready(function()
{
    sid=$('#seriesid').text();
    matchid=$('#matchid').text();
    datetime=$('#timedate').text();
    BUDGET_CONT=parseFloat($('#jsBudget').text());
    initialeleven();
});


// FUNCITION TO lOAD 11 initilally data on page **********************************************************
function initialeleven()
{
    copyPlayerIDs=new Array();
    copyPlayerStyles=new Array();
    copyPlayerNames=new Array();
    copyPlayerPrices=new Array();
    copyPlayerTeams=new Array();
    flagPosition=new Array(0,0,0,0,0,0,0,0,0,0,0);
    dailyBudgetVar=BUDGET_CONT;
    NoOfPlayers=0;
    $('#jsBudget').text(dailyBudgetVar);
    for(var i=0;i<playerIDs.length;i++)
    {
        copyPlayerIDs[i]=playerIDs[i];
        copyPlayerStyles[i]=playerStyles[i];
        copyPlayerNames[i]=playerNames[i];
        copyPlayerPrices[i]=playerPrices[i];
        copyPlayerTeams[i]=playerTeams[i];
    }
    if(playerIDs.length==11)
    {
        for(var index=0;index<11;index++)
        {
            var playerImage="photos/players/"+copyPlayerTeams[index]+"/"+ copyPlayerNames[index]+".jpg"
            colorCode='#0A0E8C';
            footerCode='#262222';
            if(copyPlayerIDs[index]==captain)
            {
                colorCode='#B5080B';
                footerCode='#B5080B';
            }

            $('#container_eleven_player').append("<div class='player-item' id='div"+copyPlayerIDs[index]+"'  style='position: absolute;width: 110px;height: 138px;left: "+arrayX[index]+"px;top: "+arrayY[index]+"px;'>"
                +"<div style='background-color:"+colorCode+";height:18px;' id='Name'><img src='photos/style/style"+copyPlayerStyles[index]+".png' alt='' height='18px' width='18px'><font class='player-name' style='font-size: 10px'>"+copyPlayerNames[index]+"</font></div>"
                +"<div id='Remove_Eleven'><img src='photos/cross.png' alt='' height='18px' width='18px' style='position:absolute;left:92px;top:0;'></div>"
                +"<div id='"+index+"'><img src='"+playerImage+"' alt='Player Image' height='102px' width='110px'></div>"
                +"<div style='position:absolute;top:120;width:100%;height:18px;background-color:"+footerCode+"'></div>"
                +"<div id='Price' style='position:absolute;top:120;color:white;padding-left:4px;'><font style='font-size:12px'>"+copyPlayerPrices[index]+"</font> m</div>"
                +"<div style='position:absolute;top:122;left:80px;color:white;padding-right:4px;'><font style='font-size:12px'>"+copyPlayerTeams[index]+"</font></div>"
                +'</div>');
            flagPosition[index]=1;
        }
        NoOfPlayers=11;
    }
    copyDailyCaptain=captain;
    enter_into_captain(copyPlayerIDs,copyPlayerNames);
    team_balance(copyPlayerStyles);
    hidePlayer(copyPlayerIDs);
}
//*****************************************************************************************************************


//select your captain that takes the captain value**********************************************************
$('#playercaptain').change(function(){
    $('#div'+copyDailyCaptain).css("background-color","blue");
    copyDailyCaptain=$('#playercaptain').val();
    $('#div'+copyDailyCaptain).css("background-color","red");
});
//******************************************************************************************************************


//ENTER DATA IN SELECT TAG OF CAPTAIN**************************************************************************
function enter_into_captain(copyPlayerIDs,copyPlayerNames)
{
    $('#playercaptain').empty();
    for(var index=0;index<copyPlayerIDs.length;index++)
    {
        $('#playercaptain').append("<option value="+copyPlayerIDs[index]+">"+copyPlayerNames[index]+"</option>");
    }

    var capIndex=copyPlayerIDs.indexOf(copyDailyCaptain);
    if(capIndex == -1 && copyPlayerIDs.length > 0)
    {
        copyDailyCaptain=copyPlayerIDs[0];
    }
    if(copyDailyCaptain != '')
        $('#playercaptain option[value='+copyDailyCaptain+']').attr("selected", "selected");
}
//******************************************************************************************************************



//***** RESET button to get initial eleven player*************************************************************************
$('#reset_eleven').click(function()
{
    for(var i=0;i<copyPlayerIDs.length;i++){
        if(copyPlayerIDs[i] != '')
            $('#selection_process #'+copyPlayerIDs[i]+'').css('opacity','1');
    }
    $('#container_eleven_player').empty();
    initialeleven();
});
// ******************************************************************************************************************



//******ON SELECT PLAYER ********************************************************************************************
$("body").on("click", ".select_eleven", function()
{
    var id1=$(this).parents("tr").attr("id");  //alert("id is...."+id1);
    var value1=$("#"+id1).find('td').eq(1).text();  //alert("val1"+value1); //style
    var value2=$("#"+id1).find('td').eq(2).text();   //name
    var value3=$("#"+id1).find('td').eq(3).text();   //team
    // var value4=$("#"+id1).find('td').eq(4).text();   //point
    var value5=$("#"+id1).find('td').eq(5).text();   //price
    var compare_player_id=-1;
    for(var index=0;index<copyPlayerIDs.length;index++)
    {
        if(copyPlayerIDs[index]==jQuery.trim(id1))
        {
            compare_player_id=index;
            break;
        }
    }

    if(NoOfPlayers<11)
    {
        if(compare_player_id==-1)
        {

            // INSERT CODE TO DISPLAY PLAYER in main GRED ****************************************************
            var index_to_insert;
            if(value1 != 5)
                index_to_insert=flagPosition.indexOf(0);
            else if(value1 == 5)
            {
                index_to_insert=flagPosition.lastIndexOf(0);
            }


            dailyBudgetVar+=parseFloat(value5);
            $('#jsBudget').text(dailyBudgetVar);
            var playerImage="photos/players/"+value3+"/"+value2+".jpg"
            colorCode='#0A0E8C';
            footerCode='#262222';
            $('#container_eleven_player').append("<div class='player-item' id='div"+id1+"'  style='position: absolute;width: 110px;height: 138px;left: "+arrayX[index_to_insert]+"px;top: "+arrayY[index_to_insert]+"px;'>"
                +"<div style='background-color:"+colorCode+";height:18px;' id='Name'><img src='photos/style/style"+value1+".png' alt='' height='18px' width='18px'><font class='player-name' style='font-size: 10px'>"+value2+"</font></div>"
                +"<div id='Remove_Eleven'><img src='photos/cross.png' alt='' height='18px' width='18px' style='position:absolute;left:92px;top:0;'></div>"
                +"<div id='"+index_to_insert+"'><img src='"+playerImage+"' alt='Player Image' height='102px' width='110px'></div>"
                +"<div style='position:absolute;top:120;width:100%;height:18px;background-color:"+footerCode+"'></div>"
                +"<div id='Price' style='position:absolute;top:120;color:white;padding-left:4px;'><font style='font-size:12px'>"+value5+"</font> m</div>"
                +"<div style='position:absolute;top:122;left:80px;color:white;padding-right:4px;'><font style='font-size:12px'>"+value3+"</font></div>"
                +'</div>');
            flagPosition[index_to_insert]=1;
            NoOfPlayers++;
            copyPlayerIDs[index_to_insert]=id1;
            copyPlayerStyles[index_to_insert]=value1;
            copyPlayerNames[index_to_insert]=value2+"";
            copyPlayerPrices[index_to_insert]=value5;
            copyPlayerTeams[index_to_insert]=value3+"";
            var captainSendIDs=new Array();
            var captainSendNames=new Array();
            for(var c=0;c<copyPlayerIDs.length;c++)
            {
                if(flagPosition[c] == '1')
                {
                    captainSendIDs.push(copyPlayerIDs[c]);
                    captainSendNames.push(copyPlayerNames[c]);
                }

            }

            enter_into_captain(captainSendIDs,captainSendNames);
            team_balance(copyPlayerStyles);
            hidePlayer(copyPlayerIDs);

        }
        else
        {
            alert("player is already selected");
        }
    }
    else
    {
        alert("11 players are selected");
    }
});



//*********ON REMOVE PLAYER ******************************************************************************
$("body").on("click", "#Remove_Eleven", function()
{
    var id=$(this).parents('div').attr("id");
    var pid=id.substring(3,id.length);
    if(id.length==4)
        idToREMOVE=id.substring(id.length-1,id.length);
    else if(id.length==5)
        idToREMOVE=id.substring(id.length-2,id.length);
    var divName=$("#"+id).find('div').eq(2).attr("id");

    dailyBudgetVar-=parseFloat(copyPlayerPrices[divName]);
    $('#jsBudget').text(dailyBudgetVar);
    copyPlayerIDs[divName]='';
    copyPlayerStyles[divName]='';
    copyPlayerNames[divName]='';
    copyPlayerPrices[divName]='';
    copyPlayerTeams[divName]='';
    flagPosition[divName]=0;
    $('#'+id).remove();
    NoOfPlayers--;



    var captainSendIDs=new Array();
    var captainSendNames=new Array();
    for(var c=0;c<copyPlayerIDs.length;c++)
    {
        if(flagPosition[c] == '1')
        {
            captainSendIDs.push(copyPlayerIDs[c]);
            captainSendNames.push(copyPlayerNames[c]);
        }

    }
    team_balance(copyPlayerStyles);
    showPlayer(pid);
    enter_into_captain(captainSendIDs,captainSendNames);
});
//****************************************************************************************************************************



// TEAM BALANCE FUNCTION **********************************************************************************************
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
function  team_balance(playerstyleIds)
{
    bat=0;
    bowl=0;
    wekeet1=0;
    wekeet2=0;
    all=0;
    for(var i=0;i<playerstyleIds.length;i++)
    {
        if(playerstyleIds[i] == BATSMEN)
            bat=bat+1;                    // bat   >4  AND <6
        else if(playerstyleIds[i]==BATSMEN_WICKETKEEPER)
        {
            if(wekeet2 == 0 && wekeet1 == 0){
                wekeet1=wekeet1+1;
            }
            else{
                bat=bat+1;
            }
        }
        else if(playerstyleIds[i] == WICKETKEEPER)
        {
            if(wekeet1 > 0){
                wekeet1 = 0;
                bat += 1;
            }
            wekeet2 += 1;
        }
        else if(playerstyleIds[i] == ALLROUNDER)   // >1   <2
        {
            all += 1;
        }
        else if(playerstyleIds[i] == BOWLLER)   //  >3    <4
        {
            bowl += 1;
        }
    }

    var players=bat+bowl+all+wekeet1+wekeet2;
    //alert(players);
    if((players != 11) || (bat < BAT_LOWER_LIMIT ) ||
        (wekeet2 > WIC_LIMIT || (wekeet1 == 0 && wekeet2 == 0)) ||
        (bowl < BOL_LOWER_LIMIT) ||
        (all < ALL_LOWER_LIMIT))
        {
        $('#error_message').css("background-color","#0D066A");
        $('#error_message').empty();
        //$('#error_message').append("YOUR TEAM SHOULD HAVE<br> 5 BATMANS, 1 WICKET-KEEPER, 1-2 ALLROUNDER 3-4 BOWLERS")
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
        $('#error_message').empty();
        $('#error_message').append("YOUR TEAM")
        $('#error_message').css("background-color","green").fadeIn();
        return true;

    }
}
//************************************************************************************************************************
//
// UPDATE IN DATA BASE*************************************************************************
$('#save_eleven').click(function(){
    if(team_balance(copyPlayerStyles) && copyDailyCaptain!=null)
    {
      
        sid=$('#seriesid').text();
        matchid=$('#matchid').text();
        datetime=$('#timedate').text();
        //alert(sid+" "+matchid+" "+datetime);
        $.post('PHP/daily_save_eleven_in_database.php',
        {
            input1:copyPlayerIDs[0],
            input2:copyPlayerIDs[1],
            input3:copyPlayerIDs[2],
            input4:copyPlayerIDs[3],
            input5:copyPlayerIDs[4],
            input6:copyPlayerIDs[5],
            input7:copyPlayerIDs[6],
            input8:copyPlayerIDs[7],
            input9:copyPlayerIDs[8],
            input10:copyPlayerIDs[9],
            input11:copyPlayerIDs[10],
            input12:dailyBudgetVar,
            input13:copyDailyCaptain,
            input14:sid,
            input15:matchid,
            input16:datetime
        },
        function(data){
            if(data == 'true')
            {
                alert("TRANSFER ARE MADE SUCCESSFULLY");
                location.reload();
            }else
                alert(data);
        }) ;
    }
    else
    {
        if(!team_balance(copyPlayerStyles))
        {
            alert("Your Team Might not balanced");
        }
        if(copyDailyCaptain==null)
        {
            alert("choose your captain");
        }
    }
});
//*******************************************************************************************************************
//************  HIDE and SHOW PLAYERS FROM LIST ***********
function hidePlayer(playersIDs){
    for(var i=0;i<playersIDs.length;i++){
        if(playersIDs[i] != '')
            $('#selection_process #'+playersIDs[i]+'').css('opacity','0.5');
    //$('#selection_process #'+playersIDs[i]+'').hide();
    }
}
function showPlayer(id){

    $('#selection_process #'+id+'').css('opacity','1');
//$('#selection_process #'+id+'').show();

}
//*******************************************