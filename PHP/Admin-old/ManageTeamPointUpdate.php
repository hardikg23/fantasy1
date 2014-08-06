<?php
include '../includes/database_connectivity_includes.php';
?>
<html>
    <head>

    </head>
    <body>
        <form name="f" method="post" action="ManageTeamPointUpdate.php">
            Enter series id :<input type="text" name="seriesId" ><br>
            Enter Match id :<input type="text" name="matchId">
            <input type="submit" value="submit">
        </form>
    </body>
</html>

<?php

if(isset ($_POST['seriesId']) && isset ($_POST['matchId']) ) {
    if(!empty ($_POST['seriesId']) && !empty ($_POST['matchId'])) {
        $seriesId=mysql_real_escape_string(htmlentities($_POST['seriesId']));
        $matchId=mysql_real_escape_string(htmlentities($_POST['matchId']));
        $locktable='s'.$seriesId.'_user_eleven_lockteam';
        $playerdatatable='s'.$seriesId.'_player_data';

        $updatequery=mysql_query("select * from $locktable where matchId=$matchId and sid=$seriesId");
        while($row=mysql_fetch_array($updatequery)) {
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

            $retreiveplayerdataquer=mysql_query("select id,match$matchId from $playerdatatable
                    where id IN ($player1, $player2, $player3, $player4,$player5,$player6,$player7,$player8,$player9,$player10,$player11)");
            $totalpoints = 0;
            while($row=mysql_fetch_array($retreiveplayerdataquer)) {
                $id=mysql_real_escape_string($row['id']);
                $matchscore=mysql_real_escape_string($row['match'.$matchId]).'<br/>';
                $matchPoints = explode("#@#", $matchscore);
                $matchPointPlayer=0;
                if(strlen($matchscore)>=12) {
                    $matchPointPlayer=$matchPoints[0]+$matchPoints[1]+$matchPoints[2]+$matchPoints[3]+0;
                    if($captain == $id)
                        $totalpoints+=$matchPointPlayer*2;
                    else {
                        $totalpoints+=$matchPointPlayer;
                    }
                }
            }
            echo $totalpoints;
        }
    }
}

?>