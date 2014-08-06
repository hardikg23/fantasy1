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


                <div style="width: 100%;">
                    <?php

                    if(isset ($_GET['userName']) && !empty ($_GET['userName'])) {
                        $userName=mysql_real_escape_string(htmlentities($_GET['userName']));
                        $tableUserEleven='s'.$seriesId.'_user_eleven';
                        $tableUserElevenData='s'.$seriesId.'_user_eleven_data';
                        $tablePlayerData='s'.$seriesId.'_player_data';
                        $fname="-";
                        $lname="-";
                        $userTeamName="-";
                        $userCountry="-";
                        $userPoints="-";
                        $rank="-";

                        $datetime=date("Y-m-d H:i:s");
                        $transferString="";
                        $transfer_schema='s'.$seriesId.'_transfer_schema';
                        if(@$result_transfer_String=  mysql_query("SELECT tLeftString from
                        $transfer_schema where '$datetime'<=toDate ORDER by toDate LIMIT 1")) {
                            $transferString=mysql_real_escape_string(mysql_result($result_transfer_String, 0));
                            if($transferString == 'UNLIMITED')
                                $transfer_left="&#8734;";
                        }


                        if(@$resultSet_find_player_history=mysql_query("SELECT * FROM $tableUserElevenData d
                   INNER JOIN $tableUserEleven e on d.user_email=e.user_email INNER JOIN users_data u
                   on  u.user_email=e.user_email WHERE e.user_name='$userName' ORDER BY e.last_modified DESC LIMIT 1")) {
                            if(@mysql_num_rows($resultSet_find_player_history)==1) {
                                ////VARS to display users data
                                $fname=mysql_real_escape_string(mysql_result($resultSet_find_player_history, 0,'first_name'));
                                $lname=mysql_real_escape_string(mysql_result($resultSet_find_player_history, 0,'last_name'));
                                $userPoints=mysql_real_escape_string(mysql_result($resultSet_find_player_history, 0,'user_points'));
                                $transfer_left=mysql_real_escape_string(mysql_result($resultSet_find_player_history, 0,'transfer_left'));

                                if($transferString == 'UNLIMITED')
                                    $transfer_left="&#8734;";

                                $user_point=  mysql_real_escape_string(htmlentities(mysql_result($resultSet_find_player_history, 0,'user_points')));
                                $Transfer_left=  mysql_real_escape_string(htmlentities(mysql_result($resultSet_find_player_history, 0,'transfer_left')));
                                $budget_left=  mysql_real_escape_string(htmlentities(mysql_result($resultSet_find_player_history, 0,'budget_left')));
                                $last_modified=  mysql_real_escape_string(htmlentities(mysql_result($resultSet_find_player_history, 0,'last_modified')));
                                if(@$session_country == 'India') {
                                    $old_date_timestamp = strtotime($last_modified);
                                    $last_modified = date('j,M Y h:i:s A', $old_date_timestamp);
                                }else {
                                    $old_date_timestamp = strtotime($last_modified);
                                    $old_date_timestamp = $old_date_timestamp - '19800';
                                    $last_modified = date('j,M Y h:i:s A', $old_date_timestamp).' GMT';
                                }
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
                                $totalPoints=  mysql_real_escape_string(htmlentities(mysql_result($resultSet_find_player_history, 0,'user_points')));


                                if(@$resultSet_player_record=mysql_query("SELECT id,Name,style,team,imgSrc,price,total_point
                                 from $tablePlayerData where id IN ($player1,$player2,$player3,$player4,$player5,$player6,
                                $player7,$player8,$player9,$player10,$player11) ORDER BY style LIMIT 11")) {

                                    if(mysql_num_rows($resultSet_player_record)==11) {

                                        echo '<div style="background-color: black;padding-left: 5px;padding-right: 5px;padding-top: 5px;padding-bottom: 5px;">';
                                        echo "<font style='color: white;font-size: 16px;'>MANAGER : $fname $lname</font><hr>";
                                        echo "<font style='color: white;font-size: 12px;'>UPDATED : $last_modified </font><hr>";
                                        echo "<font style='color: white;font-size: 12px;'>POINTS : $user_point      <div align='right'>   TREANSFER : $transfer_left </font> </div>";

                                        echo '</div>';
                                        echo '<table align="center" data-role="table" id="table-column-toggle" data-mode="columntoggle" class="ui-responsive table-stroke" style="color: #5F6060;font-size: 12px;">
                                        <thead>
                                        <tr>
                                                <th> </th>
                                                <th>PLAYER </th>
                                                <th>TEAM</th>
                                                <th>PRICE</th>
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
                                            if($captain != $id) {
                                                echo "<tr><td><img src='image/style/style$style.png' alt='$style' width='18px' height='18px'></td><td>$name</td><td>$team</td><td>$price</td></tr>";
                                            }
                                            else if($captain == $id) {
                                                $matchPointPlayer*=2;
                                                echo "<tr style='color:#0F0F0F;font-weight:bold;'><td><img src='image/style/style$style.png' alt='$style' width='18px' height='18px'></td><td>$name</td><td>$team</td><td>$price</td></tr>";
                                            }
                                            $index++;
                                        }
                                        echo '</table>';


                                    } // (mysql_num_rows($resultSet_player_record)==11)   IF CLOSE
                                    else
                                        echo '<center>Some Error</center>';
                                }else
                                    echo '<center>Some Error</center>';

                            }  // NO DATA FOUND FOR USER NAME
                            else
                                echo '<center>NO TEAM SELECTED BY MANAGER</center>';
                        }
                        else  //Main IF
                            echo '<center>Error</center>';




                    }else {
                        echo '<center>ERROR</center>';
                    }
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
