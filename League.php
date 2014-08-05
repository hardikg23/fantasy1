<?php
include 'Header.php';
include 'PHP/includes/database_connectivity_includes.php';
@session_start();
include 'PHP/includes/session_setter.php';
include 'PHP/includes/seriedId_setter.php';
?>
<html>
    <head>
        <title>LEAGUE</title>
        <link rel="stylesheet" type="text/css" href="css/League.css">
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


        <div class="filler box-shadow-comman" style="position: absolute;width: 1000px;height: 35px;left: 176px;top: 150px;background-color: white;">
        </div>

        <div class="main-body-container box-shadow-comman" style="position: absolute;width: 1000px;height: 1000px;left: 183px;top: 175px;background-color: white;">
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
            <div  style="position: absolute;width: 1000px;height: 870px;left: 0px;top: 130px;">
                <!---- CREATE and JOIN league--->
                <div class="font-containt box-shadow-comman" style="position: absolute;width: 363px;height: 120px;left: 10px;top: 0px;">
                    <div class="black-header font-containt-bold">
                        CREATE LEAGUE
                    </div>
                    <table class="create-join-table" style="background-color: #167C07;">
                        <tr>
                            <td align="right">LEAGUE NAME : </td><td> <input type="text" maxlength="18" class="input-text" id="createLeague_name"></td>
                        </tr>
                        <tr>
                            <td align="right">CODE : </td><td><input type="password" maxlength="12" class="input-text" id="createLeague_code"></td>
                        </tr>
                        <tr>
                            <td></td><td><input type="button" class="create-button" value="CREATE" id="creatLeagueButton"></td>
                        </tr>
                    </table>
                </div>

                <div class="font-containt box-shadow-comman" style="position: absolute;width: 363px;height: 120px;left: 383px;top: 0px;">
                    <div class="black-header font-containt-bold">
                        JOIN LEAGUE
                    </div>
                    <table class="create-join-table" style="background-color: #B01212;">
                        <tr>
                            <td align="right">LEAGUE NAME : </td><td> <input type="text" maxlength="18" class="input-text" id="joinLeague_name"></td>
                        </tr>
                        <tr>
                            <td align="right">CODE : </td><td><input type="password" class="input-text" id="joinLeague_code"></td>
                        </tr>
                        <tr>
                            <td></td><td><input type="button" class="join-button"  value="JOIN" id="joinLeagueButton"></td>
                        </tr>
                    </table>
                </div>
                <!-------->
            <!--  DISPLAY MAIN LEAGUE BODY-->
                <div class="font-containt box-shadow-comman" style="position: absolute;width: 736px;height: 749px;left: 10px;top: 150px;">
                    <?php
                    if(isset ($_GET['seriesId']) && isset ($_GET['lid'])) //display member of league
                    {
                        if(!empty ($_GET['seriesId']) && !empty ($_GET['lid'])) {
                            $LeageMem='s'.$seriesId.'_league_member';
                            $LeagueCode='s'.$seriesId.'_league_code';
                            $ElevenTable='s'.$seriesId.'_user_eleven_data';
                            $userDate='users_data';
                            $LeagueID=mysql_real_escape_string(htmlentities($_GET['lid']));
                            $userNameOfmanager="";
                            if($resultSet_to_get_username=  mysql_query("SELECT user_name,first_name,last_name from users_data where user_email like '$session_email'")) {
                                $userNameOfmanager=  mysql_real_escape_string(mysql_result($resultSet_to_get_username, 0,'user_name'));
                            }
                if(@$resultSet_get_all_league=mysql_query("SELECT c.leagueName,c.leagueCode,u.user_name,u.user_team_name,d.transfer_left,d.user_points,u.first_name,u.last_name FROM $LeageMem m
                                          INNER JOIN $LeagueCode c  on c.leagueID=m.leagueID
                                          INNER JOIN $ElevenTable d on d.user_email=m.user_email
                                          INNER JOIN $userDate u  on d.user_email=u.user_email
                                          where c.leagueID=$LeagueID ORDER BY d.user_points DESC LIMIT 100")) {

                                $LeagueName=mysql_real_escape_string(mysql_result($resultSet_get_all_league, 0,0));
                                $LeagueCode=mysql_real_escape_string(mysql_result($resultSet_get_all_league, 0,1));
                                $UName=mysql_real_escape_string(mysql_result($resultSet_get_all_league, 0,2));
                                $TName=mysql_real_escape_string(mysql_result($resultSet_get_all_league, 0,3));
                                $Trans=mysql_real_escape_string(mysql_result($resultSet_get_all_league, 0,4));
                                $UPoints=mysql_real_escape_string(mysql_result($resultSet_get_all_league, 0,5));
                                $firstName=mysql_real_escape_string(mysql_result($resultSet_get_all_league, 0,6));
                                $lastName=mysql_real_escape_string(mysql_result($resultSet_get_all_league, 0,7));

                                $rank_no=2;
                                $lastRank=1;
                                $lastPoints=$UPoints;
                                echo "<div style='position: absolute;width: 736px;height: 50px;left: 0px;top: 10px;overflow: auto;'>";
                                echo "<div align='left' class='league-name-code font-containt-bold'>LEAGUE NAME:  $LeagueName </div>
                                 <div align='right' class='league-name-code font-containt-bold'>CODE: $LeagueCode</div>  ";
                                echo "</div>";

                                echo "<div style='position: absolute;width: 736px;height: 700px;left: 0px;top: 65px;padding-left: 10px;padding-right: 10px;overflow: auto;'>";
                                echo '<table class="private-league-data-table"><tr>';
                                echo '<th width="10%">#</th>
                                          <th width="33%">MANAGER</th>
                                          <th width="28%">TEAM</th>
                                          <th width="17%">TRANSFERS</th>
                                          <th width="12%">POINTS</th>';
                                echo '</tr>';

                                if($userNameOfmanager == $UName) {
                                    echo '<tr bgcolor="#BCF4F9">';
                                    echo "<td>1</td><td><a href='ViewPoints.php?userName=$UName'>$firstName $lastName</a></td><td>$TName</td><td>$Trans</td><td>$UPoints</td>";
                                    echo '</tr>';
                                }  else {
                                    echo '<tr>';
                                    echo "<td>1</td><td><a href='ViewPoints.php?userName=$UName'>$firstName $lastName</a></td><td>$TName</td><td>$Trans</td><td>$UPoints</td>";
                                    echo '</tr>';
                                }
                                while ($row=mysql_fetch_array($resultSet_get_all_league)) {
                                    $username=mysql_real_escape_string($row[2]);
                                    $teamName=mysql_real_escape_string($row[3]);
                                    $Transfers=mysql_real_escape_string($row[4]);
                                    $points=mysql_real_escape_string($row[5]);
                                    $firstName=mysql_real_escape_string($row[6]);
                                    $lastName=mysql_real_escape_string($row[7]);
                                    if($lastPoints==$points) {
                                        if($userNameOfmanager == $username) {
                                            echo '<tr bgcolor="#BCF4F9">';
                                            echo "<td>$lastRank</td><td><a href='ViewPoints.php?userName=$username'>$firstName $lastName</a></td><td>$teamName</td><td>$Transfers</td><td>$points</td>";
                                            echo '</tr>';
                                        }else {
                                            echo '<tr>';
                                            echo "<td>$lastRank</td><td><a href='ViewPoints.php?userName=$username'>$firstName $lastName</a></td><td>$teamName</td><td>$Transfers</td><td>$points</td>";
                                            echo '</tr>';
                                        }
                                    } else {
                                        if($userNameOfmanager == $username) {
                                            echo '<tr bgcolor="#BCF4F9">';
                                            echo "<td>$rank_no</td><td><a href='ViewPoints.php?userName=$username'>$firstName $lastName</a></td><td>$teamName</td><td>$Transfers</td><td>$points</td>";
                                            echo '</tr>';
                                        }else {
                                            echo '<tr>';
                                            echo "<td>$rank_no</td><td><a href='ViewPoints.php?userName=$username'>$firstName $lastName</a></td><td>$teamName</td><td>$Transfers</td><td>$points</td>";
                                            echo '</tr>';
                                        }
                                        $lastRank=$rank_no;
                                        $lastPoints=$points;
                                    }
                                    $rank_no++;
                                }
                                echo '</table>';
                                echo "</div>";
                            }else {
                                echo '<center>ERROR OCCURED</center>';
                            }
                        }
                        else {
                            echo '<center>ERROR OCCURED</center>';
                        }
                    }
                    // ELSE IF PARAMETER OF PUBLIC LEAGUE IS SET............................................
                    else if(isset ($_GET['seriesId']) && isset ($_GET['plid'])) {
                        if(!empty ($_GET['seriesId']) && !empty ($_GET['plid'])) {
                            $seriesId=mysql_real_escape_string(htmlentities($_GET['seriesId']));
                            $LeageMem='s'.$seriesId.'_public_league_member';
                            $LeagueCode='s'.$seriesId.'_public_league_code';
                            $ElevenTable='s'.$seriesId.'_user_eleven_data';
                            $userDate='users_data';
                            $LeagueID=mysql_real_escape_string(htmlentities($_GET['plid']));

                            //to get user_name
                            $userNameOfmanager="";
                            if($resultSet_to_get_username=  mysql_query("SELECT user_name from users_data where user_email like '$session_email'")) {
                                $userNameOfmanager=  mysql_real_escape_string(mysql_result($resultSet_to_get_username, 0,0));
                            }

                            if($resultSet_get_all_league=mysql_query("SELECT c.leagueName,u.user_name,u.user_team_name,d.transfer_left,d.user_points,u.first_name,u.last_name
                             FROM $LeageMem m INNER JOIN $LeagueCode c on c.leagueID=m.leagueID INNER JOIN $ElevenTable d
                             on d.user_email=m.user_email INNER JOIN $userDate u on d.user_email=u.user_email
                             where c.leagueID=$LeagueID ORDER BY d.user_points DESC LIMIT 100")) {

                                $LeagueName=mysql_real_escape_string(mysql_result($resultSet_get_all_league, 0,0));
                                $UName=mysql_real_escape_string(mysql_result($resultSet_get_all_league, 0,1));
                                $TName=mysql_real_escape_string(mysql_result($resultSet_get_all_league, 0,2));
                                $Trans=mysql_real_escape_string(mysql_result($resultSet_get_all_league, 0,3));
                                $UPoints=mysql_real_escape_string(mysql_result($resultSet_get_all_league, 0,4));
                                $firstName=mysql_real_escape_string(mysql_result($resultSet_get_all_league, 0,5));
                                $lastName=mysql_real_escape_string(mysql_result($resultSet_get_all_league, 0,6));
                                $rank_no=2;
                                $lastRank=1;
                                $lastPoints=$UPoints;

                                echo "<div style='position: absolute;width: 736px;height: 49px;left: 0px;top: 0px;'>";
                                echo "<div align='left' class='league-name-code font-containt-bold' style='height:40px'>LEAGUE NAME:  $LeagueName</div>";
                                echo "</div>";
                                echo "<div style=\"position: absolute;width: 736px;height: 640px;left: 0px;top: 50px;overflow: auto;\">";
                                echo '<table class="private-league-data-table"><tr>';
                                echo '<th width="10%">#</th>
                                          <th width="33%">MANAGER</th>
                                          <th width="28%">TEAM</th>
                                          <th width="17%">TRANSFERS</th>
                                          <th width="12%">POINTS</th>';
                                echo '</tr>';
                                if($userNameOfmanager == $UName) {
                                    echo '<tr bgcolor="#BCF4F9">';
                                    echo "<td>1</td><td><a href='ViewPoints.php?userName=$UName'>$firstName $lastName</a></td><td>$TName</td><td>$Trans</td><td>$UPoints</td>";
                                    echo '</tr>';
                                }else {
                                    echo '<tr>';
                                    echo "<td>1</td><td><a href='ViewPoints.php?userName=$UName'>$firstName $lastName</a></td><td>$TName</td><td>$Trans</td><td>$UPoints</td>";
                                    echo '</tr>';
                                }
                                while ($row=mysql_fetch_array($resultSet_get_all_league)) {
                                    $username=mysql_real_escape_string($row[1]);
                                    $teamName=mysql_real_escape_string($row[2]);
                                    $Transfers=mysql_real_escape_string($row[3]);
                                    $points=mysql_real_escape_string($row[4]);
                                    $firstName=mysql_real_escape_string($row[5]);
                                    $lastName=mysql_real_escape_string($row[6]);
                                    if($lastPoints==$points) {
                                        if($userNameOfmanager == $username) {
                                            echo '<tr bgcolor="#BCF4F9">';
                                            echo "<td>$lastRank</td><td><a href='ViewPoints.php?userName=$username'>$firstName $lastName</a></td><td>$teamName</td><td>$Transfers</td><td>$points</td>";
                                            echo '</tr>';
                                        }
                                        else {
                                            echo '<tr>';
                                            echo "<td>$lastRank</td><td><a href='ViewPoints.php?userName=$username'>$firstName $lastName</a></td><td>$teamName</td><td>$Transfers</td><td>$points</td>";
                                            echo '</tr>';
                                        }
                                    }else {
                                        if($userNameOfmanager == $username) {
                                            echo '<tr bgcolor="#BCF4F9">';
                                            echo "<td>$rank_no</td><td><a href='ViewPoints.php?userName=$username'>$firstName $lastName</a></td><td>$teamName</td><td>$Transfers</td><td>$points</td>";
                                            echo '</tr>';
                                        }
                                        else {
                                            echo '<tr>';
                                            echo "<td>$rank_no</td><td><a href='ViewPoints.php?userName=$username'>$firstName $lastName</a></td><td>$teamName</td><td>$Transfers</td><td>$points</td>";
                                            echo '</tr>';
                                        }
                                        $lastRank=$rank_no;
                                        $lastPoints=$points;
                                    }
                                    $rank_no++;
                                }
                                echo '</table>';
                                echo "</div>";
                            }
                            else {
                                echo '<center>ERROR OCCURED</center>';
                            }
                        }
                        else {
                            echo '<center>ERROR OCCURED</center>';
                        }

                    }
                    else  //dispaly ALL league DATA. (PRIVATE AND PUBLIC ).....
                    {
                        echo "<div style=\"position: absolute;width: 736px;height: 700px;left: 0px;top: 0px;overflow: auto;\">";

                        //******************   PRIVATE LEAGUE **********************************************************************
                        $leagueMember='s'.$seriesId.'_league_member';
                        $leagueCode='s'.$seriesId.'_league_code';
                        $userTable='s'.$seriesId.'_user_eleven_data';
                        if($resultSet_league_data=mysql_query("select c.leagueID,c.leagueName,c.members
                                                             from $leagueMember l
                                                             INNER JOIN $leagueCode c
                                                             on l.leagueID=c.leagueID
                                                             where user_email='$session_email'")) {
                            echo '<div class="black-header font-containt-bold" style="font-weight:bold;font-size:18px;height:25px;padding-left:10px;">
                                PRIVATE LEAGUE INFORMATION
                             </div>';
                            if(mysql_num_rows($resultSet_league_data)>0) {
                                echo '<table class="privateMain-league-table">';
                                echo '<tr>';
                                echo '<th>#</th><th>NAME</th><th>MEMBERS</th><th>RANK</th>';
                                echo '</tr>';
                                $inc=1;
                                while($row=mysql_fetch_array($resultSet_league_data)) {
                                    $LeagueID=mysql_real_escape_string($row[0]);
                                    $LeagueName=mysql_real_escape_string($row[1]);
                                    $member=mysql_real_escape_string($row[2]);
                            $query_to_find_rank="SELECT count(s.user_email) FROM $leagueMember s
                               INNER JOIN $userTable u on s.user_email=u.user_email
                               where u.user_points > (select user_points from $userTable
                               where user_email='$session_email') AND leagueID = $LeagueID";
                               $resultSet_to_find_rank=mysql_query($query_to_find_rank);
                                    $rankPlayer=mysql_result($resultSet_to_find_rank, 0,0);
                                    $rank=$rankPlayer+1;

                                    echo '<tr>';
                                    echo "<td>$inc</td><td><a href=League.php?seriesId=$seriesId&lid=$LeagueID>$LeagueName</a></td><td>$member</td><td>$rank</td>";
                                    echo '</tr>';
                                    $inc++;
                                }
                                echo '</table>';
                            }else {
                                echo 'You are not joined any private league';
                            }
                        }else {
                            echo 'SOME ERROR OCCURED.';
                        }
                        //*****
                        echo '<br><br><br>';

                        //***   PUBLIC LEAGUE 
                        $publicLeagueCode='s'.$seriesId.'_public_league_code';
                        $publicLeagueMember='s'.$seriesId.'_public_league_member';
                        $userTable='s'.$seriesId.'_user_eleven_data';
                        if($resultSet_publicLeague_data=mysql_query("SELECT leagueID,leagueName,members
                         FROM $publicLeagueCode where leagueID not in (select leagueID from $publicLeagueMember where user_email='$session_email')")) {
                            echo '<div class="black-header font-containt-bold" style="font-weight:bold;font-size:18px;height:25px;padding-left:10px;">
                                PUBLIC LEAGUE INFORMATION
                             </div>';

                            echo '<table class="privateMain-league-table">';
                            echo '<tr>';
                            echo '<th>#</th><th>NAME</th><th>MEMBERS</th><th>JOIN/LEAVE</th>';
                            echo '</tr>';
                            $inc=1;
                            // IF U R NOT MEMBER OF THAT LEAGUE **********************************************************
                            while($row=mysql_fetch_array($resultSet_publicLeague_data)) {
                                $LeagueID=mysql_real_escape_string($row['leagueID']);
                                $LeagueName=mysql_real_escape_string($row['leagueName']);
                                $member=mysql_real_escape_string($row['members']);
                                echo '<tr id='.$LeagueID.'>';
                                echo "<td>$inc</td><td><a href=League.php?seriesId=$seriesId&plid=$LeagueID>$LeagueName</a></td>
                                      <td>$member</td>
                                      <td>
                                         <input type='button' value='JOIN' class='joinPublicLeague'>
                                      </td>";
                                echo '</tr>';
                                $inc++;
                            }
                            $resultSet_publicLeague_data=mysql_query("SELECT leagueID,leagueName,members
                             FROM $publicLeagueCode where leagueID in (select leagueID from $publicLeagueMember where user_email='$session_email')");
                            // IF U R MEMBER OF THAT LEAGUE
                            while($row=mysql_fetch_array($resultSet_publicLeague_data)) {
                                $LeagueID=mysql_real_escape_string($row['leagueID']);
                                $LeagueName=mysql_real_escape_string($row['leagueName']);
                                $member=mysql_real_escape_string($row['members']);

                                echo '<tr id='.$LeagueID.'>';
                                echo "<td>$inc</td><td><a href=League.php?seriesId=$seriesId&plid=$LeagueID>$LeagueName</a></td>
                                      <td>$member</td>
                                      <td>
                                            <input type='button' value='LEAVE' class='leavePublicLeague'>
                                      </td>";
                                echo '</tr>';
                                $inc++;
                            }

                            echo '</table>';
                        }else {
                            echo '<center>SOME ERROR OCCURED</center>';
                        }
                        //*****
                        echo "</div>";
                    }
                    ?>
                </div>
            <div class="font-containt box-shadow-comman" style="position: absolute;width: 220px;height: 170px;left: 770px;top: 0px;">
              <div class="black-header font-containt-bold">
                        USER INFORMATION
              </div>
                    <?php include 'PHP/includes/userData.php'; ?>
                </div>

                <!--PRIVATE LEAGUE-->
                <div class="font-containt box-shadow-comman" style="position: absolute;width: 220px;height: 178px;left: 770px;top: 186px; overflow-y:auto;">
                    <div class="black-header font-containt-bold">
                        PRIVATE LEAGUE
                    </div>
                <?php include 'PHP/includes/privateLeague.php'; ?>
                </div>
                <!---->

            <div class="font-containt box-shadow-comman" style="position: absolute;width: 220px;height: 178px;left: 770px;top: 380px; overflow:auto;">
                    <div class="black-header font-containt-bold">
                        PUBLIC LEAGUE
                    </div>
                    <?php include 'PHP/includes/publicLeague.php'; ?>
                </div>
            </div>
        </div>
        
        <div class="filler" style="position: absolute;width: 1000px;height: 45px;left: 176px;top: 1150px;background-color: white">
        </div>

        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/make_All_page_responsive.js"></script>
        <script type="text/javascript" src="js/League.js"></script>
    </body>
</html>
<?php
include 'Footer.php';
?>