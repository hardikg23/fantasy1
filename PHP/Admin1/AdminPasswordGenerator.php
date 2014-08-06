<?php
    $password1='sgp5@5HOR9#1EAI8$3dyt';
    $password='ahj135985tka';
    $mainpassword=$password;
    $salt = uniqid(mt_rand(), true);
    $salt = substr($salt, 0, 32);
    
    echo $salt.'<br/>';
    $password = substr($salt, 0, 16) . $password . substr($salt, 16, 16);
    $password = hash("sha256", $password);
    $password = hash("sha256", $password);
    echo $mainpassword.'<br/>';
    echo $password.'<br/>';
    //echo strlen($password).'<br/>';
    
?>
