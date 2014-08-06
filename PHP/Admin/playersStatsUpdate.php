<?php
@session_start();
include '../includes/database_connectivity_includes.php';
if(isset($_SESSION['setadminpassword'])&&isset($_SESSION['setdatabasepassword'])) {
    ?>
<html>
    <head>
    </head>
    <body>
        <form name="form" method="post" action="playersStatsUpdate.php">
            Enter series id :<input type="text" name="seriesId"><br><br>
            Enter match id :<input type="text" name="matchID">
            Enter TEAM :<input type="text" name="team">
            <input type="submit" value="UPDATE">
            <a href="adminlogout.php" >Logout</a>
        </form>
    </body>
</html>
    <?php
    if(isset ($_POST['seriesId']) && isset ($_POST['matchID']) && isset ($_POST['team'])) {
        if(!empty ($_POST['seriesId']) && !empty ($_POST['matchID']) && !empty ($_POST['team'])) {
            $serid=mysql_real_escape_string($_POST['seriesId']);
            $matchID=mysql_real_escape_string($_POST['matchID']);
            $team=mysql_real_escape_string($_POST['team']);
            $playerTable='s'.$serid.'_player_data';

            if($ResultSet_to_fing_totalMatch=mysql_query("select count(fid) as totalMatch from fixture where (team1='$team' OR team2='$team') and matchID<=$matchID and sid=$serid")) {
                $matchCount=mysql_result($ResultSet_to_fing_totalMatch, 0);
                echo "TOTAL MATCH FOR THE TEAm $team is : $matchCount <br>";

                if(mysql_query("UPDATE $playerTable SET form=total_point/($matchCount*13.71),value=(total_point*10)/($matchCount*price),pts_per_match=total_point/$matchCount WHERE team='$team'"))
                {
                    echo $team.' STATS are updated!!<br>';
                }

            }
        }
    }
}
else {
    header('Location: AdminLoginAuthentication.php');
}

?>