<?php
include 'Header.php';
include 'PHP/includes/database_connectivity_includes.php';
@session_start();
include 'PHP/includes/session_setter.php';
include 'PHP/includes/seriedId_setter.php';
?>
<html>
    <head>
	<title>Statastics</title>
    <link rel="stylesheet" type="text/css" href="css/fancybox/style.css" />
    <link rel="stylesheet" type="text/css" href="css/fancybox/jquery.fancybox-1.3.1.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/PointHistory.css" />
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

        <!-- MAIN BODY-->
        <div  style="position: absolute;width: 1000px;height: 870px;left: 0px;top: 130px;">
        <!-- MATCH SCROLLER-->
        <div class="font-containt box-shadow-comman" style="position: absolute;width: 736px;height: 130px;left: 10px;top: 0px;">
            <div class="black-header font-containt-bold">
                    MATCH HISTORY
            </div>
            <div id="content">
                <div class="gallery-wrap">
                    <div class="gallery clearfix">
                      <?php
                          if(@$resultSet_getFixture=mysql_query("SELECT * FROM fixture WHERE sid=$seriesId")) {
                             while ($row=mysql_fetch_array($resultSet_getFixture))
                               {
                                 $team1=mysql_real_escape_string($row['team1']);
                                 $team2=mysql_real_escape_string($row['team2']);
                                 $time=mysql_real_escape_string($row['timeAnddate']);
                                 $status=mysql_real_escape_string($row['status']);
                                 $matchNo=mysql_real_escape_string($row['matchID']);
                                 if($session_country == 'India') {
                                     $old_date_timestamp = strtotime($time);
                                     $time = date('j,M Y h:i A', $old_date_timestamp);
                                 }else {
                                     $old_date_timestamp = strtotime($time);
                                     $old_date_timestamp = $old_date_timestamp - '19800';
                                     $time = date('j,M Y h:i A', $old_date_timestamp).' GMT';
                                 }
                                 echo '<div class="gallery__item  '.$matchNo.'">';
                                 if($status == 'LOCK') {
                                     echo "<div class=\"gallery__img\" alt=\"\" align='center'>
                                     <table class='font-containt-bold' style='width:100%;background-color:#13B8BB;color:white'>
                                        <tr><td>
                                            <font style='font-size:12px'>Match $matchNo</font>
                                        </td>
                                        <td>
                                            <a href='PointHistory.php?seriesId=$seriesId&matchID=$matchNo'>
                                                <div class='viewPointHistory' id='$matchNo'>VIEW POINTS</div>
                                            </a>
                                        </td>
                                     </tr>
                                     </table>
                                     <br>
                                      <div>$team1&nbsp<img src='photos/teamsFlags/min/$team1.jpg' border='1px solid'>&nbsp VS &nbsp<img src='photos/teamsFlags/min/$team2.jpg'  border='1px solid'>&nbsp$team2</div>
                                        $time</div>";
                                 }
                                 else if($status == 'UNLOCK') {
                                 echo "<div class='gallery__img' alt=\"\" align='center'><table class='font-containt-bold' style='width:100%;background-color:#13B8BB;color:white'><tr><td><font style='font-size:12px'>Match $matchNo</font></td>
                                    <td><a href='ManageTeam.php?seriesId=$seriesId'><div class='viewPointHistory' id='$matchNo'>MANAGE TEAM</div></a></td></tr></table>
                                      <br>
                                     <div>$team1&nbsp<img src='photos/teamsFlags/min/$team1.jpg'  border='1px solid'>&nbsp VS &nbsp<img src='photos/teamsFlags/min/$team2.jpg'  border='1px solid'>&nbsp$team2</div>
                                    $time</div>";
                                 }
                                echo '</div>';
                               
                           if($status == 'UNLOCK')
                               break;
                             }
                         }
                     else
                        echo '<center>ERROR</center>';
                    ?>

                    </div> <!-- .gallery -->
                    <div class="gallery__controls clearfix">
                        <div href="#" class="gallery__controls-prev" style="position: absolute;left: 0px;top: 18px;">
                            <img src="photos/prev.png" alt="" style="width: 25px;height: 94px;" />
                        </div>
                        <div href="#" class="gallery__controls-next" style="position: absolute;left: 711px;top: 18px;">
                            <img src="photos/next.png" alt="" style="width: 25px;height: 94px;" />
                        </div>
                    </div> <!-- .gallery__controls -->
                </div> <!-- .gallery-wrap -->
            </div> <!-- #content -->
        </div>
       <!--------------->

                     
        <!--- TEAM--->
        <div class="point-history-team box-shadow-comman font-containt" id="view_Team_Player" style="position: absolute;width: 736px;height: 412px;left: 10px;top: 146px;">
            <div class="black-header font-containt-bold">
                YOUR TEAM
            </div>
             <?php
                              
                $tableLockTeam='s'.$seriesId.'_user_eleven_lockteam';
                $tablePlayerData='s'.$seriesId.'_player_data';
                $arrayX=array(3,124,245,366,487,608,63,184,305,426,547);
                $arrayY=array(25,25,25,25,25,25,175,175,175,175,175);

                //IF MATCHID N SERIESID is SET
                if (isset($_GET['seriesId']) && isset($_GET['matchID'])) {
                    if(!empty ($_GET['seriesId']) && !empty ($_GET['matchID'])) {
                        $matchID=mysql_real_escape_string($_GET['matchID']);
                        echo '<div id="hiddent-matchID" style="visibility:hidden">'.$matchID.'</div>';

                    if($resultSet_find_player_history=mysql_query("SELECT * FROM $tableLockTeam WHERE user_email='$session_email' AND matchID=$matchID LIMIT 1")) {
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

                                if(@$resultSet_player_record=mysql_query("SELECT id,Name,style,team,price,imgSrc,match$matchID
                                     from $tablePlayerData where id IN ($player1,$player2,$player3,$player4,$player5,$player6,
                                     $player7,$player8,$player9,$player10,$player11) ORDER BY style LIMIT 11"))
                                {
                                    echo "<div class='match-points font-containt-bold' style=\"position: absolute;width: 200px;height: 25px;left: 510px;top: 25px;\">MATCH POINTS: $match_points</div>";
                                    echo '<div style="position: absolute;width: 746px;height: 347px;left: 0px;top: 55px;">';
                                    $index=0;
                                    while($row=mysql_fetch_array($resultSet_player_record)) {
                                        $id=mysql_real_escape_string($row['id']);
                                        $name=mysql_real_escape_string($row['Name']);
                                        $team=mysql_real_escape_string($row['team']);
                                        $price=mysql_real_escape_string($row['price']);
                                        $playerImage=mysql_real_escape_string($row['imgSrc']);
                                        $playerImage='photos/players/'.$playerImage;
                                        $style=mysql_real_escape_string($row['style']);
                                        $matchPts=mysql_real_escape_string($row['match'.$matchID]);
                                        $matchPointPlayer=0;
                                        if(strlen($matchPts)>=12) {
                                            $matchPoints = explode("#@#", $matchPts);
                                            $matchPointPlayer=$matchPoints[0]+$matchPoints[1]+$matchPoints[2]+$matchPoints[3]+0;
                                        }
                                      
                                       if($captain != $id) {
                                          echo "<div class='player-item' style='position: absolute;width: 116px;height: 138px;left: $arrayX[$index]px;top: $arrayY[$index]px;border:1px solid;'>";
                                          echo "<div style='background-color:#0A0E8C;height:18px;'><img src='photos/style/style$style.png' alt='$style' width='18px' height='18px'><div class='player-name' style='font-size: 11px'>$name</div></div>";
                                          echo "<div><center><img src='$playerImage' alt='Player Image' height='102px' width='116px'></center></div>";
                                          echo "<div><table width='100%' height='15px'; style='background-color:#262222;font-size:12px;color:white'><tr><td align='left'>$team</td><td align='right'>$matchPointPlayer</td></tr></table></div>";
                                          echo '</div>';
                                      }
                                      else if($captain == $id) {
                                          $matchPointPlayer*=2;
                                          echo "<div class='player-item' style='position: absolute;width: 116px;height: 138px;left: $arrayX[$index]px;top: $arrayY[$index]px;border:1px solid;'>";
                                          echo "<div style='background-color:#B5080B;height:18px;'><img src='photos/style/style$style.png' alt='$style' width='18px' height='18px'><div class='player-name' style='font-size: 11px'>$name</div></div>";
                                          echo "<div><center><img src='$playerImage' alt='Player Image' height='102px' width='116px'></center></div>";
                                          echo "<div><table width='100%' height='15px';  style='background-color:#B5080B;font-size:12px;color:white'><tr><td align='left'>$team</td><td align='right'>$matchPointPlayer</td></tr></table></div>";
                                          echo '</div>';
                                      }
                                        $index++;
                                  }
                                  echo '</div>';
                              }else
                                  echo '<center>><br><br><br><br>PLAYER INDORMATION NOT FOUND</center>';
                          }
                          else
                              echo '<div><center><img src="photos/dailyChellenge/daily-bgImg1.jpg" width="100%" height="385px" style="position:absolute;top:20px;left:0px;" ><center></div>';
                      }
                      else
                          echo '<div>ERROR OCURED WHILE RETRIVING YOUT TEAM INFORMATION</div>';
                    }
                  else {
                      echo '<center><br><br><br><br>SOME ERROR OCCURED</center>';
                  }
                }
    //*********

               //*********    ELSE DEFAULT (LAST MATCH) OF USERS 
                else{
                     if(@$resultSet_find_player_history=mysql_query("SELECT * FROM $tableLockTeam WHERE user_email='$session_email' order By matchID DESC LIMIT 1")) {
                        if(mysql_num_rows($resultSet_find_player_history) == 1) {
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
                            if(@$resultSet_player_record=mysql_query("SELECT id,Name,style,team,price,imgSrc,match$matchID from $tablePlayerData where id IN ($player1,$player2,$player3,$player4,$player5,$player6,
                                            $player7,$player8,$player9,$player10,$player11) ORDER BY style LIMIT 11")) {
                                            echo "<div class='match-points font-containt-bold' style=\"position: absolute;width: 200px;height: 25px;left: 510px;top: 25px;\">MATCH POINTS:$match_points</div>";
                                            echo '<div style="position: absolute;width: 746px;height: 347px;left: 0px;top: 65px;">';
                                                $index=0;
                                            while($row=mysql_fetch_array($resultSet_player_record)) {
                                                $id=mysql_real_escape_string($row['id']);
                                                $name=mysql_real_escape_string($row['Name']);
                                                $team=mysql_real_escape_string($row['team']);
                                                $price=mysql_real_escape_string($row['price']);
                                                $playerImage=mysql_real_escape_string($row['imgSrc']);
                                                $playerImage='photos/players/'.$playerImage;
                                                $style=mysql_real_escape_string($row['style']);
                                                $matchPts=mysql_real_escape_string($row['match'.$matchID]);
                                                $matchPoints = explode("#@#", $matchPts);
                                                $matchPointPlayer=0;
                                                if(strlen($matchPts)>=12) {
                                                    $matchPoints = explode("#@#", $matchPts);
                                                    $matchPointPlayer=$matchPoints[0]+$matchPoints[1]+$matchPoints[2]+$matchPoints[3]+0;
                                                }

                                               if($captain != $id) {
                                                   echo "<div class='player-item' style='position: absolute;width: 116px;height: 138px;left: $arrayX[$index]px;top: $arrayY[$index]px;border:1px solid;'>";
                                                   echo "<div style='background-color:#0A0E8C;height:18px;'><img src='photos/style/style$style.png' alt='$style' width='18px' height='18px'><div class='player-name' style='font-size: 11px'>$name</div></div>";
                                                   echo "<div><center><img src='$playerImage' alt='Player Image' height='102px' width='116px'></center></div>";
                                                   echo "<div><table width='100%' height='15px'; style='background-color:#262222;font-size:12px;color:white'><tr><td align='left'>$team</td><td align='right'>$matchPointPlayer</td></tr></table></div>";
                                                   echo '</div>';
                                               }
                                               else if($captain == $id) {
                                                   $matchPointPlayer*=2;
                                                   echo "<div class='player-item' style='position: absolute;width: 116px;height: 138px;left: $arrayX[$index]px;top: $arrayY[$index]px;border:1px solid;'>";
                                                   echo "<div style='background-color:#B5080B;height:18px;'><img src='photos/style/style$style.png' alt='$style' width='18px' height='18px'><div class='player-name' style='font-size: 11px'>$name</div></div>";
                                                   echo "<div><center><img src='$playerImage' alt='Player Image' height='102px' width='116px'></center></div>";
                                                   echo "<div><table width='100%' height='15px';  style='background-color:#B5080B;font-size:12px;color:white'><tr><td align='left'>$team</td><td align='right'>$matchPointPlayer</td></tr></table></div>";
                                                   echo '</div>';
                                               }

                                               $index++;
                                           }
                                           echo '</div>';
                                         }else
                                                echo '<center>PLAYER DATA NOT FOUND</center>';

                                    }
                                    else
                                        echo '<center><br><br><br><br><br>Your team will be displayed after completion of match.</center>';
                                  }
                                  else
                                echo '<center>CONNECTION ERROR</center>';
                              }
                           ?>
                    </div>
                     <!---------->

            <!-- TRANSFER HISTORY ---->
             <div class="font-containt box-shadow-comman" style="position: absolute;width: 220px;height: 380px;left: 770px;top: 176px;overflow: auto">
               <div class="black-header font-containt-bold">
                    TRANSFER HISTORY
               </div>
               <?php
               $tablePlayerData='s'.$seriesId.'_player_data';
                if (isset($_GET['seriesId']) && isset($_GET['matchID'])) {
                   if(!empty ($_GET['seriesId']) && !empty ($_GET['matchID'])) {
                       $matchID=mysql_real_escape_string(htmlentities($_GET['matchID']));
                       if($resultSet_to_find_last_two_entrys=mysql_query("SELECT * from $tableLockTeam where matchID<=$matchID AND user_email='$session_email' ORDER By matchID DESC LIMIT 2")) {
                           if(mysql_num_rows($resultSet_to_find_last_two_entrys)==0) {
                               echo '<center>NO TRANSFER HISTORY<center>';
                           }
                           else if(mysql_num_rows($resultSet_to_find_last_two_entrys)==1) {
                             $playersArray=array();
                             $playersArray[0]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 0,'player1'));
                             $playersArray[1]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 0,'player2'));
                             $playersArray[2]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 0,'player3'));
                             $playersArray[3]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 0,'player4'));
                             $playersArray[4]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 0,'player5'));
                             $playersArray[5]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 0,'player6'));
                             $playersArray[6]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 0,'player7'));
                             $playersArray[7]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 0,'player8'));
                             $playersArray[8]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 0,'player9'));
                             $playersArray[9]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 0,'player10'));
                             $playersArray[10]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 0,'player11'));

                             $resultSet_of_playerData=mysql_query("SELECT Name,total_point,match$matchID from $tablePlayerData
                                    where id IN ($playersArray[0],$playersArray[1],$playersArray[2],$playersArray[3],$playersArray[4],
                                    $playersArray[5],$playersArray[6],$playersArray[7],$playersArray[8],$playersArray[9],$playersArray[10]) ORDER BY style");
                                    echo '<div><table class="transfers-table"><th>TRANSFER IN</th><th>M_PTS</th><th>T_PTS</th>';
                                    while($row=mysql_fetch_array($resultSet_of_playerData)) {
                                        $name=mysql_real_escape_string($row['Name']);
                                        $totalPoints=mysql_real_escape_string($row['total_point']);
                                        $playerPoint=mysql_real_escape_string($row['match'.$matchID]);

                                        $matchPointPlayer=0;
                                        if(strlen($playerPoint) >= 12) {
                                            $matchPoints = explode("#@#", $playerPoint);   //array of string
                                            $matchPointPlayer=$matchPoints[0]+$matchPoints[1]+$matchPoints[2]+$matchPoints[3]+0;   //total match points
                                        }

                                        echo '<tr><td width=50%>'.$name.'</td><td width=25%>'.$matchPointPlayer.'</td><td width=25%>'.$totalPoints.'</td></tr>';
                                    }
                                    echo '</table></div>';

                                }else // WHEN LIMIT IS TWO
                                {
                                    $player1Array=array();
                                    $player1Array[0]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 0,'player1'));
                                    $player1Array[1]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 0,'player2'));
                                    $player1Array[2]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 0,'player3'));
                                    $player1Array[3]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 0,'player4'));
                                    $player1Array[4]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 0,'player5'));
                                    $player1Array[5]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 0,'player6'));
                                    $player1Array[6]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 0,'player7'));
                                    $player1Array[7]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 0,'player8'));
                                    $player1Array[8]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 0,'player9'));
                                    $player1Array[9]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 0,'player10'));
                                    $player1Array[10]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 0,'player11'));


                                    $player2Array=array();
                                    $player2Array[0]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 1,'player1'));
                                    $player2Array[1]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 1,'player2'));
                                    $player2Array[2]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 1,'player3'));
                                    $player2Array[3]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 1,'player4'));
                                    $player2Array[4]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 1,'player5'));
                                    $player2Array[5]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 1,'player6'));
                                    $player2Array[6]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 1,'player7'));
                                    $player2Array[7]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 1,'player8'));
                                    $player2Array[8]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 1,'player9'));
                                    $player2Array[9]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 1,'player10'));
                                    $player2Array[10]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys,1,'player11'));

                                    $arrayIN=array();
                                    $arrayOUT=array();
                                    for($i=0;$i<count($player1Array);$i++)  // players IN
                                    {
                                        if(in_array($player1Array[$i],$player2Array)=='') {
                                            array_push($arrayIN,$player1Array[$i]);
                                        }
                                    }
                                    for($i=0;$i<count($player2Array);$i++)  // TO find Plyare OUT
                                    {
                                        if(in_array($player2Array[$i],$player1Array)=='') {
                                            array_push($arrayOUT,$player2Array[$i]);
                                        }
                                    }

                                    //  To find DATA of player which are transfer IN
                                    $inString="";
                                    for($i=0;$i<count($arrayIN);$i++) {
                                        if($i<(count($arrayIN)-1))
                                            $inString.=$arrayIN[$i].",";
                                        else
                                            $inString.=$arrayIN[$i];
                                    }

                                  @$resultSet_of_playerData=mysql_query("SELECT Name,total_point,match$matchID from $tablePlayerData
                                        where id IN ($inString) ORDER BY style");

                                    echo '<div><table class="transfers-table"><th>TRANSFER IN</th><th>M_PTS</th><th>T_PTS</th>';
                                    while($row=mysql_fetch_array($resultSet_of_playerData)) {
                                        $name=mysql_real_escape_string($row['Name']);
                                        $totalPoints=mysql_real_escape_string($row['total_point']);
                                        $playerPoint=mysql_real_escape_string($row['match'.$matchID]);

                                        $matchPointPlayer=0;
                                        if(strlen($playerPoint) >= 12) {
                                            $matchPoints = explode("#@#", $playerPoint);   //array of string
                                            $matchPointPlayer=$matchPoints[0]+$matchPoints[1]+$matchPoints[2]+$matchPoints[3]+0;   //total match points
                                        }
                                        echo '<tr><td width=50%>'.$name.'</td><td width=25%>'.$matchPointPlayer.'</td><td width=25%>'.$totalPoints.'</td></tr>';
                                    }
                                    echo '</table></div>';
                                   //***
                                   //  To find DATA of player which are transfer OUT
                                   echo '<br>';
                                   $outString="";
                                   for($i=0;$i<count($arrayOUT);$i++) {
                                       if($i<(count($arrayOUT)-1))
                                           $outString.=$arrayOUT[$i].",";
                                       else
                                           $outString.=$arrayOUT[$i];
                                   }

                                   @$resultSet_of_playerData=mysql_query("SELECT Name,total_point,match$matchID from $tablePlayerData
                                                        where id IN ($outString) ORDER BY style");

                                   echo '<div><table class="transfers-out-table"><th>TRANSFER OUT</th><th>M_PTS</th><th>T_PTS</th>';
                                   while(@$row=mysql_fetch_array($resultSet_of_playerData)) {
                                       $name=mysql_real_escape_string($row['Name']);
                                       $totalPoints=mysql_real_escape_string($row['total_point']);
                                       $playerPoint=mysql_real_escape_string($row['match'.$matchID]);
                                       $matchPointPlayer=0;
                                       if(strlen($playerPoint) >= 12) {
                                           $matchPoints = explode("#@#", $playerPoint);   //array of string
                                           $matchPointPlayer=$matchPoints[0]+$matchPoints[1]+$matchPoints[2]+$matchPoints[3]+0;   //total match points
                                       }
                                       echo '<tr><td width=50%>'.$name.'</td><td width=25%>'.$matchPointPlayer.'</td><td width=25%>'.$totalPoints.'</td></tr>';
                                   }
                                   echo '</table></div>';
                               }

                           }else {
                               echo '<center>SOME ERROR WHILE RETRIVING TRANSFER INFORMATION</center>';
                           }
                         }else {
                           echo '<center><br>SOME ERROR OCCURED</center>';
                       }
                   }
                    else   // DISPLAY LAST MATCHS TRANSFERS
                    {
                        if($resultSet_to_find_last_two_entrys=mysql_query("SELECT * from $tableLockTeam where user_email='$session_email' ORDER By matchID DESC LIMIT 2"))
                        {
                            if(mysql_num_rows($resultSet_to_find_last_two_entrys)==0)
                            {
                                echo 'NO TRANSFER HISTORY';
                            }
                            else if(mysql_num_rows($resultSet_to_find_last_two_entrys)==1)
                            {
                                $playersArray=array();
                                $playersArray[0]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 0,'player1'));
                                $playersArray[1]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 0,'player2'));
                                $playersArray[2]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 0,'player3'));
                                $playersArray[3]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 0,'player4'));
                                $playersArray[4]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 0,'player5'));
                                $playersArray[5]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 0,'player6'));
                                $playersArray[6]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 0,'player7'));
                                $playersArray[7]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 0,'player8'));
                                $playersArray[8]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 0,'player9'));
                                $playersArray[9]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 0,'player10'));
                                $playersArray[10]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 0,'player11'));

                                @$resultSet_of_playerData=mysql_query("SELECT Name,total_point,match$matchID from $tablePlayerData
                                      where id IN ($playersArray[0],$playersArray[1],$playersArray[2],$playersArray[3],$playersArray[4],
                                      $playersArray[5],$playersArray[6],$playersArray[7],$playersArray[8],$playersArray[9],$playersArray[10]) ORDER BY style");

                                echo '<div><table class="transfers-table"><th>TRANSFER IN</th><th>M_PTS</th><th>T_PTS</th>';
                                    while($row=mysql_fetch_array($resultSet_of_playerData))
                                    {
                                        $name=mysql_real_escape_string($row['Name']);
                                        $totalPoints=mysql_real_escape_string($row['total_point']);
                                        $playerPoint=mysql_real_escape_string($row['match'.$matchID]);
                                        $matchPointPlayer=0;
                                        if(strlen($playerPoint) >= 12) {
                                            $matchPoints = explode("#@#", $playerPoint);   //array of string
                                            $matchPointPlayer=$matchPoints[0]+$matchPoints[1]+$matchPoints[2]+$matchPoints[3]+0;   //total match points
                                        }

                                        echo '<tr><td width=50%>'.$name.'</td><td width=25%>'.$matchPointPlayer.'</td><td width=25%>'.$totalPoints.'</td></tr>';
                                    }
                                    echo '</table></div>';
                                  }else // WHEN LIMIT IS TWO
                                    {
                                                $player1Array=array();
                                        $player1Array[0]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 0,'player1'));
                                        $player1Array[1]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 0,'player2'));
                                        $player1Array[2]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 0,'player3'));
                                        $player1Array[3]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 0,'player4'));
                                        $player1Array[4]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 0,'player5'));
                                        $player1Array[5]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 0,'player6'));
                                        $player1Array[6]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 0,'player7'));
                                        $player1Array[7]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 0,'player8'));
                                        $player1Array[8]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 0,'player9'));
                                        $player1Array[9]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 0,'player10'));
                                        $player1Array[10]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 0,'player11'));


                                        $player2Array=array();
                                        $player2Array[0]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 1,'player1'));
                                        $player2Array[1]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 1,'player2'));
                                        $player2Array[2]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 1,'player3'));
                                        $player2Array[3]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 1,'player4'));
                                        $player2Array[4]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 1,'player5'));
                                        $player2Array[5]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 1,'player6'));
                                        $player2Array[6]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 1,'player7'));
                                        $player2Array[7]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 1,'player8'));
                                        $player2Array[8]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 1,'player9'));
                                        $player2Array[9]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys, 1,'player10'));
                                        $player2Array[10]=mysql_real_escape_string(mysql_result($resultSet_to_find_last_two_entrys,1,'player11'));

                                        $arrayIN=array();
                                        $arrayOUT=array();
                                        for($i=0;$i<count($player1Array);$i++)  // players IN
                                        {

                                                    if(in_array($player1Array[$i],$player2Array)=='')
                                                    {
                                                          array_push($arrayIN,$player1Array[$i]);
                                                    }
                                                }
                                                for($i=0;$i<count($player2Array);$i++)  // TO fing Plyare OUT
                                                {

                                                    if(in_array($player2Array[$i],$player1Array)=='')
                                                    {
                                                        array_push($arrayOUT,$player2Array[$i]);
                                                    }
                                                }

                                                //  To find DATA of player which are transfer IN*****
                                                $inString="";
                                                for($i=0;$i<count($arrayIN);$i++)
                                                {
                                                    if($i<(count($arrayIN)-1))
                                                        $inString.=$arrayIN[$i].",";
                                                    else
                                                        $inString.=$arrayIN[$i];
                                                }
                                                @$resultSet_of_playerData=mysql_query("SELECT Name,total_point,match$matchID from $tablePlayerData
                                                        where id IN ($inString) ORDER BY style");
                                                echo '<div><table class="transfers-table"><th>TRANSFER IN</th><th>M_PTS</th><th>T_PTS</th>';
                                                while($row=mysql_fetch_array($resultSet_of_playerData))
                                                {
                                                    $name=mysql_real_escape_string($row['Name']);
                                                    $totalPoints=mysql_real_escape_string($row['total_point']);
                                                    $playerPoint=mysql_real_escape_string($row['match'.$matchID]);

                                                    $matchPointPlayer=0;
                                                    if(strlen($playerPoint) >= 12)
                                                    {
                                                       $matchPoints = explode("#@#", $playerPoint);   //array of string
                                                       $matchPointPlayer=$matchPoints[0]+$matchPoints[1]+$matchPoints[2]+$matchPoints[3]+0;   //total match points
                                                    }
                                                    echo '<tr><td width=50%>'.$name.'</td><td width=25%>'.$matchPointPlayer.'</td><td width=25%>'.$totalPoints.'</td></tr>';
                                                }
                                                echo '</table></div>';
                                                //****
                        //  To find DATA of player which are transfer IN
                                                echo '<br>';
                                                $outString="";
                                                for($i=0;$i<count($arrayOUT);$i++)
                                                {
                                                    if($i<(count($arrayOUT)-1))
                                                        $outString.=$arrayOUT[$i].",";
                                                    else
                                                        $outString.=$arrayOUT[$i];
                                                }

                                                $resultSet_of_playerData=mysql_query("SELECT Name,total_point,match$matchID from $tablePlayerData
                                                        where id IN ($outString) ORDER BY style");

                                                echo '<div><table class="transfers-out-table"><th>TRANSFER OUT</th><th>M_PTS</th><th>T_PTS</th>';
                                                while($row=mysql_fetch_array($resultSet_of_playerData))
                                                {
                                                    $name=mysql_real_escape_string($row['Name']);
                                                    $totalPoints=mysql_real_escape_string($row['total_point']);
                                                    $playerPoint=mysql_real_escape_string($row['match'.$matchID]);
                                                    $matchPointPlayer=0;
                                                    if(strlen($playerPoint) >= 12)
                                                    {
                                                       $matchPoints = explode("#@#", $playerPoint);   //array of string
                                                       $matchPointPlayer=$matchPoints[0]+$matchPoints[1]+$matchPoints[2]+$matchPoints[3]+0;   //total match points
                                                    }
                                                    echo '<tr><td width=50%>'.$name.'</td><td width=25%>'.$matchPointPlayer.'</td><td width=25%>'.$totalPoints.'</td></tr>';
                                                }
                                                echo '</table></div>';
                                            }
                                    }else
                                {   
                                        echo '<center>SOME ERROR WHILE RETRIVING TRANSFER INFORMATION</center>';
                                    
                                }
                              }
                    ?>
                    </div>
                     <!------->
                    <div class="font-containt box-shadow-comman" style="position: absolute;width: 220px;height: 170px;left: 770px;top: 0px;">
                      <div class="black-header font-containt-bold">
                            USER INFORMATION
                      </div>
                     <?php include 'PHP/includes/userData.php';?>
                    </div>
                    <!-----Display All 4 types of player at bottem -->
                     <?php  include 'PHP/includes/diplay_4_type_of_player_at_bottem.php';?>
                 <!--------->
                </div>
                <!---->
            </div>
    <div class="filler" style="position: absolute;width: 1000px;height: 45px;left: 176px;top: 1170px;background-color: white">
    </div>
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/make_All_page_responsive.js"></script>
        <script type="text/javascript" src="js/PointHistory.js"></script>
        <!--SCRIPT TO SCROLL MATCH-->
        <script type="text/javascript">
        $(window).load(function(){
            var totalWidth = 0;
            $(".gallery__item").each(function(){
            totalWidth = totalWidth + $(this).outerWidth(true);
        });
        var maxScrollPosition = totalWidth - $(".gallery-wrap").outerWidth();
        function toGalleryItem($targetItem){
            if($targetItem.length){
		var newPosition = $targetItem.position().left;
                if(newPosition <= maxScrollPosition){
                $targetItem.addClass("gallery__item--active");
                $targetItem.siblings().removeClass("gallery__item--active");
                $(".gallery").animate({
                    left : - newPosition
                });
                } else {
                   $(".gallery").animate({
                        left : - maxScrollPosition
                    });
                };
            };
        };

        $(".gallery").width(totalWidth);
        var hiddenMatchID=$('#hiddent-matchID').text();
        if(hiddenMatchID!="")
        {
            $("."+hiddenMatchID+"").addClass("gallery__item--active");
             var activeTarger= $(".gallery__item--active");
             var $targetItem = $(".gallery__item--active").prev().prev();
        }
        else
        {
            $(".gallery__item:last").addClass("gallery__item--active");
            var activeTarger= $(".gallery__item--active").prev();
            var $targetItem = $(".gallery__item--active").prev().prev().prev();
        }
          $(activeTarger).css('background-color','#13B8BB').css('color','white');
            toGalleryItem($targetItem);
        $(".gallery__controls-prev").click(function(){
           var $targetItem = $(".gallery__item--active").prev();
            toGalleryItem($targetItem);
        });
        $(".gallery__controls-next").click(function(){
           var $targetItem = $(".gallery__item--active").next();
            toGalleryItem($targetItem);
        });
    });
   </script>

    <script type="text/javascript" src="css/fancybox/jquery.fancybox-1.3.1.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        $(".gallery__link").fancybox({
            'titleShow'     : false,
            'transitionIn'  : 'elastic',
            'transitionOut' : 'elastic'
        });
    });
    </script>
    </body>
</html>
<?php  include 'Footer.php';?>