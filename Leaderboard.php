<?php
include 'Header.php';
include 'PHP/includes/database_connectivity_includes.php';
@session_start();
include 'PHP/includes/session_setter.php';
include 'PHP/includes/seriedId_setter.php';
?>
<html>
    <head>
        <title>Home</title>
        <link rel="stylesheet" type="text/css" href="css/Leaderboard.css">

    </head>
    <body>
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-49852980-1', 'fantasycricleague.com');
            ga('send', 'pageview');

        </script>

        <div class="filler box-shadow-comman" style="position: absolute;width: 1000px;height: 35px;left: 176px;top: 150px;background-color: white">
        </div>


        <div class="main-body-container box-shadow-comman" style="position: absolute;width: 1000px;height: 1000px;left: 183px;top: 175px;background-color: white">
            <!--LOGIN and LOGOUT -->
            <?php include 'PHP/includes/login_and_logout_file_include.php';?>
            <!----------------->
            <!-- MAIN MENU -->
            <div style="position: absolute;left: 0px;top:40px;width:1000px;height: 30px;">
                <?php include 'PHP/includes/main_mune_finder_and _display.php';?>
            </div>
            <!---->
            <!-- SUBMENU ----->
            <?php include 'PHP/includes/sub_menu_display.php';?>
            <!--------------->


            <!-----------------Main Body ---------------------------------------------------------------------------------->
            <div  style="position: absolute;width: 1000px;height: 870px;left: 0px;top: 130px;">
                <!--LEADERBOARD-->
                <div class="black-header font-containt-bold" style="position: absolute;width: 728px;height: 22px;left: 10px;top: 0px;">
                    LEADERBOARD
                    <div style="position: absolute;left: 500px;top: 0px;">
                        <?php
                        $totalcount="";
                        @$user_eleven = 's' . $seriesId . '_user_eleven_data';
                        if(@$resultSet_total_users=mysql_query("SELECT count(TID) from $user_eleven")) {
                            $count=mysql_real_escape_string(htmlentities(mysql_result(@$resultSet_total_users, 0)));
                            $totalcount="TOTAL TEAMS : $count";
                            echo $totalcount;
                        }
                        ?>
                    </div>
                </div>

                <div class="font-containt box-shadow-comman" style="position: absolute;width: 736px;height: 820px;left: 10px;top: 25px;overflow: auto;">

                    <div align="center">
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
                          FROM $user_eleven u INNER JOIN users_data s ON u.user_email=s.user_email ORDER BY u.user_points DESC LIMIT 100";
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
                            echo '<table align="center" class="leaderboard-table"><tr>
                                          <th width="10%">#</th>
                                          <th width="33%">MANAGER</th>
                                          <th width="28%">TEAM</th>
                                          <th width="17%">TRANSFERS</th>
                                          <th width="12%">POINTS</th>
                                         </tr>';
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
                                        echo "<td>$lastRank</td><td><a href='ViewPoints.php?seriesId=$seriesId&&userName=$user_name'>$fName $lName</a></td><td>$user_team</td><td>$transfer</td><td>$user_points</td>";
                                        echo '</tr>';
                                        $user_Displayed_Flag=TRUE;
                                    }else {
                                        echo '<tr>';
                                        echo "<td>$lastRank</td><td><a href='ViewPoints.php?seriesId=$seriesId&&userName=$user_name'>$fName $lName</a></td><td>$user_team</td><td>$transfer</td><td>$user_points</td>";
                                        echo '</tr>';
                                    }
                                }
                                else {
                                    if($userNameOfmanager == $user_name) {
                                        echo '<tr bgcolor="#BCF4F9">';
                                        echo "<td>$rank_no</td><td><a href='ViewPoints.php?seriesId=$seriesId&&userName=$user_name'>$fName $lName</a></td><td>$user_team</td><td>$transfer</td><td>$user_points</td>";
                                        echo '</tr>';
                                        $user_Displayed_Flag=TRUE;
                                    }else {
                                        echo '<tr>';
                                        echo "<td>$rank_no</td><td><a href='ViewPoints.php?seriesId=$seriesId&&userName=$user_name'>$fName $lName</a></td><td>$user_team</td><td>$transfer</td><td>$user_points</td>";
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
                                        echo "<td>$rank_no1</td><td><a href='ViewPoints.php?seriesId=$seriesId&&userName=$user_name1'>$fName1 $lName1</a></td><td>$user_team1</td><td>$transfer1</td><td>$user_points1</td>";
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
                </div>
                <!------>
                <div class="font-containt box-shadow-comman" style="position: absolute;width: 220px;height: 170px;left: 770px;top: 0px;">
                    <div class="black-header font-containt-bold">
                        USER INFORMATION
                    </div>
                    <?php
                    include 'PHP/includes/userData.php';
                    ?>
                </div>
                <div class="font-containt box-shadow-comman" style="position: absolute;width: 220px;height: 178px;left: 770px;top: 186px; overflow:auto;">
                    <div class="black-header font-containt-bold">
                        PRIVATE LEAGUE
                    </div>
                    <?php include 'PHP/includes/privateLeague.php'; ?>
                </div>

                <div class="font-containt box-shadow-comman" style="position: absolute;width: 220px;height: 178px;left: 770px;top: 400px; overflow:auto;">
                    <div class="black-header font-containt-bold">
                        PUBLIC LEAGUE
                    </div>
                    <?php include 'PHP/includes/publicLeague.php';?>
                </div>
                <div align="center" style="position: absolute;width: 250px;height: 250px;left: 750px;top: 186px;">


                </div>


            </div>
            <!-------->
        </div>
        <div class="filler" style="position: absolute;width: 1000px;height: 45px;left: 176px;top: 1150px;background-color: white">
        </div>
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/make_All_page_responsive.js"></script>

    </body>
</html>
<?php
include 'Footer.php';
?>