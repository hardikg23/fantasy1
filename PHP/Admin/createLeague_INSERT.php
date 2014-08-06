<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
        include 'includes/database_connectivity_includes.php';
        @session_start();

        include 'includes/session_setter.php';
        include 'includes/seriedId_setter.php';
        $createLeagueName;$createLeagueCode;
        $joinLeagueName;$joinLeagueCode;
        $codeTable='s'.$seriesId.'_league_code';
        $memberTable='s'.$seriesId.'_league_member';
        if(isset ($_POST['cname']) && isset($_POST['ccode']))
        {
            if(!empty ($_POST['cname']) && !empty ($_POST['ccode']))
            {
                $createLeagueName=mysql_real_escape_string(htmlentities($_POST['cname']));
                $createLeagueCode=mysql_real_escape_string(htmlentities($_POST['ccode']));
                $leagueID=rand(1000,99999999);
                if(mysql_query("INSERT INTO $codeTable values ('$leagueID','$createLeagueName','$createLeagueCode','$session_email',1)"))
                {
                    if(mysql_query("INSERT INTO $memberTable values ('$leagueID','$session_email')"))
                     {
                        echo 'League Created.';
                     }
                     else
                     {
                         echo 'Something went wrong';
                     }
                }else {
                    echo 'League Name is already in Use';
                }
            }
            else
            {
                echo 'League Name Or Code is less then 5 Character';
            }
        }else if(isset ($_POST['jname']) && isset($_POST['jcode']))
        {
            if(!empty ($_POST['jname']) && !empty ($_POST['jcode']))
            {
                $joinLeagueName=mysql_real_escape_string(htmlentities($_POST['jname']));
                $joinLeagueCode=mysql_real_escape_string(htmlentities($_POST['jcode']));
                $resultSer_find_LeagueId=mysql_query("SELECT leagueID from $codeTable where leagueName = '$joinLeagueName'");
                if(mysql_num_rows($resultSer_find_LeagueId)==1)
                {
                     $LeagueID=mysql_real_escape_string(htmlentities(mysql_result($resultSer_find_LeagueId, 0, 'leagueID')));
                     if(mysql_query("INSERT INTO $memberTable values ('$LeagueID','$session_email')"))
                     {
                         mysql_query("UPDATE $codeTable
                                        SET members=members+1
                                        where leagueID=$LeagueID");
                        echo 'Joined League.';
                        
                     }
                     else
                     {
                         echo 'You Already in Group OR Something went wrong';
                     }
                     
                }
                else
                {
                    echo 'No League Name with '.$joinLeagueName;

                }
             }
            else
            {
                echo 'League Name Or Code is less then 5 Character';

            }
        }else{
            echo 'Error occured';
        }
?>
