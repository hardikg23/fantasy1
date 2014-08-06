<link rel="stylesheet" type="text/css" href="PHP/includes/css/userData-private-public-league.css">
<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

       $tableUserEleven='s'.$seriesId.'_user_eleven_data';
       $fname="";$lname="";$userTeamName="-";$userCountry="-";$userPoints="-";$transfer_left="-";$rank="-";
           

       if(@$ResultSet_of_userData=mysql_query("SELECT u.first_name,u.last_name,u.user_team_name,u.user_country,s.user_points,s.transfer_left
                                               from users_data u
                                               INNER JOIN $tableUserEleven s
                                               on u.user_email=s.user_email
                                               WHERE u.user_email='$session_email'"))
           {
                if(mysql_num_rows($ResultSet_of_userData) == 1)
                {
                    $datetime=date("Y-m-d H:i:s");
                    $transfer_schema='s'.$seriesId.'_transfer_schema';
                    $fname=mysql_real_escape_string(mysql_result($ResultSet_of_userData, 0,'first_name'));
                    $lname=mysql_real_escape_string(mysql_result($ResultSet_of_userData, 0,'last_name'));
                    $userTeamName=mysql_real_escape_string(mysql_result($ResultSet_of_userData, 0,'user_team_name'));
                    $userCountry=mysql_real_escape_string(mysql_result($ResultSet_of_userData, 0,'user_country'));
                    $userPoints=mysql_real_escape_string(mysql_result($ResultSet_of_userData, 0,'user_points'));
                    $transfer_left=mysql_real_escape_string(mysql_result($ResultSet_of_userData, 0,'transfer_left'));
		    $dpImage="photos/dp/defult.jpg";
                    if(@$result_transfer_String=  mysql_query("SELECT tLeftString from
                                  $transfer_schema where '$datetime'<=toDate ORDER by toDate LIMIT 1"))
                    {
                        $transferString=mysql_real_escape_string(mysql_result($result_transfer_String, 0));
                        if($transferString == 'UNLIMITED')
                           $transfer_left="&#8734;";
                    }
                    if($userPoints != 0)
                    {
                    $result_to_find_rank=mysql_query("SELECT count(TID) FROM $tableUserEleven
                                                    WHERE user_points > $userPoints");
                    $rank=mysql_real_escape_string(mysql_result($result_to_find_rank, 0,0))+1;
			if($rank <= 3) {
                		$dpImage="photos/dp/top3-dp.jpg";
            		}else if($rank <= 100) {
                		$dpImage="photos/dp/top100-dp.jpg";
            		}
                    }
              ?>
                  <div>
                    <div class="user-data-manager font-containt-bold">&nbsp;&nbsp;MANAGER: <?php echo $fname." ".$lname; ?></div>
                        <div><img src="<?php echo $dpImage;?>" width="70" height="85" style="position: absolute;left:5px;top:40px"></div>
                        <div style="position: absolute;left: 80px;top:30px;width: 140px">
                            <table class="user-data-table" style="font-size: 11px">
                            <tr style="height: 20px;">
                                <td style="font-size: 14px">RANK: <font class="user-data-rank font-containt-bold"><?php echo $rank; ?></font></td>
                            </tr>
                            <tr style="height: 15px;">
                                <td>POINTS: <font style='font-size:14px;' class="font-containt-bold"><?php echo $userPoints; ?></font></td>
                            </tr>
                            <tr style="height:15px;">
                                <td>TRANSFERS: <font style='font-size:14px;' class="font-containt-bold"><?php echo $transfer_left; ?></font></td>
                            </tr>
                            <tr style="height: 15px;">
                                <td>COUNTRY: <font style='font-size:14px;' class="font-containt-bold"><?php echo $userCountry; ?></font></td>
                            </tr>
                        </table>
                        </div>
                </div>
                    
          <?php
                }else
                {
                    echo '<div class="font-containt"><center>All data will be displayed after you submit your team<center></div>';
                }
           }else
           {
               echo '<center>ERROR</center>';
           }

?>
