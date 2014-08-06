<?php
include '../includes/database_connectivity_includes.php';
@session_start();
if(isset($_SESSION['setadminpassword'])&&isset($_SESSION['setdatabasepassword'])) {
    ?>

<html>
    <head>

    </head>
    <body>
        <form name="f" method="post" action="lockTeam.php">
            Enter series id :<input type="text" name="seriesId" ><br>
            Enter Match id :<input type="text" name="matchId">

            <input type="submit" value="submit">
            <a href="adminlogout.php" >Logout</a>
        </form>
    </body>
</html>



    <?php
    if(isset ($_POST['seriesId']) && isset ($_POST['matchId']) ) {
        if(!empty ($_POST['seriesId']) && !empty ($_POST['matchId'])) {
            $seriesId=mysql_real_escape_string(htmlentities($_POST['seriesId']));
            $matchId=mysql_real_escape_string(htmlentities($_POST['matchId']));
            $datetime=date("Y-m-d H:i:s");
            $resultSet_find_match_dateAndTime=mysql_query("select timeAnddate,status from fixture where matchId = $matchId AND sid = $seriesId") or die(mysql_error());
            $table='s'.$seriesId.'_user_eleven';
            $tableLockTeam='s'.$seriesId.'_user_eleven_lockteam';
            if(mysql_num_rows($resultSet_find_match_dateAndTime)==1) {
                echo 'Match Time is : '.$timeAndDate=mysql_real_escape_string(htmlentities(mysql_result($resultSet_find_match_dateAndTime, 0,'timeAnddate')));
                echo '<br> Match Status is : '.$matchStatus=mysql_real_escape_string(htmlentities(mysql_result($resultSet_find_match_dateAndTime, 0,'status')));
                echo '<br>CURRENT TIME:'.$datetime.'<br>';
                if($timeAndDate < $datetime) {
                    if($matchStatus == 'UNLOCK') {
                        $resultSet_DISTINCT_email=mysql_query("SELECT DISTINCT user_email FROM $table");

                        while($row=mysql_fetch_array($resultSet_DISTINCT_email)) {
                            $email=mysql_real_escape_string($row['user_email']);
                            $resultSet_data=mysql_query("SELECT *
                                                     from $table
                                                     where last_modified<='$timeAndDate' AND user_email='$email'
                                                     ORDER BY last_modified DESC LIMIT 1");

                            //echo "<br>NO:"+mysql_num_rows($resultSet_data);
                            if(mysql_num_rows($resultSet_data)==1) {


                                $TID=mysql_result($resultSet_data, 0,'TID');
                                $user_id=mysql_result($resultSet_data, 0,'user_id');
                                $user_email=mysql_result($resultSet_data, 0,'user_email');
                                $player1=mysql_result($resultSet_data, 0,'player1');
                                $player2=mysql_result($resultSet_data, 0,'player2');
                                $player3=mysql_result($resultSet_data, 0,'player3');
                                $player4=mysql_result($resultSet_data, 0,'player4');
                                $player5=mysql_result($resultSet_data, 0,'player5');
                                $player6=mysql_result($resultSet_data, 0,'player6');
                                $player7=mysql_result($resultSet_data, 0,'player7');
                                $player8=mysql_result($resultSet_data, 0,'player8');
                                $player9=mysql_result($resultSet_data, 0,'player9');
                                $player10=mysql_result($resultSet_data, 0,'player10');
                                $player11=mysql_result($resultSet_data, 0,'player11');
                                $captain=mysql_result($resultSet_data, 0,'captain');

                                echo '<br>INSERTING.....'.$user_email;

                                $insertString="INSERT INTO $tableLockTeam values ($TID,$user_id,'$user_email',$player1,$player2,$player3,$player4,$player5,$player6,$player7,$player8,$player9,$player10,$player11,$captain,0,$matchId,$seriesId)";
                                mysql_query($insertString);
                            }

                        }
                        mysql_query("UPDATE fixture SET status = 'LOCK' where sid=$seriesId AND matchID=$matchId");

                    }
                    else if($matchStatus == 'LOCK') {
                        echo '<br>Teams are already locked';
                    }else {
                        echo 'why?';
                    }

                }

                else
                    echo 'Time reamaning';


            }
            else
                echo 'No Match Found for SeriesID : '.$seriesId.' AND matchID : '.$matchId;




            /**
             $resultSet_find_latest_matchID=mysql_query("select sid,matchID from fixture where timeAnddate < '$datetime' ORDER BY timeAnddate DESC LIMIT 1") or die(mysql_error());
             $currentSeriesID=mysql_real_escape_string(htmlentities(mysql_result($resultSet_find_latest_matchID, 0,'sid')));
             $lastMatchID=mysql_real_escape_string(htmlentities(mysql_result($resultSet_find_latest_matchID, 0,'matchID')));
        

             if($matchId == $lastMatchID && $currentSeriesID==$seriesId)
             echo 'Update';
             else
             echo 'Check MATCH ID OR SERIES ID';

             */

        }
    }
}
else {
    header('Location: AdminLoginAuthentication.php');
}
?>