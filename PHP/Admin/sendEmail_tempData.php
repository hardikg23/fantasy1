<?php
include '../includes/database_connectivity_includes.php';
$query = mysql_query("select activation_key, user_email, first_name, last_name from users_data_temp where `date_join` > '2014-04-06 00:00:00'");
$ind=1;
while ($row = mysql_fetch_array($query)) {
    $activation=  mysql_real_escape_string($row['activation_key']);
    $email=  mysql_real_escape_string($row['user_email']);
    $f_name=  mysql_real_escape_string($row['first_name']);
    $l_name=  mysql_real_escape_string($row['last_name']);
    echo "$ind EMAIL SEND TO  :  $email  <br>";
    $headers = "From:  <no-reply@fantasycricleague.com>";
    $message = "Hello, $f_name $l_name \n";
    $message .="Your account need's to be activated in order for you to be able to log in into http://www.fantasycricleague.com/ \n\n";
    $message .="The activation email has been sent to you and it might have gone inside your promotions tab or inside the Spam folder. \n\n";
    $message .= "http://www.fantasycricleague.com/fantasy/activate.php?email=" . urlencode($email) . "&key=$activation";
    $message .= "\n\n\n";
    mail($email, 'Registration Confirmation', $message, $headers);

    $ind++;
}
?>
