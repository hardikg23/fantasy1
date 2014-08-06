<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
    include 'database_connectivity_includes.php';
    if(isset($_POST['userName']) && !empty($_POST['userName'])){
        $uName=  mysql_real_escape_string(htmlentities($_POST['userName']));
       
        if($result_from_users_data=mysql_query("SELECT user_name from users_data where user_name like '$uName'"))
        {
            if($result_from_users_temp_data=mysql_query("SELECT user_name from users_data_temp where user_name like '$uName'"))
           {
                $row1=  mysql_num_rows($result_from_users_data);
                $row2=  mysql_num_rows($result_from_users_temp_data);
                if($row1 == 1 || $row2 > 0)
                {
                    echo 'User Name is not available';
                }
           }
            
        }
    }


?>


