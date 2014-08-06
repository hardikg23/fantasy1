<?php
    session_start();
    $_SESSION['username']="harik";
    $_SESSION['email']="hardikg23@gmail.com";
    $_SESSION['password']="123456789";
    $_SESSION['country']="India";
    header("Location: ../ManageTeam.php");
?>
