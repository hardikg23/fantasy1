<?php
include 'Header.php';
include 'PHP/includes/database_connectivity_includes.php';
@session_start();
if(isset ($_SESSION['username']) && isset ($_SESSION['email'])&&isset ($_SESSION['password'])) {
    if(!empty ($_SESSION['username']))
        $session_username= $_SESSION['username'];
    if(!empty ($_SESSION['email']))
        $session_email= $_SESSION['email'];
    if(!empty ($_SESSION['password']))
        $session_password= $_SESSION['password'];
}
include 'PHP/includes/seriedId_setter.php';
?>
<html>
    <head>
        <title>Statastics</title>
        <link rel="stylesheet" type="text/css" href="css/Stats.css">
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


        <!--STAT-->
            <div   style="position: absolute;width: 1000px;height: 870px;left: 0px;top: 130px;">
                <div class="font-containt box-shadow-comman" style="position: absolute;width: 736px;height: 558px;left: 10px;top: 0px;">
                    <div class="black-header font-containt-bold">
                        <center>PLAYERS STATISTICS</center>
                    </div>
                    <div class="select-stats-container">
                    TEAM &nbsp;
                        <select name="teams" id="filter_stats1" class="team-stats-select">
                            <option value="all">ALL</option>
                            <?php
                            $s='s'.$seriesId.'_player_data';
                            $result=mysql_query("SELECT DISTINCT team FROM `$s`");
                            while($row=mysql_fetch_array($result)) {  //to get all data.....
                                $team=mysql_real_escape_string($row[0]);
                                echo '<option value='.$team.'>';
                                echo  $team;
                                echo '</option>';
                            }
                            ?>
                        </select>
                        &nbsp;&nbsp; TYPE &nbsp;
                        <select name="style" id="filter_stats2" class="style-stats-select">
                            <option value="all">ALL</option>
                            <option value="batsman">BATSMAN</option>
                            <option value="all-rounder">ALL-ROUNDER</option>
                            <option value="weeket-keeper">WEEKET-KEEPER</option>
                            <option value="bowler">BOWLER</option>
                        </select>

                        &nbsp;&nbsp;STATS &nbsp;
                        <select name="parameter" id="filter_stats3" class="para-stats-select">
                            <option value="total_point">POINTS</option>
                            <option value="selectedBy">SELECTED BY</option>
                            <option value="form">FORM</option>
                            <option value="value">VALUE</option>
                            <option value="pts_per_match">POINTS PER MATCH</option>
                        </select>
                    </div>
                    <div id="content_player_stats" align="center" style="position: absolute;width: 736px;height: 480px;left: 0px;top: 60px;overflow:auto;">
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


                <!--  Display All 4 types of player at bottem --->
                <?php
                include 'PHP/includes/diplay_4_type_of_player_at_bottem.php';
                ?>
                <!----------->
            </div>
            <!------>
        </div>
        <div class="filler" style="position: absolute;width: 1000px;height: 45px;left: 176px;top: 1160px;background-color: white">
        </div>


        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/make_All_page_responsive.js"></script>
        <script type="text/javascript" src="js/Home_login_details_validate.js"></script>
	<script type="text/javascript" src="js/jquery.tablesorter.js"></script>
        <script type="text/javascript" src="js/stats.js"></script>
    </body>
</html>

<?php
include 'Footer.php';
?>