<?php


include 'includes/database_connectivity_includes.php';
//$database='fantasy';
//mysql_select_db($database);
session_start();

include 'includes/session_setter.php';
include 'includes/seriedId_setter.php';
$old_email=$_SESSION['email'];
    if (isset($_POST['input1']))
    {
        if (!empty($_POST['input1']))
        {
            $new_email=  mysql_real_escape_string(htmlentities($_POST['input1']));         
            $query_email_change="Update users_data SET user_email='$new_email' where user_email='$old_email'";
            mysql_query($query_email_change)or die(mysql_error());
            $_SESSION['email']=$new_email;
            echo 'Sucessfully old email id has been changed.......';
        }
           
    }
    else if(isset($_POST['input2'])&&isset($_POST['input3']))
    {
        if (!empty($_POST['input2'])&&!empty($_POST['input3']))
        {
            $old_pass=  mysql_real_escape_string(htmlentities($_POST['input2']));
            $new_pass=  mysql_real_escape_string(htmlentities($_POST['input3']));
            $query="select user_password from users_data where user_email='$old_email'";
            $result=mysql_query($query) or die(mysql_error());
            while($row=mysql_fetch_array($result))
            {
                $password=mysql_real_escape_string($row['user_password']);
                if($password==$old_pass)
                {
                    $query_email_change="Update users_data SET user_password='$new_pass' where user_email='$old_email' AND user_password='$old_pass'";
                    mysql_query($query_email_change)or die(mysql_error());
                    //$_SESSION['email']=$new_email;
                    echo 'Success';
                }
                else 
                {
                    echo 'WrongPass';
                }
            }

        }
    }
    else if(isset($_POST['input4'])&&isset($_POST['input5'])&&isset($_POST['input6']))
    {
        if (!empty($_POST['input4'])&&!empty($_POST['input5'])&&!empty($_POST['input6']))
        {
            $new_email=  mysql_real_escape_string(htmlentities($_POST['input4']));
            $old_pass=  mysql_real_escape_string(htmlentities($_POST['input5']));
            $new_pass=  mysql_real_escape_string(htmlentities($_POST['input6']));
            $query="select user_password from users_data where user_email='$old_email'";
            $result=mysql_query($query) or die(mysql_error());
            while($row=mysql_fetch_array($result))
            {
                $password=mysql_real_escape_string($row['user_password']);
                if($password==$old_pass)
                {
                    $query_email_change="Update users_data SET user_email='$new_email', user_password='$new_pass' where user_email='$old_email' AND user_password='$old_pass'";
                    mysql_query($query_email_change)or die(mysql_error());
                    $_SESSION['email']=$new_email;
                    echo 'Success';
                }
                else 
                {
                    echo 'WrongPass';
                }
            }
        }
    }

?>
