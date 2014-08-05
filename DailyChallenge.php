<?php
include 'PHP/includes/database_connectivity_includes.php';
include 'Header.php';
@session_start();
include 'PHP/includes/session_setter.php';
include 'PHP/includes/seriedId_setter.php';
?>

<html>
    <head>
        <title>Daily Challenge</title>
        <link rel="stylesheet" type="text/css" href="css/DailyChallenge.css">
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

            <!--MAIN BODY--->

            <div  style="position: absolute;width: 1000px;height: 870px;left: 0px;top: 130px;">
                <!--MAIN BODY-CONTAINT--->
                <div style="position: absolute;width: 1000px;height: 620px;top: 10px;">
                    <div class="font-containt box-shadow-comman" style="position: absolute;width: 700px;height: 45px;top: 0px;left: 10px;">
                        <?php
                        $datetime=date("Y-m-d H:i:s");
                        $sid='';
                        $matchID='';
                        if(isset ($_GET['sid']) && isset ($_GET['mid'])) {
                            if(!empty($_GET['sid']) && !empty($_GET['mid'])) {
                                $sid=mysql_real_escape_string(htmlentities($_GET['sid']));
                                $matchID=mysql_real_escape_string(htmlentities($_GET['mid']));
                                $query_to_get_next_match="select * from fixture where sid=$sid AND matchID=$matchID LIMIT 1";
                                if($Resultset_of_next_match=mysql_query($query_to_get_next_match)) {

                                    if(mysql_num_rows($Resultset_of_next_match) == 0) {
                                        echo("<script>window.location= 'Error.php';</script>");
                                    }
                                    else if(mysql_num_rows($Resultset_of_next_match) == 1) {
                                        $teamone=mysql_real_escape_string(mysql_result($Resultset_of_next_match, 0,'team1'));
                                        $teamtwo=mysql_real_escape_string(mysql_result($Resultset_of_next_match, 0,'team2'));
                                        $matchidno=mysql_real_escape_string(mysql_result($Resultset_of_next_match, 0,'matchID'));
                                        $serid=mysql_real_escape_string(mysql_result($Resultset_of_next_match, 0,'sid'));
                                        $timedatefromdatabase=mysql_real_escape_string(mysql_result($Resultset_of_next_match, 0,'timeAnddate'));
                                        if($session_country == 'India') {
                                            $old_date_timestamp = strtotime($timedatefromdatabase);
                                            $matchTime = date('j, M Y h:i A', $old_date_timestamp);
                                        }else {
                                            $old_date_timestamp = strtotime($timedatefromdatabase);
                                            $old_date_timestamp = $old_date_timestamp - '19800';
                                            $matchTime = date('j, M Y h:i A', $old_date_timestamp).' GMT';
                                        }
                                        echo '<div id="seriesid" style="position: absolute;width: 15px;left:0px;height:20px;top:0px;visibility:hidden;">'.$serid.'</div>';
                                        echo '<div id="matchid" style="position: absolute;width: 15px;left:0px;height:20px;top:0px;visibility:hidden;">'.$matchidno.'</div>';
                                        echo '<div id="timedate" style="position: absolute;width: 15px;left:0px;height:20px;top:0px;visibility:hidden;">'.$timedatefromdatabase.'</div>';
                                        echo '<div class="black-header font-containt-bold"  style="position: absolute;left:0px;width:690px;height:20px;top:0px;">MATCH '.$matchidno.' : '.$teamone.' VS '.$teamtwo.'</div>';
                                        echo '<div align="center" style="color:white;font-weight:bold;position: absolute;left:450px;height: 20px;width:250px;top: 0px;">MATCH TIME<div align="center" class="match-time-div font-containt-bold">'.$matchTime.'</div></div>';

                                    }
                                    else
                                        echo("<script>window.location= 'Error.php';</script>");
                                }else {
                                    echo 'SOME ERROR OCCURED WHILE RETRIVING MATCH DATA';
                                }
                            }
                            else if(empty($_GET['sid']) || empty($_GET['mid'])) {
                                echo("<script>window.location= 'Error.php';</script>");
                            }
                        }else {
                            $query_to_get_next_match="select * from fixture
                                            where timeAnddate>'$datetime' AND dailyMatchStatus='ACTIVE' LIMIT 1";
                            if($Resultset_of_next_match=mysql_query($query_to_get_next_match)) {
                                if(mysql_num_rows($Resultset_of_next_match) == 0) {
                                    echo '<center class="black-header font-containt-bold">NO ON GOING MATCH</center>';
                                    if($Resultset_to_get_sid=mysql_query("SELECT sid,matchID FROM fixture WHERE dailyMatchStatus='ACTIVE' order by `timeAnddate` DESC limit 1")) {
                                       $sid=mysql_real_escape_string(mysql_result($Resultset_to_get_sid, 0,'sid'));
                                       $matchID=mysql_real_escape_string(mysql_result($Resultset_to_get_sid, 0,'matchID'));

                                    }
                                }
                                else if(mysql_num_rows($Resultset_of_next_match) == 1) {
                                    $sid=mysql_real_escape_string(mysql_result($Resultset_of_next_match, 0,'sid'));
                                    $matchID=mysql_real_escape_string(mysql_result($Resultset_of_next_match, 0,'matchID'));
                                    $teamone=mysql_real_escape_string(mysql_result($Resultset_of_next_match, 0,'team1'));
                                    $teamtwo=mysql_real_escape_string(mysql_result($Resultset_of_next_match, 0,'team2'));
                                    $matchidno=mysql_real_escape_string(mysql_result($Resultset_of_next_match, 0,'matchID'));
                                    $serid=mysql_real_escape_string(mysql_result($Resultset_of_next_match, 0,'sid'));
                                    $timedatefromdatabase=mysql_real_escape_string(mysql_result($Resultset_of_next_match, 0,'timeAnddate'));
                                    $old_date_timestamp = strtotime($timedatefromdatabase);
                                    $matchTime = date('j, M Y h : i a', $old_date_timestamp);
                                    echo '<div id="seriesid" style="position: absolute;width: 15px;left:0px;height:20px;top:0px;visibility:hidden;">'.$serid.'</div>';
                                    echo '<div id="matchid" style="position: absolute;width: 15px;left:0px;height:20px;top:0px;visibility:hidden;">'.$matchidno.'</div>';
                                    echo '<div id="timedate" style="position: absolute;width: 15px;left:0px;height:20px;top:0px;visibility:hidden;">'.$timedatefromdatabase.'</div>';
                                    echo '<div class="black-header font-containt-bold" style="position: absolute;left:0px;width:690px;height:20px;top:0px;">MATCH '.$matchidno.' : '.$teamone.' VS '.$teamtwo.'</div>';
                                    echo '<div align="center" style="color:white;font-weight:bold;position: absolute;left:450px;height: 20px;width:250px;top: 0px;">MATCH TIME<div align="center" class="match-time-div font-containt-bold">'.$matchTime.'</div></div>';
                                }
                                else
                                    echo("<script>window.location= 'Error.php';</script>");
                            }else {
                                echo '<center>SOME ERROR OCCURED WHILE RETRIVING MATCH DATA</center>';
                            }
                        }
                        ?>
                    </div>


                    <!---COUNTER FOR MATCH---->
                    <div  class="font-containt box-shadow-comman" style="position: absolute;width: 228px;height: 130px;left: 762px;top:0px;">
                        <?php

                        if(mysql_num_rows($Resultset_of_next_match)==1) {
                            echo "<div class='black-header font-containt-bold'>MATCH $matchID :  $teamone VS $teamtwo</div>";
                            if($timedatefromdatabase > $datetime) {
                                ?>
                        <div id="countdown" style="position: absolute;left: 5px;top: 35px;font-size: 30px;">
                            <script type="text/javascript">
                                var matchTime='<?php echo $timedatefromdatabase?>';
                                var now='<?php echo $datetime?>';
                            </script>
                        </div>
                                <?php
                            }else {
                                echo '<center>MATCH FINISHED</center>';
                            }
                        }
                        else {
                            echo "<div style='position:absolute;top:30px;'><center>ALL MATCHS FOR THIS SERIES ARE FINISHED</center></div>";
                        }

                        ?>
                    </div>
                    <!----->

                    <?php
                    if($sid != '' && $matchID != '') {
                        $s='s'.$sid.'_player_data';
                        if(@$ResultSet_to_find_eleven_player_history=mysql_query("select player1,player2,player3,player4,player5,player6,
                                     player7,player8,player9,player10,player11,captain,budget,daily_point,last_modified from daily_challenge_eleven_player
                                     where user_email='$session_email'&& sid=$sid && matchid=$matchID LIMIT 1")) {
                            if(@mysql_num_rows($ResultSet_to_find_eleven_player_history)==1) {
                                while($row=mysql_fetch_array($ResultSet_to_find_eleven_player_history)) {
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
                                    $daily_point=mysql_real_escape_string($row['daily_point']);
                                    $last_modified=mysql_real_escape_string($row['last_modified']);
                                }

                                //TO DISPLAY TEAM SELECTION LIST
                                if($timedatefromdatabase < $datetime) {
                                    ?>
                    <!--=your daily match points based on performance-->
                    <div class="font-containt box-shadow-comman" style="position: absolute;width:700px;left:10px;top: 75px;height: 45px;">
                        <div style="position: absolute;width:700px;height: 20px;left:0px;top: 0px;">
                                            <?php
                                            if($session_country == 'India') {
                                                $old_date_timestamp = strtotime($last_modified);
                                                $last_modified1 = date('j, M Y  h:i A', $old_date_timestamp);
                                            }else {
                                                $old_date_timestamp = strtotime($last_modified);
                                                $old_date_timestamp = $old_date_timestamp - '19800';
                                                $last_modified1 = date('j,M Y h:i:s A', $old_date_timestamp).' GMT';
                                            }
                                            echo  '<div class="black-header font-containt-bold">LAST UPDATE :  '.$last_modified1.' </div>';
                                            ?>
                        </div>
                        <div  style="position: absolute;width: 140px;height: 30px;left:450px;top: 0px;">
                                            <?php
                                            echo "<div class='black-header font-containt-bold'>POINTS</div>
                            <div align='center' class='daily-points-div font-containt-bold' id=\"transfer_left\">$daily_point</div>";
                                            ?>
                        </div>
                        <div style="position: absolute;width: 120px;height: 30px;left:570px;top: 0px;">
                                            <?php
                                            echo  '<div class="black-header font-containt-bold">&nbsp&nbsp&nbsp&nbspBUDGET</div>
                         <div class="budeget-div font-containt-bold" id="jsBudget">'.$budget.'</div>';
                                            ?>
                        </div>
                    </div>
                    <!---->
                                    <?php
                                }else if($timedatefromdatabase > $datetime) {
                                    ?>

                    <!--display document history of 11 player team...like 4-5 bastman-->
                    <div class="font-containt box-shadow-comman" style="position: absolute;width:700px;left:10px;top: 75px;height: 45px;">
                        <div style="position: absolute;width:700px;height: 20px;left:0px;top: 0px;">
                                            <?php
                                            if($session_country == 'India') {
                                                $old_date_timestamp = strtotime($last_modified);
                                                $last_modified1 = date('j, M Y  h:i a', $old_date_timestamp);
                                            }else {
                                                $old_date_timestamp = strtotime($last_modified);
                                                $old_date_timestamp = $old_date_timestamp - '19800';
                                                $last_modified1 = date('j,M Y h:i:s A', $old_date_timestamp).' GMT';
                                            }
                                            echo  '<div class="black-header font-containt-bold">LAST UPDATE :  '.$last_modified1.'</div>';
                                            ?>
                        </div>
                        <div style="position: absolute;width: 120px;height: 30px;left:570px;top: 0px;">
                                            <?php
                                            echo  '<div class="black-header font-containt-bold">&nbsp&nbsp&nbsp&nbspBUDGET</div>
                                 <div class="budeget-div font-containt-bold" id="jsBudget">'.$budget.'</div>';
                                            ?>
                        </div>
                        <div style="position: absolute;width: 500px;height: 30px;left:50px;top: 30px;font-size: 11px;color: #524E4E">
                            <b>NOTE</b>: For each 1 million $ that you save from 100 million $ you get additional 10 points.<br>
                            For each 1 million $ you use more than 100 million $, 10 points are deduced from your score.
                        </div>
                    </div>
                    <!---->
                                    <?php }
                            }else {
                                ?>

                    <!--display document history of 11 player team...like 4-5 bastman-->
                    <div class="font-containt box-shadow-comman" style="position: absolute;width:700px;left:10px;top: 75px;height: 45px;">
                        <div style="position: absolute;width:700px;height: 20px;left:0px;top: 0px;">
                                        <?php
                                        echo  '<div class="black-header font-containt-bold">GO AHEAD AND SELECT YOUR FANTASTIC 11</div>';
                                        ?>
                        </div>
                        <div style="position: absolute;width: 120px;height: 30px;left:570px;top: 0px;">
                                        <?php
                                        echo  '<div class="black-header font-containt-bold">&nbsp&nbsp&nbsp&nbspBUDGET</div>
                                   <div class="budeget-div font-containt-bold" id="jsBudget">0</div>';
                                        ?>
                        </div>
                        <div style="position: absolute;width: 500px;height: 30px;left:50px;top: 30px;font-size: 11px;color: #524E4E">
                            NOTE: For each 1 million $ that you save from 100 million $ you get additional 10 points.<br>
                            For each 1 million $ you use more than 100 million $, 10 points are deduced from your score.
                        </div>
                    </div>
                    <!---->
                                <?php  }
                        }
                    }
                    ?>
                    <!--= YOUR TEAM OF 11  =-->
                    <div class="font-containt box-shadow-comman" style="position: absolute;width: 700px;height: 500px;left: 10px;top: 150px;">
                        <div class="font-containt header-div-daily" id="error_message" align="center" style="position: absolute;height: 40px;top:10px;left: 15px;width:670px;background-color:green;color:white">
                            YOUR TEAM
                        </div>
                        <?php
                        $arrayX=array(10,124,238,352,466,580,65,179,293,407,521);
                        $arrayY=array(25,25,25,25,25,25,175,175,175,175,175);
                        $tableDaily='s'.$sid.'_player_data';

                        if($sid != '' && $matchID != '') {
                            $s='s'.$sid.'_player_data';
                            //************ TO DISPLAY TEAM OF 11 PLAYERS
                            if($timedatefromdatabase < $datetime) {

                                if(mysql_num_rows($ResultSet_to_find_eleven_player_history)==1) {
                                    $ResultSet_of_player_data=  mysql_query("select id,Name,team,price,imgSrc,style,match$matchID from $tableDaily
                                  where id IN($player1,$player2,$player3,$player4,$player5,$player6,$player7,$player8,$player9,$player10,$player11) ORDER BY style");

                                    if(@mysql_num_rows($ResultSet_of_player_data)==11) {
                                        $index=0;
                                        echo '<div class="background-noimage-div">';
                                        while($row=mysql_fetch_array($ResultSet_of_player_data)) {
                                            $playerid=mysql_real_escape_string($row['id']);
                                            $name=mysql_real_escape_string($row['Name']);
                                            $team=mysql_real_escape_string($row['team']);
                                            $price=mysql_real_escape_string($row['price']);
                                            $style=mysql_real_escape_string($row['style']);
                                            $playerImage=mysql_real_escape_string($row['imgSrc']);
                                            $playerImage='photos/players/'.$team.'/'.$name.'.jpg';
                                            $playerPoint=mysql_real_escape_string($row['match'.$matchID]);  //String of points
                                            $matchPointPlayer=0;
                                            if(strlen($playerPoint) >= 12) {
                                                $matchPoints = explode("#@#", $playerPoint);   //array of string
                                                $matchPointPlayer=$matchPoints[0]+$matchPoints[1]+$matchPoints[2]+$matchPoints[3]+0;   //total match points
                                            }

                                            if($captain != $playerid) {
                                                echo "<div class='player-item' style='position: absolute;width: 110px;height: 138px;left: $arrayX[$index]px;top: $arrayY[$index]px;'>";
                                                echo "<div style='background-color:#0A0E8C;height:18px;'><img src='photos/style/style$style.png' alt='' height='18px' width='18px'><div class='player-name' style='font-size: 10px'>$name</div></div>";
                                                echo "<div><center><img src='$playerImage' alt='Player Image' height='102px' width='110px'></center></div>";
                                                echo "<div><table width='100%' height='15px'; style='background-color:#262222;font-size:12px;color:white'><tr><td align='left'>$price m</td><td align='left'>$team</td><td align='right'>$matchPointPlayer</td></tr></table></div>";
                                                echo '</div>';
                                            }
                                            else if($captain == $playerid) {
                                                $matchPointPlayer=$matchPointPlayer*2;
                                                echo "<div class='player-item' style=\"position: absolute;width: 110px;height: 138px;left: $arrayX[$index]px;top: $arrayY[$index]px;\">";
                                                echo "<div style='background-color:#B5080B;height:18px;'><img src='photos/style/style$style.png' alt='' height='18px' width='18px'><div class='player-name' style='font-size: 10px'>$name</div></div>";
                                                echo "<div><center><img src='$playerImage' alt='Player Image' height='102px' width='110px'></center></div>";
                                                echo "<div><table width='100%' height='15px'; style='background-color:#B5080B;font-size:12px;color:white'><tr><td align='left'>$price m</td><td align='center'>$team</td><td align='right'>$matchPointPlayer</td></tr></table></div>";
                                                echo '</div>';
                                            }
                                            $index++;
                                        }
                                        echo '</div>';
                                    }else {
                                        echo '<center><br><br><br><br><br><br>SOME ERROR OCCURED WHILE RETRIVING YOUR DATA PLEASE TRY LETER</center>';
                                    }
                                }else {
                                    echo '<div class="background-image-div header-div-daily"></div>';
                                }
                            }
                            //TO DISPLAY TEAM OF 11 with selection option
                            else if($timedatefromdatabase > $datetime) {
                                ?>
                        <script type="text/javascript">
                            var playerIDs=new Array();
                            var playerStyles=new Array();
                            var playerNames=new Array();
                            var playerPrices=new Array();
                            var playerTeams=new Array();
                            var captain;
                        </script>

                                <?php
                                if(mysql_num_rows($ResultSet_to_find_eleven_player_history)==1) {
                                    $ResultSet_of_player_data=  mysql_query("select id,Name,team,price,style,total_point from $tableDaily
                                                    where id IN($player1,$player2,$player3,$player4,$player5
                                                    ,$player6,$player7,$player8,$player9,$player10,$player11) ORDER BY style");

                                    if(mysql_num_rows($ResultSet_of_player_data)==11) {

                                        ?>
                        <script type="text/javascript">
                            captain=<?php echo $captain ?>;
                        </script>

                        <div id="container_eleven_player" class="background-image2-div header-div-daily">
                                            <?php
                                            $index=0;
                                            while($row=mysql_fetch_array($ResultSet_of_player_data)) {
                                                $playerid=mysql_real_escape_string($row['id']);
                                                $name=mysql_real_escape_string($row['Name']);
                                                $team=mysql_real_escape_string($row['team']);
                                                $price=mysql_real_escape_string($row['price']);
                                                $style=mysql_real_escape_string($row['style']);
                                                $point=mysql_real_escape_string($row['total_point']);
                                                ?>
                            <script type="text/javascript">
                                playerIDs.push(<?php echo $playerid;?>);
                                playerStyles.push(<?php echo $style;?>);
                                playerNames.push("<?php echo $name; ?>");
                                playerTeams.push("<?php echo $team; ?>");
                                playerPrices.push(<?php echo $price; ?>);
                            </script>

                                                <?php
                                                $index++;
                                            }
                                            echo '</div>';
                                        }else {
                                            echo '<br><br><br><br><br><br><center>SOME ERROR OCCURED WHILE RETRIVING YOUR DATA PLEASE TRY LETER</center>';
                                        }
                                    }else {
                                        echo '<div id="container_eleven_player" class="background-image2-div header-div-daily"></div>';
                                    }
                                    ?>
                            <!--captain selection save or reset button-->
                            <div class="font-containt header-div-daily" style="position: absolute; width: 670px;left: 15px; top: 410px; height: 50px;background-color:#76207C;color:white;">

                                <div style="position: absolute; left:20px;top:10px;">
                                    Your Captain:
                                    <select style="margin-top: 5px;width: 125px;" id="playercaptain">
                                    </select>
                                </div>

                                <input class="captain-save-button" style="position:absolute;left:450px;top:10px;" type="button" Value="SAVE" id="save_eleven">
                                <input class="captain-reset-button" style="position:absolute ;left:550px;top:10px;" type="button" Value="RESET" id="reset_eleven">

                            </div>

                            <!--=-->
                                    <?php
                                }
                            }

                            ?>
                        </div>
                        <!--=-->


                        <!--===team selection div displayed on right side=-->
                        <div class="font-containt box-shadow-comman" id="daily_team_selection_process" style="position: absolute;width: 270px;height: 500px;left:720px;top: 150px;">
                            <?php
                            if($sid != '' && $matchID != '') {
                                $s='s'.$sid.'_player_data';
                                // TO DISPLAY TEAM SELECTION LIST
                                if($timedatefromdatabase > $datetime) {

                                    ?>
                            <!----=========================  Select team and type =============================================----->
                            <div class="font-containt box-shadow-comman" style="position: absolute;width: 270px;height: 50px;left:0px;top: 0px;background-color: #A50606">
                                <div class="black-header font-containt-bold">
                                    <center>SELECT PLAYERS IN YOUR TEAM</center>
                                </div>
                                TEAM :
                                <select name="teams" class="select_team_1" id="select_daily_team_1">

                                            <?php
                                            echo '<option value="all">ALL</option>';
                                            echo '<option value='.$teamone.'>'.$teamone.'</option>';
                                            echo '<option value='.$teamtwo.'>'.$teamtwo.'</option>';
                                            ?>
                                </select>
                                TYPE:
                                <select name="style" class="select_type_1" id="select_daily_type_1">
                                    <option value="all">ALL</option>
                                    <option value="batsman">BATSMAN</option>
                                    <option value="all-rounder">ALL-ROUNDER</option>
                                    <option value="weeket-keeper">WEEKET-KEEPER</option>
                                    <option value="bowler">BOWLER</option>

                                </select>
                            </div>
                            <!-------->

                            <script type="text/javascript">
                                var playerID=new Array();
                                var playerName=new Array();
                                var playerTeam=new Array();
                                var playerPrice=new Array();
                                var playerStyle=new Array();
                                var playerPoints=new Array();
                                var playerPlayingStatus=new Array();
                                var playerPhoto=new Array();
                                var index_of_players=0;
                            </script>
                                    <?php
                                    $result=mysql_query("SELECT * from $s WHERE (playingStatus=1 OR playingStatus=2) AND (team = '$teamone' || team = '$teamtwo') ORDER BY total_point DESC");
                                    echo '<div style="position:absolute;left:0px;top:50px;height:450px;width:270px;overflow-y:auto;">';
                                    echo '<table id="selection_process" class="tablesorter selection-table">';
                                    echo '<thead><tr><th></th><th></th><th>PLAYER</th><th>TEAM</th><th>T_PTS</th><th>PRICE</th></tr></thead>
                                          <tbody id="selection_process_body">';

                                    while($row=mysql_fetch_array($result)) {


                                        $playerid=mysql_real_escape_string($row['id']);
                                        $name=mysql_real_escape_string($row['Name']);
                                        $team=mysql_real_escape_string($row['team']);
                                        $price=mysql_real_escape_string($row['price']);
                                        $style=mysql_real_escape_string($row['style']);
                                        $point=mysql_real_escape_string($row['total_point']);
                                        $playingStatus=mysql_real_escape_string($row['playingStatus']);
                                        $photo=mysql_real_escape_string($row['imgSrc']);
                                        $colorCode='black';

                                        ?>
                            <script type="text/javascript">
                                var h1,h2,h3,h4,h5,h6,h7,h8;
                                h1=<?php echo $playerid?>;
                                h2=<?php echo "'$name'"?>;
                                h3=<?php echo "'$team'"?>;
                                h4=<?php echo $price?>;
                                h5=<?php echo $style?>;
                                h6=<?php echo $point?>;
                                h7=<?php echo $playingStatus?>;
                                h8=<?php echo "'$photo'"?>;
                                playerID.push(h1);
                                playerName.push(h2);
                                playerTeam.push(h3);
                                playerPrice.push(h4);
                                playerStyle.push(h5);
                                playerPoints.push(h6);
                                playerPlayingStatus.push(h7);
                                playerPhoto.push(h8);
                            </script>


                                        <?php
                                        if($playingStatus==2)
                                            $colorCode='red';
                                        echo '<tr  style="color:'.$colorCode.'" align="center" id='.$playerid.' >';
                                        echo '<td><img style="cursor:pointer" class="select_eleven" src="photos/right.png" height="15px" width="15px"></td>
                                              <td id='.$style.'><font style="visibility: hidden">'.$style.'</font><img  src="photos/style/style'.$style.'.png" height="15px" width="15px"></td>
                                              <td>'.$name.'</td><td>'.$team.'</td><td>'.$point.'</td><td>'.$price.'</td>';
                                        echo '</tr>';

                                    }
                                    echo '</tbody></table>';
                                    echo '</div>';
                                }

                                else    //TO DISPLAY TOP PLAYERS TEAM
                                {
                                    $query_to_fing_first_rank="SELECT *
                                        FROM daily_challenge_eleven_player
                                        WHERE sid=$sid AND matchid=$matchID
                                        HAVING daily_point=(SELECT MAX(daily_point) from daily_challenge_eleven_player where sid=$sid AND matchid=$matchID)
                                        ORDER BY last_modified LIMIT 1";


                                    if($ResultSet_to_fing_first_rank=mysql_query($query_to_fing_first_rank)) {
                                        if(mysql_num_rows($ResultSet_to_fing_first_rank)==1) {
                                            echo '<div class="black-header font-containt-bold">
                                                    <center> WINNER OF QUICK PLAY MATCH</center>
                                                  </div>';

                                            $dailyUserName=mysql_real_escape_string(mysql_result($ResultSet_to_fing_first_rank, 0,'user_name'));
                                            $player1=mysql_real_escape_string(mysql_result($ResultSet_to_fing_first_rank, 0,'player1'));
                                            $player2=mysql_real_escape_string(mysql_result($ResultSet_to_fing_first_rank, 0,'player2'));
                                            $player3=mysql_real_escape_string(mysql_result($ResultSet_to_fing_first_rank, 0,'player3'));
                                            $player4=mysql_real_escape_string(mysql_result($ResultSet_to_fing_first_rank, 0,'player4'));
                                            $player5=mysql_real_escape_string(mysql_result($ResultSet_to_fing_first_rank, 0,'player5'));
                                            $player6=mysql_real_escape_string(mysql_result($ResultSet_to_fing_first_rank, 0,'player6'));
                                            $player7=mysql_real_escape_string(mysql_result($ResultSet_to_fing_first_rank, 0,'player7'));
                                            $player8=mysql_real_escape_string(mysql_result($ResultSet_to_fing_first_rank, 0,'player8'));
                                            $player9=mysql_real_escape_string(mysql_result($ResultSet_to_fing_first_rank, 0,'player9'));
                                            $player10=mysql_real_escape_string(mysql_result($ResultSet_to_fing_first_rank, 0,'player10'));
                                            $player11=mysql_real_escape_string(mysql_result($ResultSet_to_fing_first_rank, 0,'player11'));
                                            $dailyCaptain=mysql_real_escape_string(mysql_result($ResultSet_to_fing_first_rank, 0,'captain'));
                                            $user_team_name=mysql_real_escape_string(mysql_result($ResultSet_to_fing_first_rank, 0,'user_team_name'));
                                            $daily_point=mysql_real_escape_string(mysql_result($ResultSet_to_fing_first_rank, 0,'daily_point'));
                                            $last_modified=mysql_real_escape_string(mysql_result($ResultSet_to_fing_first_rank, 0,'last_modified'));
                                            $budget=mysql_real_escape_string(mysql_result($ResultSet_to_fing_first_rank, 0,'budget'));

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
                                            echo "<div align='center' style='background-color:#640C6E;'>
                                                <table width=100% style='color:white;font-size:12px;padding-left:10px;'>
                                                    <tr>
                                                        <td>USER NAME :  $d_firstname $d_lastname </td>
                                                    </tr>
                                                    <tr>
                                                        <td>LAST UPDATED : $last_modified1</td>
                                                    </tr>
                                                    <tr>
                                                        <td>TEAM NAME : $user_team_name</td>
                                                    </tr>
                                                    <tr>
                                                        <td>POINTS :<font style='color:#EB0B2D;font-size:18px;font-weight:bold;'> $daily_point </font>
                                                            &nbsp;&nbsp;&nbsp;&nbsp; BUDGET : <font style='color:#EB0B2D;font-size:18px;font-weight:bold;'>$budget m$</font> </td>
                                                     </tr>
                                                    </table>
                                                  </div>";


                                            $query_to_get_elevent_player="SELECT id,Name,team,style,match$matchID FROM $s where id IN ($player1,$player2,$player3,$player4,$player5,
                                                    $player6,$player7,$player8,$player9,$player10,$player11) ORDER BY style";

                                            if($ResultSet_to_get_elevent_player=mysql_query($query_to_get_elevent_player)) {
                                                if(mysql_num_rows($ResultSet_to_get_elevent_player) == 11) {
                                                    echo '<table class="selection-table" style="top:110px;">';
                                                    echo '<th></th><th>PLAYER</th><th>TEAM</th><th>POINTS</th>';
                                                    while($row=mysql_fetch_array($ResultSet_to_get_elevent_player)) {
                                                        $playerid1=mysql_real_escape_string($row['id']);
                                                        $playerStyle=mysql_real_escape_string($row['style']);
                                                        $playerName=mysql_real_escape_string($row['Name']);
                                                        $playerTeam=mysql_real_escape_string($row['team']);
                                                        $playerPoint=mysql_real_escape_string($row['match'.$matchID]);  //String of points
                                                        $matchPointPlayer=0;

                                                        if(strlen($playerPoint) >= 12) {
                                                            $matchPoints = explode("#@#", $playerPoint);   //array of string
                                                            $matchPointPlayer=$matchPoints[0]+$matchPoints[1]+$matchPoints[2]+$matchPoints[3]+0;   //total match points
                                                        }
                                                        if($dailyCaptain==$playerid1) {
                                                            $matchPointPlayer*=2;
                                                            echo '<tr style="background-color:#FF3535">';
                                                            echo "<td><img src='photos/style/style$playerStyle.png' ></td><td>$playerName</td><td>$playerTeam</td><td>$matchPointPlayer</td>";
                                                            echo '</tr>';
                                                        }
                                                        else {
                                                            echo '<tr>';
                                                            echo "<td><img src='photos/style/style$playerStyle.png' ></td><td>$playerName</td><td>$playerTeam</td><td>$matchPointPlayer</td>";
                                                            echo '</tr>';
                                                        }

                                                    }
                                                    echo '</table>';
                                                }else {
                                                    echo '11 TOP player not found';
                                                }
                                            }else {
                                                echo 'SOME ERROR OCCERD';
                                            }
                                        }else {
                                            echo '<center>NO RESULT FOUND FOR THIS MATCH</center>';
                                        }
                                    }else {
                                        echo '<center>SOME ERROR OCCURED</center>';
                                    }
                                }
                            }
                            else {
                                echo 'DISPLAY IMAGE';
                            }

                            ?>
                        </div>
                        <!-------->
			
			 <div align="center" style="position: absolute; left: 10px; top: 700px; width: 980px; height: 90px;">
				<!-- START CLIENT.YESADVERTISING CODE -->
<script language="javascript" type="text/javascript" charset="utf-8">
cpxcenter_width = 728;
cpxcenter_height = 90;
</script>
<script language="JavaScript" type="text/javascript" src="http://ads.cpxcenter.com/cpxcenter/showAd.php?nid=4&amp;zone=57769&amp;type=banner&amp;sid=42856&amp;pid=40382&amp;subid=">
</script>
<!-- END CLIENT.YESADVERTISING CODE -->

			</div>

                        <!--- NEXT and PRIVOUS BUTTON ----->
                        <div style="position: absolute;left:-90px;top:250px;">
                            <?php
                            $query_to_get_prev_match_fixture="SELECT sid,matchID
                                 from fixture where timeAnddate<( SELECT timeAnddate
                                 FROM fixture WHERE sid=$sid AND matchID=$matchID) AND dailyMatchStatus='ACTIVE'
                                 ORDER BY timeAnddate DESC LIMIT 1";
                            $prevSID='';
                            $prevMID='';
                            if($resultSet_prev_fixture_data=mysql_query($query_to_get_prev_match_fixture)) {
                                if(mysql_num_rows($resultSet_prev_fixture_data)==1) {
                                    $prevSID=mysql_real_escape_string(mysql_result($resultSet_prev_fixture_data, 0,'sid'));
                                    $prevMID=mysql_real_escape_string(mysql_result($resultSet_prev_fixture_data, 0,'matchID'));
                                    $prevHref="DailyChallenge.php?seriesId=$seriesId&sid=$prevSID&mid=$prevMID";
                                }
                                else
                                    $prevHref="DailyChallenge.php?seriesId=$seriesId&sid=$sid&mid=$matchID";
                            }
                            ?>
                            <a href="<?php echo $prevHref?>">
                                <img src="photos/dailyChellenge/prevDailyButton.png" id="Previous" width="100px" height="100px">
                            </a>
                        </div>
                        <div style="position: absolute;left:990px;top:250px;">
                            <?php
                            $query_to_get_next_match_fixture="SELECT sid,matchID from fixture
               where timeAnddate>(SELECT timeAnddate FROM fixture WHERE sid=$sid AND matchID=$matchID) AND dailyMatchStatus='ACTIVE' LIMIT 1";
                            $nextSID='';
                            $nextMID='';
                            if($resultSet_next_fixture_data=mysql_query($query_to_get_next_match_fixture)) {
                                if(mysql_num_rows($resultSet_next_fixture_data)==1) {
                                    $nextSID=mysql_real_escape_string(mysql_result($resultSet_next_fixture_data, 0,'sid'));
                                    $nextMID=mysql_real_escape_string(mysql_result($resultSet_next_fixture_data, 0,'matchID'));
                                    $nextHref="DailyChallenge.php?seriesId=$seriesId&sid=$nextSID&mid=$nextMID";
                                }else
                                    $nextHref="DailyChallenge.php?seriesId=$seriesId&sid=$sid&mid=$matchID";
                            }

                            ?>
                            <a href="<?php echo $nextHref?>">
                                <img id="Next"  src="photos/dailyChellenge/nextDailyButton.png" id="Previous" width="100px" height="100px">
                            </a>
                        </div>
                        <!-------->
                    </div>
                </div>
            </div>
            <!---------->

        </div>
        <div class="filler" style="position: absolute;width: 1000px;height: 45px;left: 176px;top: 1150px;background-color: white">
        </div>
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
        <script type="text/javascript" src="js/make_All_page_responsive.js"></script>
        <script type="text/javascript">

            $('#selection_process').tablesorter();
            $("body").on("change", "#select_daily_team_1,#select_daily_type_1", function(){

                var item1=$('#select_daily_team_1').val();
                var item2=$('#select_daily_type_1').val();
                $('#selection_process_body').empty();
                for(var i=0;i<playerID.length;i++)
                {
                    var colorCode='black';
                    if(playerPlayingStatus[i]==2)
                        colorCode='red';
                    if(item1=='all' && item2=='all')
                    {
                        var styleImage="photos/style/style"+playerStyle[i]+".png";
                        $('#selection_process_body').append("<tr style=color:"+colorCode+" align='center' id="+playerID[i]+"><td><img style='cursor:pointer' class='select_eleven' src='photos/right.png' height='15px' width='15px'></td><td id='"+playerStyle[i]+"'><font style='visibility: hidden'>"+playerStyle[i]+"</font><img  src='"+styleImage+"' height='15px' width='15px'></td><td>"+playerName[i]+"</td><td>"+playerTeam[i]+"</td><td>"+playerPoints[i]+"</td><td>"+playerPrice[i]+"</td></tr>");
                    }
                    else if(item1!='all' && item2 == 'all')
                    {
                        var styleImage="photos/style/style"+playerStyle[i]+".png";
                        if(item1 == playerTeam[i])
                            $('#selection_process_body').append("<tr style=color:"+colorCode+" align='center' id="+playerID[i]+"><td><img style='cursor:pointer' class='select_eleven' src='photos/right.png' height='15px' width='15px'></td><td id='"+playerStyle[i]+"'><font style='visibility: hidden'>"+playerStyle[i]+"</font><img  src='"+styleImage+"' height='15px' width='15px'></td><td>"+playerName[i]+"</td><td>"+playerTeam[i]+"</td><td>"+playerPoints[i]+"</td><td>"+playerPrice[i]+"</td></tr>");
                    }
                    else if(item1 =='all' && item2 != 'all')
                    {
                        var styleImage="photos/style/style"+playerStyle[i]+".png";
                        if(item2 == 'batsman' && (playerStyle[i] == 1 || playerStyle[i] == 2))
                            $('#selection_process_body').append("<tr style=color:"+colorCode+" align='center' id="+playerID[i]+"><td><img style='cursor:pointer' class='select_eleven' src='photos/right.png' height='15px' width='15px'></td><td id='"+playerStyle[i]+"'><font style='visibility: hidden'>"+playerStyle[i]+"</font><img  src='"+styleImage+"' height='15px' width='15px'></td><td>"+playerName[i]+"</td><td>"+playerTeam[i]+"</td><td>"+playerPoints[i]+"</td><td>"+playerPrice[i]+"</td></tr>");
                        if(item2 == 'all-rounder' && playerStyle[i] == 4)
                            $('#selection_process_body').append("<tr style=color:"+colorCode+" align='center' id="+playerID[i]+"><td><img style='cursor:pointer' class='select_eleven' src='photos/right.png' height='15px' width='15px'></td><td id='"+playerStyle[i]+"'><font style='visibility: hidden'>"+playerStyle[i]+"</font><img  src='"+styleImage+"' height='15px' width='15px'></td><td>"+playerName[i]+"</td><td>"+playerTeam[i]+"</td><td>"+playerPoints[i]+"</td><td>"+playerPrice[i]+"</td></tr>");
                        if(item2 == 'weeket-keeper' && (playerStyle[i] == 2 || playerStyle[i] == 3))
                            $('#selection_process_body').append("<tr style=color:"+colorCode+" align='center' id="+playerID[i]+"><td><img style='cursor:pointer' class='select_eleven' src='photos/right.png' height='15px' width='15px'></td><td id='"+playerStyle[i]+"'><font style='visibility: hidden'>"+playerStyle[i]+"</font><img  src='"+styleImage+"' height='15px' width='15px'></td><td>"+playerName[i]+"</td><td>"+playerTeam[i]+"</td><td>"+playerPoints[i]+"</td><td>"+playerPrice[i]+"</td></tr>");
                        if(item2 == 'bowler' && playerStyle[i] == 5)
                            $('#selection_process_body').append("<tr style=color:"+colorCode+" align='center' id="+playerID[i]+"><td><img style='cursor:pointer' class='select_eleven' src='photos/right.png' height='15px' width='15px'></td><td id='"+playerStyle[i]+"'><font style='visibility: hidden'>"+playerStyle[i]+"</font><img  src='"+styleImage+"' height='15px' width='15px'></td><td>"+playerName[i]+"</td><td>"+playerTeam[i]+"</td><td>"+playerPoints[i]+"</td><td>"+playerPrice[i]+"</td></tr>");

                    }
                    else if(item1 !='all' && item2 != 'all')
                    {
                        var styleImage="photos/style/style"+playerStyle[i]+".png";
                        if((item1 == playerTeam[i]) &&    item2 == 'batsman' && (playerStyle[i] == 1 || playerStyle[i] == 2))
                            $('#selection_process_body').append("<tr style=color:"+colorCode+" align='center' id="+playerID[i]+"><td><img style='cursor:pointer' class='select_eleven' src='photos/right.png' height='15px' width='15px'></td><td id='"+playerStyle[i]+"'><font style='visibility: hidden'>"+playerStyle[i]+"</font><img  src='"+styleImage+"' height='15px' width='15px'></td><td>"+playerName[i]+"</td><td>"+playerTeam[i]+"</td><td>"+playerPoints[i]+"</td><td>"+playerPrice[i]+"</td></tr>");
                        if((item1 == playerTeam[i]) &&  item2 == 'all-rounder' && playerStyle[i] == 4)
                            $('#selection_process_body').append("<tr style=color:"+colorCode+" align='center' id="+playerID[i]+"><td><img style='cursor:pointer' class='select_eleven' src='photos/right.png' height='15px' width='15px'></td><td id='"+playerStyle[i]+"'><font style='visibility: hidden'>"+playerStyle[i]+"</font><img  src='"+styleImage+"' height='15px' width='15px'></td><td>"+playerName[i]+"</td><td>"+playerTeam[i]+"</td><td>"+playerPoints[i]+"</td><td>"+playerPrice[i]+"</td></tr>");
                        if((item1 == playerTeam[i]) &&  item2 == 'weeket-keeper' && (playerStyle[i] == 2 || playerStyle[i] == 3))
                            $('#selection_process_body').append("<tr style=color:"+colorCode+" align='center' id="+playerID[i]+"><td><img style='cursor:pointer' class='select_eleven' src='photos/right.png' height='15px' width='15px'></td><td id='"+playerStyle[i]+"'><font style='visibility: hidden'>"+playerStyle[i]+"</font><img  src='"+styleImage+"' height='15px' width='15px'></td><td>"+playerName[i]+"</td><td>"+playerTeam[i]+"</td><td>"+playerPoints[i]+"</td><td>"+playerPrice[i]+"</td></tr>");
                        if((item1 == playerTeam[i]) &&  item2 == 'bowler' && playerStyle[i] == 5)
                            $('#selection_process_body').append("<tr style=color:"+colorCode+" align='center' id="+playerID[i]+"><td><img style='cursor:pointer' class='select_eleven' src='photos/right.png' height='15px' width='15px'></td><td id='"+playerStyle[i]+"'><font style='visibility: hidden'>"+playerStyle[i]+"</font><img  src='"+styleImage+"' height='15px' width='15px'></td><td>"+playerName[i]+"</td><td>"+playerTeam[i]+"</td><td>"+playerPoints[i]+"</td><td>"+playerPrice[i]+"</td></tr>");

                    }
                }
<?php
//}
?>
        $('#selection_process').append("</tbody>");
        $("#selection_process").trigger("update");
        var sorting = [[4,1]];
        $("#selection_process").trigger("sorton",[sorting]);
        return false;
    });
        </script>
        <script type="text/javascript" src="js/DailyChallenge.js"></script>
        <script type="text/javascript" src="js/DailyChallenge-effects.js"></script>
        <script type="text/javascript" src="js/countdown.jquery.js"></script>
    </body>
</html>

<?php
include 'Footer.php';
?>