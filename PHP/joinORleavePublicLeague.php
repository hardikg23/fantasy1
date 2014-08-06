<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
        include 'includes/database_connectivity_includes.php';
        //$database = 'fantasy';
        //mysql_select_db($database);
        session_start();

        include 'includes/session_setter.php';
        include 'includes/seriedId_setter.php';
        $codeTable='s'.$seriesId.'_public_league_code';
        $memberTable='s'.$seriesId.'_public_league_member';
        if(isset ($_POST['action']) && isset($_POST['leagueID']))
        {
            if(!empty ($_POST['action']) && !empty ($_POST['leagueID']))
            {
                $action=mysql_real_escape_string(htmlentities($_POST['action']));
                $leagueID=mysql_real_escape_string(htmlentities($_POST['leagueID']));
                if($action == 'join')
                {
                     if(mysql_query("INSERT INTO $memberTable values ('$leagueID','$session_email')"))
                     {
                        if(mysql_query("UPDATE $codeTable SET members=members+1 where leagueID=$leagueID"))
                         {echo "JOINED IN LEAGUE";}
                     }
                }
                else if($action == 'leave')
                {
                    if(mysql_query("DELETE FROM $memberTable WHERE user_email='$session_email' AND leagueID=$leagueID"))
                     {
                        if(mysql_query("UPDATE $codeTable SET members=members-1 where leagueID=$leagueID"))
                         {echo "REMOVED FROM LEAGUE";}
                     }

                }else
                {
                    echo 'SOME ERROR OCCURED';
                }

            }
        }
?>
