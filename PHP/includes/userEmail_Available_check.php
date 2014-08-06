<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
    include 'database_connectivity_includes.php';
    if(isset($_POST['userEmail']) && !empty($_POST['userEmail'])){
        $uEmail=  mysql_real_escape_string(htmlentities($_POST['userEmail']));
       
        if($result_from_users_data=mysql_query("SELECT user_email from users_data where user_email like '$uEmail'"))
        {
            if($result_from_users_temp_data=mysql_query("SELECT user_email from users_data_temp where user_email like '$uEmail'"))
           {
                $row1=  mysql_num_rows($result_from_users_data);
                $row2=  mysql_num_rows($result_from_users_temp_data);
                if($row1 == 1 || $row2 == 1)
                {
                    echo 'Email Address is Already in use!';
                }
           }
            
        }
    }


?>


