<?php
@session_start();
if(isset($_SESSION['setadminpassword'])&&isset($_SESSION['setdatabasepassword'])) {
?>
<html>
    <head>

    </head>
    <body>
        <form name="form" method="post" action="updateMatchPoints2.php">
            Enter series id :<input type="text" name="seriesId" ><br><br>
            Enter Match id :<input type="text" name="matchId">

            <select name="matchType">
                <option value="ODI">ODI</option>
                <option value="T20">T20</option>
                <option value="TEST">TEST</option>

            </select>

            <input type="submit" value="UPDATE">
            <a href="adminlogout.php" >Logout</a>
        </form>
    </body>
</html>

    <?php
}
else {
    header('Location: AdminLoginAuthentication.php');
}

?>