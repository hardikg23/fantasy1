<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include 'includes/database_connectivity_includes.php';
session_start();
include 'includes/session_setter.php';
include 'includes/seriedId_setter.php';
$s = 's'.$seriesId .'_player_data';
if (isset($_POST['teamname']))
    {
        if (!empty($_POST['teamname']))
         {
            $teamName=mysql_real_escape_string(htmlentities($_POST['teamname']));
            mysql_query("UPDATE users_data SET `user_team_name`='$teamName' where user_email = '$session_email'");
         }
    }

?>
