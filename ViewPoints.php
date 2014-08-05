<?php
include 'PHP/includes/database_connectivity_includes.php';
  if(isset ($_GET['userName']) && !empty ($_GET['userName']))
  {
    $userName=mysql_real_escape_string(htmlentities($_GET['userName']));
    include 'Header.php';
    @session_start();
    include 'PHP/includes/session_setter.php';
    include 'PHP/includes/seriedId_setter.php';

?>
<html>
    <head>
	<title>View Points</title>
         <link rel="stylesheet" type="text/css" href="css/ViewPoints.css">
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
        <!--MAIN BODY-->
        <div  style="position: absolute;width: 1000px;height: 870px;left: 0px;top: 130px;">
            <!--- IMAGE ------->
              <div class="font-containt div-header-img" style="position: absolute;width: 736px;height: 100px;left: 10px;top: 20px;background-image: url('photos/viewpoints/header.jpg');">
              </div>
             <!--------->
        <!--- TEAM ------>
         <div class="font-containt box-shadow-comman" style="position: absolute;width: 736px;height: 412px;left: 10px;top: 140px;">

        <?php
              $tableUserEleven='s'.$seriesId.'_user_eleven';
              $tableUserElevenData='s'.$seriesId.'_user_eleven_data';
              $tablePlayerData='s'.$seriesId.'_player_data';
              $arrayX=array(5,126,247,368,489,610,65,186,307,428,549);
              $arrayY=array(25,25,25,25,25,25,175,175,175,175,175);
              $fname="-";$lname="-";$userTeamName="-";$userCountry="-";$userPoints="-";$rank="-";
             
                        $datetime=date("Y-m-d H:i:s");
                        $transferString="";
                        $transfer_schema='s'.$seriesId.'_transfer_schema';
                        if(@$result_transfer_String=  mysql_query("SELECT tLeftString from
                                  $transfer_schema where '$datetime'<=toDate ORDER by toDate LIMIT 1"))
                        {
                            $transferString=mysql_real_escape_string(mysql_result($result_transfer_String, 0));
                            if($transferString == 'UNLIMITED')
                               $transfer_left="&#8734;";
                        }
                        //$transfer_left="-";
              
             // ****** DISPLAY MAIN TEAM***
             if(@$resultSet_find_player_history=mysql_query("SELECT * FROM $tableUserElevenData d
                   INNER JOIN $tableUserEleven e on d.user_email=e.user_email INNER JOIN users_data u
                   on  u.user_email=e.user_email WHERE e.user_name='$userName' ORDER BY e.last_modified DESC LIMIT 1"))
                   {
                        if(@mysql_num_rows($resultSet_find_player_history)==1)
                        {
                            ////VARS to display users data
                            $fname=mysql_real_escape_string(mysql_result($resultSet_find_player_history, 0,'first_name'));
                            $lname=mysql_real_escape_string(mysql_result($resultSet_find_player_history, 0,'last_name'));
                            $userTeamName=mysql_real_escape_string(mysql_result($resultSet_find_player_history, 0,'user_team_name'));
                            $userCountry=mysql_real_escape_string(mysql_result($resultSet_find_player_history, 0,'user_country'));
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
                                    echo '<div class="font-containt box-shadow-comman" style="position: absolute;width: 736px;height: 65px;left: 0px;top: 0px;">';
                                    echo "<div style='position: absolute;width: 100%;height: 20px;left:0px;top: 0px;'>";
                                    echo '<div class="black-header font-containt-bold">LAST UPDATE :  '.$last_modified.' </div></div>';

                                    echo "<div style='position: absolute;width: 140px;height: 30px;left:480px;top: 0px;'>
                                          <div class='black-header font-containt-bold'>TRANSFERS LEFT</div>
                                          <div align='center' class='transfer-left font-containt-bold' id=\"transfer_left\">$transfer_left</div>
                                          </div>";

                                    echo "<div style='position: absolute;width: 100px;height: 30px;left:626px;top: 0px;'>
                                         <div class='black-header font-containt-bold'>BUDGET LEFT</div>
                                         <div class='budeget-left font-containt-bold'>$budget_left</div>
                                                                                        </div>";

                                    echo '</div>';
                                    echo '<div class="font-containt" style="position: absolute;width: 736px;height: 347px;left: 0px;top: 80px;">';
                                    $index=0;
                                    while($row=mysql_fetch_array($resultSet_player_record)) {
                                    $id=mysql_real_escape_string($row['id']);
                                    $name=mysql_real_escape_string($row['Name']);
                                    $team=mysql_real_escape_string($row['team']);
                                    $price=mysql_real_escape_string($row['price']);
                                    $playerImage=mysql_real_escape_string($row['imgSrc']);
                                    $playerImage='photos/players/'.$playerImage;
                                    $style=mysql_real_escape_string($row['style']);
                                    $total_points=mysql_real_escape_string($row['total_point']);
                                    if($captain != $id) {
                                        echo "<div class='player-item' style='position: absolute;width: 116px;height: 138px;left: $arrayX[$index]px;top: $arrayY[$index]px;border:1px solid;'>";
                                        echo "<div style='background-color:#0A0E8C;height:18px;'><img src='photos/style/style$style.png' alt='$style' width='18px' height='18px'><div class='player-name' style='font-size: 11px'>$name</div></div>";
                                        echo "<div><center><img src='$playerImage' alt='Player Image' height='102px' width='116px'></center></div>";
                                        echo "<div><table width='100%' height='15px'; style='background-color:#262222;font-size:12px;color:white'><tr><td align='left'>$price</td><td align='center'>$team</td><td align='right'>$total_points</td></tr></table></div>";
                                        echo '</div>';
                                    }
                                    else if($captain == $id) {
                                        echo "<div class='player-item' style='position: absolute;width: 116px;height: 138px;left: $arrayX[$index]px;top: $arrayY[$index]px;border:1px solid;'>";
                                        echo "<div style='background-color:#B5080B;height:18px;'><img src='photos/style/style$style.png' alt='$style' width='18px' height='18px'><div class='player-name' style='font-size: 11px'>$name</div></div>";
                                        echo "<div><center><img src='$playerImage' alt='Player Image' height='102px' width='116px'></center></div>";
                                        echo "<div><table width='100%' height='15px';  style='background-color:#B5080B;font-size:12px;color:white'><tr><td align='left'>$price</td><td align='center'>$team</td><td align='right'>$total_points</td></tr></table></div>";
                                        echo '</div>';
                                    }
                                    $index++;
                                }
                                echo '</div>';
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
                ?>
                </div>
               <!--------->
		
		<div align="center"  style="position: absolute;width: 980px;height: 100px;left: 10px;top: 600px;">
                    <table width="100%">
                        <tr>
                            <td><iframe src='http://www.flipkart.com/affiliate/displayWidget?affrid=WRID-139784968628945179' frameborder=0 height=250 width=300></iframe></td>
                             <td><iframe src='http://www.flipkart.com/affiliate/displayWidget?affrid=WRID-139784951802590230' frameborder=0 height=250 width=300></iframe></td>
                              <td><iframe src='http://www.flipkart.com/affiliate/displayWidget?affrid=WRID-139784953416817182' frameborder=0 height=250 width=300></iframe></td>
                        </tr>
                    </table>
                </div>

            <!----------------------------- USER HISTORY --------------------------------------------------------->
            <div class="font-containt box-shadow-comman" style="position: absolute;width: 220px;height: 170px;left: 770px;top: 20px;">
            <div class="black-header font-containt-bold">
                MANAGER INFORMATION
            </div>
             <?php
		     $dpImage="photos/dp/defult.jpg";
                     $tableUserEleven='s'.$seriesId.'_user_eleven_data';
                     if(mysql_num_rows($resultSet_find_player_history) == 1) {
                         if($userPoints != 0) {
                             $result_to_find_rank=mysql_query("SELECT count(TID) FROM $tableUserEleven WHERE user_points > $userPoints");
                             $rank=mysql_real_escape_string(mysql_result($result_to_find_rank, 0,0))+1;
				 if($rank <= 3) {
                                    $dpImage="photos/dp/top3-dp.jpg";
                                }else if($rank <= 100) {
                                    $dpImage="photos/dp/top100-dp.jpg";
                                }
                         }
                         ?>
                <div>
                    <div class="user-data-manager font-containt-bold">&nbsp;&nbsp;MANAGER: <?php echo $fname." ".$lname; ?></div>
                    <div><img src="<?php echo $dpImage;?>" width="75" height="85" style="position: absolute;left:5px;top:40px"></div>
                    <div style="position: absolute;left: 80px;top:30px;width: 140px">
                        <table class="user-data-table" style="font-size: 11px">
                            <tr style="height: 20px;">
                                <td style="font-size: 14px">RANK: <font class="user-data-rank font-containt-bold"><?php echo $rank; ?></font></td>
                            </tr>
                            <tr style="height: 15px;">
                                <td>POINTS: <font style='font-size:14px;' class="font-containt-bold"><?php echo $userPoints; ?></font></td>
                            </tr>
                            <tr style="height:15px;">
                                <td>TRANSFERS: <font style='font-size:14px;' class="font-containt-bold"><?php echo $transfer_left; ?></font></td>
                            </tr>
                            <tr style="height: 15px;">
                                <td>COUNTRY: <font style='font-size:14px;' class="font-containt-bold"><?php echo $userCountry; ?></font></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <?php
                   }else
                {
                  echo '<center>No Data Found For this user</center>';
                }
                ?>
                </div>


                  <div class="font-containt box-shadow-comman" style="position: absolute;width: 220px;height: 178px;left: 770px;top: 206px; overflow:auto;">
                    <div class="black-header font-containt-bold">
                          PRIVATE LEAGUE
                    </div>
                    <?php
                    $leagueMember='s'.$seriesId.'_league_member';
                    $leagueCode='s'.$seriesId.'_league_code';
                    $userTable='s'.$seriesId.'_user_eleven_data';
                    if(@$resultSet_league_data=mysql_query("select c.leagueID,c.leagueName,c.members
                     from $leagueMember l INNER JOIN $leagueCode c on l.leagueID=c.leagueID INNER JOIN users_data u
                     on l.user_email=u.user_email where u.user_name='$userName'")) {
                    if(mysql_num_rows($resultSet_league_data)>0) {
                            echo '<table class="private-league-table">';
                            echo '<tr>';
                            echo '<th width="60%">NAME</th><th width="20%">MEM</th><th width="20%">RANK</th>';
                            echo '</tr>';

                            while($row=mysql_fetch_array($resultSet_league_data)) {
                                $LeagueID=mysql_real_escape_string($row[0]);
                                $LeagueName=mysql_real_escape_string($row[1]);
                                $member=mysql_real_escape_string($row[2]);


                                /*$query_to_find_rank="SELECT count(s.user_email) FROM $leagueMember s
                                 INNER JOIN $userTable u on s.user_email=u.user_email
                                 where u.user_points > (select user_points from $userTable
                                  where user_email='$session_email') AND leagueID = $LeagueID";*/
								  $query_to_find_rank="SELECT count(s.user_email) 
                                        FROM $leagueMember s
                                        INNER JOIN $userTable u 
                                        on s.user_email=u.user_email
                                        where u.user_points > (select user_points 
                                        from $userTable
                                        where user_email=(select user_email from users_data where user_name='$userName')) 
                                        AND leagueID = $LeagueID";
                                $resultSet_to_find_rank=mysql_query($query_to_find_rank);
                                $rankPlayer=mysql_result($resultSet_to_find_rank, 0,0);
                                $rank=$rankPlayer+1;
                                echo '<tr>';
                                echo "<td class='private-league-table-a'><a href=League.php?seriesId=$seriesId&lid=$LeagueID>$LeagueName</a></td><td>$member</td><td>$rank</td>";
                                echo '</tr>';
                            }
                            echo '</table>';
                        }else {
                            echo '<center>No League Data</center>';

                        }
                    }else {
                        echo '<center>Some Errored Occured while retriving Your league data</center>';
                    }
                    ?>
                     </div>
			
		
			

                     <!--------->
                </div>
                <!---->
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
<?php
}
   else{
         header( 'Location:Error.php' ) ;
 }
?>

