<?php
$mysql_host='localhost';
$mysql_user='root';
$mysql_pass='';
$conn_error='Could not connect';
date_default_timezone_set('Asia/Kolkata');
if(!@mysql_connect($mysql_host, $mysql_user, $mysql_pass))
             die($conn_error);

$database='fantasy';
if(mysql_select_db($database))
{
}
else
{
    echo 'cants connect to database';
}
?>
