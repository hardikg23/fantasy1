<?php
    session_start();
    $_SESSION['username']="Ronak";
    $_SESSION['email']="jitendraprajapati971@gmail.com";
    $_SESSION['password']="123456789";
    $_SESSION['country']="India";
    header("Location: ../../ManageTeam.php");
?>
