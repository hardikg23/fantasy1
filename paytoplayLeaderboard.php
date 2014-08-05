<?php
@include 'Header.php';
@include 'PHP/includes/database_connectivity_includes.php';
@session_start();
include 'PHP/includes/session_setter.php';
include 'PHP/includes/seriedId_setter.php';
?>
<html>
    <head>
        <title>Pay To Play</title>
        <link rel="stylesheet" type="text/css" href="css/paytoplayLeaderboard.css">
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
        <div  class="main-body-container box-shadow-comman" style="position: absolute;width: 1000px;height: 1000px;left: 183px;top: 175px;background-color: white">
            <!--LOGIN and LOGOUT -->
            <?php include 'PHP/includes/login_and_logout_file_include.php'; ?>
            <!----------------->
            <!-- MAIN MENU -->
            <div style="position: absolute;left: 0px;top:40px;width:1000px;height: 30px;">
                <?php include 'PHP/includes/main_mune_finder_and _display.php'; ?>
            </div>
            <!---->
            <!-- SUBMENU ----->
            <?php include 'PHP/includes/sub_menu_display.php'; ?>
            <!--------------->


            <!--MAIN BODY--->

            <div class="font-containt" style="position: absolute;width: 1000px;height: 850px;left: 0px;top: 150px;">

                <div class="font-containt box-shadow-comman" style="position: absolute;width: 200px;height: 170px;left: 790px;top: 0px;">
                    <div class="black-header font-containt-bold">
                        USER INFORMATION
                    </div>
                    <?php
                    include 'PHP/includes/userData.php';
                    ?>
                </div>


                <?php
                if(isset ($_GET['mid']) && isset ($_GET['code'])) {
                    $matchID=htmlentities(mysql_real_escape_string($_GET['mid']));
                    $Code=htmlentities(mysql_real_escape_string($_GET['code']));
                    if(!empty ($matchID) && !empty ($Code)) {

                        $table = 's'.$seriesId.'_pay_to_play_club';
                        $datetime = date("Y-m-d H:i:s");
                        if($result_to_get_MatchDATA = mysql_query("SELECT timeAnddate from fixture  where matchID = $matchID and sid = '$seriesId'")) {
                            $matchTime = mysql_result($result_to_get_MatchDATA, 0, 0);
                        }

                        $mStaus = false;
                        if($datetime > $matchTime)
                            $mStaus = true;

                        if($ResultSet_to_find_userjoined_inLeague = mysql_query("SELECT * from $table where user_email = '$session_email' and matchID = $matchID and leagueCode = '$Code'")) {
                            if(mysql_num_rows($ResultSet_to_find_userjoined_inLeague) == 1 || $mStaus) {


                                $leaguerray = array("25PFREE","25P25R","25P100R","25P250R","50PFREE","50P25R","50P100R","50P250R");
                                if (in_array($Code, $leaguerray)) {

                                    // to get match data...
                                    if($result_to_get_MatchDATA = mysql_query("SELECT timeAnddate,team1,team2 FROM `fixture`  where matchID = $matchID and sid=$seriesId")) {
                                        $matchTime = mysql_result($result_to_get_MatchDATA, 0, 0);
                                        $team1 = mysql_result($result_to_get_MatchDATA, 0, 1);
                                        $team2 = mysql_result($result_to_get_MatchDATA, 0, 2);
                                    }
                                    if($session_country == 'India') {
                                        $old_date_timestamp = strtotime($matchTime);
                                        $matchTime = date('j,M h:i A', $old_date_timestamp).' IST';
                                    }else {
                                        $old_date_timestamp = strtotime($matchTime);
                                        $old_date_timestamp = $old_date_timestamp - '19800';
                                        $matchTime = date('j,M h:i A', $old_date_timestamp).' GMT';
                                    }

                                    $club = substr($Code,0,2);
                                    $indexOfP = strrpos($Code, "P");
                                    $indexOfFREE = strrpos($Code, "FREE");
                                    $indexOfR = strrpos($Code, "R");

                                    if($indexOfFREE === false) {
                                        $payedRupee = substr($Code,$indexOfP+1,$indexOfR - $indexOfP - 1) . '  &#x20B9;';
                                    }else {
                                        $payedRupee = 'FREE';
                                    }


                                    ?>
                <div class="fixture-div-item-container" style="position: absolute;width: 760px;height: 30px;left: 10px;top: 0px;height: 110px;">
                    <table width=100% height=110px style="text-shadow:1px 1px 1px #504848;padding-left:10px;color:white;background-image:url(photos/fixturebg.jpg)">
                        <tr>
                            <td align="center"><img class="fixture-images" src="photos/teamsFlags/<?php echo $team1.'.';?>jpg" alt="$team1" width="120px" height="85px"></td>
                            <td align="center"><?php echo 'Match : '.$matchID; ?><br><?php echo '<b>'.$team1.' VS '.$team2.'</b>' ; ?><br><?php echo $matchTime; ?></td>
                            <td align="center"><img class="fixture-images" src="photos/teamsFlags/<?php echo $team2.'.';?>jpg" alt="team2" width="120px" height="85px"></td>
                        </tr>
                    </table>
                </div>

                                    <?php
                                    if($club == '50')
                                        $imageB= 'PTPBanner1';
                                    else
                                        $imageB= 'PTPBanner2';
                                    ?>
                <div class="fixture-div-item-container font-containt-bold" style="position: absolute;width: 760px;height: 70px;left: 10px;top: 140px;">
                    <img src="photos/paytoplay/<?php echo $imageB;?>.jpg" width="100%" height="100%">
                </div>


                <div class="black-header font-containt-bold" style="position: absolute;width: 970px;height: 25px;left: 10px;top: 225px;">
                    <div style='position: absolute;left:0px;top:0px;width: 970px;height:25px;'>

                        <div style='position: absolute;top: 0px;width: 90%;' align = 'left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  LEADERBOARD</div>

                        <div style='position: absolute;top: 0px;width: 90%;' align = 'right'><?php echo 'ENTRY FEE : '.$payedRupee;?></div>
                    </div>

                </div>


                <div class="box-shadow-comman" style="position: absolute;width: 980px;height: 750px;left: 10px;top: 250px;overflow-x: no;">
                                        <?php

                                        if($result_to_get_leaderboardData=mysql_query("SELECT u.first_name,u.last_name,u.user_id,d.last_modified,d.daily_point,s.user_email,s.winStatus FROM $table s
                                                                                Inner Join daily_challenge_eleven_player d
                                                                                on s.user_email = d.user_email and s.matchID = d.matchid
                                                                                Inner join users_data u
                                                                                on u.user_id = s.user_id
                                                                                WHERE s.leagueCode = '$Code' and s.matchID = $matchID
                                                                                order by d.daily_point DESC,d.last_modified")) {


                                            echo "<div style='position: absolute;left:0px;top:0px;width: 950px;;height:75%;padding-bottom:15px;'>";

                                            echo "<div class='leaderboard-item-head' style='position: absolute;left:0px;top:5px;width: 98%;height:20px;'>
                                                <div style='position: absolute;top: 0px;width: 90%;left:20px;'>#</div>
                                                <div style='position: absolute;top: 0px;width: 90%;left:80px;'>MANAGERS</div>
                                                <div style='position: absolute;top: 0px;width: 90%;left:400px;'>LAST UPDATED</div>
                                                <div style='position: absolute;top: 0px;width: 90%;left:750px;'>POINTS</div>
                                           </div>";
                                            echo "<div class='content' style='position: absolute;left:0px;top:30px;width:970px;height:93%;overflow-x: hidden;'>"; // div STRT  id =1

                                            if(mysql_num_rows($result_to_get_leaderboardData) >0) {

                                                $index = 1;
                                                while($row=mysql_fetch_array($result_to_get_leaderboardData)) {
                                                    $firstName=mysql_real_escape_string($row['first_name']);
                                                    $lastName=mysql_real_escape_string($row['last_name']);
                                                    $lastModify=mysql_real_escape_string($row['last_modified']);
                                                    $points=mysql_real_escape_string($row['daily_point']);
                                                    $user_id=mysql_real_escape_string($row['user_id']);
                                                    $user_email=mysql_real_escape_string($row['user_email']);
                                                    $winStatus=mysql_real_escape_string($row['winStatus']);

                                                    if($session_country == 'India') {
                                                        $old_date_timestamp = strtotime($lastModify);
                                                        $lastModify = date('j,M h:i:s A', $old_date_timestamp).' IST';
                                                    }else {
                                                        $old_date_timestamp = strtotime($lastModify);
                                                        $old_date_timestamp = $old_date_timestamp - '19800';
                                                        $lastModify = date('j,M h:i:s A', $old_date_timestamp).' GMT';
                                                    }


                                                    if($winStatus == "Y") {
                                                        $color= '#555555';
                                                        if($user_email == $session_email) {
                                                            $color= 'black';
                                                            $user_id = 'self';
                                                        }
                                                        echo "<a href='#' class='font-containt leaderboard-item match-link' userID='$user_id' mid='$matchID' sid='$seriesId' style='color:$color;font-size:12px;font-weight:bold;background-color:#C4C4C4;'>
                                                <div style='position: absolute;top: 0px;width: 90%; padding-top: 3px;left:20px;'>$index</div>
                                                <div style='position: absolute;top: 0px;width: 90%; padding-top: 3px;left:80px;'>$firstName $lastName </div>
                                                <div style='position: absolute;top: 0px;width: 90%; padding-top: 3px;left:400px;'>$lastModify </div>
                                                <div style='position: absolute;top: 0px;width: 90%; padding-top: 3px;left:750px;'>$points</div>
                                            </a>";
                                                        echo "<div class='$seriesId$matchID' style='width:93%;'></div>";
                                                    }else {
                                                        //$bgcolor= 'white';
                                                        $color= '#818181';
                                                        if($user_email == $session_email) {
                                                            $color= 'black';
                                                            $user_id = 'self';
                                                        }
                                                        echo "<a href='#' class='font-containt leaderboard-item match-link' userID='$user_id' mid='$matchID' sid='$seriesId'  style='color:$color;font-size:12px;background-color:white;'>
                                                <div style='position: absolute;top: 0px;width: 90%; padding-top: 3px;left:20px;'>$index</div>
                                                <div style='position: absolute;top: 0px;width: 90%; padding-top: 3px;left:80px;'>$firstName $lastName </div>
                                                <div style='position: absolute;top: 0px;width: 90%; padding-top: 3px;left:400px;'>$lastModify </div>
                                                <div style='position: absolute;top: 0px;width: 90%; padding-top: 3px;left:750px;'>$points</div>
                                                </a>";
                                                        echo "<div class='$seriesId$matchID' style='width:93%;'></div>";
                                                    }
                                                    $index++;
                                                }

                                                echo '</div></div>';
                                            }else {
                                                echo '<div style="width=93%;" align="center">No member to display</div>';
                                            }
                                            echo "</div>"; // div ENED  id =1
                                        }else {
                                            echo '<div style="width=93%;" align="center">Error occurred while retrieving data</div>';
                                        }
                                        ?>
                </div></div>
                                <?php

                            }else {
                                echo '<div style="width=93%;" align="center">NO such Club</div>';
                            }
                        }else {
                            echo '<center>Please Join the club to view other teams. </center>';
                        }
                    }else {
                        echo '<center> Some Error Occurred.</center>';
                    }

                }else {
                    echo 'Some Data missing.';
                }
            }else {
                echo ' Some Error Occurred.';

            }
            ?>

        </div>
    </div>
    <div class="filler" style="color: #616161;padding-left: 20px;position: absolute;width: 1000px;height: 45px;left: 176px;top: 1150px;background-color: white;padding-top: 8px; ">
        <b>NOTE :</b> In case of 2 or more managers get same points money will be awarded to team which was finalized earlier.
    </div>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery-ui.js"></script>
    <script type="text/javascript" src="js/make_All_page_responsive.js"></script>
    <script type="text/javascript">
        $( ".content" ).accordion({
            heightStyle: "content",
            collapsible: true,
            active:false
        });

        $('.match-link').click(function(){
            var sid=$(this).attr('sid');
            var mid=$(this).attr('mid');
            var userID = $(this).attr('userID');

            $("."+sid+mid).empty();
            $.post('PHP/playToPlayLeaderboardItemClick.php',{
                sid:sid,
                mid:mid,
                userID:userID
            },
            function(data){
                $("."+sid+mid).empty().append(data);
            });
        });
    </script>

</body>
</html>

<?php
include 'Footer.php';
?>

