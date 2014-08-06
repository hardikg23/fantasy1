<?php
include 'includes/database_connectivity_includes.php';
@session_start();
include 'includes/session_setter.php';
include 'includes/seriedId_setter.php';

if(isset ($_POST['matchID']) && isset ($_POST['Code']) && isset ($_POST['pay'])) {
    $matchID=htmlentities(mysql_real_escape_string($_POST['matchID']));
    $Code=htmlentities(mysql_real_escape_string($_POST['Code']));
    $pay=htmlentities(mysql_real_escape_string($_POST['pay']));

    $datetime=date("Y-m-d H:i:s");
    if($resultSetOfMatchTime = mysql_query("SELECT timeAnddate from fixture where matchID = $matchID and sid = $seriesId")) {
        $matchTime = mysql_result($resultSetOfMatchTime, 0);

        if($datetime < $matchTime) {


            $club = substr($Code,0,2);
            $indexOfP = strrpos($Code, "P");
            $indexOfFREE = strrpos($Code, "FREE");
            $indexOfR = strrpos($Code, "R");
            if($indexOfFREE === false) {
                $pay = substr($Code,$indexOfP+1,$indexOfR - $indexOfP - 1);
            }else {
                $pay = 0;
            }

            if(!empty ($matchID) && !empty ($Code) && !empty ($session_email)) {
                $query="SELECT TID FROM s".$seriesId."_pay_to_play_club WHERE user_email = '$session_email' and leagueCode='$Code' and matchID=$matchID";
                if($resutSet_if_already=mysql_query($query)) {
                    if(mysql_num_rows($resutSet_if_already) == 1) {
                        echo 'Alredy join in this club';
                    }else {
                        $query="SELECT user_id,user_balance FROM paytoplaybalance WHERE user_email = '$session_email'";
                        if($resutSet_to_find_balance=mysql_query($query)) {
                            $userId = mysql_result($resutSet_to_find_balance, 0, 0);
                            $balance = mysql_result($resutSet_to_find_balance, 0, 1);
                            if($balance >= (int)$pay  || (int)$pay == 0) {
                                $table= 's'.$seriesId.'_pay_to_play_club';
                                $datetime=date("Y-m-d H:i:s");
                                $query = "INSERT INTO withdrawhistory(TID,user_email,Amount,status,TimeAndDate,TransactionID,Mobileno,oldBalance,newBalance)
                                                VALUES ('','$session_email',$pay,'A','$datetime','','Join in Club',$balance,$balance-$pay)";
                                if(mysql_query("UPDATE `paytoplaybalance` SET user_balance=user_balance - $pay WHERE user_email = '$session_email'") &&
                                        @mysql_query("INSERT INTO $table VALUES ('',$userId , '$session_email' , '$Code' , $matchID,'N')") &&
                                        @mysql_query($query)) {
                                    //echo 'You are join in the Club and '.$pay.'rs is deducted from your account.';
                                    echo 'done';
                                }else {
                                    echo 'Some Error occured';
                                }
                            }else {
                                echo 'You don\'t have sufficient balance to join in this league. check balance in My Account';
                            }
                        }else {
                            echo 'Some Error occured';
                        }
                    }
                }else {
                    echo 'Some Error occured';
                }
            }else {
                echo 'Some Error occured';
            }
        }else{
            echo 'Sorry match started.';
        }
    }
}
?>
