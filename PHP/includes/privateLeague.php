<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<?php

                    $leagueMember='s'.$seriesId.'_league_member';
                    $leagueCode='s'.$seriesId.'_league_code';
                    $userTable='s'.$seriesId.'_user_eleven_data';
                    if(@$resultSet_league_data=mysql_query("select c.leagueID,c.leagueName,c.members
                              from $leagueMember l INNER JOIN $leagueCode c on l.leagueID=c.leagueID where user_email='$session_email'"))
                    {
                        if(mysql_num_rows($resultSet_league_data)>0) {
                        echo '<table class="private-league-table">';
                        echo '<tr>';
                        echo '<th width="60%">NAME</th><th width="20%">MEM</th><th width="20%">RANK</th>';
                        echo '</tr>';
                        while($row=mysql_fetch_array($resultSet_league_data)) {
                            $LeagueID=mysql_real_escape_string($row[0]);
                            $LeagueName=mysql_real_escape_string($row[1]);
                            $member=mysql_real_escape_string($row[2]);
                            $query_to_find_rank="SELECT count(s.user_email) FROM $leagueMember s
                                        INNER JOIN $userTable u on s.user_email=u.user_email
                                        where u.user_points > (select user_points from $userTable
                                         where user_email='$session_email') AND leagueID = $LeagueID";
                            $resultSet_to_find_rank=mysql_query($query_to_find_rank);
                            $rankPlayer=mysql_result($resultSet_to_find_rank, 0,0);
                            $rank=$rankPlayer+1;

                            echo '<tr>';
                            echo "<td class='private-league-table-a'><a href=League.php?seriesId=$seriesId&lid=$LeagueID>$LeagueName</a></td>
                                    <td>$member</td>
                                    <td>$rank</td>";
                            echo '</tr>';
                        }
                        echo '</table>';
                    }else {
                        echo '<center>No League Data</center>';

                    }
                }else
                    {
                        echo '<center>Some Errored Occured while retriving Your league data</center>';
                    }

?>