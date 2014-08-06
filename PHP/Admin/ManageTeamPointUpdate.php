<?php
include '../includes/database_connectivity_includes.php';
@session_start();
if (isset($_SESSION['setadminpassword']) && isset($_SESSION['setdatabasepassword'])) {
    ?>
    <html>
        <head>
        </head>
        <body>
            <form name="f" method="post" action="ManageTeamPointUpdate.php">
                Enter series id :<input type="text" name="seriesId" ><br>
                Enter Match id :<input type="text" name="matchId">
                <input type="submit" value="submit">
                <a href='adminlogout.php'>Logout</a>
            </form>
        </body>
    </html>

    <?php
    if (isset($_POST['seriesId']) && isset($_POST['matchId'])) {
        if (!empty($_POST['seriesId']) && !empty($_POST['matchId'])) {
            $seriesId = mysql_real_escape_string(htmlentities($_POST['seriesId']));
            $matchId = mysql_real_escape_string(htmlentities($_POST['matchId']));

            if ($resultOfUpdate = mysql_query("SELECT updateStatus from fixture where sid=$seriesId and matchID=$matchId")) {

                $updateing = mysql_result($resultOfUpdate, 0);
                if ($updateing != 'YES') {

                    $locktable = 's' . $seriesId . '_user_eleven_lockteam';
                    $playerdatatable = 's' . $seriesId . '_player_data';
                    $userelevendata = 's' . $seriesId . '_user_eleven_data';
                    $updatequery = mysql_query("select * from $locktable where matchId=$matchId and sid=$seriesId");
                    while ($row = mysql_fetch_array($updatequery)) {
                        echo $useremail = mysql_real_escape_string($row['user_email']);
                        $player1 = mysql_real_escape_string($row['player1']);
                        $player2 = mysql_real_escape_string($row['player2']);
                        $player3 = mysql_real_escape_string($row['player3']);
                        $player4 = mysql_real_escape_string($row['player4']);
                        $player5 = mysql_real_escape_string($row['player5']);
                        $player6 = mysql_real_escape_string($row['player6']);
                        $player7 = mysql_real_escape_string($row['player7']);
                        $player8 = mysql_real_escape_string($row['player8']);
                        $player9 = mysql_real_escape_string($row['player9']);
                        $player10 = mysql_real_escape_string($row['player10']);
                        $player11 = mysql_real_escape_string($row['player11']);
                        $captain = mysql_real_escape_string($row['captain']);

                        $retreiveplayerdataquer = mysql_query("select id,match$matchId from $playerdatatable
                    where id IN ($player1, $player2, $player3, $player4,$player5,$player6,$player7,$player8,$player9,$player10,$player11)");
                        $totalpoints = 0;
                        while ($row = mysql_fetch_array($retreiveplayerdataquer)) {
                            $id = mysql_real_escape_string($row['id']);
                            $matchscore = mysql_real_escape_string($row['match' . $matchId]);
                            $matchPoints = explode("#@#", $matchscore);
                            $matchPointPlayer = 0;
                            if (strlen($matchscore) >= 12) {
                                $matchPointPlayer = $matchPoints[0] + $matchPoints[1] + $matchPoints[2] + $matchPoints[3] + 0;
                                if ($captain == $id)
                                    $totalpoints+=$matchPointPlayer * 2;
                                else {
                                    $totalpoints+=$matchPointPlayer;
                                }
                            }
                        }
                        //update query of match point in userlockteam;
                        if (mysql_query("Update $locktable SET match_points=$totalpoints where user_email='$useremail' and matchID= $matchId and sid= $seriesId")) {
                            echo 'LockTeam Match_points Updated';
                            if (mysql_query("Update $userelevendata SET user_points=user_points+$totalpoints where user_email='$useremail'")) {
                                echo 'User_points in user_eleven_data updated';
                            }


                            /* $userelevenquery=  mysql_query("select SUM(match_points) as mat_points from $locktable where user_email='$useremail' and matchID <= $matchId and sid= $seriesId");
                              while ($row1 = mysql_fetch_array($userelevenquery)) {
                              $score=mysql_real_escape_string($row1['mat_points']);
                              echo 'score='.$score.'<br/>';
                              //update query to update total series point in user_eleven_data;
                              if(mysql_query("Update $userelevendata SET user_points=$score where user_email='$useremail'")) {
                              echo 'User_points in user_eleven_data updated';
                              }
                              } */
                        }
                        echo $totalpoints;
                    }
                    
                    mysql_query("UPDATE fixture SET updateStatus = 'YES' where sid=$seriesId and matchID=$matchId");
                }
                else{ // if already updated..........
                    echo 'MATCH ALREDAY UPDATED';
                }
            } else {
                echo 'ERROR IN QUERY';
            } // if already updated Query error.....
        }
    }
} else {
    header('Location: AdminLoginAuthentication.php');
}
?>