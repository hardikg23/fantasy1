<?php

include 'PHP/includes/database_connectivity_includes.php';
$psward = 'aniketpagal';
$email = 'am@gmail.com';
$result = mysql_query("select user_password, user_password_salt from users_data_temp where user_email='$email'");
$salt = mysql_result($result, 0,1);
$ogpwd = mysql_result($result, 0,0);
$psward = substr($salt, 0, 16) . $psward . substr($salt, 16, 16);
$psward = hash("sha256", $psward);
$psward = hash("sha256", $psward);

echo "$salt <br/>";
echo "$psward <br/> $ogpwd <br/>";

if($psward == $ogpwd){
    echo "I am a disco dancer!!";
}

?>
