<?php
/*
 *  POINT HISTORY (View POINTS)
*/
include 'PHP/includes/database_connectivity_includes.php';
@session_start();
include 'PHP/includes/session_setter.php';
include 'PHP/includes/seriedId_setter.php';

?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=0" />
        <link rel="stylesheet" href="css/jquery.mobile-1.4.2.min.css">
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/mJquery.js"></script>
        

    </head>
    <body>
        <div id="grad" class="body-container" >
            <?php
            include 'PHP/includes/header.php';
            ?>
            <div class="data-container" style="width: 100%;">
                <br>
                <div style="background-color: black;padding-left: 5px;padding-right: 5px;padding-top: 5px;padding-bottom: 5px;">
                    <font style="color: white;font-size: 16px;">VIEW POINTS</font>
                    <hr>
                </div>



                <div>
                    <?php
                    $tableLockTeam='s'.$seriesId.'_user_eleven_lockteam';
                    $tablePlayerData='s'.$seriesId.'_player_data';
                    if($resultSet_find_player_history=mysql_query("SELECT * FROM $tableLockTeam WHERE user_email='$session_email' ORDER BY `matchID` DESC LIMIT 1")) {
                        if(mysql_num_rows($resultSet_find_player_history)==1) {
                            $player1=  mysql_real_escape_string(htmlentities(mysql_result($resultSet_find_player_history, 0,'player1')));
                            $player2=  mysql_real_escape_string(htmlentities(mysql_result($resultSet_find_player_history, 0,'player2')));
                            $player3=  mysql_real_escape_string(htmlentities(mysql_result($resultSet_find_player_history, 0,'player3')));
                            $player4=  mysql_real_escape_string(htmlentities(mysql_result($resultSet_find_player_history, 0,'player4')));
                            $player5=  mysql_real_escape_string(htmlentities(mysql_result($resultSet_find_player_history, 0,'player5')));
                            $player6=  mysql_real_escape_string(htmlentities(mysql_result($resultSet_find_player_history, 0,'player6')));
                            $player7=  mysql_real_escape_string(htmlentities(mysql_result($resultSet_find_player_history, 0,'player7')));
                            $player8=  mysql_real_escape_string(htmlentities(mysql_result($resultSet_find_player_history, 0,'player8')));
                            $player9=  mysql_real_escape_string(htmlentities(mysql_result($resultSet_find_player_history, 0,'player9')));
                            $player10= mysql_real_escape_string(htmlentities(mysql_result($resultSet_find_player_history, 0,'player10')));
                            $player11= mysql_real_escape_string(htmlentities(mysql_result($resultSet_find_player_history, 0,'player11')));
                            $captain=  mysql_real_escape_string(htmlentities(mysql_result($resultSet_find_player_history, 0,'captain')));
                            $match_points= mysql_real_escape_string(htmlentities(mysql_result($resultSet_find_player_history, 0,'match_points')));
                            $matchID= mysql_real_escape_string(htmlentities(mysql_result($resultSet_find_player_history, 0,'matchID')));

                            if(@$resultSet_player_record=mysql_query("SELECT id,Name,style,team,price,match$matchID
                                     from $tablePlayerData where id IN ($player1,$player2,$player3,$player4,$player5,$player6,
                            $player7,$player8,$player9,$player10,$player11) ORDER BY style LIMIT 11")) {
                                echo "<div style='background-color: black;padding-left: 5px;padding-right: 5px;padding-bottom: 5px;'><font style='color: white;font-size: 12px;'>MATCH POINTS: $match_points</font></div>";
                                //echo '<div style="position: absolute;width: 746px;height: 347px;left: 0px;top: 55px;">';
                                echo '<table align="center" data-role="table" id="table-column-toggle" data-mode="columntoggle" class="ui-responsive table-stroke" style="color: #5F6060;font-size: 12px;">
                                        <thead>
                                        <tr>
                                                <th> </th>
                                                <th>PLAYER </th>
                                                <th>TEAM</th>
                                                <th data-priority="1">PRICE</th>
                                                <th>POINTS</th>
                                        </tr>
                                    </thead>';
                                $index=0;
                                while($row=mysql_fetch_array($resultSet_player_record)) {
                                    $id=mysql_real_escape_string($row['id']);
                                    $name=mysql_real_escape_string($row['Name']);
                                    $team=mysql_real_escape_string($row['team']);
                                    $price=mysql_real_escape_string($row['price']);
                                    //$playerImage='photos/players/'.$playerImage;
                                    $style=mysql_real_escape_string($row['style']);
                                    $matchPts=mysql_real_escape_string($row['match'.$matchID]);
                                    $matchPointPlayer=0;
                                    if(strlen($matchPts)>=12) {
                                        $matchPoints = explode("#@#", $matchPts);
                                        $matchPointPlayer=$matchPoints[0]+$matchPoints[1]+$matchPoints[2]+$matchPoints[3]+0;
                                    }

                                    if($captain != $id) {
                                        echo "<tr><td><img src='image/style/style$style.png' alt='$style' width='18px' height='18px'></td><td>$name</td><td>$team</td><td>$price</td><td>$matchPointPlayer</td></tr>";
                                    }
                                    else if($captain == $id) {
                                        $matchPointPlayer*=2;
                                        echo "<tr style='color:#0F0F0F;font-weight:bold;'><td><img src='image/style/style$style.png' alt='$style' width='18px' height='18px'></td><td>$name</td><td>$team</td><td>$price</td><td>$matchPointPlayer</td></tr>";
                                    }
                                    $index++;
                                }
                                echo '</table>';
                            }else
                                echo '<center>><br><br><br><br>PLAYER INDORMATION NOT FOUND</center>';
                        }
                        else
                            echo '<div><center>NO DATA<center></div>';
                    }
                    else
                        echo '<div>ERROR OCURED WHILE RETRIVING YOUT TEAM INFORMATION</div>';

                    ?>




                </div>

            </div>
            <div>
                <?php
                include 'PHP/includes/menu.php';
                ?>
            </div>

        </div>
    </body>
</html>
