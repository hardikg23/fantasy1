<?php
include 'includes/database_connectivity_includes.php';
session_start();
include 'includes/session_setter.php';
include 'includes/seriedId_setter.php';
if(isset ($_POST['sid']) && isset ($_POST['mid']) && isset ($_POST['userID'])) {
    if(!empty ($_POST['sid']) && !empty ($_POST['mid']) && !empty ($_POST['userID'])) {
        $sid=mysql_real_escape_string(htmlentities($_POST['sid']));
        $mid=mysql_real_escape_string(htmlentities($_POST['mid']));
        $userID=mysql_real_escape_string(htmlentities($_POST['userID']));
        $s='s'.$sid.'_player_data';

        if($resultSet_to_find_status=mysql_query("SELECT updateStatus from fixture where sid= $sid and matchID = $mid")) {
            $matchStatus = mysql_result($resultSet_to_find_status, 0,0);
            if($matchStatus == 'YES' || $userID == 'self' ) {

                if($userID == 'self')
                    $query_to_find_team="SELECT * FROM daily_challenge_eleven_player WHERE sid=$sid AND matchid=$mid AND user_email='$session_email'";
                else
                    $query_to_find_team="SELECT * FROM daily_challenge_eleven_player WHERE sid=$sid AND matchid=$mid AND user_id=$userID";
                if($ResultSet_to_find_team=mysql_query($query_to_find_team)) {
                    if(mysql_num_rows($ResultSet_to_find_team)==1) {
                        $dailyUserName=mysql_real_escape_string(mysql_result($ResultSet_to_find_team, 0,'user_name'));
                        $player1=mysql_real_escape_string(mysql_result($ResultSet_to_find_team, 0,'player1'));
                        $player2=mysql_real_escape_string(mysql_result($ResultSet_to_find_team, 0,'player2'));
                        $player3=mysql_real_escape_string(mysql_result($ResultSet_to_find_team, 0,'player3'));
                        $player4=mysql_real_escape_string(mysql_result($ResultSet_to_find_team, 0,'player4'));
                        $player5=mysql_real_escape_string(mysql_result($ResultSet_to_find_team, 0,'player5'));
                        $player6=mysql_real_escape_string(mysql_result($ResultSet_to_find_team, 0,'player6'));
                        $player7=mysql_real_escape_string(mysql_result($ResultSet_to_find_team, 0,'player7'));
                        $player8=mysql_real_escape_string(mysql_result($ResultSet_to_find_team, 0,'player8'));
                        $player9=mysql_real_escape_string(mysql_result($ResultSet_to_find_team, 0,'player9'));
                        $player10=mysql_real_escape_string(mysql_result($ResultSet_to_find_team, 0,'player10'));
                        $player11=mysql_real_escape_string(mysql_result($ResultSet_to_find_team, 0,'player11'));
                        $dailyCaptain=mysql_real_escape_string(mysql_result($ResultSet_to_find_team, 0,'captain'));
                        $user_team_name=mysql_real_escape_string(mysql_result($ResultSet_to_find_team, 0,'user_team_name'));
                        $daily_point=mysql_real_escape_string(mysql_result($ResultSet_to_find_team, 0,'daily_point'));
                        $last_modified=mysql_real_escape_string(mysql_result($ResultSet_to_find_team, 0,'last_modified'));
                        $budget=mysql_real_escape_string(mysql_result($ResultSet_to_find_team, 0,'budget'));

                        $d_firstname="";
                        $d_lastname="";
                        if(@$resultSet_to_fl_name=mysql_query("SELECT first_name,last_name from users_data where user_name='$dailyUserName'")) {
                            $d_firstname=mysql_real_escape_string(mysql_result($resultSet_to_fl_name, 0,0));
                            $d_lastname=mysql_real_escape_string(mysql_result($resultSet_to_fl_name, 0,1));
                        }

                        if($session_country == 'India') {
                            $old_date_timestamp = strtotime($last_modified);
                            $last_modified1 = date('j,M Y h:i:s A', $old_date_timestamp);
                        }else {
                            $old_date_timestamp = strtotime($last_modified);
                            $old_date_timestamp = $old_date_timestamp - '19800';
                            $last_modified1 = date('j,M Y h:i:s A', $old_date_timestamp).' GMT';
                        }
                        echo "<div  style='border:1px solid silver;'>
                           <table align='center' width='100%' style='color:#454346;font-size:12px;padding-left:10px;'>
                             <tr>
                                <td align='left' >
                                        MANAGER :  $d_firstname $d_lastname &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </td>
                                <td align='center' >
                                        POINTS :<font style='color:#EB0B2D;font-size:18px;font-weight:bold;'> $daily_point </font>
                                </td>
                                <td align='right' >
                                        BUDGET : <font style='color:#EB0B2D;font-size:18px;font-weight:bold;'>$budget m$</font>
                                </td>
                             </tr>
                            </table>
                          </div>";


                        $query_to_get_elevent_player="SELECT id,Name,team,style,match$mid FROM $s where id IN ($player1,$player2,$player3,$player4,$player5,
                                $player6,$player7,$player8,$player9,$player10,$player11) ORDER BY style";

                        if($ResultSet_to_get_elevent_player=mysql_query($query_to_get_elevent_player)) {
                            if(mysql_num_rows($ResultSet_to_get_elevent_player) == 11) {
                                echo '<table class="selection-table">';
                                echo '<th></th><th>PLAYER</th><th>TEAM</th><th>POINTS</th>';
                                while($row=mysql_fetch_array($ResultSet_to_get_elevent_player)) {
                                    $playerid1=mysql_real_escape_string($row['id']);
                                    $playerStyle=mysql_real_escape_string($row['style']);
                                    $playerName=mysql_real_escape_string($row['Name']);
                                    $playerTeam=mysql_real_escape_string($row['team']);
                                    $playerPoint=mysql_real_escape_string($row['match'.$mid]);  //String of points
                                    $matchPointPlayer=0;

                                    if(strlen($playerPoint) >= 12) {
                                        $matchPoints = explode("#@#", $playerPoint);   //array of string
                                        $matchPointPlayer=$matchPoints[0]+$matchPoints[1]+$matchPoints[2]+$matchPoints[3]+0;   //total match points
                                    }
                                    if($dailyCaptain==$playerid1) {
                                        $matchPointPlayer*=2;
                                        echo '<tr style="background-color:#FF3535">';
                                        echo "<td><img src='photos/style/style$playerStyle.png' ></td><td>$playerName</td><td>$playerTeam <img align='right' style='border:1px solid silver;' width='30px' height='20px' src='photos/teamsFlags/$playerTeam.jpg' alt=''></td><td>$matchPointPlayer</td>";
                                        echo '</tr>';
                                    }
                                    else {
                                        echo '<tr>';
                                        echo "<td><img src='photos/style/style$playerStyle.png' ></td><td>$playerName</td><td>$playerTeam <img align='right' style='border:1px solid silver;' width='30px' height='20px' src='photos/teamsFlags/$playerTeam.jpg' alt=''></td><td>$matchPointPlayer</td>";
                                        echo '</tr>';
                                    }

                                }
                                echo '</table>';
                            }else {
                                echo '11 TOP player not found';
                            }
                        }else {
                            echo '<center>SOME ERROR OCCURED</center>';
                        }
                    }else {
                        echo '<center>NO TEAM SELECTED</center>';
                    }
                }else {
                    echo '<center>SOME ERROR OCCURED</center>';
                }

            }else {
                echo '<div style="font-size:12px;color:#676767" align="right">Team will be visible after match finish.</div>';
            }
        }else {
            echo 'Error';
        }
    }else {
        echo 'Some error occurred ';  // empty
    }
}

?>
