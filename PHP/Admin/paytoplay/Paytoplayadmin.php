<?php

include '../../includes/database_connectivity_includes.php';
@session_start();
if (isset($_SESSION['setadminpassword']) && isset($_SESSION['setdatabasepassword'])) {
    ?>
<html>
    <head>

    </head>
    <body>
        <div>
                <?php

                if(isset($_POST['sid'])&&isset($_POST['mid'])) {
                    if(!empty($_POST['sid'])&&!empty($_POST['mid'])) {
                        $seriesid=mysql_real_escape_string(htmlentities($_POST['sid']));
                        $matchid=mysql_real_escape_string(htmlentities($_POST['mid']));

                        if($result=mysql_query("SELECT updateStatus from fixture where matchID = $matchid and sid=$seriesid")) {
                            $usdateStatus = mysql_result($result, 0);
                        }

                        if($usdateStatus == 'YES') {

                            echo '<h1>CLUB FOR 25 PERCENT</h1>';
                            //LeagueCode======= PERCENT=25P250R
                            $s2 = 's' . $seriesid . '_pay_to_play_club';
                            if($dailyquery=  mysql_query("SELECT s.winStatus , d.user_email , d.daily_point
                                    FROM daily_challenge_eleven_player d
                                    inner join $s2 s on s.user_email=d.user_email
                                    WHERE s.leagueCode = '25P250R' and s.matchID = $matchid and d.matchid = $matchid
                                    ORDER BY d.daily_point DESC,d.last_modified")) {

                                $length = mysql_num_rows($dailyquery);  //4
                                $toRun=round($length/4);
                                echo '<h1>LeagueCode 25P250R</h1>';
                                echo 'Total User in League 25P250R is='.$length.'<br>';
                                echo  'Winner of LeagueCode = 25P250R and Length of winner is='.$toRun.'<br>';
                                $i=0;
                                echo '<table border="1px">';
                                echo '<th>Email</th><th>Point</th><th>WinnerStatus</th><th>OldBalance</th>';
                                while ($rowdaily = mysql_fetch_array($dailyquery)   ) {
                                    $point=mysql_real_escape_string($rowdaily['daily_point']);
                                    $emailuser=mysql_real_escape_string($rowdaily['user_email']);
                                    $winnerstatus=mysql_real_escape_string($rowdaily['winStatus']);

                                    echo '<tr><td>'.$emailuser.'</td><td>'.$point.'</td><td>'.$winnerstatus.'</td>';


                                    if($winnerstatus == 'N' && $i<$toRun) {
                                        $query="SELECT user_balance FROM paytoplaybalance WHERE user_email = '$emailuser'";
                                        if($resutSet_to_find_balance=mysql_query($query)) {
                                            $balance = mysql_result($resutSet_to_find_balance, 0, 0);
                                            echo '<td>'.$balance.'</td></tr>';
                                        }else {
                                            echo 'balance not found';
                                        }

                                        if (mysql_query("Update paytoplaybalance SET user_balance=user_balance+500 where user_email='$emailuser'") &&
                                                mysql_query("update $s2 SET winStatus = 'Y' where user_email='$emailuser' and leagueCode='25P250R' and matchID=$matchid")) {
                                            $datetime=date("Y-m-d H:i:s");
                                            $query = "INSERT INTO depositehistory(TID,user_email,Amount,status,TimeAndDate,transacrtionID,oldBalance,newBalance) VALUES ('','$emailuser',500,'A','$datetime','won in Club',$balance,$balance+500)";
                                            if(mysql_query($query)) {
                                                echo '<h3>data successfully entered</h3>';
                                            }else {
                                                echo 'cant insert in deposite acc';
                                            }
                                        }else {
                                            echo 'cant uodated user balance and status';
                                        }

                                    }else {
                                        if($winnerstatus == 'Y') {
                                            echo 'Prize already added';
                                        }
                                    }
                                    $i++;
                                }
                                echo '</table>';
                            }else {
                                echo 'Main Query no run';
                            }



                            echo '<br><br><br>';




                            //League Code is 25P100R
                            if($dailyquery=  mysql_query("SELECT s.winStatus , d.user_email , d.daily_point
                                    FROM daily_challenge_eleven_player d
                                    inner join $s2 s on s.user_email=d.user_email
                                    WHERE s.leagueCode = '25P100R' and s.matchID = $matchid and d.matchid = $matchid
                                    ORDER BY d.daily_point DESC,d.last_modified")) {

                                $length = mysql_num_rows($dailyquery);  //4
                                $toRun=round($length/4);
                                echo '<h1>LeagueCode 25P100R</h1>';
                                echo 'Total User in League 25P100R is='.$length.'<br>';
                                echo  'Winner of LeagueCode = 25P100R and Length of winner is='.$toRun.'<br>';
                                $i=0;
                                echo '<table border="1px">';
                                echo '<th>Email</th><th>Point</th><th>WinnerStatus</th><th>OldBalance</th>';
                                while ($rowdaily = mysql_fetch_array($dailyquery)   ) {
                                    $point=mysql_real_escape_string($rowdaily['daily_point']);
                                    $emailuser=mysql_real_escape_string($rowdaily['user_email']);
                                    $winnerstatus=mysql_real_escape_string($rowdaily['winStatus']);

                                    echo '<tr><td>'.$emailuser.'</td><td>'.$point.'</td><td>'.$winnerstatus.'</td>';


                                    if($winnerstatus == 'N' && $i<$toRun) {
                                        $query="SELECT user_balance FROM paytoplaybalance WHERE user_email = '$emailuser'";
                                        if($resutSet_to_find_balance=mysql_query($query)) {
                                            $balance = mysql_result($resutSet_to_find_balance, 0, 0);
                                            echo '<td>'.$balance.'</td></tr>';
                                        }else {
                                            echo 'balance not found';
                                        }

                                        if (mysql_query("Update paytoplaybalance SET user_balance=user_balance+200 where user_email='$emailuser'") &&
                                                mysql_query("update $s2 SET winStatus = 'Y' where user_email='$emailuser' and leagueCode='25P100R' and matchID=$matchid")) {
                                            $datetime=date("Y-m-d H:i:s");
                                            $query = "INSERT INTO depositehistory(TID,user_email,Amount,status,TimeAndDate,transacrtionID,oldBalance,newBalance) VALUES ('','$emailuser',200,'A','$datetime','won in Club',$balance,$balance+200)";
                                            if(mysql_query($query)) {
                                                echo '<h3>data successfully entered</h3>';
                                            }else {
                                                echo 'cant insert in deposite acc';
                                            }
                                        }else {
                                            echo 'cant uodated user balance and status';
                                        }

                                    }else {
                                        if($winnerstatus == 'Y') {
                                            echo 'Prize already aded';
                                        }
                                    }
                                    $i++;
                                }
                                echo '</table>';
                            }else {
                                echo 'Main Query no run';
                            }





                            echo '<br><br><br>';




                            //League Code is 25P25R
                            if($dailyquery=  mysql_query("SELECT s.winStatus , d.user_email , d.daily_point
                                    FROM daily_challenge_eleven_player d
                                    inner join $s2 s on s.user_email=d.user_email
                                    WHERE s.leagueCode = '25P25R' and s.matchID = $matchid and d.matchid = $matchid
                                    ORDER BY d.daily_point DESC,d.last_modified")) {

                                $length = mysql_num_rows($dailyquery);  //4
                                $toRun=round($length/4);
                                echo '<h1>LeagueCode 25P25R</h1>';
                                echo 'Total User in League 25P25R is='.$length.'<br>';
                                echo  'Winner of LeagueCode = 25P25R and Length of winner is='.$toRun.'<br>';
                                $i=0;
                                echo '<table border="1px">';
                                echo '<th>Email</th><th>Point</th><th>WinnerStatus</th><th>OldBalance</th>';
                                while ($rowdaily = mysql_fetch_array($dailyquery)   ) {
                                    $point=mysql_real_escape_string($rowdaily['daily_point']);
                                    $emailuser=mysql_real_escape_string($rowdaily['user_email']);
                                    $winnerstatus=mysql_real_escape_string($rowdaily['winStatus']);

                                    echo '<tr><td>'.$emailuser.'</td><td>'.$point.'</td><td>'.$winnerstatus.'</td>';


                                    if($winnerstatus == 'N' && $i<$toRun) {
                                        $query="SELECT user_balance FROM paytoplaybalance WHERE user_email = '$emailuser'";
                                        if($resutSet_to_find_balance=mysql_query($query)) {
                                            $balance = mysql_result($resutSet_to_find_balance, 0, 0);
                                            echo '<td>'.$balance.'</td></tr>';
                                        }else {
                                            echo 'balance not found';
                                        }

                                        if (mysql_query("Update paytoplaybalance SET user_balance=user_balance+50 where user_email='$emailuser'") &&
                                                mysql_query("update $s2 SET winStatus = 'Y' where user_email='$emailuser' and leagueCode='25P25R' and matchID=$matchid")) {
                                            $datetime=date("Y-m-d H:i:s");
                                            $query = "INSERT INTO depositehistory(TID,user_email,Amount,status,TimeAndDate,transacrtionID,oldBalance,newBalance) VALUES ('','$emailuser',50,'A','$datetime','won in Club',$balance,$balance+50)";
                                            if(mysql_query($query)) {
                                                echo '<h3>data successfully entered</h3>';
                                            }else {
                                                echo 'cant insert in deposite acc';
                                            }
                                        }else {
                                            echo 'cant uodated user balance and status';
                                        }

                                    }else {
                                        if($winnerstatus == 'Y') {
                                            echo 'Prize already aded';
                                        }
                                    }
                                    $i++;
                                }
                                echo '</table>';
                            }else {
                                echo 'Main Query no run';
                            }




                            echo '<br><br><br>';




                            //League Code is 25PFREE
                            if($dailyquery=  mysql_query("SELECT s.winStatus , d.user_email , d.daily_point
                                    FROM daily_challenge_eleven_player d
                                    inner join $s2 s on s.user_email=d.user_email
                                    WHERE s.leagueCode = '25PFREE' and s.matchID = $matchid and d.matchid = $matchid
                                    ORDER BY d.daily_point DESC,d.last_modified")) {

                                $length = mysql_num_rows($dailyquery);  //4
                                $toRun=round($length/4);
                                echo '<h1>LeagueCode 25PFREE</h1>';
                                echo 'Total User in League 25PFREE is='.$length.'<br>';
                                echo  'Winner of LeagueCode = 25PFREE and Length of winner is='.$toRun.'<br>';
                                $i=0;
                                echo '<table border="1px">';
                                echo '<th>Email</th><th>Point</th><th>WinnerStatus</th><th>OldBalance</th>';
                                while ($rowdaily = mysql_fetch_array($dailyquery)   ) {
                                    $point=mysql_real_escape_string($rowdaily['daily_point']);
                                    $emailuser=mysql_real_escape_string($rowdaily['user_email']);
                                    $winnerstatus=mysql_real_escape_string($rowdaily['winStatus']);

                                    echo '<tr><td>'.$emailuser.'</td><td>'.$point.'</td><td>'.$winnerstatus.'</td>';


                                    if($winnerstatus == 'N' && $i<$toRun) {
                                        $query="SELECT user_balance FROM paytoplaybalance WHERE user_email = '$emailuser'";
                                        if($resutSet_to_find_balance=mysql_query($query)) {
                                            $balance = mysql_result($resutSet_to_find_balance, 0, 0);
                                            echo '<td>'.$balance.'</td></tr>';
                                        }else {
                                            echo 'balance not found';
                                        }

                                        if (mysql_query("update $s2 SET winStatus = 'Y' where user_email='$emailuser' and leagueCode='25PFREE' and matchID=$matchid")) {
                                            echo '<h3>data successfully entered</h3>';
                                        }else {
                                            echo 'cant uodated user balance and status';
                                        }

                                    }else {
                                        if($winnerstatus == 'Y') {
                                            echo 'Prize already aded';
                                        }
                                    }
                                    $i++;
                                }
                                echo '</table>';
                            }else {
                                echo 'Main Query no run';
                            }




                            echo '<br><br><br>';


                            echo '<h1>CLUB FOR 50 PERCENT</h1>';

                            //League Code is 50P250R
                            if($dailyquery=  mysql_query("SELECT s.winStatus , d.user_email , d.daily_point
                                    FROM daily_challenge_eleven_player d
                                    inner join $s2 s on s.user_email=d.user_email
                                    WHERE s.leagueCode = '50P250R' and s.matchID = $matchid and d.matchid = $matchid
                                    ORDER BY d.daily_point DESC,d.last_modified")) {

                                $length = mysql_num_rows($dailyquery);  //4
                                $toRun=round($length/2);
                                echo '<h1>LeagueCode 50P250R</h1>';
                                echo 'Total User in League 50P250R is='.$length.'<br>';
                                echo  'Winner of LeagueCode = 50P250R and Length of winner is='.$toRun.'<br>';
                                $i=0;
                                echo '<table border="1px">';
                                echo '<th>Email</th><th>Point</th><th>WinnerStatus</th><th>OldBalance</th>';
                                while ($rowdaily = mysql_fetch_array($dailyquery)   ) {
                                    $point=mysql_real_escape_string($rowdaily['daily_point']);
                                    $emailuser=mysql_real_escape_string($rowdaily['user_email']);
                                    $winnerstatus=mysql_real_escape_string($rowdaily['winStatus']);

                                    echo '<tr><td>'.$emailuser.'</td><td>'.$point.'</td><td>'.$winnerstatus.'</td>';


                                    if($winnerstatus == 'N' && $i<$toRun) {
                                        $query="SELECT user_balance FROM paytoplaybalance WHERE user_email = '$emailuser'";
                                        if($resutSet_to_find_balance=mysql_query($query)) {
                                            $balance = mysql_result($resutSet_to_find_balance, 0, 0);
                                            echo '<td>'.$balance.'</td></tr>';
                                        }else {
                                            echo 'balance not found';
                                        }

                                        if (mysql_query("Update paytoplaybalance SET user_balance=user_balance+375 where user_email='$emailuser'") &&
                                                mysql_query("update $s2 SET winStatus = 'Y' where user_email='$emailuser' and leagueCode='50P250R' and matchID=$matchid")) {
                                            $datetime=date("Y-m-d H:i:s");
                                            $query = "INSERT INTO depositehistory(TID,user_email,Amount,status,TimeAndDate,transacrtionID,oldBalance,newBalance) VALUES ('','$emailuser',375,'A','$datetime','won in Club',$balance,$balance+375)";
                                            if(mysql_query($query)) {
                                                echo '<h3>data successfully entered</h3>';
                                            }else {
                                                echo 'cant insert in deposite acc';
                                            }
                                        }else {
                                            echo 'cant uodated user balance and status';
                                        }

                                    }else {
                                        if($winnerstatus == 'Y') {
                                            echo 'Prize already aded';
                                        }
                                    }
                                    $i++;
                                }
                                echo '</table>';
                            }else {
                                echo 'Main Query no run';
                            }


                            echo '<br><br><br>';

                            //League Code is 50P100R
                            if($dailyquery=  mysql_query("SELECT s.winStatus , d.user_email , d.daily_point
                                    FROM daily_challenge_eleven_player d
                                    inner join $s2 s on s.user_email=d.user_email
                                    WHERE s.leagueCode = '50P100R' and s.matchID = $matchid and d.matchid = $matchid
                                    ORDER BY d.daily_point DESC,d.last_modified")) {

                                $length = mysql_num_rows($dailyquery);  //4
                                $toRun=round($length/2);
                                echo '<h1>LeagueCode 50P100R</h1>';
                                echo 'Total User in League 50P100R is='.$length.'<br>';
                                echo  'Winner of LeagueCode = 50P100R and Length of winner is='.$toRun.'<br>';
                                $i=0;
                                echo '<table border="1px">';
                                echo '<th>Email</th><th>Point</th><th>WinnerStatus</th><th>OldBalance</th>';
                                while ($rowdaily = mysql_fetch_array($dailyquery)   ) {
                                    $point=mysql_real_escape_string($rowdaily['daily_point']);
                                    $emailuser=mysql_real_escape_string($rowdaily['user_email']);
                                    $winnerstatus=mysql_real_escape_string($rowdaily['winStatus']);

                                    echo '<tr><td>'.$emailuser.'</td><td>'.$point.'</td><td>'.$winnerstatus.'</td>';


                                    if($winnerstatus == 'N' && $i<$toRun) {
                                        $query="SELECT user_balance FROM paytoplaybalance WHERE user_email = '$emailuser'";
                                        if($resutSet_to_find_balance=mysql_query($query)) {
                                            $balance = mysql_result($resutSet_to_find_balance, 0, 0);
                                            echo '<td>'.$balance.'</td></tr>';
                                        }else {
                                            echo 'balance not found';
                                        }

                                        if (mysql_query("Update paytoplaybalance SET user_balance=user_balance+150 where user_email='$emailuser'") &&
                                                mysql_query("update $s2 SET winStatus = 'Y' where user_email='$emailuser' and leagueCode='50P100R' and matchID=$matchid")) {
                                            $datetime=date("Y-m-d H:i:s");
                                            $query = "INSERT INTO depositehistory(TID,user_email,Amount,status,TimeAndDate,transacrtionID,oldBalance,newBalance) VALUES ('','$emailuser',150,'A','$datetime','won in Club',$balance,$balance+150)";
                                            if(mysql_query($query)) {
                                                echo '<h3>data successfully entered</h3>';
                                            }else {
                                                echo 'cant insert in deposite acc';
                                            }
                                        }else {
                                            echo 'cant uodated user balance and status';
                                        }

                                    }else {
                                        if($winnerstatus == 'Y') {
                                            echo 'Prize already aded';
                                        }
                                    }
                                    $i++;
                                }
                                echo '</table>';
                            }else {
                                echo 'Main Query no run';
                            }


                            echo '<br><br><br>';

                            //League Code is 50P25R
                            if($dailyquery=  mysql_query("SELECT s.winStatus , d.user_email , d.daily_point
                                    FROM daily_challenge_eleven_player d
                                    inner join $s2 s on s.user_email=d.user_email
                                    WHERE s.leagueCode = '50P25R' and s.matchID = $matchid and d.matchid = $matchid
                                    ORDER BY d.daily_point DESC,d.last_modified")) {

                                $length = mysql_num_rows($dailyquery);  //4
                                $toRun=round($length/2);
                                echo '<h1>LeagueCode 50P25R</h1>';
                                echo 'Total User in League 50P25R is='.$length.'<br>';
                                echo  'Winner of LeagueCode = 50P25R and Length of winner is='.$toRun.'<br>';
                                $i=0;
                                echo '<table border="1px">';
                                echo '<th>Email</th><th>Point</th><th>WinnerStatus</th><th>OldBalance</th>';
                                while ($rowdaily = mysql_fetch_array($dailyquery)   ) {
                                    $point=mysql_real_escape_string($rowdaily['daily_point']);
                                    $emailuser=mysql_real_escape_string($rowdaily['user_email']);
                                    $winnerstatus=mysql_real_escape_string($rowdaily['winStatus']);

                                    echo '<tr><td>'.$emailuser.'</td><td>'.$point.'</td><td>'.$winnerstatus.'</td>';


                                    if($winnerstatus == 'N' && $i<$toRun) {
                                        $query="SELECT user_balance FROM paytoplaybalance WHERE user_email = '$emailuser'";
                                        if($resutSet_to_find_balance=mysql_query($query)) {
                                            $balance = mysql_result($resutSet_to_find_balance, 0, 0);
                                            echo '<td>'.$balance.'</td></tr>';
                                        }else {
                                            echo 'balance not found';
                                        }

                                        if (mysql_query("Update paytoplaybalance SET user_balance=user_balance+37 where user_email='$emailuser'") &&
                                                mysql_query("update $s2 SET winStatus = 'Y' where user_email='$emailuser' and leagueCode='50P25R' and matchID=$matchid")) {
                                            $datetime=date("Y-m-d H:i:s");
                                            $query = "INSERT INTO depositehistory(TID,user_email,Amount,status,TimeAndDate,transacrtionID,oldBalance,newBalance) VALUES ('','$emailuser',37,'A','$datetime','won in Club',$balance,$balance+37)";
                                            if(mysql_query($query)) {
                                                echo '<h3>data successfully entered</h3>';
                                            }else {
                                                echo 'cant insert in deposite acc';
                                            }
                                        }else {
                                            echo 'cant uodated user balance and status';
                                        }

                                    }else {
                                        if($winnerstatus == 'Y') {
                                            echo 'Prize already aded';
                                        }
                                    }
                                    $i++;
                                }
                                echo '</table>';
                            }else {
                                echo 'Main Query no run';
                            }


                            echo '<br><br><br>';

                            //League Code is 50PFREE
                            if($dailyquery=  mysql_query("SELECT s.winStatus , d.user_email , d.daily_point
                                    FROM daily_challenge_eleven_player d
                                    inner join $s2 s on s.user_email=d.user_email
                                    WHERE s.leagueCode = '50PFREE' and s.matchID = $matchid and d.matchid = $matchid
                                    ORDER BY d.daily_point DESC,d.last_modified")) {

                                $length = mysql_num_rows($dailyquery);  //4
                                $toRun=round($length/2);
                                echo '<h1>LeagueCode 50PFREE</h1>';
                                echo 'Total User in League 50PFREE is='.$length.'<br>';
                                echo  'Winner of LeagueCode = 50PFREE and Length of winner is='.$toRun.'<br>';
                                $i=0;
                                echo '<table border="1px">';
                                echo '<th>Email</th><th>Point</th><th>WinnerStatus</th><th>OldBalance</th>';
                                while ($rowdaily = mysql_fetch_array($dailyquery)   ) {
                                    $point=mysql_real_escape_string($rowdaily['daily_point']);
                                    $emailuser=mysql_real_escape_string($rowdaily['user_email']);
                                    $winnerstatus=mysql_real_escape_string($rowdaily['winStatus']);

                                    echo '<tr><td>'.$emailuser.'</td><td>'.$point.'</td><td>'.$winnerstatus.'</td>';


                                    if($winnerstatus == 'N' && $i<$toRun) {
                                        $query="SELECT user_balance FROM paytoplaybalance WHERE user_email = '$emailuser'";
                                        if($resutSet_to_find_balance=mysql_query($query)) {
                                            $balance = mysql_result($resutSet_to_find_balance, 0, 0);
                                            echo '<td>'.$balance.'</td></tr>';
                                        }else {
                                            echo 'balance not found';
                                        }

                                        if (mysql_query("update $s2 SET winStatus = 'Y' where user_email='$emailuser' and leagueCode='50PFREE' and matchID=$matchid")) {
                                            echo '<h3>data successfully entered</h3>';
                                        }else {
                                            echo 'cant uodated user balance and status';
                                        }

                                    }else {
                                        if($winnerstatus == 'Y') {
                                            echo 'Prize already aded';
                                        }
                                    }
                                    $i++;
                                }
                                echo '</table>';
                            }else {
                                echo 'Main Query no run';
                            }
                        }else {
                            echo 'Match points in not updated yet for SERIESID' .$seriesid. ' And match ID '.$matchid;
                        }
                    }
                }
                ?>
        </div>
    </body>
</html>
    <?php
} else {
    header('Location: ../AdminLoginAuthentication.php');
}
?>