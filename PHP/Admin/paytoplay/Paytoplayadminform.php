<?php
@session_start();

if (isset($_SESSION['setadminpassword']) && isset($_SESSION['setdatabasepassword'])) {
    ?>

<html>
    <head>
        
    </head>
    <body>
        
        <form action="Paytoplayadmin.php" method="post">
           SeriesID <input type="text" name="sid"><br>
           MatchID <input type="text" name="mid"><br>
            <input type="submit" value="Update">
        </form>
        
    </body>
</html>
  <?php
} else {
    header('Location: ../AdminLoginAuthentication.php');
}
?>