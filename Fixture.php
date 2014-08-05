<?php
include 'Header.php';
include 'PHP/includes/database_connectivity_includes.php';
$session_country='';
@session_start();
if(isset ($_SESSION['username']) && isset ($_SESSION['email'])&&isset ($_SESSION['password']) &&isset ($_SESSION['country'])) {
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
?>

<html>
<head>
    <title>FIXTURE</title>
    <link rel="stylesheet" type="text/css" href="css/Fixture.css">
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

         <!-----------------Main Body ---------------------------------------------------------------------------------->
           <div  style="position: absolute;width: 1000px;left: 0px;height: 850px;top: 150px;">
             <div style="position: absolute;width: 980px;height: 745px;top:30px;overflow:auto;padding-left: 10px;padding-right: 10px;">
               <div class="black-header font-containt-bold" style="width: 972px;">
                        UPCOMING MATCHES
               </div>
                  <br>
                 <?php
                        $datetime=date("Y-m-d H:i:s");
                        if($ResultSet_of_fixture=mysql_query("SELECT * from fixture where timeAnddate>'$datetime'"))
                        {
                            if(mysql_num_rows($ResultSet_of_fixture)==0)
                            {
                                echo '<center>No UPCOMING FIXTURE</center>';
                            }
                            else
                            {
                                while($row=mysql_fetch_array($ResultSet_of_fixture))
                                {
                                    $sid=mysql_real_escape_string($row['sid']);
                                    $matchID=mysql_real_escape_string($row['matchID']);
                                    $team1=mysql_real_escape_string($row['team1']);
                                    $team2=mysql_real_escape_string($row['team2']);
                                    $matchTime=mysql_real_escape_string($row['timeAnddate']);

                                    if($session_country == 'India'){
                                        $old_date_timestamp = strtotime($matchTime);
                                        $matchTime = date('j,M Y h:i A', $old_date_timestamp).' IST';
                                    }else{
                                        $old_date_timestamp = strtotime($matchTime);
                                        $old_date_timestamp = $old_date_timestamp - '19800';
                                        $matchTime = date('j,M Y h:i:s A', $old_date_timestamp).' GMT';
                                    }
                                    $Ground=mysql_real_escape_string($row['Ground']);
                                    $location=mysql_real_escape_string($row['location']);
                                    $matchType=mysql_real_escape_string($row['matchType']);
                                    $matchDescription=mysql_real_escape_string($row['matchDescription']);
                                    $dailyMatchStatus=mysql_real_escape_string($row['dailyMatchStatus']);
                                    $dailyHREF='';
                                    if($dailyMatchStatus == 'ACTIVE')
                                    {
                                        $dailyHREF="DailyChallenge.php?sid=$sid&mid=$matchID";
                                    }

                                    echo '<div class="font-containt fixture-div-item-container">
                                            <table width=100% height=120px style="text-shadow:1px 1px 1px #504848;padding-left:10px;color:white;background-image:url(photos/fixturebg.jpg)">
                                                <tr>
                                                        <td width="5%" align="center"><div><img src="photos/matchType/'.$matchType.'.jpg" alt="'.$matchType.'" class="fixture-images" width="50px" height="50px"></div></td>
                                                        <td width="15%" align="center"><div><img src="photos/teamsFlags/'.$team1.'.jpg" alt="'.$team1.'" class="fixture-images" width="120px" height="85px"></div></td>
                                                        <td width="25%" align="center" style="font-size:14px">MATCH NO : '.$matchID.'<br><font style="font-size:16px;font-weight:bold">'.$team1.'  Vs.  '.$team2.'</font><br>'.$matchDescription.'<br>TIME: '.$matchTime.'<br>VENUE: '.$Ground.' <br>( '.$location.' )</td>
                                                        <td width="15%" align="center"><div><img src="photos/teamsFlags/'.$team2.'.jpg" alt="'.$team2.'" class="fixture-images" width="120px" height="85px"></div></td>
                                                        <td align="right" style="padding-right: 25px;"><a href="ManageTeam.php?seriesId='.$sid.'"><input type="button" value="MANAGE TEAM" class="manageteam-button"></a><br><br>';
                                                          if($dailyMatchStatus == 'ACTIVE')
                                                           echo '<a href="'.$dailyHREF.'"><input type="button" value="QUICK PLAY" class="dailyChellenge-button"></a></td>';

                                        echo   '</tr>
                                            </table>
                                          </div>';
                                    echo '<div style="width:100%;height:25px;"></div>';
                                }
                    }
        }else{
                echo '<center>SOME ERROR OCCURED WHILE RETRIVING DATA</center>';
        }
                    ?>
           </div>
        </div>
       <!------------------------------------------------------------------------------------------------------------->
     </div>
    <div class="filler" style="position: absolute;width: 1000px;height: 45px;left: 176px;top: 1150px;background-color: white">
    </div>
     <script type="text/javascript" src="js/jquery.js"></script>
     <script type="text/javascript" src="js/make_All_page_responsive.js"></script>
     <script type="text/javascript" src="js/Home_login_details_validate.js"></script>
</body>
</html>
<?php
	include 'Footer.php';
?>