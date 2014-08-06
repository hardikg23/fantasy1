<?php
@session_start();
include 'session_setter.php';
include 'database_connectivity_includes.php';
if(isset($_POST['old']) && isset($_POST['new1']) && isset($_POST['new2'])) {
    if(!empty($_POST['old']) && !empty($_POST['new1']) && !empty($_POST['new2'])) {
        $psward=mysql_real_escape_string(htmlentities($_POST['old']));
        $new1=mysql_real_escape_string(htmlentities($_POST['new1']));
        $new2=mysql_real_escape_string(htmlentities($_POST['new2']));

        if($result_to_get_salt=mysql_query("SELECT user_password,user_password_salt from users_data where user_email='$session_email'")) {

            if(mysql_num_rows($result_to_get_salt)==1) {
                $oldPassword=mysql_real_escape_string(mysql_result($result_to_get_salt, 0,0));
                $salt=mysql_real_escape_string(mysql_result($result_to_get_salt, 0,1));
            }

        }
        $psward = substr($salt, 0, 16) . $psward . substr($salt, 16, 16);
        $psward = hash("sha256", $psward);
        $psward = hash("sha256", $psward);

        if($oldPassword != $psward) {
           echo 'Old Password not matching!';
        }
        else if($new1 != $new2) {
            echo 'New password and confirm password not matching';
        }
        else {
                $new1 = substr($salt, 0, 16) . $new1 . substr($salt, 16, 16);
                $new1 = hash("sha256", $new1);
                $new1 = hash("sha256", $new1);

                if(mysql_query("UPDATE users_data SET user_password='$new1' where user_email='$session_email'")) {
                echo '<font style="color:green">Password updated</font>';
            }else {
                echo 'Error';
            }
        }
    }
}

?>
