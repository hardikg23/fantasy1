<?php
@session_start();

if (isset($_SESSION['setadminpassword']) && isset($_SESSION['setdatabasepassword']) || TRUE) {
    ?>
<html>
    <head>
    </head>
    <body>
        <form action="viewUsersTransactionHistory.php" method="post">
            EMAILID= <input type="text" name="email"><br>
            <input type="submit" value="Update">
        </form>
    </body>
</html>
    <?php

    if(isset ($_POST['email']) && !empty ($_POST['email'])) {
        $email = mysql_real_escape_string($_POST['email']);

        $query = "SELECT `Amount`,`TimeAndDate`,`oldBalance`,`newBalance`,`transacrtionID`
                    FROM  depositehistory
                    where `user_email` = '$email'
                    UNION
                    SELECT `Amount`,`TimeAndDate`,`oldBalance`,`newBalance`,`Mobileno`
                    FROM withdrawhistory
                    where `user_email` = '$email'";
        if($result = mysql_query($query)){
            
            echo '<table>';
                while ($row = mysql_fetch_array($result)){
                    $amount=mysql_real_escape_string($row['Amount']);
                    $time = mysql_real_escape_string($row['TimeAndDate']);
                    $oldB=mysql_real_escape_string($row['oldBalance']);
                    $newB=mysql_real_escape_string($row['newBalance']);
                    $tran = mysql_real_escape_string($row[4]);

                    echo "<tr>
                            <td>$amount</td><td>$time</td><td>$oldB</td><td>$newB</td><td>$tran</td>
                        </tr>";
                }
                echo '</table>';
        }else{
            echo 'error';
        }


    }



} else {
    header('Location: ../AdminLoginAuthentication.php');
}
?>