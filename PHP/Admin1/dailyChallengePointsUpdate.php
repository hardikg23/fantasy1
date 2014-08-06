<?php
include '../includes/database_connectivity_includes.php';
@session_start();


if(isset($_SESSION['setadminpassword'])&&isset($_SESSION['setdatabasepassword'])) {
    ?>

<html>
    <head>
        <title>
            QuickPlayeUpdate
        </title>
    </head>
    <body>
        <form action="dailyChallengePointsUpdate.php" method="post">
            SeriesId:<input type="text" name="seriesid"><br>
            MatchId:<input type="text" name="matchid"><br>
            <input type="submit" value="update"><br>
            <a href="adminlogout.php">Logout</a>
        </form>
    </body>
</html>


    <?php
    if(isset($_POST['seriesid'])&&isset($_POST['matchid'])) {
        if(!empty($_POST['seriesid'])&&!empty($_POST['matchid'])) {
            $seriesid=mysql_real_escape_string(htmlentities($_POST['seriesid']));
            $matchid=mysql_real_escape_string(htmlentities($_POST['matchid']));
            $daily_eleven='daily_challenge_eleven_player';
            $playertable='s'.$seriesid.'_player_data';
            $playerreteivequery=  mysql_query("select * from $daily_eleven where matchid=$matchid and sid=$seriesid");
            while($row=  mysql_fetch_array($playerreteivequery)) {
                echo $useremail=mysql_real_escape_string($row['user_email']);
                $player1=mysql_real_escape_string($row['player1']);
                $player2=mysql_real_escape_string($row['player2']);
                $player3=mysql_real_escape_string($row['player3']);
                $player4=mysql_real_escape_string($row['player4']);
                $player5=mysql_real_escape_string($row['player5']);
                $player6=mysql_real_escape_string($row['player6']);
                $player7=mysql_real_escape_string($row['player7']);
                $player8=mysql_real_escape_string($row['player8']);
                $player9=mysql_real_escape_string($row['player9']);
                $player10=mysql_real_escape_string($row['player10']);
                $player11=mysql_real_escape_string($row['player11']);
                $captain=mysql_real_escape_string($row['captain']);
                $budget=mysql_real_escape_string($row['budget']);

                $playerscore=  mysql_query("select id, match$matchid from $playertable
                        where id IN ($player1, $player2, $player3, $player4,$player5,$player6,$player7,$player8,$player9,$player10,$player11)");

                $totalpoint=0;
                while($row=  mysql_fetch_array($playerscore)) {
                    $id=mysql_real_escape_string($row['id']);
                    $matchscore=mysql_real_escape_string($row['match'.$matchid]).'<br/>';
                    $matchPoints = explode("#@#", $matchscore);
                    $matchPointPlayer=0;
                    if(strlen($matchscore)>=12) {
                        $matchPointPlayer=$matchPoints[0]+$matchPoints[1]+$matchPoints[2]+$matchPoints[3]+0;
                        if($captain == $id)
                            $totalpoint+=$matchPointPlayer*2;
                        else {
                            $totalpoint+=$matchPointPlayer;
                        }
                    }
                }
                $budget=100-$budget;
                echo 'budget='.$budget;
                $budget=$budget*10;
                $totalpoint+=$budget;
                echo 'totalpoint='.$totalpoint;
                if(mysql_query("Update $daily_eleven SET daily_point=$totalpoint where user_email='$useremail' and matchid=$matchid and sid=$seriesid")) {
                    echo 'Updated';
                }

            }
        }
    }
}
else {
    header('Location: AdminLoginAuthentication.php');
}
?>