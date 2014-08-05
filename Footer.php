
<?php
    include 'PHP/includes/seriedId_setter.php';
   //echo $seriesId;
?>
<html>
	<head>
		<title>
			FOOTER
		</title>
            <link rel="stylesheet" type="text/css" href="css/footer.css">
	</head>
        <body>
         <div id="footer-container" align="center" style="position: absolute;left: 176px;top:1175px;width: 1000px;height: 300px;color: white;">
             <img src="photos/footer/footer-bg.jpg" style="position:absolute;left: -8px;top:0px;width: 1016px;height: 130%;" >
             <div class="tags">
                 <div style="position: absolute;left: 0px;">#feelLike<font style="color: white;font-family: AR JULIAN;">OWNER</font></div>
                
                 <div style="position: absolute;left: 400px;"><font style="color: white;font-family: AR JULIAN;">THANK YOU!</font></div>
                
                 <div style="position: absolute;left:780px;"> #playLike<font style="font-family: AR JULIAN;color: white;">OWNER</font></div>
             </div>

             <table width="95%" style="position: absolute;top:85px;color: white" >
                 <tr style="">
                    <td width='5%'></td>
                    <td width='15%'>
                       <div class="main-item">SITE MAP</div>
                       <div class="sub-item">
                           <div><?php echo "<a href='ManageTeam.php?seriesId=$seriesId'>"; ?><font style="color: white;">MANAGE TEAM</font></a></div>
                           <div><?php echo "<a href='PointHistory.php?seriesId=$seriesId'>"; ?><font style="color: white;">VIEW POINTS</font></a></div>
                           <div><?php echo "<a href='League.php?seriesId=$seriesId'>"; ?><font style="color: white;">LEAGUE</font></a></div>
                           <div><?php echo "<a href='Leaderboard.php?seriesId=$seriesId'>"; ?><font style="color: white;">LEADERBOARD</font></a></div>
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
                        <div class="main-item"><?php echo "<a href='T&C.php?seriesId=$seriesId'>"; ?><font style="color: white;">TERMS&CONDITIONS</font></a></div>
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

		<div style="position: absolute;left: 15px;width: 728px;height: 90px;top: 250px;">
		 		
					
		<!-- START CLIENT.YESADVERTISING CODE -->
		<script language="javascript" type="text/javascript" charset="utf-8">
		cpxcenter_width = 728;
		cpxcenter_height = 90;
		</script>
		<script language="JavaScript" type="text/javascript" src="http://ads.cpxcenter.com/cpxcenter/showAd.php?nid=4&amp;zone=57881&amp;type=banner&amp;sid=42856&amp;pid=40382&amp;subid=">
		</script>
		<!-- END CLIENT.YESADVERTISING CODE -->
     		
		</div>


            	<div style="position: absolute;left: 20px;top: 355px;font-family: Lao UI;font-size: 10px;color: #ACA3A3">
                	SEND FEEDBACK : feedback@fantasycricleague.com &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  |
               		 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TECHNICAL PROBLEM : support@fantasycricleague.com
            	</div>


            </div>
	</body>
</html>