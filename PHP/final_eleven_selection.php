<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
        include 'includes/database_connectivity_includes.php';
        //$database='fantasy';
        //mysql_select_db($database);
        session_start();

        include 'includes/session_setter.php';
        include 'includes/seriedId_setter.php';

        if(isset ($_POST['item1']) && isset ($_POST['item2']) && isset ($_POST['item3'])
              && isset ($_POST['item4']) && isset ($_POST['item5']) )
        {
            echo 'set';

        }
        else
            {
                echo 'Take from database and diplay it in table form';
            }
?>
