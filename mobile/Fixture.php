<?php
/*
 *  MANAGETEAM
*/
include 'PHP/includes/database_connectivity_includes.php';
@session_start();
include 'PHP/includes/session_setter.php';
include 'PHP/includes/seriedId_setter.php';

?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=0" />
        <link rel="stylesheet" href="css/jquery.mobile-1.4.2.min.css">
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/mJquery.js"></script>
    </head>
    <body>
        <div id="grad" class="body-container" >
            <?php
            include 'PHP/includes/header.php';
            ?>
            <div class="data-container" style="width: 100%;">
                <br>
                <div style="background-color: black;padding-left: 5px;padding-right: 5px;padding-top: 5px;padding-bottom: 5px;">
                    <font style="color: white;font-size: 16px;">FIXTURE</font>
                </div>
                <div>
                    <?php
                    $datetime=date("Y-m-d H:i:s");
                    if($ResultSet_of_fixture=mysql_query("SELECT * from fixture where timeAnddate>'$datetime'")) {
                        if(mysql_num_rows($ResultSet_of_fixture)==0) {
                            echo '<center>No UPCOMING FIXTURE</center>';
                        }
                        else {

                            echo '<table align="center" data-role="table" id="table-column-toggle" data-mode="columntoggle" class="ui-responsive table-stroke" style="color: #5F6060;font-size: 10px;">';
                            echo '<thead><tr>
                                    <th>#</th>
                                    <th>TEAMS</th>
                                    <th data-priority="1">DECS</th>
                                    <th>TIME</th>
                                   </tr></thead>';
                            while($row=mysql_fetch_array($ResultSet_of_fixture)) {
                                $sid=mysql_real_escape_string($row['sid']);
                                $matchID=mysql_real_escape_string($row['matchID']);
                                $team1=mysql_real_escape_string($row['team1']);
                                $team2=mysql_real_escape_string($row['team2']);
                                $matchTime=mysql_real_escape_string($row['timeAnddate']);

                                if($session_country == 'India') {
                                    $old_date_timestamp = strtotime($matchTime);
                                    $matchTime = date('j,M h:i A', $old_date_timestamp);
                                }else {
                                    $old_date_timestamp = strtotime($matchTime);
                                    $old_date_timestamp = $old_date_timestamp - '19800';
                                    $matchTime = date('j,M h:i A', $old_date_timestamp).' GMT';
                                }
                                //$Ground=mysql_real_escape_string($row['Ground']);
                                //$location=mysql_real_escape_string($row['location']);
                                $matchType=mysql_real_escape_string($row['matchType']);
                                $matchDescription=mysql_real_escape_string($row['matchDescription']);
                                //$dailyMatchStatus=mysql_real_escape_string($row['dailyMatchStatus']);
                                //$dailyHREF='';
                                //if($dailyMatchStatus == 'ACTIVE') {
                                //    $dailyHREF="DailyChallenge.php?sid=$sid&mid=$matchID";
                                //}

                                echo '<tr>
                                      <td >'.$matchID.'</td><td style="font-weight:bold;font-size:12px;">'.$team1.'  Vs.  '.$team2.'</td><td>'.$matchDescription.'</td><td>'.$matchTime.'</td>
                                     </tr>';

                            }
                            echo '</table>';
                        }
                    }else {
                        echo '<center>SOME ERROR OCCURED WHILE RETRIVING DATA</center>';
                    }
                    ?>

                </div>

            </div>
            <div>
                <?php
                include 'PHP/includes/menu.php';
                ?>
            </div>

        </div>
    </body>
</html>
