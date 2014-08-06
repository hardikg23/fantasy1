<?php


include 'includes/database_connectivity_includes.php';
session_start();

include 'includes/session_setter.php';
include 'includes/seriedId_setter.php';

$s = 's'.$seriesId .'_player_data';
$table='s'.$seriesId.'_user_eleven';
$tableData='s'.$seriesId.'_user_eleven_data';
$transferShcema='s'.$seriesId.'_transfer_schema';
if (isset($_SESSION['email'])&&isset($_SESSION['password'])&&isset($_POST['input1']) && isset($_POST['input2']) &&
        isset($_POST['input3']) && isset($_POST['input4']) && isset($_POST['input5'])
        && isset($_POST['input6']) && isset($_POST['input7']) && isset($_POST['input8'])
        && isset($_POST['input9']) && isset($_POST['input10']) && isset($_POST['input11'])
        && isset($_POST['input12']) && isset($_POST['input13']) && isset($_POST['input14'])) {

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
            && !empty($_POST['input14'])) {


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
        $transfers =  mysql_real_escape_string(htmlentities($_POST['input13']));
        $captain =  mysql_real_escape_string(htmlentities($_POST['input14']));
        $datetime=date("Y-m-d H:i:s");


        
        if(teamCountAndCaptain($seriesId,$player1,$player2,$player3,$player4,$player5,$player6,$player7,$player8,$player9,$player10,$player11,$captain) &&
           balance_team($seriesId,$player1,$player2,$player3,$player4,$player5,$player6,$player7,$player8,$player9,$player10,$player11) &&
           budget($seriesId,$player1,$player2,$player3,$player4,$player5,$player6,$player7,$player8,$player9,$player10,$player11,$budget)  &&
           transfer($seriesId,$player1,$player2,$player3,$player4,$player5,$player6,$player7,$player8,$player9,$player10,$player11,$transfers,$datetime,$session_email))
           {
            // To get USER_ID and USER_NAME *****************************************************************************
            $result_username_userid=  mysql_query("SELECT user_id,user_name from
                                        users_data where user_email='$session_email' LIMIT 1");
            if(mysql_num_rows($result_username_userid)==1) {
                $user_id=mysql_result($result_username_userid, 0,'user_id');
                 $user_name=  mysql_real_escape_string(htmlentities(mysql_result($result_username_userid, 0,'user_name')));
            }
            // *************************************************************************************************************



            // ********** TO GET Transfer Schema deta*********************************************************************
            $transferLeftString='LIMITED';$transferLeft=0;
            if($resultset_find_transfer_string=mysql_query("select tLeft,tLeftString from $transferShcema where '$datetime'<=toDate LIMIT 1") or die(mysql_error()))
            {
                @$transferLeft=mysql_result($resultset_find_transfer_string, 0,'tLeft');
                @$transferLeftString=mysql_result($resultset_find_transfer_string, 0,'tLeftString');
            }
            //*************************************************************************************************************


            // To INSERT TRANSFER MODIFICATION in DATABASE**************************************************************
            $userTeamName="";
            if($result_username_useridto_get_team_name=  mysql_query("SELECT user_team_name from users_data where user_email='$session_email'"))
            {
                $userTeamName=  mysql_real_escape_string(htmlentities(mysql_result($result_username_useridto_get_team_name, 0)));
            }
            
            
            $query_insert_Main_into_database="insert into $table values('',$user_id,'$session_email','$user_name',
                    $player1,$player2,$player3,$player4,$player5,$player6,$player7,$player8,$player9,$player10,$player11,$captain,'$userTeamName','$datetime')";
            //*************************************************************************************************************



            $result_find_data_budget=mysql_query("select * from $tableData where user_email='$session_email' LIMIT 1");

            if(mysql_num_rows($result_find_data_budget)==0) {
                $query_insert_into_database="insert into $tableData values('','$session_email',0,$transferLeft,$budget,'$datetime')";

                //echo 'Values Inserted in Transfer 0 table *****************************';
                mysql_query($query_insert_into_database);
                mysql_query($query_insert_Main_into_database);
                
            }
            else if(mysql_num_rows($result_find_data_budget)==1) {
                if($transferLeftString=='UNLIMITED') {
                    $query_insert_into_database="UPDATE $tableData
                                                SET budget_left=$budget,last_modified='$datetime',transfer_left=$transferLeft
                                                WHERE user_email='$session_email'";
                    
                    //echo 'Values Inserted in Transfer 1 UNLIMITED table **********************';
                    mysql_query($query_insert_into_database);
                    mysql_query($query_insert_Main_into_database);
                    
                }
                else if($transferLeftString=='LIMITED' && $transfers>=0) {
                    $query_insert_into_database="UPDATE $tableData
                                                SET budget_left=$budget,last_modified='$datetime',transfer_left=$transfers
                                                WHERE user_email='$session_email'";

                    //echo 'Values Inserted in Transfers LIMITED table **************************';
                    mysql_query($query_insert_into_database);
                    mysql_query($query_insert_Main_into_database);
                    
                    $starTable='s'.$seriesId.'_star';
                    $pointsTransfers=($transferLeft-$transfers)*10;
                    mysql_query("update $starTable SET total_star=total_star-m_transfer, m_transfer=$pointsTransfers, total_star=total_star+m_transfer where user_email='$session_email' ");
                    
                   
                }
                else if($transferLeftString=='LIMITED' && $transfers<0 ) { // to deduct 100 points if transfers is less the 0
                    $query_insert_into_database="UPDATE $tableData
                                                SET budget_left=$budget,last_modified='$datetime',transfer_left=0,user_points=user_points+(100*$transfers)
                                                WHERE user_email='$session_email'";
                    
                    //echo 'Values Inserted in Transfers LIMITED table **************************';
                    mysql_query($query_insert_into_database);
                    mysql_query($query_insert_Main_into_database);
                    
                    $starTable='s'.$seriesId.'_star';
                    $pointsTransfers=($transferLeft-$transfers)*10;
                    mysql_query("update $starTable SET total_star=total_star-m_transfer, m_transfer=$pointsTransfers, total_star=total_star+m_transfer where user_email='$session_email' ");
                    
                    
                }
                else
                    echo 'Something went wrong When Updating Transfers Information';
            }
            else
                echo 'Something went wrong When Updating Transfers Information';


            
            echo 'Your Transfers are Updated';
        }
        else // VALIDATION else ************************************************************
        {
            echo 'Somting went wrong while updating.';
        }
    }
    else    // EMPTY else  *******************************************************
    {
        echo 'Something went wrong. Try again leter';
    }

}
else       // ISSET else *******************************************************
{
    echo 'Something went wrong. Try again leter';
}





