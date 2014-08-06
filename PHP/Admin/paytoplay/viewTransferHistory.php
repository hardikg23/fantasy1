<?php
@session_start();

if (isset($_SESSION['setadminpassword']) && isset($_SESSION['setdatabasepassword'])) {
    include '../../includes/database_connectivity_includes.php';
    ?>
<html>
    <head>

    </head>
    <bodyd>
        <form name="form" method="post" action="viewTransferHistory.php">
            <table width="30%" style="height: 100px;">
                <tr>
                    <td>EMAIL</td>
                </tr>
                <tr>
                    <td><input type="text" name="email"></td>
                </tr>
                <tr>
                    <td><input type="submit" value="ENTER"></td>
                </tr>
            </table>

        </form>
    </body>
</html>

    <?php
    if(isset ($_POST['email']) && !empty($_POST['email'])) {
        $EmailID=mysql_real_escape_string($_POST['email']);

        $query = "SELECT Amount,TimeAndDate,oldBalance,newBalance,transacrtionID FROM  depositehistory where user_email = '$EmailID' UNION
	SELECT Amount,TimeAndDate,oldBalance,newBalance,Mobileno FROM withdrawhistory where user_email = '$EmailID' order by `TimeAndDate`; ";

        if($result = mysql_query ($query)) {
            if(mysql_num_rows($result) > 0) {

                echo '<table border = "1px" width="70%">';
                echo '<tr><th>#</th><th>Time</th><th>OLD BALANCE</th><th>Amonut</th><th>NEW BALANCE</th><th>TYPE</th></tr>';
                $index = 1;
                while ($row = mysql_fetch_array($result)) {
                    $amount = mysql_real_escape_string($row['Amount']);
                    $TimeAndDate = mysql_real_escape_string($row['TimeAndDate']);
                    $oldBalance = mysql_real_escape_string($row['oldBalance']);
                    $newBalance = mysql_real_escape_string($row['newBalance']);
                    $type = mysql_real_escape_string($row[4]);

                    if($oldBalance > $newBalance)
                        $color = 'red';
                    else
                        $color = 'green';

                    echo '<tr>';
                        echo "<td>$index</td>";
                        echo "<td>$TimeAndDate</td>";
                        echo "<td>$oldBalance</td>";
                        echo "<td bgcolor = '$color'>$amount</td>";
                        echo "<td>$newBalance</td>";
                        echo "<td>$type</td>";
                    echo '</tr>';

                    $index++;
                }
                echo '</table>';

            }else {
                echo 'Not data to display';
            }
        }
        else
            echo 'Query not run';
    }


} else {
    header('Location: ../AdminLoginAuthentication.php');
}
?>