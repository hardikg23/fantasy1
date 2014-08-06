<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if (empty($session_email) && empty($session_password)) {
    ?>
    <!-- Small Menu-->
    <div class="SubMenu font-containt" style="position: absolute;left: 0px;top:80px;width:1000px;height:30px;">
        <a href="Home.php?seriesId=<?php echo $seriesId ?>" class="a-home SubLargeMenuElement">HOME</a>
        <a href="Stats.php?seriesId=<?php echo $seriesId ?>" class="a-stats SubLargeMenuElement">STATS</a>
        <a href="Fixture.php?seriesId=<?php echo $seriesId ?>" class="a-fixture SubLargeMenuElement">FIXTURE</a>
        <a href="#dialog1" name="modal" class="SubLargeMenuElement">HOW TO PLAY</a>
        <a href="#dialog2" name="modal" class="SubLargeMenuElement">POINT SYSTEM</a>
        <a href="#dialog3" name="modal" class="SubLargeMenuElement">FAQs</a>
        <a href="#dialog4" name="modal" class="SubLargeMenuElement">PRIZES</a>
    </div>

    <!-- If Session is  SET then LARGE SUBMENU -->
    <?php } else {
    ?>
    <!-- Large Menu-->
    <div class="SubLargeMenu font-containt" style="position: absolute;left: 0px;top:80px;width:1000px;height:30px;">
        <a href="Home.php?seriesId=<?php echo $seriesId ?>" class="a-home SubLargeMenuElement">HOME</a>
        <a href="ManageTeam.php?seriesId=<?php echo $seriesId ?>" class="a-manage SubLargeMenuElement">MANAGE TEAM</a>
        <a href="PointHistory.php?seriesId=<?php echo $seriesId ?>" class="a-pointhistory SubLargeMenuElement">VIEW POINTS</a>
        <a href="League.php?seriesId=<?php echo $seriesId ?>" class="a-league SubLargeMenuElement">LEAGUE</a>
        <a href="Leaderboard.php?seriesId=<?php echo $seriesId ?>" class="a-leaderboard SubLargeMenuElement">LEADERBOARD</a>
        <a href="Stats.php?seriesId=<?php echo $seriesId ?>" class="a-stats SubLargeMenuElement">STATS</a>
        <a href="Fixture.php?seriesId=<?php echo $seriesId ?>" class="a-fixture SubLargeMenuElement">FIXTURE</a>
        <a href="DailyChallenge.php?seriesId=<?php echo $seriesId ?>" id="dailychallenge" class="a-daily SubLargeMenuElement" >QUICK PLAY</a>
        <a href="paytoplay.php?seriesId=<?php echo $seriesId ?>" id="dailychallenge" class="a-play SubLargeMenuElement" >PAY TO PLAY</a>
        <a href="#dialog1" name="modal" class="SubLargeMenuElement">HOW TO PLAY</a>
        <a href="#dialog2" name="modal" class="SubLargeMenuElement">POINT SYSTEM</a>
        <a href="#dialog5" name="modal" class="SubLargeMenuElement">RULES</a>
        <a href="#dialog4" name="modal" class="SubLargeMenuElement">PRIZES</a>
        <a href="#dialog3" name="modal" class="SubLargeMenuElement">FAQs</a>
    </div>
    <?php
}
?>

