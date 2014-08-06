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
if (isset($_POST['input1']) && isset($_POST['input2']))
    {
        if (!empty($_POST['input1']) && !empty($_POST['input2']))
         {
            $playerIN=  mysql_real_escape_string(htmlentities($_POST['input1']));
            $playerOUT=  mysql_real_escape_string(htmlentities($_POST['input2']));

            $playerIN=str_replace("#@#",",",$playerIN);
            $playerOUT=str_replace("#@#",",",$playerOUT);
            mysql_query("UPDATE $s SET selectedBy=selectedBy+1 where id IN ( $playerIN )");
            mysql_query("UPDATE $s SET selectedBy=selectedBy-1 where id IN ( $playerOUT )");
         }
    }
?>
