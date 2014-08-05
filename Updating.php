<?php


@include 'Header.php';
@include 'PHP/includes/database_connectivity_includes.php';
@session_start();
//include 'PHP/includes/session_setter.php';
if(isset ($_SESSION['username']) && isset ($_SESSION['email']) && isset ($_SESSION['password']) &&isset ($_SESSION['country'])){
        if(!empty ($_SESSION['username']))
        $session_username= $_SESSION['username'];
        if(!empty ($_SESSION['email']))
        $session_email= $_SESSION['email'];
        if(!empty ($_SESSION['password']))
            $session_password= $_SESSION['password'];
         if(!empty ($_SESSION['country']))
            $session_country= $_SESSION['country'];
        

        }
        else
        {
                echo("<script>window.location= 'Login.php';</script>");
        }
include 'PHP/includes/seriedId_setter.php';
?>
<html>
    <head>
        <title>Updating</title>
        <link rel="stylesheet" type="text/css" href="css/footer.css">
        <style type="text/css">
             body{background-image: url('photos/background.jpg');}
            .font-containt-bold{font-family: "Lao UI";font-weight: bold;}
            .font-containt{font-family: "Lao UI";}
            .box-shadow-comman{box-shadow:6px 0px 5px -5px #504848, -6px 0px 5px -5px #504848;-webkit-box-shadow:6px 0px 5px -5px #504848, -6px 0px 5px -5px #504848;-moz-box-shadow:6px 0px 5px -5px #504848, -6px 0px 5px -5px #504848;}
            .filler{box-shadow:6px 0px 5px -5px #504848, -6px 0px 5px -5px #504848;-webkit-box-shadow:6px 0px 5px -5px #504848, -6px 0px 5px -5px #504848;-moz-box-shadow:6px 0px 5px -5px #504848, -6px 0px 5px -5px #504848;}
        </style>
    </head>
    <body>
        <div class="filler box-shadow-comman" style="position: absolute;width: 1000px;height: 35px;left: 176px;top: 150px;background-color: white">
        </div>
        <div  class="main-body-container box-shadow-comman" style="position: absolute;width: 1000px;height: 400px;left: 183px;top: 175px;background-color: white">
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


            <div style="position: absolute;left: 0px;top:150px;width:1000px;height: 300px;">
                <center><font color="#17DCDC" style="font-size:32;font-weight: bold">UPDATING...</font></center>
                <center><font color="#696464" style="font-size:20;">Points are updating. It might take half an hour. PLEASE try later!</font></center>
            </div>


        </div>
        <div class="filler box-shadow-comman" style="position: absolute;width: 1000px;height: 45px;left: 176px;top: 575px;background-color: white">
        </div>




        <div id="footer-container" align="center" style="position: absolute;left: 176px;top:575px;width: 1000px;height: 300px;color: white;">
            <img src="photos/footer/footer-bg.png" style="position:absolute;left: -8px;top:0px;" >
            <div class="tags">
                <div style="position: absolute;left: 0px;">#feelLike<font style="color: white;font-family: AR JULIAN;">OWNER</font></div>

                <div style="position: absolute;left: 400px;"><font style="color: white;font-family: AR JULIAN;">THANK YOU!</font></div>

                <div style="position: absolute;left:780px;"> #playLike<font style="font-family: AR JULIAN;color: white;">OWNER</font></div>
            </div>

            <table width="95%" style="position: absolute;top:75px;color: white" >
                <tr style="">
                    <td width='5%'></td>
                    <td width='15%'>
                        <div class="main-item">SITE MAP</div>
                        <div class="sub-item">
                            <div><?php echo "<a href='ManageTeam.php?seriesId=$seriesId'>"; ?><font style="color: white;">MANAGE TEAM</font></a></div>
                            <div><?php echo "<a href='PointHistory.php?seriesId=$seriesId'>"; ?><font style="color: white;">VIEW POINTS</font></a></div>
                            <div><?php echo "<a href='League.php?seriesId=$seriesId'>"; ?><font style="color: white;">LEAGUE</font></a></div>
                            <div><?php echo "<a href='Leaderboard.php?seriesId=$seriesId'>"; ?><font style="color: white;">LEADERBOARS</font></a></div>
                            <div><?php echo "<a href='Stats.php?seriesId=$seriesId'>"; ?><font style="color: white;">STATS</font></a></div>
                            <div><?php echo "<a href='Fixture.php?seriesId=$seriesId'>"; ?><font style="color: white;">FIXTURE</font></a></div>
                        </div>
                    </td>
                    <td width='15%'>
                        <div class="main-item">TEAMS</div>
                        <div class="sub-item">
                            <div style="font-size: 10px;">(*teams we support)</div>
                            <div>INDIA</div>
                            <div>AUSTRALIA</div>
                            <div>SOUTH AFRICA</div>
                            <div>ENGLAND</div>
                            <div>SRI LANKA</div>
                            <div>PAKISTAN</div>
                            <div>NEW ZEALAND</div>
                            <div>WEST INDIES</div>
                        </div>
                    </td>

                    <td width='25%'>
                        <div class="main-item"><?php echo "<a href='T&C.php?seriesId=$seriesId'>"; ?><font style="color: white;">TERMS&CONDITION</font></a></div>
                        <div class="sub-item">
                            <div><?php echo "<a href='T&C.php?seriesId=$seriesId#copy&tread'>"; ?><font style="color: white;">COPYRIGHTS & TRADEMARKS</font></a></div>
                            <div><?php echo "<a href='T&C.php?seriesId=$seriesId#privacypolicy'>"; ?><font style="color: white;">PRIVACY POLICY</font></a></div>
                            <div><?php echo "<a href='T&C.php?seriesId=$seriesId#licenceofuse'>"; ?><font style="color: white;">LICENCE TO USE WEBSITE</font></a></div>
                            <div><?php echo "<a href='T&C.php?seriesId=$seriesId#acceptableuse'>"; ?><font style="color: white;">ACCEPTABLE USE</font></a></div>
                            <div><?php echo "<a href='T&C.php?seriesId=$seriesId#regandacc'>"; ?><font style="color: white;">REGISTRATION & ACCOUNTS</font></a></div>
                            <div><?php echo "<a href='T&C.php?seriesId=$seriesId#emailandpass'>"; ?><font style="color: white;">EMAIL ADDs & PASSWORDS</font></a></div>
                            <div><?php echo "<a href='T&C.php?seriesId=$seriesId#canandsusp'>"; ?><font style="color: white;">CANCELLATION & SUSPENSION OF A/C</font></a></div>
                        </div>
                    </td>
                    <td width='15%'>
                        <div class="main-sub-item">

                            <div>
                                ABOUT US<br>
                                <font style="color: white;font-size: 11px;">
                                    <div style="padding-bottom: 4px;">Hardik Gondaliya<br>
                                        <a href="https://www.facebook.com/hardik.gondalia.7" target="blank"><img src="photos/facebook-logo.jpg" width="15px" height="15px" border="1px"></a>
                                        <a href="https://twitter.com/hardikg23" target="blank"><img src="photos/twitter-logo.jpg" width="15px" height="15px" border="1px"></a>
                                        <a href="https://plus.google.com/u/0/115442858578429795537/posts" target="blank"><img src="photos/google-logo.jpg" width="15px" height="15px" border="1px"></a>
                                        <a href="https://in.linkedin.com/pub/hardik-gondaliya/62/30b/656/" target="blank"><img src="photos/linked-in-logo.jpg" width="15px" height="15px" border="1px"></a>

                                    </div>
                                    <div style="padding-bottom: 4px;">Jitendra Prajapati<br>
                                        <a href="https://www.facebook.com/jitendra.prajapat.56" target="blank"><img src="photos/facebook-logo.jpg" width="15px" height="15px" border="1px"></a>
                                        <a href="https://in.linkedin.com/pub/jitendra-prajapati/61/bb5/80/" target="blank"><img src="photos/linked-in-logo.jpg" width="15px" height="15px" border="1px"></a>

                                    </div>
                                    <div style="padding-bottom: 4px;">Aniket Shinde<br>
                                        <a href="https://www.facebook.com/aniketIT?fref=ts" target="blank"><img src="photos/facebook-logo.jpg" width="15px" height="15px" border="1px"></a>
                                    </div>
                                </font>
                            </div>

                        </div>
                    </td>
                    <td width='5%'>
                        <div id="fb-root"></div>
                        <script>(function(d, s, id) {
                            var js, fjs = d.getElementsByTagName(s)[0];
                            if (d.getElementById(id)) return;
                            js = d.createElement(s); js.id = id;
                            js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
                            fjs.parentNode.insertBefore(js, fjs);
                        }(document, 'script', 'facebook-jssdk'));</script>

                        <div class="fb-like-box"
                             data-href="https://www.facebook.com/pages/FantasyCricLeaguecom/1428833860689079"
                             data-width="160" data-height="225"
                             data-colorscheme="dark"
                             data-show-faces="true"
                             data-header="true" data-stream="false"
                             data-show-border="true">
                        </div>

                    </td>
                </tr>
            </table>
        </div>
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/Home_login_details_validate.js"></script>
        <script type="text/javascript" src="js/make_All_page_responsive.js"></script>
    </body>
</html>





