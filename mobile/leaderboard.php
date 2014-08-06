<?php
/* 
 *  LEADERBOARD
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
        <link rel="stylesheet" href="css/leaderboard.css">
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
                <!--LEADERBOARD-->
                <div style="background-color: black;padding-left: 5px;padding-right: 5px;padding-top: 5px;padding-bottom: 5px;">
                    <font style="color: white;font-size: 16px;">LEADERBOARD</font>
                    <hr>
                    <div>
                        <?php
                        $totalcount="";
                        @$user_eleven = 's' . $seriesId . '_user_eleven_data';
                        if(@$resultSet_total_users=mysql_query("SELECT count(TID) from $user_eleven")) {
                            $count=mysql_real_escape_string(htmlentities(mysql_result(@$resultSet_total_users, 0))) + 20;
                            $totalcount="TOTAL TEAMS : $count";
                            echo "<font style='color: white;font-size: 12px;'>$totalcount</font>";
                        }
                        ?>
                    </div>
                </div>


                <div align="center" id="scrol">
                    <?php

                    $datetime=date("Y-m-d H:i:s");
                    $transfer_schema='s'.$seriesId.'_transfer_schema';
                    $user_eleven = 's' . $seriesId . '_user_eleven_data';
                    $transferString="";
                    if(@$result_transfer_String=  mysql_query("SELECT tLeftString from
                    $transfer_schema where '$datetime'<=toDate ORDER by toDate LIMIT 1")) {
                        $transferString=mysql_real_escape_string(mysql_result($result_transfer_String, 0));

                    }

                    $query_to_leaderboard="SELECT s.user_name,s.user_team_name,u.user_points,u.transfer_left,s.first_name,s.last_name
                          FROM $user_eleven u INNER JOIN users_data s ON u.user_email=s.user_email ORDER BY u.user_points DESC LIMIT 50";
                    $userNameOfmanager="";
                    if($resultSet_to_get_username=  mysql_query("SELECT first_name,last_name,user_name from users_data where user_email like '$session_email'")) {
                        $firstNameOfmanager=  mysql_real_escape_string(mysql_result($resultSet_to_get_username, 0,'first_name'));
                        $lastNameOfmanager=  mysql_real_escape_string(mysql_result($resultSet_to_get_username, 0,'last_name'));
                        $userNameOfmanager=  mysql_real_escape_string(mysql_result($resultSet_to_get_username, 0,'user_name'));
                    }
                    $user_Displayed_Flag=FALSE;
                    if($result = mysql_query($query_to_leaderboard)) {
                        $rank_no=1;
                        $lastRank=0;
                        $lastPoints=0;
                        echo '<table align="center" data-role="table" id="table-column-toggle" data-mode="columntoggle" class="ui-responsive table-stroke" style="font-size: 12px;color: #565656;">
                                        <thead>
                                          <tr>
                                          <th>#</th>
                                          <th>MANAGER</th>
                                          <th data-priority="1">TRANSFERS</th>
                                          <th>POINTS</th>
                                         </tr></thead>';
                        while ($row = mysql_fetch_array($result)) {  //to get all data.....
                            $user_name = htmlentities($row[0]);
                            $user_team = htmlentities($row[1]);
                            $user_points = htmlentities($row[2]);
                            $transfer = htmlentities($row[3]);
                            if($transferString == 'UNLIMITED')
                                $transfer="&#8734;";
                            $fName=htmlentities($row[4]);
                            $lName=htmlentities($row[5]);

                            if($lastPoints==$user_points) {
                                if($userNameOfmanager == $user_name) {
                                    echo '<tr bgcolor="#BCF4F9">';
                                    echo "<td>$lastRank</td><td><a href='ViewPoints.php?seriesId=$seriesId&&userName=$user_name'>$fName $lName</a></td><td>$transfer</td><td>$user_points</td>";
                                    echo '</tr>';
                                    $user_Displayed_Flag=TRUE;
                                }else {
                                    echo '<tr>';
                                    echo "<td>$lastRank</td><td><a href='ViewPoints.php?seriesId=$seriesId&&userName=$user_name'>$fName $lName</a></td><td>$transfer</td><td>$user_points</td>";
                                    echo '</tr>';
                                }
                            }
                            else {
                                if($userNameOfmanager == $user_name) {
                                    echo '<tr bgcolor="#BCF4F9">';
                                    echo "<td>$rank_no</td><td><a href='ViewPoints.php?seriesId=$seriesId&&userName=$user_name'>$fName $lName</a></td><td>$transfer</td><td>$user_points</td>";
                                    echo '</tr>';
                                    $user_Displayed_Flag=TRUE;
                                }else {
                                    echo '<tr>';
                                    echo "<td>$rank_no</td><td><a href='ViewPoints.php?seriesId=$seriesId&&userName=$user_name'>$fName $lName</a></td><td>$transfer</td><td>$user_points</td>";
                                    echo '</tr>';
                                }

                                $lastRank=$rank_no;
                                $lastPoints=$user_points;

                            }
                            $rank_no++;
                        }
                        if(!$user_Displayed_Flag) {
                            $query_to_userPoints="SELECT s.user_name,s.user_team_name,u.user_points,u.transfer_left,s.first_name,s.last_name
                                  FROM $user_eleven u INNER JOIN users_data s ON u.user_email=s.user_email WHERE u.user_email='$session_email' LIMIT 1";
                            if($resultSet_to_get_username=  mysql_query($query_to_userPoints)) {
                                if(mysql_num_rows($resultSet_to_get_username)==1) {
                                    $user_name1 = htmlentities(mysql_result($resultSet_to_get_username, 0,0));
                                    $user_team1 = htmlentities(mysql_result($resultSet_to_get_username, 0,1));
                                    $user_points1 = htmlentities(mysql_result($resultSet_to_get_username, 0,2));
                                    $transfer1 = htmlentities(mysql_result($resultSet_to_get_username, 0,3));
                                    $fName1= htmlentities(mysql_result($resultSet_to_get_username, 0,4));
                                    $lName1 = htmlentities(mysql_result($resultSet_to_get_username, 0,5));
                                    if($transferString == 'UNLIMITED')
                                        $transfer1="&#8734;";

                                    if($resultSet_to_get_username=  mysql_query("SELECT count(TID)  FROM $user_eleven WHERE  user_points>$user_points1")) {
                                        $rank_no1=  mysql_real_escape_string(mysql_result($resultSet_to_get_username, 0))+1;
                                    }
                                    echo '<tr bgcolor="#BCF4F9">';
                                    echo "<td>$rank_no1</td><td><a href='ViewPoints.php?seriesId=$seriesId&&userName=$user_name1'>$fName1 $lName1</a></td><td>$transfer1</td><td>$user_points1</td>";
                                    echo '</tr>';
                                }
                            }
                        }
                        echo '</table>';
                    }else {
                        echo '<center>SOME ERROR OCCURED</center>';
                    }
                    ?>
                </div>
                <!------>
            </div>
            <div>
                <?php
                include 'PHP/includes/menu.php';
                ?>
            </div>

        </div>


        <script type="text/javascript" src="js/leaderboard.js"></script>

    </body>
</html>
