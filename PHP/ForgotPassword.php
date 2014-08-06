<?php
        include 'includes/database_connectivity_includes.php';
        $result1='';
        if(isset($_POST['input1']))
        {
            $email=mysql_real_escape_string($_POST['input1']);
        }
        $query="select user_name,first_name,last_name, user_email from users_data where user_email='$email'";
        $result=mysql_query($query) or die(mysql_error());
        $no_rows= mysql_num_rows($result);

        if($no_rows==0)
        {
            echo 'NOTHING';
        }
        else if($no_rows==1)
        {

            while($row=mysql_fetch_array($result))
            {
                $u_name=mysql_real_escape_string($row['user_name']);
                $f_name=mysql_real_escape_string($row['first_name']);
                $l_name=mysql_real_escape_string($row['last_name']);
                $useremail=mysql_real_escape_string($row['user_email']);
                $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
                $pass = array();
                $alphaLength = strlen($alphabet) - 1;
                for ($i = 0; $i < 10; $i++) {
                    $n = rand(0, $alphaLength);
                    $pass[] = $alphabet[$n];
                    $newpassword=implode($pass);

                }
                $pswrd=$newpassword;
                $salt = uniqid(mt_rand(), true);
                $salt = substr($salt, 0, 32);
                $pswrd = substr($salt, 0, 16) . $pswrd . substr($salt, 16, 16);
                $pswrd = hash("sha256", $pswrd);
                $pswrd = hash("sha256", $pswrd);
                $query_insert = "Update users_data SET user_password = '$pswrd', user_password_salt='$salt' where user_email='$email'";
                    if (@$query_insert_run = mysql_query($query_insert)) { // insert user
                        $result1='success';
                        $headers = "From:  <no-reply@fantasycricleague.com>";
                        $message = "Hello, $f_name $l_name \n";
                        $message .="Your Account Password has been changed successfully";
                        $message .= "\n\n\n";
                        $message .= "YOU USER NAME : $u_name \n";
                        $message .= "YOU EMAIL ADDREDD : $email \n";
                        $message .= "YOU NEW PASSWORD : $newpassword \n";
                        mail($email, 'Changed Password', $message,$headers);
                        echo "New password is set and sent to you on your email address.";

                    }
                    else{
                        echo 'Something went wrong. Please try again later.';
                    }

            }

        }


?>