<html>
    <head>

        <link rel="stylesheet" href="css/jquery-ui-1.10.3.custom.css">
        <link rel="stylesheet" href="css/jquery-ui-1.10.3.custom.min.css">
        <link rel="stylesheet" type="text/css" href="css/modal.css"/>
        <link rel="stylesheet" type="text/css" href="PHP/includes/css/Sub_Menu.css">
    </head>
    <body>
        <div id="box">
            <!--************************   MODEL for HOW TO PLAY  **********************************-->
            <div id="dialog1" class="window">
                HOW TO PLAY
                <a href="#" class="close">
                    <img src="photos/ModelClose.png" alt="close" style="position: absolute;left:725px;top:5px;" height="20px" left="20px">
                </a>

                <div class="content" style="position: absolute;left:15px;top:45px;height: 550px;">
                    <a href="#" class="header">SELECTING YOUR INITIAL SQAURD</a>
                    <div>
                        <p class="content-header">SQUAD SIZE</p>

                        <p class="content-content">
                            Your squad size should be 11.<br>
                            To start selecting your squad: Login-> Manage Team-> And start selecting your squad.
                        </p>


                        <p class="content-header"> 
                            BUDGET
                        </p>

                        <p class="content-content">
                            Your budget for all tournaments will be 100 m$ initially. <br>
                            Each player is allocated some price based on his playing factors.
                            Now, in the allocated budget you are supposed to create a team of exactly 11 players such that they fit inside the budget. Hence, total budget of all players will be less than or equal to 100m$.
                        </p>

                        <p class="content-header">
                            TEAM FORMATION
                        </p>
                        <p class="content-content">
                            Each player you need has a price and you need to make a team of possibly your favourite players inside the given budget. That sounds good but to add to the fun here is a list of some more restriction, considering your team of 11 you can have:
                        </p>       <ul class="content-ul">
                            <li>Minimum 4 Batsmen.</li>
                            <li>1 Wicket-Keeper.</li>
                            <li>Minimum 2 All-rounders.</li> 
                            <li>Minimum 2 Bowlers.</li>
                        </ul>
                        <p class="content-content">
                            *you can not select 2 pure wicket-keeper.<br>
                            if your team have 2 or more batting-wicket keeper one will be consider as  wicket-keeper and other(s) will be consider as batsman.
                        </p>

                    </div>

                    <a href="#" class="header">HOW TO MAKE TEAM CHANGES</a>
                    <div>
                        <div class="content-header">PROCEDURE TO CHANGE TEAMS</div>
                        <div class="content-content">
                            To manage your team: Login-> Manage Team<br>
                            To add new player :  select the <img src="photos/right.png" width="15px" height="15px;">   button next to the player you wish to add to your team.
                            <br>To remove player :  select the  <img src="photos/cross.png" width="15px" height="15px;">  button next to the player you want to remove.

                        </div>

                        <div class="content-header">CAPTAIN SELECTION</div>
                        <div class="content-content">
                            To select captain:<br>
                            Create a valid team in Manage Team page -> Select the captain from the dropdown box.<br><br>
                            <font style="font-weight: bold">Captains Power</font>: Whichever captain you select, your captain's points will be doubled i.e you will receive two times points allocated to your captain. Hence, chose your captain wisely.
                        </div>
                    </div>



                    <a href="#" class="header">TRANSFERS</a>
                    <div>
                        <div class="content-content">
                            While managing your team each season you are given N no of transfers. Hence, you have to manage your team by making only N no of transfers throughout the entire series.
                            Details about total no of transfers for a series will be different for different series and can be found in series Rules.
                        </div>

                    </div>

                    <a href="#" class="header">LEAGUE</a>
                    <div>
                        <div class="content-content">There are two types of league: Private League and Public League</div>
                        <div class="content-header">PRIVATE LEAGUE</div>
                        <div class="content-content">
                            You can create your own private league and add other fantasy managers to find out how other manager from that league stand in terms of points.
                            <br><br>To create your private league:<br>
                            Login-> Go To League-> In the Create League Column enter LeageName and Code.<br>
                            Now, you can forward the LeagueName and Code to your friends.<br><br>
                            To join a private league:<br>
                            Login-> Go To League-> In the Join League Column enter LeageName and Code.
                        </div>
                        <div class="content-header">PUBLIC LEAGUE</div>
                        <div class="content-content">
                            There will be public leagues auto-created and you can join/leave these leagues.
                        </div>
                    </div>


                    <a href="#" class="header">LEADERBOARD</a>
                    <div>
                        <div class="content-content">
                            Each series will have a leaderboard where top scoring users will be displayed.
                        </div>
                    </div>



                    <a href="#" class="header">QUICK PLAY</a>
                    <div>
                        <div class="content-content">
                            You can play the game for the entire series, but you can also play it on per match basis.<br>
                            In Quick Play you can make a team for any particular match and winners will be declared on per match basis.
                          </div>  
                            <div class="content-header">Make your team for a match:</div>
                            <div class="content-content">
                            Login-> Go to QUICK PLAY-> Select squad of 11 for the match you wish<br>
                            Note: The squad you select in Quick play is differently managed and will not in any way get mixed up with your series team squad. Hence, Quick Play is per match basis and ManageTeam is for the entire series.
                            </div>
                            <div class="content-header">Few Differences</div>
                            <div class="content-content">In QUICK PLAY you don't have any limit on the budget or no of transfers but the lower the budget better your points.
                            Precisely:
                            <ul class="content-ul">
                                <li>
                                    For each 1 million $ that you save from 100 million $ you get additional 10 points.
                                </li>
                                <li>
                                    For each 1 million $ you use more than 100 million $, 10 points are deduced from your score.
                                </li>
                            </ul>
                            </div>
                         
                    </div>
                </div>
            </div>






            <!--************************   MODEL for  POINT SYSTEM  **********************************-->
            <div id="dialog2" class="window">
                POINT SYSTEM
                <a href="#" class="close">
                    <img src="photos/ModelClose.png" alt="close" style="position: absolute;left:725px;top:5px;" height="20px" left="20px">
                </a>
                <div class="content" style="position: absolute;left:15px;top:45px;">
                    <a href="#" class="header">ODI</a>
                    <div>
                        <div style="background-color: red">BATTING POINTS</div>
                        <div>
                            <table style="font-size: 11px;width: 100%">
                                <tr style="color:red">
                                    <td colspan="2">CORE POINT SYSTEM</td>
                                </tr>
                                <tr>
                                    <td width=35%>1 RUN = 1 POINT</td><td width=60%>for player clasified as BATSMAN,WICKET-KEEPER OR ALL-ROUNDER </td>
                                </tr>
                                <tr>
                                    <td>1 RUN = 2 POINT</td><td>for player clasified as BOWLER </td>
                                </tr>
                                <tr>
                                    <td>1 SIX  = 5 POINTS</td><td>for ALL PLAYER </td>
                                </tr>
                                <tr style="color:red">
                                    <td colspan="2">POWER BOOSTER</td>
                                </tr>
                                <tr>
                                    <td>FOR EVERY 10 RUNS = 5 POINTS</td><td>for ALL PLAYER </td>
                                </tr>
                                <tr>
                                    <td>(RUNS X 1.2 - BALLS PLAYED) POINTS</td><td>for ALL PLAYER</td>
                                </tr>
                                <tr>
                                    <td>-20 POINTS FOR OUT ON '0'</td><td>for player clasified as BATSMAN,WICKET-KEEPER OR ALL-ROUNDER</td>
                                </tr>
                            </table>
                        </div>
                        <br>
                        <div style="background-color: red">BOWLING POINTS</div>
                        <div>
                            <table style="font-size: 11px;width: 100%">
                                <tr style="color:red">
                                    <td colspan="2">CORE POINT SYSTEM</td>
                                </tr>
                                <tr>
                                    <td width=35%>1 EACH WKT = 25 POINTS</td><td width=60%>for player clasified as BOWLER OR ALL-ROUNDER </td>
                                </tr>
                                <tr>
                                    <td>1 EACH WKT = 30 POINTS</td><td>for player clasified as BATSMAN </td>
                                </tr>
                                <tr>
                                    <td>MAIDEN OVER - 12 POINTS</td><td>for ALL PLAYER </td>
                                </tr>
                                <tr style="color:red">
                                    <td colspan="2">POWER BOOSTER</td>
                                </tr>
                                <tr>
                                    <td>FOR 2nd WKT - 5 POINTS EXTRA<br>FOR 3rd WKT - 10 POINTS EXTRA<br>FOR 4th WKT or ABOVE - 15 POINTS EXTRA</td><td>for ALL PLAYER </td>
                                </tr>
                                <tr>
                                    <td>(BALL BOWLED - RUN GIVEN) X 2 POINTS</td><td>for ALL PLAYER</td>
                                </tr>
                                <tr>
                                    <td>HAT-TRICK  - 30 POINTS</td><td>for ALL PLAYER</td>
                                </tr>
                            </table>
                        </div>

                        <br>
                        <div style="background-color: red">FIELDING POINTS</div>
                        <div>
                            <table style="font-size: 11px;width: 100%">
                                <tr>
                                    <td width=35%>FOR EACH CATCH - 15 POINTS</td><td width=60%>  for ALL PLAYER</td>
                                </tr>
                                <tr>
                                    <td>FOR EACH RUN-OUT - 15 POINTS</td><td>  for ALL PLAYER</td>
                                </tr>
                            </table>
                        </div>

                        <br>
                        <div style="background-color: red">BONUS POINTS</div>
                        <div>
                            <table style="font-size: 11px;width: 100%">
                                <tr>
                                    <td width=35%>FOR MAN OF THE MATCH - 50 POINTS</td><td width=60%>  for ALL PLAYER</td>
                                </tr>
                                <tr>
                                    <td>FOR WINNING MATCH - 10 POINTS</td><td>  for ALL PLAYER</td>
                                </tr>
                            </table>
                        </div>

                    </div>


                    <a href="#" class="header">T20</a>
                    <div>
                        <div style="background-color: red">BATTING POINTS</div>
                        <div>
                            <table style="font-size: 11px;width: 100%">
                                <tr style="color:red">
                                    <td colspan="2">CORE POINT SYSTEM</td>
                                </tr>
                                <tr>
                                    <td width=35%>1 RUN = 1 POINT</td><td width=60%>for player clasified as BATSMAN,WICKET-KEEPER OR ALL-ROUNDER </td>
                                </tr>
                                <tr>
                                    <td>1 RUN = 2 POINT</td><td>for player clasified as BOWLER </td>
                                </tr>
                                <tr>
                                    <td>1 SIX  = 6 POINTS</td><td>for ALL PLAYER </td>
                                </tr>
                                <tr style="color:red">
                                    <td colspan="2">POWER BOOSTER</td>
                                </tr>
                                <tr>
                                    <td>FOR EVERY 10 RUNS = 5 POINTS</td><td>for ALL PLAYER </td>
                                </tr>
                                <tr>
                                    <td>(RUNS X 1.2 - BALLS PLAYED) POINTS</td><td>for ALL PLAYER</td>
                                </tr>
                                <tr>
                                    <td>-20 POINTS FOR OUT ON '0'</td><td>for player clasified as BATSMAN,WICKET-KEEPER OR ALL-ROUNDER</td>
                                </tr>
                            </table>
                        </div>
                        <br>
                        <div style="background-color: red">BOWLING POINTS</div>
                        <div>
                            <table style="font-size: 11px;width: 100%">
                                <tr style="color:red">
                                    <td colspan="2">CORE POINT SYSTEM</td>
                                </tr>
                                <tr>
                                    <td width=35%>1 EACH WKT = 25 POINTS</td><td width=60%>for player clasified as BOWLER OR ALL-ROUNDER </td>
                                </tr>
                                <tr>
                                    <td>1 EACH WKT = 30 POINTS</td><td>for player clasified as BATSMAN </td>
                                </tr>
                                <tr>
                                    <td>MAIDEN OVER - 15 POINTS</td><td>for ALL PLAYER </td>
                                </tr>
                                <tr>
                                    <td>1 DOT BALL - 1 POINT</td><td>for ALL PLAYER </td>
                                </tr>
                                <tr style="color:red">
                                    <td colspan="2">POWER BOOSTER</td>
                                </tr>
                                <tr>
                                    <td>FOR 2nd WKT - 5 POINTS EXTRA<br>FOR 3rd WKT - 10 POINTS EXTRA<br>FOR 4th WKT or ABOVE - 15 POINTS EXTRA</td><td>for ALL PLAYER </td>
                                </tr>
                                <tr>
                                    <td>(BALL BOWLED X 1.5 - RUN GIVEN) X 2 POINTS</td><td>for ALL PLAYER</td>
                                </tr>
                                <tr>
                                    <td>HAT-TRICK  - 30 POINTS</td><td>for ALL PLAYER</td>
                                </tr>
                            </table>
                        </div>

                        <br>
                        <div style="background-color: red">FIELDING POINTS</div>
                        <div>
                            <table style="font-size: 11px;width: 100%">
                                <tr>
                                    <td width=35%>FOR EACH CATCH - 15 POINTS</td><td width=60%>  for ALL PLAYER</td>
                                </tr>
                                <tr>
                                    <td>FOR EACH RUN-OUT - 15 POINTS</td><td>  for ALL PLAYER</td>
                                </tr>
                            </table>
                        </div>

                        <br>
                        <div style="background-color: red">BONUS POINTS</div>
                        <div>
                            <table style="font-size: 11px;width: 100%">
                                <tr>
                                    <td width=35%>FOR MAN OF THE MATCH - 50 POINTS</td><td width=60%>  for ALL PLAYER</td>
                                </tr>
                                <tr>
                                    <td>FOR WINNING MATCH - 10 POINTS</td><td>  for ALL PLAYER</td>
                                </tr>
                            </table>
                        </div>

                    </div>


                    <a href="#" class="header">TEST</a>
                    <div>
                        <div style="background-color: red">BATTING POINTS</div>
                        <div>
                            <table style="font-size: 11px;width: 100%">
                                <tr style="color:red">
                                    <td colspan="2">CORE POINT SYSTEM</td>
                                </tr>
                                <tr>
                                    <td width=35%>1 RUN = 1 POINT</td><td width=60%>for ALL PLAYER </td>
                                </tr>
                                <tr>
                                    <td>1 SIX  = 8 POINTS</td><td>for ALL PLAYER </td>
                                </tr>
                                <tr>
                                    <td>5 BALLS PLAYED  = 1 POINT</td><td>for ALL PLAYER</td>
                                </tr>
                                <tr style="color:red">
                                    <td colspan="2">POWER BOOSTER</td>
                                </tr>
                                <tr>
                                    <td>FOR EVERY 25 RUNS = 10 POINTS</td><td>for ALL PLAYER </td>
                                </tr>
                                <tr>
                                    <td>(RUNS X 1.5 - BALLS PLAYED) POINTS</td><td>for ALL PLAYER</td>
                                </tr>
                                <tr>
                                    <td>-30 POINTS FOR OUT ON '0'</td><td>for player clasified as BATSMAN,WICKET-KEEPER OR ALL-ROUNDER</td>
                                </tr>
                            </table>
                        </div>
                        <br>
                        <div style="background-color: red">BOWLING POINTS</div>
                        <div>
                            <table style="font-size: 11px;width: 100%">
                                <tr style="color:red">
                                    <td colspan="2">CORE POINT SYSTEM</td>
                                </tr>
                                <tr>
                                    <td width=35%>1 EACH WKT = 25 POINTS</td><td width=60%>for player clasified as BOWLER OR ALL-ROUNDER </td>
                                </tr>
                                <tr>
                                    <td>1 EACH WKT = 35 POINTS</td><td>for player clasified as BATSMAN </td>
                                </tr>
                                <tr>
                                    <td>1 OVER BOWLED - 2 POINTS</td><td>for ALL PLAYER </td>
                                </tr>
                                <tr style="color:red">
                                    <td colspan="2">POWER BOOSTER</td>
                                </tr>
                                <tr>
                                    <td>FOR 3 WKTs HAUL - 30 POINTS<br>FOR 5 WKTs HAUL - 45 POINTS<br>FOR 7 WKTs HAUL or ABOVE  - 55 POINTS</td><td>for ALL PLAYER </td>
                                </tr>
                                <tr>
                                    <td>(BALL BOWLED - RUN GIVEN) POINTS</td><td>for ALL PLAYER</td>
                                </tr>
                                <tr>
                                    <td>HAT-TRICK  - 30 POINTS</td><td>for ALL PLAYER</td>
                                </tr>
                            </table>
                        </div>

                        <br>
                        <div style="background-color: red">FIELDING POINTS</div>
                        <div>
                            <table style="font-size: 11px;width: 100%">
                                <tr>
                                    <td width=35%>FOR EACH CATCH - 15 POINTS</td><td width=60%>  for ALL PLAYER</td>
                                </tr>
                                <tr>
                                    <td>FOR EACH RUN-OUT - 15 POINTS</td><td>  for ALL PLAYER</td>
                                </tr>
                            </table>
                        </div>

                        <br>
                        <div style="background-color: red">BONUS POINTS</div>
                        <div>
                            <table style="font-size: 11px;width: 100%">
                                <tr>
                                    <td width=35%>FOR MAN OF THE MATCH - 100 POINTS</td><td width=60%>  for ALL PLAYER</td>
                                </tr>
                                <tr>
                                    <td>FOR WINNING MATCH - 15 POINTS</td><td>  for ALL PLAYER</td>
                                </tr>
                            </table>
                        </div>

                    </div>
                </div>

            </div>

            <!--************************   FAQs  **********************************-->
            <div id="dialog3" class="window">
                FREQUENTLY ASKED QUESTIONS

                <a href="#" class="close">
                    <img src="photos/ModelClose.png" alt="close" style="position: absolute;left:725px;top:5px;" height="20px" left="20px">
                </a>

                <div class="content" style="position: absolute;left:15px;top:45px;height: 550px;">
                    <a href="#" class="faq-content-header">Can I have more than one team?</a>
                    <div class="content-content">
                        Each person may only enter one team. You may enter this team in multiple leagues and compete against different groups of friends.
                    </div>

                    <a href="#" class="faq-content-header">Can I make transfers to my team after entering the series?</a>
                    <div class="content-content">
                        Yes, unlimited free transfers can be made before the next deadline.
                        but after that your transfers count will decrease for each transfers.
                    </div>

                    <a href="#" class="faq-content-header">What player formation can I play in?</a>
                    <div class="content-content">
                        Your team should have 4-5 batsman 1 wicket-keeper 1-2 all-rounder 3-4 bowlers.  
                    </div>

                    <a href="#" class="faq-content-header">When can I make captain changes?</a>
                    <div class="content-content">
                        Captain changes are unlimited throughout the series and can therefore be changed prior to the scheduled start time of every single match.
                    </div>

					<a href="#" class="faq-content-header">When do points get updated?</a>
                    <div class="content-content">
                        Points get updated 1hour after completion of match or if there are two matches on the same day then first match point's will be updated after start of 2nd match and 2nd match point's will be updated 1 hour after completion. 
                    </div>
					
                    <a href="#" class="faq-content-header">What is team name use for?</a>
                    <div class="content-content">
                        Team name is name of your team.  Which is use in case of 2 or more manager are on same points at the end of series then which ever managers team name is more attractive will be awarded a prize. Decision will be made by fantasycricleague.com.
                    </div>

					<a href="#" class="faq-content-header">When can I make transfers?</a>
                    <div class="content-content">
                        Anytime when the site is not updating.
                    </div>
					
					<a href="#" class="faq-content-header">Can I make transfers after I finished my all available transfers for that series? </a>
                    <div class="content-content">
                        Yes, but for each transfers 100 points will be deducted from you total points, which may effect your rankings.
                    </div>
                    
                    <a href="#" class="faq-content-header">When is my team locked?</a>
                    <div class="content-content">
                        Your team will be locked as soon as match starts. Any changes/transfers made to your team after that will be considered for the next match. <br>
			i.e. if match time between any two team is 06:30 pm then your team will be lock at 06:30 pm. <br>
			In case of delayed start because of rain or for any other reason lock time will be scheduled match time. So you have to make your team before schedule time of match.

                    </div>

                    <a href="#" class="faq-content-header">Can I create a public league?</a>
                    <div class="content-content">
                        No, you can't. For each series, fantasycricleague.com will create  public league's for the fans of every team that will be participating in the tournament.
                        Users can join any of the public leagues that have been created.
                        After joining a public league your team name and rank will appear in the league leaderboard only after the scores for the next gameday have been updated.
                    </div>

                    <a href="#" class="faq-content-header">How many leagues can I join?</a>
                    <div class="content-content">
                        There is no restriction on the number of private leagues and public league you can join. But you can only join a private league if you know league name and league code.
                    </div>

                    <a href="#" class="faq-content-header">Can I create a league of my own?</a>
                    <div class="content-content">
                        Yes, you can create unlimited private league of your own.
                    </div>

                    <a href="#" class="faq-content-header">How many transfers can I make in QUICK PLAY?</a>
                    <div class="content-content">
                       Unlimited.
                    </div>

                    <a href="#" class="faq-content-header">How much budget I get for QUICK PLAY?</a>
                    <div class="content-content">
                       In QUICK PLAY you don't have any limit on the budget or no of transfers but the lower the budget better your points. Precisely:
                       <br>
                       For each 1 million $ that you save from 100 million $ you get additional 10 points.
                       <br>
                       For each 1 million $ you use more than 100 million $, 10 points are deduced from your score.
                    </div>
                </div>
            </div>





            
            <!--************************   RULES (DYNAMIC RULES FOR DIFFERENT FOR SERIES)  **********************************-->
            <div id="dialog5" class="window">
                <a href="#" class="close">
                    <img src="photos/ModelClose.png" alt="close" style="position: absolute;left:725px;top:5px;" height="20px" left="20px">
                </a>
                <div style="position: absolute;left:15px;top:15px;">
                    <?php
                        include 'seriesRULSEandPRIZE/s' . $seriesId . 'Rules.html';
                    ?>
                </div>
            </div>


            <!--************************   PRIZES (STATIC) **********************************-->
            <div id="dialog4" class="window">
                <a href="#" class="close">
                    <img src="photos/ModelClose.png" alt="close" style="position: absolute;left:725px;top:5px;" height="20px" left="20px">
                </a>
                <div>
                    <?php
                        include 'seriesRULSEandPRIZE/s' . $seriesId . 'Prizes.html';
                    ?>
                </div>

            </div>



            <!--************************   PRIZES (DYNAMIC) **********************************-->
            <div id="dialog4" class="window">
                <a href="#" class="close">
                    <img src="photos/ModelClose.png" alt="close" style="position: absolute;left:725px;top:5px;" height="20px" left="20px">
                </a>
                <div style="position: absolute;left:15px;top:15px;">
                    <?php
                    include 'seriesRULSEandPRIZE/s' . $seriesId . 'Prizes.html';
                    ?>
                </div>
            </div>


        </div>
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/jquery-ui.js"></script>
        <script type="text/javascript" src="js/modal.js"></script>
        <script type="text/javascript" src="js/modal-ui.js"></script>
        <script type="text/javascript" src="PHP/includes/js/Sub_Menu.js"></script>

    </body>
</html>