// FUNCTION TO check No OF Player in TEAM And CAPTAIN ********************************************************
function teamCountAndCaptain($seriesId,$player1,$player2,$player3,$player4,$player5,$player6,$player7,$player8,$player9,$player10,$player11,$captain) {

    $table='s'.$seriesId.'_player_data';
    $noOfPlayerInTeam=mysql_query("SELECT count(id) from $table
                  where id IN ($player1,$player2,$player3,$player4,$player5,$player6,$player7,$player8,$player9,$player10,$player11)");
    $count=mysql_result($noOfPlayerInTeam, 0, 0);

    $captainSelection=mysql_query("SELECT count(id) from $table
                  where id = $captain");
    $countCaptain=mysql_result($captainSelection, 0, 0);
    if($count == 11 && $countCaptain==1) {
        if($captain==$player1 || $captain==$player2 || $captain==$player3 || $captain==$player4
                || $captain==$player5 || $captain==$player6 || $captain==$player7 || $captain==$player8
                || $captain==$player9 || $captain==$player10 || $captain==$player11)
            {
                return true;
            }
        else
            return false;
    }
    else
        return false;
}
//************************************************************************************************

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


// FUNCTION TO check BUDGET
function budget($seriesId,$player1,$player2,$player3,$player4,$player5,$player6,$player7,$player8,$player9,$player10,$player11,$budget) {
    $table='s'.$seriesId.'_player_data';
    $resultSet=mysql_query("SELECT sum(price) from $table
                where id IN ($player1,$player2,$player3,$player4,$player5,$player6,$player7,$player8,$player9,$player10,$player11)");
    $total_used=mysql_result($resultSet, 0, 0)+0.0;
    if($total_used<=100.0)
     { return true;
     }
    else
        {
            return false;
        }
}
//*****



// FUNCTION TO check TRANSFER
function transfer($seriesId,$player1,$player2,$player3,$player4,$player5,$player6,$player7,$player8,$player9,$player10,$player11,$transfers,$datetime,$session_email) {
    $transferShcema='s'.$seriesId.'_transfer_schema';
    $tableData='s'.$seriesId.'_user_eleven_data';
    $table='s'.$seriesId.'_user_eleven';

    if($resultset_find_transfer_string=
    mysql_query("select tLeft,tLeftString from $transferShcema where '$datetime'<=toDate LIMIT 1"))
    {
        @$transferLeft=mysql_result($resultset_find_transfer_string, 0,'tLeft');
        @$transferLeftString=mysql_result($resultset_find_transfer_string, 0,'tLeftString');
    }
    $result_find_data_budget=mysql_query("select * from $tableData where user_email='$session_email' LIMIT 1");
   
    if(mysql_num_rows($result_find_data_budget)==1 && $transferLeftString=='LIMITED') {
        $resultSetPlayer=mysql_query("select * from $table where user_email='$session_email' ORDER BY last_modified DESC LIMIT 1");
        $p1=mysql_result($resultSetPlayer, 0,'player1');
        $p2=mysql_result($resultSetPlayer, 0,'player2');
        $p3=mysql_result($resultSetPlayer, 0,'player3');
        $p4=mysql_result($resultSetPlayer, 0,'player4');
        $p5=mysql_result($resultSetPlayer, 0,'player5');
        $p6=mysql_result($resultSetPlayer, 0,'player6');
        $p7=mysql_result($resultSetPlayer, 0,'player7');
        $p8=mysql_result($resultSetPlayer, 0,'player8');
        $p9=mysql_result($resultSetPlayer, 0,'player9');
        $p10=mysql_result($resultSetPlayer, 0,'player10');
        $p11=mysql_result($resultSetPlayer, 0,'player11');
        $transferLeftUsers=mysql_result($result_find_data_budget, 0,'transfer_left');

        $currentPlayer=array($p1,$p2,$p3,$p4,$p5,$p6,$p7,$p8,$p9,$p10,$p11);
        $changePlayer=array($player1,$player2,$player3,$player4,$player5,$player6,$player7,$player8,$player9,$player10,$player11);

        $transferMade=0;
        for($i=0;$i<11;$i++) {
            for($j=0;$j<11;$j++) {
                if($changePlayer[$i] == $currentPlayer[$j] )
                    break;
                if($j == 10)
                    $transferMade+=1;
            }
        }

        if(($transferLeftUsers-$transferMade)==$transfers)
            {
                if($transfers<0)
                    echo 'Your '.($transfers*-100).' POINTS IS DEDUCTED.   ';
                return true;
            }
        else
            return false;

    }
    return true;
}
//************************************************************************************************

?>