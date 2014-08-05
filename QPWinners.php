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
        <link rel="stylesheet" type="text/css" href="css/QPWinners.css">
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
            <div class="black-header font-containt-bold" style="position: absolute;left:10px;top: 130px;width: 970px;">QIUCK PLAY WINNERS</div>
            <div class="box-shadow-comman" style="position: absolute;width: 980px;height: 870px;left: 10px;top: 160px;overflow:auto; ">

                <?php
                $datetime=date("Y-m-d H:i:s");

                if($resultSetOFmatch=mysql_query("SELECT * FROM `fixture` WHERE `timeAnddate` < '$datetime' and `dailyMatchStatus` = 'ACTIVE' order by timeAnddate DESC")) {
                    if(mysql_num_rows($resultSetOFmatch) != 0) {
                        echo "<div class='content' style='position: absolute;left:0px;top:0px;width: 100%;height:93%;'>";

                        while($row=mysql_fetch_array($resultSetOFmatch)) {

                            $sid=mysql_real_escape_string($row['sid']);
                            $matchID=mysql_real_escape_string($row['matchID']);
                            $matchTime=mysql_real_escape_string($row['timeAnddate']);

                            if($session_country == 'India') {
                                $old_date_timestamp = strtotime($matchTime);
                                $matchTime = date('j,M Y h:i A', $old_date_timestamp).' IST';
                            }else {
                                $old_date_timestamp = strtotime($matchTime);
                                $old_date_timestamp = $old_date_timestamp - '19800';
                                $matchTime = date('j,M Y h:i:s A', $old_date_timestamp).' GMT';
                            }
                            $team1=mysql_real_escape_string($row['team1']);
                            $team2=mysql_real_escape_string($row['team2']);
                            $Ground=mysql_real_escape_string($row['Ground']);
                            $location=mysql_real_escape_string($row['location']);
                            $matchType=mysql_real_escape_string($row['matchType']);
                            $matchDescription=mysql_real_escape_string($row['matchDescription']);
                            $dailyMatchStatus=mysql_real_escape_string($row['dailyMatchStatus']);
                            echo "<a href='#' class='match-link font-containt' sid='$sid' matchID='$matchID' style='background-image:url(photos/fixturebg.jpg);color:white;'>
                                Match No : $matchID<br>
                                <table width=100%>
                                    <tr>
                                         <td width=15% align=center><div><img src='photos/teamsFlags/$team1.jpg' alt='$team1' class=fixture-images width=120px height=85px></div></td>
                                         <td width=25% align=center style=font-size:14px;color:white;><font style=font-size:13px;font-weight:bold;>$team1  Vs.  $team2</font><br>$matchDescription<br>TIME: $matchTime<br>VENUE: $Ground <br>( $location )</td>
                                         <td width=15% align=center><div><img src='photos/teamsFlags/$team2.jpg' alt='$team2' class=fixture-images width=120px height=85px></div></td>
                                     </tr>
                                </table>
                                </a>";
                            echo "<div class='$sid$matchID' style='width:98%;'></div>";
                        }
                        echo "</div>";

                    }else {
                        echo '<div style="position: absolute;top:200px;left:450px;">No Match to display</div>';
                    }
                }else {
                    echo '<div style="position: absolute;top:200px;left:400px;">Some error occurred while retrieving data</div>';
                }
                ?>
            </div>
        </div>
        <div class="filler" style="position: absolute;width: 1000px;height: 45px;left: 176px;top: 1150px;background-color: white">
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
                var mid=$(this).attr('matchID');
                //$("."+s+m).append("hello");

                $.post('PHP/findQPWinner.php',{
                    sid:sid,
                    mid:mid
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
