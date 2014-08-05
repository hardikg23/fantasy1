<?php

    @include 'PHP/includes/database_connectivity_includes.php';
    session_start();
    if(isset ($_SESSION['username']) && isset ($_SESSION['email'])&&isset ($_SESSION['password'])&&isset ($_SESSION['country'])){
        if(!empty ($_SESSION['username']))
            $session_username= $_SESSION['username'];
        if(!empty ($_SESSION['email']))
            $session_email= $_SESSION['email'];
        if(!empty ($_SESSION['password']))
            $session_password= $_SESSION['password'];
        if(!empty ($_SESSION['country']))
            $session_country= $_SESSION['country'];
    }
    include 'PHP/includes/seriedId_setter.php';
    @include 'Header.php';
?>
<html>
    <head>
	<title>HOME</title>
            <link rel="stylesheet" type="text/css" href="css/Home.css">
            <link rel="stylesheet" type="text/css" href="themes/1/js-image-slider.css">
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
    <div class="main-body-container box-shadow-comman" style="position: absolute;width: 1000px;height: 1000px;left: 176px;top: 170px;background-color: white">
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

        <div  class="font-containt box-shadow-comman" style="position: absolute;width: 228px;height: 130px;left: 762px;top: 130px;">
        <?php
                    $datetime=date("Y-m-d H:i:s");
                    if($resultSET=mysql_query("SELECT matchID,team1,team2,timeAnddate FROM fixture WHERE timeAnddate > '$datetime' AND sid=$seriesId LIMIT 1")){
                       if(mysql_num_rows($resultSET)==1)
                        {
                        $team1 = mysql_result($resultSET, 0,'team1');
                        $team2 = mysql_result($resultSET, 0,'team2');
                        $match = mysql_result($resultSET, 0,'matchID');
                        $matchDate = mysql_result($resultSET, 0,'timeAnddate');
                        echo "<div class='home-10-playerStats-header font-containt-bold'>NEXT MATCH : $match  $team1 VS $team2</div>";
                        ?>
                        <div id="countdown" style="position: absolute;left: 5px;top: 35px;font-size: 30px;">
                         <script type="text/javascript">
                            var matchTime='<?php echo $matchDate?>';
                            var now='<?php echo $datetime?>';
                         </script>
                        </div>
                        <?php
                        }
                        else{
                            echo "<div style='position:absolute;top:30px;'><center>ALL MATCHS FOR THIS SERIES ARE FINISHED</center></div>";
                            $match="finished";
                        }
                    }
                ?>
        </div>


        <!----- IMAGE CORZOLLA------>
        <div style="position: absolute;left: 0px;top: 120px;width: 750px;height: 680px;">
            <div class="box-shadow-comman" style="position: absolute;left: 10px;top: 5px;width: 730px;height: 350px; background-color: #cccccc">
                <a href="paytoplay.php"><img src="images/homeImage.png" width="98%" height="95%" style="padding-left: 1%;padding-top: 1%;"></a>
                <!--
                <div id="sliderFrame">
                    <div id="slider">
                        <img src="images/image-slider-1.jpg" alt="1. To Pick your squad...Use your budget of $100m to pick a squad of 11 players from the Series which is going on" />
                        <img src="images/image-slider-2.jpg" alt="2. Create and join leagues...Play against friends and family, colleagues or a web community in private leagues." />
                        <img src="images/image-slider-3.jpg" alt="3. Play daily in QUICK PLAY and win cash prize" />
                        <img src="images/image-slider-4.jpg" alt="4. Win greate Prizes for free. Best place to win greate prize for free." />
                    </div>
                </div>
                -->
            </div>
            <div class="website-container">
                <div class="font-containt box-shadow-comman" id="prediction_error" style="position: absolute;font-weight: bold;color:red;padding-left: 10px;left: 196; top: 360px; height: 20px; width: 533; background-color: #000000">
                </div>



		<div align="center" class="font-containt box-shadow-comman" style="position: absolute;left: 10px;top: 360px;width: 171px;height: 197px;">
                    <div class="black-header1 font-containt-bold">
                         MOST SELECTED CAPTAIN
                    </div>
                   <hr style="border:1px solid #ffffff">
                   <?php
                    $s='s'.$seriesId.'_user_eleven_lockteam';
                    $s1='s'.$seriesId.'_player_data';
                    if($match==1)
                            {
                                echo "<div style='font-size:12px;font-weight:bold;color:black;margin-top:40px;height:40px;padding-left:5px;'><center>First match not finished yet.<center></div>";
                            }
                    else if($match=="finished")
                       {
                           echo "<div style='font-size:12px;font-weight:bold;color:white;margin-top:40px;background-color: #4D043F;height:40px;padding-left:5px;'>ALL MATCHES FOR THIS SERIES ARE FINISHED</div>";

                       }
                     else
                       {
                           $lastmatchid=$match-1;
                                $mostcap=mysql_query("SELECT team1,team2 FROM fixture where matchID=$lastmatchid and sid=$seriesId");
                                if(mysql_num_rows($mostcap)==1)
                                {
                                    $teamname1 = mysql_result($mostcap, 0,'team1');
                                    $teamname2 = mysql_result($mostcap, 0,'team2');
                                
                                echo "<div style='font-size:12px;font-weight:bold;color:white;background-color: #4D043F;height:16px;padding-left:5px;'>LAST MATCH : $lastmatchid $teamname1 VS $teamname2</div>";
                                }
                                $most_cap_query="select captain, COUNT(captain) AS ct FROM $s where matchID = $lastmatchid and sid = $seriesId GROUP BY captain ORDER BY ct DESC LIMIT 1";
                                $cap_query=mysql_query($most_cap_query);
                                while(@$row=mysql_fetch_array($cap_query))
                                {
                                    $cap_id=mysql_real_escape_string($row['captain']);
                                    $totaltime=mysql_real_escape_string($row['ct']);
                                    $cap_name="select Name, imgSrc from $s1 where id = $cap_id";
                                    $cap_name_query=mysql_query($cap_name) or die(mysql_error());
                                    while(@$row1=mysql_fetch_array($cap_name_query))
                                    {
                                        @$captain_name=mysql_real_escape_string($row1['Name']);
                                        @$captain_image=mysql_real_escape_string($row1['imgSrc']);
                                        echo "<hr style='border:1px solid #ffffff'>";
                                        echo "<img src='photos/players/$captain_image' style='width:110px;  height:125px;'>";
                                        echo "<hr style='border:1px solid #ffffff'>";
                                        echo "<div style='font-size:12px;font-weight:bold;color:white;background-color: #4D043F;height:16px;padding-left:5px;'>$captain_name <b> COUNT:$totaltime</b></div>";
                                    }
                                }
                            }
                    ?>

                </div>
                <div class="font-containt box-shadow-comman" style="position: absolute;top: 557px;left:10px;width: 171px; height: 117px;">
                    <div class="black-header1 font-containt-bold"  >
                         <font style="font-size: 12px;">LAST QUICK PLAY WINNER</font>
                   </div>
                   <hr style="border:1px solid #ffffff">
                    <?php
                    if($match==1)
                    {
                      echo "<div style='font-size:12px;font-weight:bold;color:black;margin-top:40px;height:40px;padding-left:5px;'><center>Winner will be displayed here</center></div>";
                    }
                    else
                     {
							//echo "<div align='center' style='font-size:12px;font-weight:bold;height:16px;padding-left:5px;top:30px;'>Manager:Barath Balu</div>"; 
							 @$dailywin=  mysql_query("select email_id, matchID, seriedID from prize_winners_table where seriedID='$seriesId' ORDER BY matchID DESC LIMIT 1");
                        if(mysql_num_rows($dailywin)==1)
                        {
                            while(@$rowdaily=  mysql_fetch_array($dailywin))
                            {
                                $daily_email=mysql_real_escape_string($rowdaily['email_id']);
                                //echo "<div class='black-header1 font-containt-bold' style='font-size:11px;font-weight:bold;height:16px;padding-left:5px;'>LAST MATCH : $daily_email</div>";
                                $daily_matchid=mysql_real_escape_string($rowdaily['matchID']);
                                $daily_sid=mysql_real_escape_string($rowdaily['seriedID']);
                                @$dailyteam=mysql_query("SELECT team1,team2 FROM fixture where matchID=$daily_matchid and sid=$daily_sid");
                                if(mysql_num_rows($dailyteam)==1)
                                {
                                    $teamname1 = mysql_result($dailyteam, 0,'team1');
                                    $teamname2 = mysql_result($dailyteam, 0,'team2');
                                    echo "<div  style='font-size:11px;color:#4B4343;font-weight:bold;height:16px;padding-left:5px;'>LAST MATCH : $daily_matchid $teamname1 VS $teamname2</div>";
                                    echo "<hr style='border:1px solid #ffffff'>";
                                    @$managerdata=  mysql_query("select first_name, last_name from users_data where user_email = '$daily_email'");
                                    while(@$rowuser=  mysql_fetch_array($managerdata))
                                    {
                                        $first_name=mysql_real_escape_string($rowuser['first_name']);
                                        $last_name=mysql_real_escape_string($rowuser['last_name']);
                                        echo "<div  align='center' style='font-size:12px;color:#4B4343;font-weight:bold;height:16px;padding-left:5px;'>Manager :$first_name $last_name</div><br>";
                                        @$managerscore=  mysql_query("select daily_point from daily_challenge_eleven_player where user_email = '$daily_email' and matchid = $daily_matchid and sid = $daily_sid");
                                        while(@$rowscore=  mysql_fetch_array($managerscore))
                                        {
                                            $daily_point_user=mysql_real_escape_string($rowscore['daily_point']);
                                            echo "<hr style='border:1px solid #ffffff'>";
                                            echo "<hr style='border:1px solid #ffffff'>";
                                            echo "<div  align='center' style='font-size:13px;color:red;font-weight:bold;height:16px;padding-left:5px;'>Your Points :$daily_point_user</div>";
                                        }
                                    }
                                }
                            }
                        }
							

                    }

                       ?>
                </div>



















               

               	<div class="font-containt box-shadow-comman" style="position: absolute;left: 196px;top: 385px;width: 170px;height: 289px;">
                   <div class="black-header font-containt-bold">
                         BATSMAN
                    </div>
                       <table class="home-allrounder-prediction-table">
                           <tr>
                               <td style="color:red;font-weight: bold">
                                   Select Type:
                               </td>
                               <td>
                                   <select name="matchType" id="matchtype" class="predicttext">
                                       <option value="ODI">ODI</option>
                                       <option value="T20">T20</option>
                                       <option value="TEST">TEST</option>

                                   </select>
                               </td>
                           </tr>
                           <tr>
                               <td>BatsmanRun:</td>
                               <td><input class="predicttext" type="text" id="run" name="run"></td>
                           </tr>
                           <tr>
                               <td>BowlPlayed:</td>
                               <td><input  class="predicttext" type="text" id="bowlplay" name="bowlplay"></td>
                           </tr>
                           <tr>
                               <td>Sixs:</td>
                               <td><input  class="predicttext" type="text" id="six" name="six"></td>
                           </tr>
                           <tr>
                               <td>Catch:
                               </td>
                               <td><input  class="predicttext" type="text" id="catch" name="catch">
                               </td>
                           </tr>
                           <tr>
                               <td>RunOut:
                               </td>
                               <td><input  class="predicttext" type="text" id="runout" name="runout">
                               </td>
                           </tr>
                           <tr>
                               <td style="color:red;font-weight: bold">
                                    ManOfMatch:
                               </td>
                               <td>
                                   <select name="manofthematch" id="manofthematch" class="predicttext">
                                       <option value="yes">yes</option>
                                       <option value="no">no</option>
                                   </select>
                               </td>
                           </tr>
                           <tr>
                               <td style="color:blue;font-weight: bold">
                                   Your Points:
                               </td>
                               <td>
                                   <input class="predicttext" type="text" style="border: none" value="0" id="points" name="point" readonly>
                               </td>
                           </tr>
                           <tr>
                               <td style="padding-top: 2px;">
                                   <a style="margin-left: 10px;" id="battingcalculate" class="calculatepredictscore-button">Calculate</a>
                               </td>
                               <td style="padding-top: 2px;">
                                   <a style="margin-left: 10px;" id="battingreset" class="resetpredictscore-button">Reset</a>
                               </td>
                           </tr>
                       </table>

               </div>
                <div class="font-containt box-shadow-comman" style="position: absolute;left: 383px;top: 385px;width: 170px;height: 289px;">
                   <div class="black-header font-containt-bold">
                         BOWLER
                    </div>
                       <table class="home-allrounder-prediction-table">

                           <tr>
                               <td style="color:red;font-weight: bold;">
                               Select Type:
                               </td>
                               <td>
                                   <select name="matchType" id="bowlmatchtype" class="predicttext">
                                            <option value="ODI">ODI</option>
                                            <option value="T20">T20</option>
                                            <option value="TEST">TEST</option>
                                    </select>
                               </td>
                           </tr>
                           <tr>
                               <td>
                                   Overs:
                               </td>
                               <td>
                                   <input class="predicttext" type="text" id="over" name="over">
                               </td>
                           </tr>
                           <tr>
                               <td>
                                   Wicket:
                               </td>
                               <td>
                                   <input  class="predicttext" type="text" id="wicket" name="wicket">
                               </td>
                           </tr>
                           <tr>
                               <td>
                                   DotBall:
                               </td>
                               <td>
                                   <input  class="predicttext" type="text" id="dotball" name="dotball">
                               </td>
                           </tr>
                           <tr>
                               <td>
                                   RunGiven:
                               </td>
                               <td>
                                   <input class="predicttext" type="text" id="rungiven" name="rungiven">
                               </td>
                           </tr>
                           <tr>
                               <td >
                                   Catch:
                               </td>
                               <td>
                                   <input class="predicttext" type="text" id="bowlercatch" name="catch">
                               </td>
                           </tr>
                           <tr>
                               <td >
                                   RunOut:
                               </td>
                               <td>
                                   <input class="predicttext" type="text" id="bowlerrunout" name="runout">
                               </td>
                           </tr>
                           <tr>
                               <td style="color:red;font-weight: bold">
                                   ManOfMatch:
                               </td>
                               <td>
                                   <select name="manofthematch" id="bowlermanofthematch" class="predicttext">
                                            <option value="yes">yes</option>
                                            <option value="no">no</option>
                                    </select>
                               </td>
                           </tr>
                           <tr>
                               <td style="color:blue;font-weight: bold">
                                   Your Points:
                               </td>
                               <td>
                                   <input  class="predicttext" type="text" style="border: none" value="0" id="bowlerpoints" name="point" readonly>
                               </td>
                           </tr>
                           <tr>
                               <td style="padding-top: 3px;">
                                   <a style="margin-left: 10px;" id="bowlercalculate" class="calculatepredictscore-button">Calculate</a>
                               </td>
                               <td style="padding-top: 3px;">
                                   <a style="margin-left: 10px;" id="bowlerreset" class="resetpredictscore-button">Reset</a>
                               </td>
                           </tr>
                       </table>
                </div>
               <div class="font-containt box-shadow-comman" style="position: absolute;left: 569px;top: 385px;width: 171px;height: 289px;">
                   <div class="black-header font-containt-bold">
                         ALL-ROUNDER
                    </div>
                   <table class="home-allrounder-prediction-table">
                       <tr>
                               <td style="color:red;font-weight: bold">
                               Select Type:
                               </td>
                               <td>
                                   <select name="matchType" id="allmatchtype" class="predicttext">
                                            <option value="ODI">ODI</option>
                                            <option value="T20">T20</option>
                                            <option value="TEST">TEST</option>
                                    </select>
                               </td>
                           </tr>
                           <tr>
                               <td>
                                   BatsmanRun:
                               </td>
                               <td>
                                   <input class="predicttext" type="text" id="allrun" name="run">
                               </td>
                           </tr>

                           <tr>
                               <td>
                                   BowlPlayed:
                               </td>
                               <td>
                                   <input class="predicttext" type="text" id="allbowlplay" name="bowlplay">
                               </td>
                           </tr>
                           <tr>
                               <td>
                                   Six:
                               </td>
                               <td>
                                   <input class="predicttext" type="text" id="allsix" name="six">
                               </td>
                           </tr>
                           <tr>
                               <td>
                                   Overs:
                               </td>
                               <td>
                                   <input class="predicttext" type="text" id="allover" name="over">
                               </td>
                           </tr>
                           <tr>
                               <td>
                                   Wicket:
                               </td>
                               <td>
                                   <input class="predicttext" type="text" id="allwicket" name="wicket">
                               </td>
                           </tr>

                           <tr>
                               <td>
                                   RunGiven:
                               </td>
                               <td>
                                   <input class="predicttext" type="text" id="allrungiven" name="rungiven">
                               </td>
                           </tr>
                           <tr>
                               <td>
                                   Catch:
                               </td>
                               <td>
                                   <input class="predicttext" type="text" id="allcatch" name="catch">
                               </td>
                           </tr>
                           <tr>
                               <td>
                                   RunOut:
                               </td>
                               <td>
                                   <input class="predicttext" type="text" id="allrunout" name="runout">
                               </td>
                           </tr>
                           <tr>
                               <td style="color: red;font-weight: bold">
                                    ManOfMatch:
                               </td>
                               <td>
                                   <select name="manofthematch" id="allmanofthematch" class="predicttext">
                                            <option value="yes">yes</option>
                                            <option value="no">no</option>
                                  </select>
                               </td>
                           </tr>
                           <tr>
                               <td style="font-size: 12px;color: darkblue;font-weight: bold">
                                   Your Points:
                               </td>
                               <td>
                                   <input class="predicttext" style="border: none" value="0" type="text" id="allpoints" name="point" readonly>
                               </td>
                           </tr>
                           <tr>
                               <td style="padding-top: 0px;">
                                   <a style="margin-left: 10px;" id="allcalculate" class="calculatepredictscore-button">Calculate</a>
                               </td>
                               <td style="padding-top: 0px;">
                                   <a style="margin-left: 10px;" id="allreset" class="resetpredictscore-button">Reset</a>
                               </td>
                           </tr>
                   </table>
               </div>
         </div>
        </div>
 <!----------->

    


    <!---- Player STATS--->
        <div class="home-10-playerStats font-containt box-shadow-comman" style="position: absolute;width: 228px;height: 250px;left: 762px;top: 275px;">
            <div class="home-10-playerStats-header font-containt-bold">
                TOP 10 PLAYERS PRICE
            </div>
              <?php
                $s='s'.$seriesId.'_player_data';
                if(@$result=mysql_query("SELECT Name,team,price,total_point from $s ORDER BY price DESC LIMIT 10"))
                 {
                    echo '<table class="home-10-playerStats-table"><thead>';
                    echo '<tr class="home-10-playerStats-table-header">';
                    echo '<th align="left">PLAYER</th>
                         <th align="left">TEAM</th>
                         <th align="left">PRICE</th>
                         <th align="left">POINTS</th>';
                    echo '</tr></thead>';
                    while($row=mysql_fetch_array($result)){
                        $name=mysql_real_escape_string($row['Name']);
                        $team=mysql_real_escape_string($row['team']);
                        $price=mysql_real_escape_string($row['price']);
                        $point=mysql_real_escape_string($row['total_point']);
                        $teamFlag="photos/teamsFlags/min/$team.jpg";
                        echo '<tr>';
                        echo '<td>'.$name.'</td>
                            <td><img src="'.$teamFlag.'" width="25px" height="90%" style="border:1px solid"></td>
                            <td>'.$price.'m</td>
                            <td>'.$point.'</td>';
                        echo '</tr>';
                    }
                    echo '</table>';
                 }else
                  {
                     echo '<center>Some Problem occured while retriving data</center>';
                  }
            ?>
         </div>
          <!-------------------------------------------------------------------------------------------------------------------->


          <!----10 PLAYER RANKING--->
        <div class="home-10-playerRank font-containt box-shadow-comman" style="position: absolute;width: 228px;height: 250px;left: 762px;top: 542px;overflow: auto">
            <div class="home-10-playerRank-header font-containt-bold">
                TOP 10 MANAGERS
            </div>
            <table class="home-10-playerRank-table">
               <tr>
                     <th>#</th><th>MANAGER</th><th>POINTS</th>
               </tr>
                <?php
                   $user_eleven = 's' . $seriesId . '_user_eleven_data';
                   $query_to_leaderboard="SELECT s.first_name,s.last_name,u.user_points,s.user_name
                                            FROM $user_eleven u
                                            INNER JOIN users_data s
                                            ON u.user_email=s.user_email
                                            ORDER BY u.user_points
                                            DESC LIMIT 10";
                    if($result = mysql_query($query_to_leaderboard))
                    {
                       $rank_no=1;
                       $lastRank=0;
                       $lastPoints=-1;
                       while ($row = mysql_fetch_array($result)) {  //to get all data.....
                          $first_name = htmlentities($row[0]);
                          $last_name = htmlentities($row[1]);
                          $user_points = mysql_real_escape_string(htmlentities($row[2]));
                          $user_name = htmlentities($row[3]);
                          if($lastPoints==$user_points) {
                             echo '<tr>';
                             echo "<td>$lastRank</td><td><a href='ViewPoints.php?seriesId=$seriesId&&userName=$user_name' style='letter-spacing: 1px'>$first_name $last_name</a></td><td>$user_points</td>";
                             echo '</tr>';
                          }
                          else {
                              echo '<tr>';
                              echo "<td>$rank_no</td><td><a href='ViewPoints.php?seriesId=$seriesId&&userName=$user_name' style='letter-spacing: 1px'>$first_name $last_name</a></td><td>$user_points</td>";
                              echo '</tr>';
                              $lastRank=$rank_no;
                              $lastPoints=$user_points;
                           }
                           $rank_no++;
                        }
                       }else {
                        echo '<center>Some Error Occured while Retriving data</center>';
                    }
                  ?>
              </table>
        </div>
       <!-------->

       <!-- Player Scroller ---->
        <div class="home-scroller font-containt box-shadow-comman" style="position: absolute;left:10px;top:825px;width: 980px;height: 150px;">
          <div class="home-scroller-header font-containt-bold">
                TOP SELECTED PLAYERS IN TEAM
          </div>
          <?php
           $s='s'.$seriesId.'_player_data';
		$s_user_eleven='s'.$seriesId.'_user_eleven';
             if(@$result1=mysql_query("SELECT Name,price,total_point,selectedBy,imgSrc from $s ORDER BY selectedBy DESC LIMIT 5")) {
               if(@$result2=mysql_query("SELECT count(DISTINCT user_id) from $s_user_eleven")) {
                   $data=mysql_result($result2, 0);
                   echo '<table class="home-scroller-table font-containt-bold" width=100% height=125px><tr>';
                   while($row=mysql_fetch_array($result1)) {
                       $name=mysql_real_escape_string($row['Name']);
                       $price=mysql_real_escape_string($row['price']);
                       $point=mysql_real_escape_string($row['total_point']);
                       $playerImage=mysql_real_escape_string($row['imgSrc']);
                       $playerImage='photos/players/'.$playerImage;
                       $selectedBy=mysql_real_escape_string($row['selectedBy'])*100/$data;
                       $selectedBy=floor($selectedBy);
                       echo '<td align="top"><img src="'.$playerImage.'" border="1px solid" width="95" height="125px" alt="player"></td>';
                       echo '<td><table class="home-scroller-innerTable font-containt-bold" width=90px height=50px><tr><td>'.$name.'</td></tr><tr><td>'.$price.'m$</td></tr><tr><td>'.$selectedBy.'%</td></tr></table></td>';
                   }
                   echo '</tr></table>';


               }else {
                   echo '<center>Some Error Occured while Retriving data</center>';
               }
           }else {
               echo '<center>Some Error Occured while Retriving data</center>';
           }
           ?>
        </div>
         <!----------------------------------------------------------------------------------------------------------------->
    </div>
    <div class="filler" style="position: absolute;width: 1000px;height: 45px;left: 176px;top: 1150px;background-color: white">
    </div>

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/make_All_page_responsive.js"></script>
    <script type="text/javascript" src="js/Home.js"></script>
    <script type="text/javascript" src="js/Home_login_details_validate.js"></script>
    <script type="text/javascript" src="themes/1/js-image-slider.js"></script>
    <script type="text/javascript" src="js/countdown.jquery.js"></script>
</body>
</html>
<?php
	include 'Footer.php';
?>