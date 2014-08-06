<?php
include '../includes/database_connectivity_includes.php';
$query = mysql_query("SELECT user_email, first_name, last_name
from users_data where user_id >499 LIMIT 500;");
/*$query = mysql_query("SELECT user_email, first_name, last_name
from users_data where user_email='hardikg23@gmail.com'");*/
while ($row = mysql_fetch_array($query)) {


    $email=  mysql_real_escape_string($row['user_email']);
    $f_name=  mysql_real_escape_string($row['first_name']);
    $l_name=  mysql_real_escape_string($row['last_name']);

    $message='';

    $message .= "<div style='color:#666666;font-size:12px;font-family: Lao UI;'>
            Hello, <b>$f_name $l_name</b>  <br>
         Greetings from the Fantasy team! <br><br>";

    $message .= "<a href='http://www.predictfox.com/'><img src='http://www.fantasycricleague.com/fantasy/images/mail2.png' width='550px' height='400px'></a>  <br><br>";

    $message .="New website for football lovers...
        <a href='http://www.predictfox.com/'>www.predictfox.com</a>
    just predict the outcome of the currant match & if your  prediction turns out 2 be correct...
    u gain valuable pts.
    <br><br>
    Football aficionados will totally love it....
    so have a look fast...<br><br>";
    $message .= "<br><br><br><br>";


    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
    $headers .= "From:  <no-reply@fantasycricleague.com>";
    if(mail($email, 'FIFA PREDICTION', $message, $headers))
        echo "EMAIL SEND TO  :  $email  <br>";

}
?>
