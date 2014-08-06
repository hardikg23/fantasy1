<?php
include '../includes/database_connectivity_includes.php';
if(isset ($_POST['seriesId']) && isset ($_POST['matchId']) && isset ($_POST['matchType']))
{
    if(!empty ($_POST['seriesId']) && !empty ($_POST['matchId']) && !empty ($_POST['matchType']))
    {
        $seriesId=mysql_real_escape_string(htmlentities($_POST['seriesId']));
        $matchId=mysql_real_escape_string(htmlentities($_POST['matchId']));
        $matchType=mysql_real_escape_string(htmlentities($_POST['matchType']));

        echo '<form name="form" target="_blank" method="post" action="updateMatchPoints3.php">';
        echo "Enter series id : <input type=\"text\" name=\"seriesId\" value='$seriesId' > <br><br>";
        echo "Enter Match id : <input type=\"text\" name=\"matchId\" value='$matchId' > <br><br>";
        echo "Enter Match type : <input type=\"text\" name=\"matchType\" value='$matchType' > <br><br>";

        $playerTable='s'.$seriesId.'_player_data';

        if($ResultSet_players_of_match=mysql_query("SELECT id,Name,match$matchId
                                                 from $playerTable
                                                 where team =(SELECT team1 from fixture where sid=$seriesId and matchID=$matchId)
                                                 OR team =(SELECT team2 from fixture where sid=$seriesId and matchID=$matchId)
                                                  ORDER BY style"))
            {
            echo '<select name="playerData">';
            while($row=mysql_fetch_array($ResultSet_players_of_match)) {
                $id=mysql_real_escape_string($row['id']);
                $name=mysql_real_escape_string($row['Name']);
                $matchPoints=mysql_real_escape_string($row['match'.$matchId]);
                echo "<option value='$id'>$name &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp $matchPoints</option>";
   
            }
            echo '<select>';
            echo '<table border="1px">';
            echo '<tr><td>BATSMAN-RUNS : </td><td><input type="text" name="runs" maxlength="3"></td></tr>';
            echo '<tr><td>DUCK : </td><td><input type="text" name="duck" maxlength="3" value="no"></td></tr>';
            echo '<tr><td>BALLS PLAYED : </td><td><input type="text" name="balls" maxlength="3"></td></tr>';
            echo '<tr><td>SIXS : </td><td><input type="text"         name="sixs" maxlength="2"></td></tr>';


            echo '<tr><td>OVERs : </td><td><input type="text"        name="overs" maxlength="3"></td></tr>';
            echo '<tr><td>INCOMPLETE-OVER-BALLS : </td><td><input type="text" name="minOvers" maxlength="3"></td></tr>';
            echo '<tr><td>MAIDENS : </td><td><input type="text"      name="maiden" maxlength="2"></td></tr>';
            echo '<tr><td>RUNS GIVEN : </td><td><input type="text"   name="ballRuns" maxlength="3"></td></tr>';
            echo '<tr><td>WIKETS TAKEN : </td><td><input type="text" name="wiket" maxlength="2"></td></tr>';
            echo '<tr><td>HATTRICK TAKEN : </td><td><input type="text" name="hattrik" maxlength="3" value="no"></td></tr>';
            echo '<tr><td>BOT BALLS : </td><td><input type="text"    name="dotBall" maxlength="3"></td></tr>';


            echo '<tr><td>CATCHS : </td><td><input type="text"       name="catch" maxlength="2"></td></tr>';
            echo '<tr><td>RUNOUTS : </td><td><input type="text"      name="runout" maxlength="2"></td></tr>';
            echo '<tr><td>MAN OF THE MATCH : </td><td><input type="text" name="mom" maxlength="3" value="no"></td></tr>';
            echo '<tr><td>WIN MATCH : </td><td><input type="text"    name="winMatch" maxlength="3"></td></tr>';
            echo '</table>';
            echo '<input type="submit" value="UPDATE"></form>';
        }
        else {
            echo 'ERROR in SQL SYNTAX';
        }


    }
}
?>
