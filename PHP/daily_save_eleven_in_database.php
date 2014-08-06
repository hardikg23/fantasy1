<?php

    include 'includes/database_connectivity_includes.php';
       session_start();

        include 'includes/session_setter.php';
        include 'includes/seriedId_setter.php';
       $s='';
        if (isset($_POST['input1']) && isset($_POST['input2']) &&
        isset($_POST['input3']) && isset($_POST['input4']) && isset($_POST['input5'])
        && isset($_POST['input6']) && isset($_POST['input7']) && isset($_POST['input8'])
        && isset($_POST['input9']) && isset($_POST['input10']) && isset($_POST['input11'])
        && isset($_POST['input12']) && isset($_POST['input13']) && isset($_POST['input14'])
                && isset($_POST['input15'])&& isset($_POST['input16'])) 
        {

            if (!empty($_POST['input1'])
            && !empty($_POST['input2'])
            && !empty($_POST['input3'])
            && !empty($_POST['input4'])
            && !empty($_POST['input5'])
            && !empty($_POST['input6'])
            && !empty($_POST['input7'])
            && !empty($_POST['input8'])
            && !empty($_POST['input9'])
            && !empty($_POST['input10'])
            && !empty($_POST['input11'])
            && !empty($_POST['input14'])
            && !empty($_POST['input15'])
            && !empty($_POST['input16']))
            {
                $player1=  mysql_real_escape_string(htmlentities($_POST['input1']));
                $player2=  mysql_real_escape_string(htmlentities($_POST['input2']));
                $player3=  mysql_real_escape_string(htmlentities($_POST['input3']));
                $player4=  mysql_real_escape_string(htmlentities($_POST['input4']));
                $player5=  mysql_real_escape_string(htmlentities($_POST['input5']));
                $player6=  mysql_real_escape_string(htmlentities($_POST['input6']));
                $player7=  mysql_real_escape_string(htmlentities($_POST['input7']));
                $player8=  mysql_real_escape_string(htmlentities($_POST['input8']));
                $player9=  mysql_real_escape_string(htmlentities($_POST['input9']));
                $player10= mysql_real_escape_string(htmlentities($_POST['input10']));
                $player11= mysql_real_escape_string(htmlentities($_POST['input11']));
                $budget =  mysql_real_escape_string(htmlentities($_POST['input12']));
                $cap =  mysql_real_escape_string(htmlentities($_POST['input13']));
                $sid =  mysql_real_escape_string(htmlentities($_POST['input14']));
                $matchid =  mysql_real_escape_string(htmlentities($_POST['input15']));
                $matchdatetime =  mysql_real_escape_string(htmlentities($_POST['input16']));
                $todaydatetime=date("Y-m-d H:i:s");

                if($todaydatetime > $matchdatetime){
                    echo 'Time Over! Match has been started';
                }else{
                $s='s'.$sid.'_player_data';
                
                $ResultSet_to_find_player_Info=mysql_query("select player1,player2,player3,player4,player5,player6,
                                            player7,player8,player9,player10,player11,captain from daily_challenge_eleven_player
                                            where user_email='$session_email'&& sid= $sid && matchid= $matchid && timeAnddate= '$matchdatetime'
                                            ORDER BY last_modified DESC LIMIT 1");
                
                
                
                 $length=mysql_field_len($ResultSet_to_find_player_Info,0);
                 $no_rows= mysql_num_rows($ResultSet_to_find_player_Info);
            
                if($no_rows==0) 
                {
                    //Insert into database if there is a new user..................................
                    if(teamCountAndCaptain($sid,$player1,$player2,$player3,$player4,$player5,$player6,$player7,$player8,$player9,$player10,$player11,$cap) &&
                        balance_team($sid,$player1,$player2,$player3,$player4,$player5,$player6,$player7,$player8,$player9,$player10,$player11)&&
                        budget_validation($sid,$player1,$player2,$player3,$player4,$player5,$player6,$player7,$player8,$player9,$player10,$player11,$budget))
                        {
                            //echo 'valid';
                            if($result_username_userid=  mysql_query("SELECT user_id,user_name,user_team_name from
                                        users_data where user_email='$session_email' LIMIT 1")){
                                
                                if(mysql_num_rows($result_username_userid)==1)
                                {
                                    $user_id=mysql_result($result_username_userid, 0,'user_id');
                                    $user_name=mysql_real_escape_string(htmlentities(mysql_result($result_username_userid, 0,'user_name')));
                                    $user_team_name=  mysql_real_escape_string(htmlentities(mysql_result($result_username_userid, 0,'user_team_name')));
                                   
                                    //echo 'name='.$user_name.'id=='.$user_id;
                                }

                                $query_insert_user_team_into_database="insert into daily_challenge_eleven_player values('',$user_id,$sid,$matchid,'$matchdatetime','$session_email','$user_name',
                                        $player1,$player2,$player3,$player4,$player5,$player6,$player7,$player8,$player9,$player10,$player11,$cap,$budget,'$user_team_name','','$todaydatetime')";
                                mysql_query($query_insert_user_team_into_database)or die(mysql_error());

                                echo 'true';
                            }else{
                                echo 'Something has been gone wrong while retriving your data.';
                            }
                        }
                    else
                    {
                        echo 'Something has been gone wrong.';
                    }
                } 
                else 
                {
                    //update the database of the particular user.................................
                    if(teamCountAndCaptain($sid,$player1,$player2,$player3,$player4,$player5,$player6,$player7,$player8,$player9,$player10,$player11,$cap) &&
                        balance_team($sid,$player1,$player2,$player3,$player4,$player5,$player6,$player7,$player8,$player9,$player10,$player11)&&
                        budget_validation($sid,$player1,$player2,$player3,$player4,$player5,$player6,$player7,$player8,$player9,$player10,$player11,$budget))
                        {
                            $query_update_user_team_into_database="UPDATE daily_challenge_eleven_player 
                                                        SET player1=$player1, player2=$player2, player3=$player3, 
                                                        player4=$player4, player5=$player5,
                                                        player6=$player6, player7=$player7, player8=$player8, player9=$player9, 
                                                        player10=$player10, player11=$player11, captain=$cap, budget=$budget,
                                                        last_modified='$todaydatetime' 
                                                        WHERE user_email='$session_email'&& sid= $sid && matchid= $matchid && timeAnddate= '$matchdatetime'";
                                if(mysql_query($query_update_user_team_into_database))
                                    echo 'true';
                                else
                                    echo 'Some Error ocuured while updating Please try again leter';
                        }
                    else
                    {
                        echo 'Something has been gone wrong';
                    }
               }
            }
         }
   }



// FUNCTION TO check BALANCE OF TEAM ************************************************************
function balance_team($seriesId,$player1,$player2,$player3,$player4,$player5,$player6,$player7,$player8,$player9,$player10,$player11) {
    $table='s'.$seriesId.'_player_data';
    $resultSet=mysql_query("SELECT style from $table
                where id IN ($player1,$player2,$player3,$player4,$player5,$player6,$player7,$player8,$player9,$player10,$player11)");

    $styleIDs=array();
    $countId=0;
    while($row=mysql_fetch_array($resultSet)) {
        $style=mysql_real_escape_string($row['style']);
        $styleIDs[$countId]=$style;
        $countId++;
    }

    $bat=0;
    $bowl=0;
    $wekeet1=0;
    $wekeet2=0;
    $all=0;

    $BATSMEN = 1;
    $BATSMEN_WICKETKEEPER = 2;
    $WICKETKEEPER = 3;
    $ALLROUNDER = 4;
    $BOWLLER = 5;
    $BAT_LOWER_LIMIT = 4;
    //$BAT_UPPER_LIMIT = 5;
    $BOL_LOWER_LIMIT = 2;
    //$BOL_UPPER_LIMIT = 4;
    $ALL_LOWER_LIMIT = 2;
    //$ALL_UPPER_LIMIT = 2;
    //$BOWL_ALLROUNDER_LIMIT = 5;
    $WIC_LIMIT = 1;


    for($i=0;$i<count($styleIDs);$i++) {
        if($styleIDs[$i] == $BATSMEN)
            $bat=$bat+1;                    // bat   >4  AND <6
        else if($styleIDs[$i]==$BATSMEN_WICKETKEEPER) {
            if($wekeet2 == 0 && $wekeet1 == 0) {
                $wekeet1=$wekeet1+1;
            }
            else {
                $bat=$bat+1;
            }
        }
        else if($styleIDs[$i] == $WICKETKEEPER) {
            if($wekeet1 > 0) {
                $wekeet1 = 0;
                $bat += 1;
            }
            $wekeet2 += 1;
        }
        else if($styleIDs[$i] == $ALLROUNDER)   // >1   <2
        {
            $all += 1;
        }
        else if($styleIDs[$i] == $BOWLLER)   //  >3    <4
        {
            $bowl += 1;
        }
    }
    /*
     * if((styleIDs.length != 11) || (bat < BAT_LOWER_LIMIT ) ||
        (wekeet2 > WIC_LIMIT || (wekeet1 == 0 && wekeet2 == 0)) ||
        (bowl < BOL_LOWER_LIMIT ) ||
        (all < ALL_LOWER_LIMIT) ||
        (bowl < BOL_LOWER_LIMIT))
     *
     *
     */

    if((count($styleIDs)!= 11) || ($bat < $BAT_LOWER_LIMIT) ||
            ($wekeet2 > $WIC_LIMIT || ($wekeet1 == 0 && $wekeet2 == 0)) ||
            ($bowl < $BOL_LOWER_LIMIT) ||
            ($all < $ALL_LOWER_LIMIT)) {
        return false;
    }
    else {
        //echo 'TEAM BALANCED...';
        return true;
    }
}
//************************************************************************************************


function teamCountAndCaptain($sid,$player1,$player2,$player3,$player4,$player5,$player6,$player7,$player8,$player9,$player10,$player11,$cap) {

    $table='s'.$sid.'_player_data';
    $noOfPlayerInTeam=mysql_query("SELECT count(id) from $table
                  where id IN ($player1,$player2,$player3,$player4,$player5,$player6,$player7,$player8,$player9,$player10,$player11)");
    $count=mysql_result($noOfPlayerInTeam, 0, 0);
    //echo 'counttttt='.$count;
    $captainSelection=mysql_query("SELECT count(id) from $table
                  where id = $cap");
    $countCaptain=mysql_result($captainSelection, 0, 0);
    //echo 'countCaptain==='.$countCaptain;
    if($count == 11 && $countCaptain==1) {
        if($cap==$player1 || $cap==$player2 || $cap==$player3 || $cap==$player4
                || $cap==$player5 || $cap==$player6 || $cap==$player7 || $cap==$player8
                || $cap==$player9 || $cap==$player10 || $cap==$player11)
        {
            //echo 'countCaptain==='.$countCaptain;
            return true;
        }
        else
            return false;
    }
    else
        return false;
}


function budget_validation($sid,$player1,$player2,$player3,$player4,$player5,$player6,$player7,$player8,$player9,$player10,$player11,$budget)
{
    $table='s'.$sid.'_player_data';
    $query1=  mysql_query("select sum(price) from $table where id IN ($player1,$player2,$player3,$player4,$player5,$player6,$player7,$player8,$player9,$player10,$player11)");
    $totalbudget=mysql_result($query1, 0, 0);
    if($totalbudget==$budget)
    {
        return true;
    }
    else 
    {
        return false;
    }
}

?>
