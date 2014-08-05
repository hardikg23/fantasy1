<?php
@include 'Header.php';
@include 'PHP/includes/database_connectivity_includes.php';
@session_start();
include 'PHP/includes/session_setter.php';
include 'PHP/includes/seriedId_setter.php';
?>
<html>
    <head>
        <title>MANAGE TEAM</title>
        <link rel="stylesheet" type="text/css" href="css/ManageTeam.css">
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

            <!---- MAIN BODY --->
            <div  style="position: absolute;width: 1000px;height: 870px;left: 0px;top: 130px;">

                <div style="position: absolute;width: 200px;height: 30px;left: 100px;top: 30px;color: black;">
                    <!--  MASGE To DISPLAY-->
                </div>

                <div style="position: absolute;width: 746px;height: 558px;left: 0px;top: 0px;">
                    <!--TRANSFER AND BUDGET LEFT--->
                    <div class="font-containt box-shadow-comman" style="position: absolute;width: 746px;height:75px;left: 10px;top: 0px;">
                        <?php
                        $s = 's' . $seriesId . '_player_data';
                        $players = 's' . $seriesId . '_user_eleven';
                        $players_data = 's' . $seriesId . '_user_eleven_data';
                        $transfer_schema = 's' . $seriesId . '_transfer_schema';
                        if (@$result_budget_transfer = mysql_query("SELECT last_modified,budget_left,transfer_left from
                                  $players_data where user_email='$session_email' LIMIT 1")) {
                            //BUDGET  and LAST MODIFIED
                            $budget_left = 100;
                            $last_modified = 'GO AHEAD MAKE YOUR FANTASTIC 11';
                            if (mysql_num_rows($result_budget_transfer) == 1) {
                                $last_modified = mysql_result($result_budget_transfer, 0, 'last_modified');
                                $budget_left = mysql_result($result_budget_transfer, 0, 'budget_left');
                            } else {
                                $last_modified = 'GO AHEAD MAKE YOUR FANTASTIC 11';
                            }
                            //***************
                            //TRANSFER
                            $datetime = date("Y-m-d H:i:s");
                            $transfer_left = 'UNLIMITED';
                            $tString = 'LIMITED';
                            if ($result_transfer_String = mysql_query("SELECT tLeft,tLeftString from
                                  $transfer_schema where '$datetime'<=toDate LIMIT 1")) {
                                if (mysql_num_rows($result_transfer_String) > 0)
                                    $tString = mysql_real_escape_string(mysql_result($result_transfer_String, 0, 'tLeftString'));
                                if (mysql_num_rows($result_budget_transfer) == 1 && $tString == 'UNLIMITED')
                                    $transfer_left = 'UNLIMITED';
                                else if (mysql_num_rows($result_budget_transfer) == 1 && $tString == 'LIMITED')
                                    $transfer_left = mysql_result($result_budget_transfer, 0, 'transfer_left');
                                else if (mysql_num_rows($result_budget_transfer) == 0 && $tString == 'LIMITED')
                                    $transfer_left = 'UNLIMITED';
                            }
                            //******
                        }
                        ?>

                        <div style="position: absolute;width: 100%;height: 20px;left:0px;top: 0px;">
                            <?php
                            if ($last_modified != 'GO AHEAD MAKE YOUR FANTASTIC 11') {
                                if ($session_country == 'India') {
                                    $old_date_timestamp = strtotime($last_modified);
                                    $last_modified = date('j,M Y h:i:sa', $old_date_timestamp);
                                    echo '<div class="black-header font-containt-bold">LAST UPDATE :  ' . $last_modified . ' IST </div>';
                                } else {
                                    $old_date_timestamp = strtotime($last_modified);
                                    $old_date_timestamp = $old_date_timestamp - '19800';
                                    $last_modified = date('j,M Y h:i:s A', $old_date_timestamp);
                                    echo '<div class="black-header font-containt-bold">LAST UPDATE : ' . $last_modified . ' GMT </div>';
                                }
                            } else {
                                echo '<div class="black-header font-containt-bold">LAST UPDATE : ' . $last_modified . '</div>';
                            }
                            ?>
                        </div>
                        <div  style="position: absolute;width: 140px;height: 30px;left:15px;top: 35px;">
                            <?php
                            $userTeamName = "";
                            if ($resultSet_teamname = mysql_query("SELECT user_team_name from users_data where user_email like '$session_email'")) {
                                $userTeamName = mysql_result($resultSet_teamname, 0);
                            }if ($userTeamName == "") {
                                ?>
                                <input type="text" value="<?php echo $userTeamName; ?>" placeholder="YOUR TEAM NAME" class="text-team-name" maxlength="15">
                                <input type="button" value="UPDATE" class="button-team-name">
                            <?php } ?>
                        </div>

			 <div  style="position: absolute;width: 450px;height: 30px;left:170px;top: 28px;">
                            <?php
                            echo "<div class='font-containt' style='font-size: 12px;color: #3D3C3C'></div>";
                            ?>
                        </div>


                        <div  style="position: absolute;width: 140px;height: 30px;left:480px;top: 0px;">
                            <?php
                            echo "<div class='black-header font-containt-bold'>TRANSFERS LEFT</div>
                                         <div align='center' class='transfer-left font-containt-bold' id=\"transfer_left\">$transfer_left</div>";
                            ?>
                        </div>
                        <div style="position: absolute;width: 120px;height: 30px;left:626px;top: 0px;">
                            <?php
                            echo '<div class="black-header font-containt-bold">BUDGET LEFT</div>
                                <div class="budeget-left font-containt-bold" id="budget_left">' . $budget_left . '</div>';
                            ?>
                        </div>
                    </div>
                    <!-------->

                    <!----ERROR and SELECTION----->
                    <div class="font-containt box-shadow-comman" style="position: absolute;width: 746px;height: 60px;left: 10px;top: 75px;">
                        <div class="error-msg font-containt" id="error_message" style="position: absolute;width: 363px;height: 40px;left: 0px;top:0px;background-color: #0D066A;font-size: 10px;font-weight: bold;">
                            
                        </div>
                        <div class="select-tags font-containt" style="position: absolute;width: 363px;height: 40px;left: 373px;top: 0px;">
                            TEAM: &nbsp;&nbsp;
                            <select name="teams" id="select_team_1">
                                <option value="all">ALL</option>
                                <?php
                                $s = 's' . $seriesId . '_player_data';
                                if ($result = mysql_query("SELECT DISTINCT team FROM `$s` where playingStatus = 1")) {
                                    while ($row = mysql_fetch_array($result)) {  //to get all data.....
                                        $team = mysql_real_escape_string($row[0]);
                                        echo '<option value=' . $team . '>';
                                        echo $team;
                                        echo '</option>';
                                    }
                                }
                                ?>
                                &nbsp;&nbsp;
                            </select>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            TYPE:
                            &nbsp;&nbsp;
                            <select name="style" id="select_type_1">
                                <option value="all">ALL</option>
                                <option value="batsman">BATSMAN</option>
                                <option value="all-rounder">ALL-ROUNDER</option>
                                <option value="weeket-keeper">WICKET-KEEPER</option>
                                <option value="bowler">BOWLER</option>
                            </select>
                        </div>
                    </div>
                    <!------>
                    <!---- Display FINAL 11 --->
                    <div class="font-containt box-shadow-comman" style="position: absolute;width: 363px;height: 433px;left: 10px;top: 125px;">
                        <div class="black-header font-containt-bold">
                            <center>YOUR TEAM</center>
                        </div>
                        <?php
                        $s = 's' . $seriesId . '_player_data';
                        $players = 's' . $seriesId . '_user_eleven';
                        $player_data = '';
                        if ($result1 = mysql_query("select player1,player2,player3,player4,player5,player6,
                                            player7,player8,player9,player10,player11 from $players
                                            where user_email='$session_email' ORDER BY last_modified DESC LIMIT 1")) {
                            $length = mysql_field_len($result1, 0);
                            $no_rows = mysql_num_rows($result1);
                            if ($no_rows == 0) {
                                $player_data = '<center>NOTHING</center>';
                            } else {
                                while ($row = mysql_fetch_array($result1)) {
                                    $player1 = mysql_real_escape_string($row['player1']);
                                    $player2 = mysql_real_escape_string($row['player2']);
                                    $player3 = mysql_real_escape_string($row['player3']);
                                    $player4 = mysql_real_escape_string($row['player4']);
                                    $player5 = mysql_real_escape_string($row['player5']);
                                    $player6 = mysql_real_escape_string($row['player6']);
                                    $player7 = mysql_real_escape_string($row['player7']);
                                    $player8 = mysql_real_escape_string($row['player8']);
                                    $player9 = mysql_real_escape_string($row['player9']);
                                    $player10 = mysql_real_escape_string($row['player10']);
                                    $player11 = mysql_real_escape_string($row['player11']);

                                    $confirm_budget = 0;
                                    if ($result2 = mysql_query("select * from $s where id IN(
                                                                $player1,$player2,$player3,$player4
                                                                ,$player5,$player6,$player7,$player8,$player9,$player10,$player11)")) {
                                        while ($row1 = mysql_fetch_array($result2)) {
                                            $playerid = mysql_real_escape_string($row1['id']);
                                            $name = mysql_real_escape_string($row1['Name']);
                                            $team = mysql_real_escape_string($row1['team']);
                                            $price = mysql_real_escape_string($row1['price']);
                                            $style = mysql_real_escape_string($row1['style']);
                                            $point = mysql_real_escape_string($row1['total_point']);
                                            $p_data = $style . "@#@" . $name . "@#@" . $team . "@#@" . $point . "@#@" . $price . "@#@" . $playerid;
                                            $player_data = $player_data . "" . $p_data . "......";

                                            $confirm_budget = $confirm_budget + $price;
                                        }
                                        $confirm_budget = 100 - $confirm_budget;
                                        if ($confirm_budget != $budget_left) {
                                            ?>
                                            <script>
                                                $('#budget_left').empty();
                                                $('#budget_left').text(<?php echo $confirm_budget; ?>);
                                            </script>
                                            <?php
                                        }
                                    } else {
                                        echo '<center>Error Ocuured while retriving your players information</center>';
                                    }
                                }
                            }
                            ?>
                            <script type="text/javascript">
                                var data="<?php echo $player_data; ?>";
                            </script>

                            <?php
                        } else {
                            echo '<center>Error Ocuured while retriving your players information</center>';
                        }
                        ?>
			
			<table  style="position: absolute;top:25px;left: 0px;width:25px;font-size: 10px;">
                            <th height="21px"></th>
                            <tr><td height="21px">1  |</td><tr>
                            <tr><td height="21px">2  |</td><tr>
                            <tr><td height="21px">3  |</td><tr>
                            <tr><td height="21px">4  |</td></tr>
                            <tr><td height="21px">5  |</td></tr>
                            <tr><td height="21px">6  |</td><tr>
                            <tr><td height="21px">7  |</td><tr>
                            <tr><td height="21px">8  |</td><tr>
                            <tr><td height="21px">9  |</td></tr>
                            <tr><td height="21px">10 |</td></tr>
                            <tr><td height="21px">11 |</td></tr>
                        </table>





                        <table class="final-eleven-table" id="final_eleven_selection" style="position: absolute;top:25px;left: 5px;width:353px" >
                        </table>
                    </div>
                    <!---------->

                    <!----------------------------------  Display SELECTION LIST---------------------------------------->
                    <div class="font-containt box-shadow-comman" id="team_selection_process" align="center" style="position: absolute;width: 373px;height: 433px;left: 383px;top: 125px;overflow: auto;">
                        <div class="black-header font-containt-bold">
                            <center>SELECT PLAYERS IN YOUR TEAM</center>
                        </div>
                        <?php
                        $s = 's' . $seriesId . '_player_data';
                        ?>
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
                        if ($result = mysql_query("SELECT * from $s WHERE (playingStatus=1 OR playingStatus=2) ORDER BY price DESC") or die(mysql_error())) {
                            echo '<table width=353px id="selection_process" class="tablesorter selection-table">';
                            echo '<thead><tr>
                                           <th width="6%"></th>
                                           <th width="15%"></th>
                                           <th width="45%">NAME</th>
                                           <th width="10%">TEAM</th>
                                           <th width="12%">POINTS</th>
                                           <th width="12%">PRICE</th>
                                           </tr>
                                       </thead>
                                       <tbody id="selection_process_body">';
                            while ($row = mysql_fetch_array($result)) {
                                $playerid = mysql_real_escape_string($row['id']);
                                $name = mysql_real_escape_string($row['Name']);
                                $team = mysql_real_escape_string($row['team']);
                                $price = mysql_real_escape_string($row['price']);
                                $style = mysql_real_escape_string($row['style']);
                                $point = mysql_real_escape_string($row['total_point']);
                                $playingStatus = mysql_real_escape_string($row['playingStatus']);
                                $photo = mysql_real_escape_string($row['imgSrc']);
                                $colorCode = 'black';
                                ?>
                                <script type="text/javascript">
                                    var h1,h2,h3,h4,h5,h6,h7,h8;
                                    h1=<?php echo $playerid ?>;
                                    h2=<?php echo "'$name'" ?>;
                                    h3=<?php echo "'$team'" ?>;
                                    h4=<?php echo $price ?>;
                                    h5=<?php echo $style ?>;
                                    h6=<?php echo $point ?>;
                                    h7=<?php echo $playingStatus ?>;
                                    h8=<?php echo "'$photo'" ?>;
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
                                if ($playingStatus == 2)
                                    $colorCode = 'red';
                                echo '<tr  style="color:' . $colorCode . '" align="center" id=' . $playerid . ' >';
                                echo '<td><img style="cursor:pointer" class="select_eleven"   src="photos/right.png" height="20px" width="20px"></td>
                                             <td id=' . $style . '><font style="visibility: hidden">' . $style . '</font><img  src="photos/style/style' . $style . '.png"></td>
                                              <td>' . $name . '</td><td>' . $team . '</td><td>' . $point . '</td><td>' . $price . '</td>';
                                echo '</tr>';
                            }
                            echo '</tbody></table>';
                        }else {
                            echo '<center>Error Occured while retriving player data</center>';
                        }
                        ?>
                    </div>
                    <!----------->

			
		
                     <!-----player COUNT by COUNTRY  ------>
                        <div class="count-country font-containt" style="position: absolute;width: 358px;height:40px;left: 10px;top: 452px;color: #535252;font-size: 9px;">
                            YOUR TEAM HAVE :
                            <table class="count-country-table font-containt" style="width: 100%;font-size: 16px;color: #363535;">
                            </table>
                        </div>
                    <!------*************----->



                    <div class="captain-selection font-containt" style="position: absolute;width: 358px;height: 50px;left: 10px;top: 500px;">
                        <div style="visibility: hidden" id="captain">
                            <?php
                            $players = 's' . $seriesId . '_user_eleven';
                            $query_to_find_captain = "SELECT captain FROM $players where user_email='$session_email'
                                                        ORDER BY last_modified DESC LIMIT 1";
                            $result_to_find_captain = mysql_query($query_to_find_captain);

                            if (mysql_num_rows($result_to_find_captain) == 1) {
                                echo $captain = mysql_result($result_to_find_captain, 0, 'captain');
                            }
                            ?>
                        </div>
                        Your-Captain
                        <select name="select_captain" id="captain_player" class="captain-select-tag">
                        </select>
                        <a href="#saveDialog" name="modal" class="save_modalID">
                            <input type="button" Value="SAVE" class="captain-save-button">
                        </a>

                        <input type="button" Value="RESET" id="rester_eleven" class="captain-reset-button">

                        <!--*****TRANSFER CONFORMATION ****-->
                        <div id="box">
                            <div id="saveDialog" class="window" >
                                <div id="displayModelErrorMsg" style="position: absolute;left:5px;top:30px;width:500px;height: 40px;font-size: 12px;">
                                </div>

                                <div id="displayTransfersMade" style="position: absolute;left:20px;top:100px;color:black;font-size: 12px;">
                                </div>

                                <a href="#" class="close">
                                    <input type="button" value="CANCEL" style="cursor: pointer;position: absolute;left:420px;top:35px;height: 30px;width:65px;background-color: #0C056C;color: white;font-size: 14px;font-weight: bold;border: 1px solid silver;">
                                </a>
                                <input type="button" id="save_eleven" value="CONFIRM" style="cursor: pointer;position: absolute;left:300px;top:35px;height: 30px;width: 95px;background-color: #B25610;color: white;font-size: 14px;font-weight: bold;border: 1px solid silver;">
                            </div>
                        </div>
                        <!-------------------------------------------------------------------------------------------------->

                    </div>
                </div>


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
                    <?php
                    include 'PHP/includes/privateLeague.php';
                    ?>
                </div>

                <div class="font-containt box-shadow-comman" style="position: absolute;width: 220px;height: 178px;left: 770px;top: 380px; overflow:auto;">
                    <div class="black-header font-containt-bold">
                        PUBLIC LEAGUE
                    </div>
                    <?php
                    include 'PHP/includes/publicLeague.php';
                    ?>
                </div>






                <!-----------------  UPCOMING FITURES  --------------------->
                <div class="font-containt box-shadow-comman" style="position: absolute;width: 980px;height: 200px;left: 10px;top: 600px;">
                    <div class="black-header font-containt-bold">
                        UPCOMING MATCHS
                    </div>
                    <div>
                        <?php
                        $datetime = date("Y-m-d H:i:s");

                        if ($ResultSet_of_fixture = mysql_query("SELECT * from fixture where timeAnddate>'$datetime' AND sid=$seriesId LIMIT 6")) {
                            if (mysql_num_rows($ResultSet_of_fixture) != 0) {
                                echo '<table class="fixture-table" style="position: absolute;top:20px;height: 100px;color:white;">
                                        <tr>';
                                while ($row = mysql_fetch_array($ResultSet_of_fixture)) {
                                    $sid = mysql_real_escape_string($row['sid']);
                                    $matchID = mysql_real_escape_string($row['matchID']);
                                    $team1 = mysql_real_escape_string($row['team1']);
                                    $team2 = mysql_real_escape_string($row['team2']);
                                    $matchTime = mysql_real_escape_string($row['timeAnddate']);
                                    $Ground = mysql_real_escape_string($row['Ground']);
                                    $location = mysql_real_escape_string($row['location']);
                                    $matchType = mysql_real_escape_string($row['matchType']);
                                    $matchDescription = mysql_real_escape_string($row['matchDescription']);

                                    if ($session_country == 'India') {
                                        $old_date_timestamp = strtotime($matchTime);
                                        $matchTime = date('j,M Y h:i A', $old_date_timestamp);
                                    } else {
                                        $old_date_timestamp = strtotime($matchTime);
                                        $old_date_timestamp = $old_date_timestamp - '19800';
                                        $matchTime = date('j,M Y h:i A', $old_date_timestamp) . ' GMT';
                                    }

                                    echo '<td align="center" valign="top" width="200px;" style="color:#504F4F;border-right: 1px solid silver;border-bottom: 1px solid silver;">
                                            <div style="width:100%;background-color:#2139EC;height:20px">
                                                <font class="font-containt-bold" style="top:0px;color:white;font-size:14px;">MATCH ' . $matchID . ' : ' . $team1 . ' Vs  ' . $team2 . '</font>
                                            </div>
                                            <br>
                                            <div>
                                                <img src="photos/teamsFlags/' . $team1 . '.jpg" alt="team1" width=55px height=35px class="fixture-min-flag"> VS <img src="photos/teamsFlags/' . $team2 . '.jpg" class="fixture-min-flag" alt="team2" width=55px height=35px><br>
                                                  <font style="font-size:11px;"><font style="font-size:12px;font-weight:bold">' . $matchTime . '</font><br>' . $Ground . ' <br>( ' . $location . ' )</font>
                                            </div>
                                            <br><br>
                                          </td>';
                                }
                                echo '</tr></table>';
                            } else {
                                echo '<div>No UPCOMING FIXTURE</div>';
                            }
                        }
                        ?>
                    </div>

                </div>
                <!--------------------------------------------------------------------------------------------->



            </div>

        </div>
        <div class="filler" style="position: absolute;width: 1000px;height: 45px;left: 176px;top: 1150px;background-color: white">
        </div>
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/jquery-ui.js"></script>
        <script type="text/javascript" src="js/make_All_page_responsive.js"></script>
        <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
        <script type="text/javascript">
            $('#selection_process').tablesorter();
            $("body").on("change", "#select_team_1,#select_type_1", function(){
            
                var item1=$('#select_team_1').val();
                var item2=$('#select_type_1').val();
                $('#selection_process_body').empty();
                for(var i=0;i<playerID.length;i++)
                {
                    var colorCode='black';
                    if(playerPlayingStatus[i]==2)
                        colorCode='red';

                    if(item1=='all' && item2=='all')
                        $('#selection_process_body').append("<tr style=color:"+colorCode+" align='center' id="+playerID[i]+"><td><img style='cursor:pointer' class='select_eleven' src='photos/right.png' height='20px' width='20px'></td><td id='"+playerStyle[i]+"'><font style='visibility: hidden'>"+playerStyle[i]+"</font><img  src='photos/style/style"+playerStyle[i]+".png'></td><td>"+playerName[i]+"</td><td>"+playerTeam[i]+"</td><td>"+playerPoints[i]+"</td><td>"+playerPrice[i]+"</td></tr>");
                    else if(item1!='all' && item2 == 'all')
                    {
                        if(item1 == playerTeam[i])
                            $('#selection_process_body').append("<tr style=color:"+colorCode+" align='center' id="+playerID[i]+"><td><img style='cursor:pointer' class='select_eleven' src='photos/right.png' height='20px' width='20px'></td><td id='"+playerStyle[i]+"'><font style='visibility: hidden'>"+playerStyle[i]+"</font><img  src='photos/style/style"+playerStyle[i]+".png'></td><td>"+playerName[i]+"</td><td>"+playerTeam[i]+"</td><td>"+playerPoints[i]+"</td><td>"+playerPrice[i]+"</td></tr>");
                    }
                    else if(item1 =='all' && item2 != 'all')
                    {
                        if(item2 == 'batsman' && (playerStyle[i] == 1 || playerStyle[i] == 2))
                            $('#selection_process_body').append("<tr style=color:"+colorCode+" align='center' id="+playerID[i]+"><td><img style='cursor:pointer' class='select_eleven' src='photos/right.png' height='20px' width='20px'></td><td id='"+playerStyle[i]+"'><font style='visibility: hidden'>"+playerStyle[i]+"</font><img  src='photos/style/style"+playerStyle[i]+".png'></td><td>"+playerName[i]+"</td><td>"+playerTeam[i]+"</td><td>"+playerPoints[i]+"</td><td>"+playerPrice[i]+"</td></tr>");
                        if(item2 == 'all-rounder' && playerStyle[i] == 4)
                            $('#selection_process_body').append("<tr style=color:"+colorCode+" align='center' id="+playerID[i]+"><td><img style='cursor:pointer' class='select_eleven' src='photos/right.png' height='20px' width='20px'></td><td id='"+playerStyle[i]+"'><font style='visibility: hidden'>"+playerStyle[i]+"</font><img  src='photos/style/style"+playerStyle[i]+".png'></td><td>"+playerName[i]+"</td><td>"+playerTeam[i]+"</td><td>"+playerPoints[i]+"</td><td>"+playerPrice[i]+"</td></tr>");
                        if(item2 == 'weeket-keeper' && (playerStyle[i] == 2 || playerStyle[i] == 3))
                            $('#selection_process_body').append("<tr style=color:"+colorCode+" align='center' id="+playerID[i]+"><td><img style='cursor:pointer' class='select_eleven' src='photos/right.png' height='20px' width='20px'></td><td id='"+playerStyle[i]+"'><font style='visibility: hidden'>"+playerStyle[i]+"</font><img  src='photos/style/style"+playerStyle[i]+".png'></td><td>"+playerName[i]+"</td><td>"+playerTeam[i]+"</td><td>"+playerPoints[i]+"</td><td>"+playerPrice[i]+"</td></tr>");
                        if(item2 == 'bowler' && playerStyle[i] == 5)
                            $('#selection_process_body').append("<tr style=color:"+colorCode+" align='center' id="+playerID[i]+"><td><img style='cursor:pointer' class='select_eleven' src='photos/right.png' height='20px' width='20px'></td><td id='"+playerStyle[i]+"'><font style='visibility: hidden'>"+playerStyle[i]+"</font><img  src='photos/style/style"+playerStyle[i]+".png'></td><td>"+playerName[i]+"</td><td>"+playerTeam[i]+"</td><td>"+playerPoints[i]+"</td><td>"+playerPrice[i]+"</td></tr>");
                    }
                    else if(item1 !='all' && item2 != 'all')
                    {
                        if((item1 == playerTeam[i]) &&    item2 == 'batsman' && (playerStyle[i] == 1 || playerStyle[i] == 2))
                            $('#selection_process_body').append("<tr style=color:"+colorCode+" align='center' id="+playerID[i]+"><td><img style='cursor:pointer' class='select_eleven' src='photos/right.png' height='20px' width='20px'></td><td id='"+playerStyle[i]+"'><font style='visibility: hidden'>"+playerStyle[i]+"</font><img  src='photos/style/style"+playerStyle[i]+".png'></td><td>"+playerName[i]+"</td><td>"+playerTeam[i]+"</td><td>"+playerPoints[i]+"</td><td>"+playerPrice[i]+"</td></tr>");
                        if((item1 == playerTeam[i]) &&  item2 == 'all-rounder' && playerStyle[i] == 4)
                            $('#selection_process_body').append("<tr style=color:"+colorCode+" align='center' id="+playerID[i]+"><td><img style='cursor:pointer' class='select_eleven' src='photos/right.png' height='20px' width='20px'></td><td id='"+playerStyle[i]+"'><font style='visibility: hidden'>"+playerStyle[i]+"</font><img  src='photos/style/style"+playerStyle[i]+".png'></td><td>"+playerName[i]+"</td><td>"+playerTeam[i]+"</td><td>"+playerPoints[i]+"</td><td>"+playerPrice[i]+"</td></tr>");
                        if((item1 == playerTeam[i]) &&  item2 == 'weeket-keeper' && (playerStyle[i] == 2 || playerStyle[i] == 3))
                            $('#selection_process_body').append("<tr style=color:"+colorCode+" align='center' id="+playerID[i]+"><td><img style='cursor:pointer' class='select_eleven' src='photos/right.png' height='20px' width='20px'></td><td id='"+playerStyle[i]+"'><font style='visibility: hidden'>"+playerStyle[i]+"</font><img  src='photos/style/style"+playerStyle[i]+".png'></td><td>"+playerName[i]+"</td><td>"+playerTeam[i]+"</td><td>"+playerPoints[i]+"</td><td>"+playerPrice[i]+"</td></tr>");
                        if((item1 == playerTeam[i]) &&  item2 == 'bowler' && playerStyle[i] == 5)
                            $('#selection_process_body').append("<tr style=color:"+colorCode+" align='center' id="+playerID[i]+"><td><img style='cursor:pointer' class='select_eleven' src='photos/right.png' height='20px' width='20px'></td><td id='"+playerStyle[i]+"'><font style='visibility: hidden'>"+playerStyle[i]+"</font><img  src='photos/style/style"+playerStyle[i]+".png'></td><td>"+playerName[i]+"</td><td>"+playerTeam[i]+"</td><td>"+playerPoints[i]+"</td><td>"+playerPrice[i]+"</td></tr>");

                    }
                }

		hidePlayer(playersIDs);
                $('#selection_process').append("</tbody>");
                $("#selection_process").trigger("update");
                var sorting = [[4,1]];
                $("#selection_process").trigger("sorton",[sorting]);
                return false;
                        
            });
        </script>

        <script type="text/javascript" src="js/manageteam.js"></script>
        <script type="text/javascript" src="js/manageteam_effects.js"></script>
        <script type="text/javascript" src="js/manageTeam-Modal.js"></script>
    </body>
</html>

<?php
include 'Footer.php';
?>