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
        <link rel="stylesheet" type="text/css" href="css/paytoplay.css">
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
            <?php
            if($resultSettoFindFirstTime = mysql_query("SELECT * from paytoplaybalance where user_email = '$session_email'")) {
                if(mysql_num_rows($resultSettoFindFirstTime) == 0) {
                    if($resultSettoFindUserID = mysql_query("SELECT user_id from users_data where user_email = '$session_email'")) {
                        $userId=mysql_result($resultSettoFindUserID, 0);
                    }
                    mysql_query("insert into paytoplaybalance values($userId,'$session_email',0,0,0)");
                }else {
                    mysql_query("UPDATE paytoplaybalance SET VisitCount = VisitCount+1 WHERE user_email = '$session_email'");
                }
            }
            ?>

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

                <?PHP
                $datetime = date("Y-m-d H:i:s");
                $s2 = 's' . $seriesId . '_pay_to_play_club';
                $sid = '';
                $matchID = '';
                $timeAndDate = '';
                $matchLive;
                if (isset($_GET['matchid']) && !empty($_GET['matchid'])) {
                    $matchID = mysql_real_escape_string(htmlentities($_GET['matchid']));
                    if ($result_to_get_MatchID = mysql_query("SELECT timeAnddate from fixture where matchID = $matchID LIMIT 1")) {
                        if (mysql_num_rows($result_to_get_MatchID) == 1) {
                            $matchTime = mysql_result($result_to_get_MatchID, 0, 0);

                            if($matchTime > $datetime)
                                $matchLive= true;
                            else {
                                $matchLive= false;
                            }
                        }

                    }
                } else {
                    if ($result_to_get_MatchID = mysql_query("SELECT matchID from fixture where timeAnddate >= '$datetime' and sid=$seriesId and ptpStatus = 'A' ORDER BY timeAnddate LIMIT 1 ")) {
                        if (mysql_num_rows($result_to_get_MatchID) == 1) {
                            $matchID = mysql_result($result_to_get_MatchID, 0, 0);
                            $matchLive= true;
                        }
                        else {
                            if ($result_to_get_MatchID = mysql_query("SELECT matchID FROM `fixture`  where sid=$seriesId and ptpStatus = 'A' ORDER BY `timeAnddate` DESC LIMIT 1")) {
                                $matchID = mysql_result($result_to_get_MatchID, 0);
                                $matchLive= false;
                            }
                        }
                    }
                }

                /*if ($result_to_get_MatchID = mysql_query("SELECT matchID from fixture where timeAnddate >= '$datetime' and sid=$seriesId and ptpStatus = 'A' ORDER BY timeAnddate LIMIT 1 ")) {
                    if (mysql_num_rows($result_to_get
                 * e;_MatchID) == 1) {
                        $currentMatch = mysql_result($result_to_get_MatchID, 0, 0);
                    }else {
                        if ($result_to_get_MatchID = mysql_query("SELECT matchID FROM `fixture`  where sid=$seriesId and ptpStatus = 'A' ORDER BY `timeAnddate`DESC LIMIT 1")) {
                            $lastMatch = mysql_result($result_to_get_MatchID, 0);
                        }
                    }
                }*/





                // to get match data...
                if($result_to_get_MatchDATA = mysql_query("SELECT timeAnddate,team1,team2 FROM `fixture`  where matchID = $matchID and sid = '$seriesId'")) {
                    $matchTime = mysql_result($result_to_get_MatchDATA, 0, 0);
                    $team1 = mysql_result($result_to_get_MatchDATA, 0, 1);
                    $team2 = mysql_result($result_to_get_MatchDATA, 0, 2);
                }

                //if daily team is made or not
                $dailyStatus = false;
                if (!empty($matchID)) {
                    if ($query_to_getDailyTeam = mysql_query("SELECT TID from daily_challenge_eleven_player where sid = $seriesId AND matchid = $matchID AND user_email = '$session_email' ")) {
                        if (mysql_num_rows($query_to_getDailyTeam) == 1)
                            $dailyStatus = true;
                    }
                }

                /*
                // if match is live or not
                $matchLive= true;
                if($matchID < $currentMatch) {
                    $matchLive= false;
                }
                if($matchID == $lastMatch) {
                    $matchLive= false;
                }
                */

                $leaguerray = array();
                if ($query_to_get_leaguecode = mysql_query("select leagueCode from $s2 where user_email='$session_email' and matchID = $matchID")) {
                    while ($leaguecodename = mysql_fetch_array($query_to_get_leaguecode)) {
                        $joinedleaguename = mysql_real_escape_string($leaguecodename['leagueCode']);
                        array_push($leaguerray, $joinedleaguename);
                    }
                    //print_r($leaguerray);
                }
                if (!$dailyStatus) {
                    $HREFString = '<a href="DailyChallenge.php?seriesId='.$seriesId.'&sid='.$seriesId.'&mid='.$matchID.'"><input type="button" value="CREATE TEAM" class="dailay-pay-button" style="position: absolute;left: 1px;top: 150px;"></a>';
                }

                if($session_country == 'India') {
                    $old_date_timestamp = strtotime($matchTime);
                    $matchTime = date('j,M h:i A', $old_date_timestamp).' IST';
                }else {
                    $old_date_timestamp = strtotime($matchTime);
                    $old_date_timestamp = $old_date_timestamp - '19800';
                    $matchTime = date('j,M h:i A', $old_date_timestamp).' GMT';
                }



                ?>

                <div>


                    <!-- START OF POPUP CODE   -->
                    <div  style="position: absolute;width: 770px;height: 120px;left: 10px;top: 0px;">
                        <table width="100%">
                            <tr>
                                <td><a href="#HowToPlay" name="modal"><input type="button" style="background-color: #437D00;cursor: pointer;color: white;" value="HOW TO PLAY" class="popup-buttons font-containt-bold box-shadow-comman"></a></td>
                                <td><a href="#HowToPay" name="modal"><input type="button" style="background-color: #E86100;cursor: pointer;color: white;" value="HOW TO PAY" class="popup-buttons font-containt-bold box-shadow-comman"></a></td>
                                <td><a href="#HowToWithdraw" name="modal"><input type="button" style="background-color: #008EDA;cursor: pointer;color: white;" value="HOW TO COLLECT MONEY" class="popup-buttons font-containt-bold box-shadow-comman"></a></td>
                            </tr>
                        </table>

                        <div id="box">
                            <!--************************   MODEL for HOW TO PLAY  **********************************-->
                            <div id="HowToPlay" class="window">
                                <br><br>
                                <div class="black-header font-containt-bold">HOW TO PLAY</div>
                                <a href="#" class="close">
                                    <img src="photos/ModelClose.png" alt="close" style="position: absolute;left:725px;top:5px;" height="20px" left="20px">
                                </a>
                                <div class="container" style="position: absolute;left:15px;top:45px;height: 500px;">
                                    To <b>PAY TO PLAY</b> simply follow the steps given below:
                                    <ol class="content-ul">
                                        <li>
                                            Make your team in QuickPlay for the match for which you wish to pay to play.
                                        </li>
                                        <li>
                                            Select the club amongst which you wish to play. There are 2 types of clubs:
                                            <ol type="a" class="content-ul">
                                                <li>
                                                    <b>50% Club </b>: In this club top 50% users amongst total number of users in the club will get 1.5 times the amount invested.
                                                </li>
                                                <li>
                                                    <b>25% Club </b>: In this club top 25% users amongst total number of users in the club will get 2 times the amount invested.
                                                </li>

                                            </ol>
                                        </li>
                                        <li>
                                            Join in the Club by clicking JOIN button below OR you can play for free and try the platform.
                                        </li>
                                        <li>
                                            You’ll be prompted to make your <b>QuickPlay</b> team if not already made.
                                        </li>
                                        <li>
                                            Selected amount’s value will be deducted from your balance if balance is sufficient. If insufficient balance, then you can add balance to your account by your preferred payment method show in <b>HOW TO PAY</b>.
                                        </li>
                                        <li>
                                            Now, you are all set to win. Good Luck!!
                                        </li>
                                        <li>
                                            How Much Money You get :
                                            <ol type="a" class="content-ul">
                                                <li> <b>In 50% Club</b> : You Get <font style="color: #B30000;font-size: 14px;font-weight: bold;"> x1.5 </font> money back (eg for paying 25 &#x20B9; you get 37 &#x20B9;)</li>
                                                <li><b>In 25% Club</b> : You Get <font style="color: #B30000;font-size: 14px;font-weight: bold;"> x2 </font> money back (eg for paying 100 &#x20B9; you get 200 &#x20B9;)</li>
                                            </ol>
                                        </li>
                                    </ol>

                                    <br><br>
                                    <div style="font-size: 12px;">
                                        <b> NOTE </b> : In 50% Club you need to be in top 50% Managers which are joined in tha Club (eg. if 500 Managers joined in Club your rank must be in top 250 Managers )
                                        <br>
                                        In 25% Club you need to be in top 25% Managers which are joined in tha Club (eg. if 500 Managers joined in Club your rank must be in top 125 Managers )
                                        <br><br>

                                        For any query please contact <b>9867565492</b> or email at <b>support@fantasycricleague.com</b>
                                    </div>
                                </div>
                            </div>


                            <!--************************   MODEL for HOW TO PAY **********************************-->
                            <div id="HowToPay" class="window">
                                <br><br>
                                <div class="black-header font-containt-bold">HOW TO PAY</div>
                                <a href="#" class="close">
                                    <img src="photos/ModelClose.png" alt="close" style="position: absolute;left:725px;top:5px;" height="20px" left="20px">
                                </a>
                                <div class="container" style="position: absolute;left:15px;top:45px;height: 450px;">
                                    You can easily pay by <font style="font-size: 14;color: #C90000;font-weight: bold;">Vodafone m-pesa </font>(recommended)

                                    <br><br>

                                    There are 2 ways 2 pay via <font style="font-size: 14;color: #C90000;font-weight: bold;">Vodafone m-pesa </font>

                                    <ol class="content-ul" type="i">
                                        <li>
                                            If you are a registered <b>m-pesa</b> user then you can directly pay by transferring any amount more then <b>&#x20B9; &nbsp; 25</b>  to <b>9820589683</b> using <b>m-pesa transfer</b> <a href="https://www.mpesa.in/portal/services/send_money.jsp" target="_blank" style="color: #0075AB;font-size: 14px;font-weight: bold"> more details</a>
                                            <br>
                                            <ul class="content-ul">
                                                <li>
                                                    <b>Step 1</b> Dial *400#
                                                </li>
                                                <li>
                                                    <b>Step 2</b> Select option 1
                                                </li>
                                                <li>
                                                    <b>Step 3</b> Select 'Send to any Mobile Number'
                                                </li>
                                                <li>
                                                    <b>Step 4</b> Select a beneficiary if already added. Else select 'Other'
                                                </li>
                                                <li>
                                                    <b>Step 5</b> Enter the recipient's mobile number <b>(9820589683)</b>
                                                </li>
                                                <li>
                                                    <b>Step 6</b> Enter the amount you wish to transfer
                                                </li>
                                                <li>
                                                    <b>Step 7</b> Enter your unique m-pesa PIN
                                                </li>
                                                <li>
                                                    <b>Step 8</b> Select 'Confirm'
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            If you are not registered <b>m-pesa</b> user you can either register
                                            <a style="color: #0075AB;font-size: 14px;font-weight: bold" target="_blank"  href="https://www.mpesa.in/portal/user/userRegistration.jsp">here</a>
                                            OR you can transfer money from the nearest agent store to mobile no <b>9820589683</b>. Find Nearest agent store
                                            <a href="https://www.mpesa.in/portal/agent/agentLocator.jsp" target="_blank" style="color: #0075AB;font-size: 14px;font-weight: bold">here</a>
                                            <br>
                                            <ul class="content-ul">
                                                <li>
                                                    <b>Step 1</b> Visit your nearest Vodafone m-pesa agent store.
                                                </li>
                                                <li>
                                                    <b>Step 2</b> Make a transaction to Mobile Number <b>(9820589683)</b>
                                                </li>
                                                <li>
                                                    <b>Step 3</b> Note the TRANSACRTION NO from agent
                                                </li>
                                                <li>
                                                    <b>Step 4</b> Enter TRANSACRTION NO in MyAccount section
                                                </li>
                                            </ul>

                                        </li>
                                    </ol>
                                    <br>
                                    After you made transaction to above mention mobile number (9820567890) you have to enter TRANSACRTION NO in
                                    <a href="AccountSetting.php" target="_blank" style="color: #0075AB;font-size: 14px;font-weight: bold">MyAccount</a>
                                    section which is generated while doing transaction. <br>

                                    <br>
                                    In either case you have to submit the TRANSACRTION NO of the m-pesa money transfer you made. <br>
                                    <b>NOTE : In case of store transfer don’t forget to take the TRANSACRTION NO from the store agent. </b>

                                    <br> <br>
                                    Once, submitted your TRANSACRTION NO will be verified (this might take some time)
                                    and the respective amount will be added to your balance in
                                    <a href="AccountSetting.php" target="_blank" style="color: #0075AB;font-size: 14px;font-weight: bold">MyAccount</a>
                                    PAY TO PLAY Section. You can use this balance to join any club in PayToPlay section.
                                    <div align="center">
                                        <img src="photos/paytoplay/transcartionNo.jpg">
                                    </div>
                                    For any query please contact <b>9867565492</b> or email at <b>support@fantasycricleague.com</b>
                                </div>
                            </div>

                            <!--************************   MODEL for HOW TO WITHDRAW  **********************************-->
                            <div id="HowToWithdraw" class="window">
                                <br><br>
                                <div class="black-header font-containt-bold">HOW TO COLLECT MONEY</div>
                                <a href="#" class="close">
                                    <img src="photos/ModelClose.png" alt="close" style="position: absolute;left:725px;top:5px;" height="20px" left="20px">
                                </a>
                                <div class="container" style="position: absolute;left:15px;top:45px;height: 450px;">
                                    <ol class="content-ul">
                                        <li>
                                            Go to <a href="AccountSetting.php" target="_blank" style="color: #0075AB;font-size: 14px;font-weight: bold">MyAccount</a> section, enter the amount you wish to withdraw.
                                        </li>
                                        <li>
                                            You will be asked to enter the <b>mobile no</b> on which you wish to receive payment info. Kindly check your entered mobile no, as transaction once proceeded from here cannot be undone.
                                        </li>
                                        <li>
                                            Your withdraw request will be processed and further process will go on, this might take upto 1-2 working days.
                                        </li>
                                        <li>
                                            Payment will be done and you will receive a message containing transaction details on your entered mobile no.
                                        </li>
                                        <li>
                                            You can then use this message to withdraw your respective amount from any m-pesa agent store. You can find your nearest m-pesa agent store
                                            <a href="https://www.mpesa.in/portal/agent/agentLocator.jsp" target="_blank" style="color: #0075AB;font-size: 14px;font-weight: bold">here</a>.
                                        </li>
                                    </ol>

                                    <br><br>
                                    <b>
                                        NOTE :
                                        <ul class="content-ul">
                                            <li>
                                                If you are m-pase user then amount will be added to your m-pase account.
                                            </li>
                                            <li>
                                                If you are not m-pase user then use message you received to withdraw your respective amount from any m-pesa agent store.
                                            </li>
                                            <li>
                                                Any Mobile service provider user can withdraw money.
                                            </li>
                                        </ul>
                                    </b>
                                    <br><br>
                                    For any query please contact <b>9867565492</b> or email at <b>support@fantasycricleague.com</b>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END OF POPUP CODE   -->

                    <div class="fixture-div-item-container" style="position: absolute;width: 760px;height: 30px;left: 10px;top: 120px;height: 110px;">
                        <table width=100% height=110px style="text-shadow:1px 1px 1px #504848;padding-left:10px;color:white;background-image:url(photos/fixturebg.jpg)">
                            <tr>
                                <td align="center"><img class="fixture-images" src="photos/teamsFlags/<?php echo $team1.'.';?>jpg" alt="$team1" width="120px" height="85px"></td>
                                <td align="center"><?php echo 'Match : '.$matchID; ?><br><?php echo '<b>'.$team1.' VS '.$team2.'</b>' ; ?><br><?php echo $matchTime; ?></td>
                                <td align="center"><img class="fixture-images" src="photos/teamsFlags/<?php echo $team2.'.';?>jpg" alt="team2" width="120px" height="85px"></td>
                            </tr>

                        </table>
                    </div>


                    <div class="fixture-div-item-container font-containt-bold" style="position: absolute;width: 760px;height: 70px;left: 10px;top: 250px;">
                        <img src="photos/paytoplay/PTPBanner1.jpg" width="100%" height="100%">
                    </div>




                    <div  style="position: absolute;width: 770px;height: 185px;left: 10px;top: 330px;">
                        <div style="position: absolute;width: 185px;height: 185px;left: 0px;top: 0px;">
                            <img class="box-shadow-comman" width="175px" height="175px" src="photos/paytoplay/Pay0_0.png">
                            <?php
                            if($matchLive) {
                                if (!$dailyStatus) {
                                    echo $HREFString;
                                }else {
                                    //$pos = strrpos($leaguerray, "50PFREE");
                                    if (in_array("50PFREE", $leaguerray)) {
                                        echo '<a href="paytoplayLeaderboard.php?seriesId='.$seriesId.'&sid='.$seriesId.'&mid='.$matchID.'&&code=50PFREE"><input type="button" value="LEADERBOARD" class="leaderboard-pay-button" style="position: absolute;left: 1px;top: 150px;"></a>';
                                    }else {
                                        echo '<input type="button" value="JOIN" id="join-pay-button" class="joinCLUB" name="'.$matchID.'" code="50PFREE" pay="0" style="position: absolute;left: 1px;top: 150px;">';
                                    }
                                }
                            }
                            else {
                                if (in_array("50PFREE", $leaguerray)) {
                                    echo '<a href="paytoplayLeaderboard.php?seriesId='.$seriesId.'&sid='.$seriesId.'&mid='.$matchID.'&&code=50PFREE"><input type="button" value="LEADERBOARD" class="leaderboard-pay-button" style="position: absolute;left: 1px;top: 150px;"></a>';
                                }else {
                                    echo '<a href="paytoplayLeaderboard.php?seriesId='.$seriesId.'&sid='.$seriesId.'&mid='.$matchID.'&&code=50PFREE"><input type="button" value="LEADERBOARD" id="join-pay-button" style="position: absolute;left: 1px;top: 150px;"></a>';
                                }
                            }
                            ?>
                        </div>

                        <div style="position: absolute;width: 185px;height: 185px;left: 195px;top: 0px;">
                            <img class="box-shadow-comman" width="175px" height="175px" src="photos/paytoplay/Pay25_37.png">
                            <?php
                            if($matchLive) {
                                if (!$dailyStatus) {
                                    echo $HREFString;
                                }else {
                                    //$pos = strrpos($leaguerray, "50PFREE");
                                    if (in_array("50P25R", $leaguerray)) {
                                        echo '<a href="paytoplayLeaderboard.php?seriesId='.$seriesId.'&sid='.$seriesId.'&mid='.$matchID.'&&code=50P25R"><input type="button" value="LEADERBOARD" class="leaderboard-pay-button" style="position: absolute;left: 1px;top: 150px;"></a>';
                                    }else {
                                        echo '<input type="button" value="JOIN" id="join-pay-button" class="joinCLUB" name="'.$matchID.'" code="50P25R" pay="25" style="position: absolute;left: 1px;top: 150px;">';
                                    }
                                }
                            }
                            else {
                                if (in_array("50P25R", $leaguerray)) {
                                    echo '<a href="paytoplayLeaderboard.php?seriesId='.$seriesId.'&sid='.$seriesId.'&mid='.$matchID.'&&code=50P25R"><input type="button" value="LEADERBOARD" class="leaderboard-pay-button" style="position: absolute;left: 1px;top: 150px;"></a>';
                                }else {
                                    echo '<a href="paytoplayLeaderboard.php?seriesId='.$seriesId.'&sid='.$seriesId.'&mid='.$matchID.'&&code=50P25R"><input type="button" value="LEADERBOARD" id="join-pay-button" style="position: absolute;left: 1px;top: 150px;"></a>';
                                }
                            }
                            ?>
                        </div>

                        <div style="position: absolute;width: 185px;height: 185px;left: 390px;top: 0px;">
                            <img class="box-shadow-comman" width="175px" height="175px" src="photos/paytoplay/Pay100_150.png">
                            <?php
                            if($matchLive) {
                                if (!$dailyStatus) {
                                    echo $HREFString;
                                }else {
                                    //$pos = strrpos($leaguerray, "50P100R");
                                    if (in_array("50P100R", $leaguerray)) {
                                        echo '<a href="paytoplayLeaderboard.php?seriesId='.$seriesId.'&sid='.$seriesId.'&mid='.$matchID.'&&code=50P100R"><input type="button" value="LEADERBOARD" class="leaderboard-pay-button" style="position: absolute;left: 1px;top: 150px;"></a>';
                                    }else {
                                        echo '<input type="button" value="JOIN" id="join-pay-button" class="joinCLUB" name="'.$matchID.'" code="50P100R" pay="100" style="position: absolute;left: 1px;top: 150px;">';
                                    }
                                }
                            }else {
                                if (in_array("50P100R", $leaguerray)) {
                                    echo '<a href="paytoplayLeaderboard.php?seriesId='.$seriesId.'&sid='.$seriesId.'&mid='.$matchID.'&&code=50P100R"><input type="button" value="LEADERBOARD" class="leaderboard-pay-button" style="position: absolute;left: 1px;top: 150px;"></a>';
                                }else {
                                    echo '<a href="paytoplayLeaderboard.php?seriesId='.$seriesId.'&sid='.$seriesId.'&mid='.$matchID.'&&code=50P100R"><input type="button" value="LEADERBOARD" id="join-pay-button" style="position: absolute;left: 1px;top: 150px;"></a>';
                                }
                            }
                            ?>
                        </div>

                        <div style="position: absolute;width: 185px;height: 185px;left: 585px;top: 0px;">
                            <img class="box-shadow-comman" width="175px" height="175px" src="photos/paytoplay/Pay250_375.png">
                            <?php
                            if($matchLive) {
                                if (!$dailyStatus) {
                                    echo $HREFString;
                                }else {
                                    //$pos = strrpos($leaguerray, "50P100R");
                                    if (in_array("50P250R", $leaguerray)) {
                                        echo '<a href="paytoplayLeaderboard.php?seriesId='.$seriesId.'&sid='.$seriesId.'&mid='.$matchID.'&&code=50P250R"><input type="button" value="LEADERBOARD" class="leaderboard-pay-button" style="position: absolute;left: 1px;top: 150px;"></a>';
                                    }else {
                                        echo '<input type="button" value="JOIN" id="join-pay-button" class="joinCLUB" name="'.$matchID.'" code="50P250R" pay="250" style="position: absolute;left: 1px;top: 150px;">';
                                    }
                                }
                            }else {
                                if (in_array("50P250R", $leaguerray)) {
                                    echo '<a href="paytoplayLeaderboard.php?seriesId='.$seriesId.'&sid='.$seriesId.'&mid='.$matchID.'&&code=50P250R"><input type="button" value="LEADERBOARD" class="leaderboard-pay-button" style="position: absolute;left: 1px;top: 150px;"></a>';
                                }else {
                                    echo '<a href="paytoplayLeaderboard.php?seriesId='.$seriesId.'&sid='.$seriesId.'&mid='.$matchID.'&&code=50P250R"><input type="button" value="LEADERBOARD" id="join-pay-button" style="position: absolute;left: 1px;top: 150px;"></a>';
                                }
                            }
                            ?>
                        </div>
                    </div>


                    <hr style="color: black;position: absolute;top: 530px;left: 0px;width: 770px;">


                    <div class="fixture-div-item-container font-containt-bold" style="position: absolute;width: 760px;height: 70px;left: 10px;top: 550px;">
                        <img src="photos/paytoplay/PTPBanner2.jpg" width="100%" height="100%">
                    </div>


                    <div  style="position: absolute;width: 770px;height: 185px;left: 10px;top: 630px;">
                        <div style="position: absolute;width: 185px;height: 185px;left: 0px;top: 0px;">
                            <img class="box-shadow-comman" width="175px" height="175px" src="photos/paytoplay/Pay0_0.png">
                            <?php
                            if($matchLive) {
                                if (!$dailyStatus) {
                                    echo $HREFString;
                                }else {
                                    //$pos = strrpos($leaguerray, "50P100R");
                                    if (in_array("25PFREE", $leaguerray)) {
                                        echo '<a href="paytoplayLeaderboard.php?seriesId='.$seriesId.'&sid='.$seriesId.'&mid='.$matchID.'&&code=25PFREE"><input type="button" value="LEADERBOARD" class="leaderboard-pay-button" style="position: absolute;left: 1px;top: 150px;"></a>';
                                    }else {
                                        echo '<input type="button" value="JOIN" id="join-pay-button" class="joinCLUB" name="'.$matchID.'" code="25PFREE" pay="0" style="position: absolute;left: 1px;top: 150px;">';
                                    }
                                }
                            }else {
                                if (in_array("25PFREE", $leaguerray)) {
                                    echo '<a href="paytoplayLeaderboard.php?seriesId='.$seriesId.'&sid='.$seriesId.'&mid='.$matchID.'&&code=25PFREE"><input type="button" value="LEADERBOARD" class="leaderboard-pay-button" style="position: absolute;left: 1px;top: 150px;"></a>';
                                }else {
                                    echo '<a href="paytoplayLeaderboard.php?seriesId='.$seriesId.'&sid='.$seriesId.'&mid='.$matchID.'&&code=25PFREE"><input type="button" value="LEADERBOARD" id="join-pay-button" style="position: absolute;left: 1px;top: 150px;"></a>';
                                }
                            }
                            ?>
                        </div>

                        <div style="position: absolute;width: 185px;height: 185px;left: 195px;top: 0px;">
                            <img class="box-shadow-comman" width="175px" height="175px" src="photos/paytoplay/Pay25_50.png">
                            <?php
                            if($matchLive) {
                                if (!$dailyStatus) {
                                    echo $HREFString;
                                }else {
                                    //$pos = strrpos($leaguerray, "50P100R");
                                    if (in_array("25P25R", $leaguerray)) {
                                        echo '<a href="paytoplayLeaderboard.php?seriesId='.$seriesId.'&sid='.$seriesId.'&mid='.$matchID.'&&code=25P25R"><input type="button" value="LEADERBOARD" class="leaderboard-pay-button" style="position: absolute;left: 1px;top: 150px;"></a>';
                                    }else {
                                        echo '<input type="button" value="JOIN" id="join-pay-button" class="joinCLUB" name="'.$matchID.'" code="25P25R" pay="25" style="position: absolute;left: 1px;top: 150px;">';
                                    }
                                }
                            }else {
                                if (in_array("25P25R", $leaguerray)) {
                                    echo '<a href="paytoplayLeaderboard.php?seriesId='.$seriesId.'&sid='.$seriesId.'&mid='.$matchID.'&&code=25P25R"><input type="button" value="LEADERBOARD" class="leaderboard-pay-button" style="position: absolute;left: 1px;top: 150px;"></a>';
                                }else {
                                    echo '<a href="paytoplayLeaderboard.php?seriesId='.$seriesId.'&sid='.$seriesId.'&mid='.$matchID.'&&code=25P25R"><input type="button" value="LEADERBOARD" id="join-pay-button" style="position: absolute;left: 1px;top: 150px;"></a>';
                                }
                            }
                            ?>
                        </div>

                        <div style="position: absolute;width: 185px;height: 185px;left: 390px;top: 0px;">
                            <img class="box-shadow-comman" width="175px" height="175px" src="photos/paytoplay/Pay100_200.png">
                            <?php
                            if($matchLive) {
                                if (!$dailyStatus) {
                                    echo $HREFString;
                                }else {
                                    //$pos = strrpos($leaguerray, "50P100R");
                                    if (in_array("25P100R", $leaguerray)) {
                                        echo '<a href="paytoplayLeaderboard.php?seriesId='.$seriesId.'&sid='.$seriesId.'&mid='.$matchID.'&&code=25P100R"><input type="button" value="LEADERBOARD" class="leaderboard-pay-button" style="position: absolute;left: 1px;top: 150px;"></a>';
                                    }else {
                                        echo '<input type="button" value="JOIN" id="join-pay-button" class="joinCLUB" name="'.$matchID.'" code="25P100R" pay="100" style="position: absolute;left: 1px;top: 150px;">';
                                    }
                                }
                            }else {
                                if (in_array("25P100R", $leaguerray)) {
                                    echo '<a href="paytoplayLeaderboard.php?seriesId='.$seriesId.'&sid='.$seriesId.'&mid='.$matchID.'&&code=25P100R"><input type="button" value="LEADERBOARD" class="leaderboard-pay-button" style="position: absolute;left: 1px;top: 150px;"></a>';
                                }else {
                                    echo '<a href="paytoplayLeaderboard.php?seriesId='.$seriesId.'&sid='.$seriesId.'&mid='.$matchID.'&&code=25P100R"><input type="button" value="LEADERBOARD" id="join-pay-button" style="position: absolute;left: 1px;top: 150px;"></a>';
                                }
                            }
                            ?>
                        </div>

                        <div style="position: absolute;width: 185px;height: 185px;left: 585px;top: 0px;">
                            <img class="box-shadow-comman" width="175px" height="175px" src="photos/paytoplay/Pay250_500.png">
                            <?php
                            if($matchLive) {
                                if (!$dailyStatus) {
                                    echo $HREFString;
                                }else {
                                    //$pos = strrpos($leaguerray, "50P100R");
                                    if (in_array("25P250R", $leaguerray)) {
                                        echo '<a href="paytoplayLeaderboard.php?seriesId='.$seriesId.'&sid='.$seriesId.'&mid='.$matchID.'&&code=25P250R"><input type="button" value="LEADERBOARD" class="leaderboard-pay-button" style="position: absolute;left: 1px;top: 150px;"></a>';
                                    }else {
                                        echo '<input type="button" value="JOIN" id="join-pay-button" class="joinCLUB" name="'.$matchID.'" code="25P250R" pay="250" style="position: absolute;left: 1px;top: 150px;">';
                                    }
                                }
                            }else {
                                if (in_array("25P250R", $leaguerray)) {
                                    echo '<a href="paytoplayLeaderboard.php?seriesId='.$seriesId.'&sid='.$seriesId.'&mid='.$matchID.'&&code=25P250R"><input type="button" value="LEADERBOARD" class="leaderboard-pay-button" style="position: absolute;left: 1px;top: 150px;"></a>';
                                }else {
                                    echo '<a href="paytoplayLeaderboard.php?seriesId='.$seriesId.'&sid='.$seriesId.'&mid='.$matchID.'&&code=25P250R"><input type="button" value="LEADERBOARD" id="join-pay-button" style="position: absolute;left: 1px;top: 150px;"></a>';
                                }
                            }
                            ?>
                        </div>
                    </div>


                </div>


                <div class="font-containt box-shadow-comman" style="position: absolute;width: 200px;height: 170px;left: 790px;top: 0px;">
                    <div class="black-header font-containt-bold">
                        USER INFORMATION
                    </div>
                    <?php
                    include 'PHP/includes/userData.php';
                    ?>
                </div>

                <div class="box-shadow-comman font-containt"  style="position: absolute;width: 200px;height: 520px;left: 790px;top: 180px;">
                    <div class="black-header font-containt-bold" >
                        Navigation
                    </div>
                    <div class="fixture-div" style="position: absolute;width: 200px;height: 500px;overflow: auto;">
                        <?php
                        if (@$resultSet_to_get_ACTIVE_PTP = mysql_query("SELECT * from fixture where ptpStatus = 'A' and sid = '$seriesId' ")) {
                            if (mysql_num_rows($resultSet_to_get_ACTIVE_PTP) > 0) {

                                echo '<table class="nav-fixture-table font-containt" width="100%"><tr style="font-weight:bold;font-size:16px;"><td>#</td><td>Match</td></tr>';
                                while ($row = mysql_fetch_array($resultSet_to_get_ACTIVE_PTP)) {
                                    $matchID1 = mysql_real_escape_string($row['matchID']);
                                    $team1 = mysql_real_escape_string($row['team1']);
                                    $team2 = mysql_real_escape_string($row['team2']);

                                    if($matchID == $matchID1) {
                                        echo "<tr class='href-tr' id='current-tr' href='paytoplay.php?seriesId=$seriesId&&matchid=$matchID1' style='background-color:#E86100;font-weight:bold;color:black'>";
                                        echo "<td>$matchID1</td><td>$team1 vs $team2</td>";
                                        echo '</tr>';
                                    }else {
                                        echo "<tr class='href-tr' href='paytoplay.php?seriesId=$seriesId&&matchid=$matchID1'>";
                                        echo "<td>$matchID1</td><td>$team1 vs $team2</td>";
                                        echo '</tr>';
                                    }
                                }
                                echo '</table>';
                            } else {
                                echo '<center><font style="font-size:12px;color:#5C5C5C">NO UPCOMING PAY TO PLAY MATCH</font></center>';
                            }
                        }
                        ?>
                    </div>
                </div>

                <!--Conformation Dailog BOX -->
                <div id="dialog-confirm" title="JOIN THIS CLUB">
                    <p class="daillog-text" style="height: 250px;"></p>
                </div>
                <!--Conformation Dailog BOX -->


            </div>



        </div>
        <div class="filler" style="position: absolute;width: 1000px;height: 45px;left: 176px;top: 1150px;background-color: white">
        </div>
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/jquery-ui.js"></script>
        <script type="text/javascript" src="js/make_All_page_responsive.js"></script>
        <script type="text/javascript" src="js/paytoplay.js"></script>

    </body>
</html>

<?php
include 'Footer.php';
?>