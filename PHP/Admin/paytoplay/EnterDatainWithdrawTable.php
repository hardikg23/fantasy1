<?php
@session_start();

if (isset($_SESSION['setadminpassword']) && isset($_SESSION['setdatabasepassword'])) {
    include '../../includes/database_connectivity_includes.php';
    ?>

<html>
    <head>

    </head>
    <bodyd>
        <form name="form" method="post" action="EnterDatainWithdrawTable.php">
            <table width="30%" style="height: 100px;">
                <tr>
                    <td>TID</td><td>Mobile NO</td><td>EMAIL</td><td>AMOUNT</td><td>TRANx ID</td>
                </tr>
                <tr>
                    <td><input type="text" name="TID"></td>
                    <td><input type="text" name="mobileNo"></td>
                    <td><input type="text" name="email"></td>
                    <td><input type="text" name="amount"></td>
                    <td><input type="text" name="transactionID"></td>
                </tr>
                <tr>
                    <td></td><td><input type="submit" value="ENTER"></td><td></td><td></td>
                </tr>
            </table>

        </form>
    </body>
</html>
    <?php
    if(isset ($_POST['TID']) && isset ($_POST['mobileNo']) && isset ($_POST['email']) && isset ($_POST['amount'])  && isset ($_POST['transactionID'])) {
        if(!empty ($_POST['TID']) && !empty ($_POST['mobileNo']) && !empty($_POST['email']) && isset ($_POST['amount']) && isset ($_POST['transactionID'])) {
            $TID=mysql_real_escape_string($_POST['TID']);
            $mobileNo=mysql_real_escape_string($_POST['mobileNo']);
            $EmailID=mysql_real_escape_string($_POST['email']);
            $amount=mysql_real_escape_string($_POST['amount']);
            $transactionID=mysql_real_escape_string($_POST['transactionID']);


            $query="SELECT user_balance FROM paytoplaybalance WHERE user_email = '$EmailID'";
            if($resutSet_to_find_balance=mysql_query($query)) {
              $balance = mysql_result($resutSet_to_find_balance, 0, 0);

            }else {
                echo 'balance not found';
            }


            if($result=mysql_query("SELECT TID from withdrawhistory where user_email = '$EmailID' and Mobileno = '$mobileNo' and TID=$TID and Amount= $amount")) {

                if(mysql_num_rows($result) == 1) {

                    $query1 ="UPDATE withdrawhistory SET status='A',TransactionID = '$transactionID'
                            WHERE user_email = '$EmailID' and Mobileno = '$mobileNo' and TID=$TID and TID=$TID Amount= $amount";
                    if(mysql_query($query1)) {
                        echo 'Data Enterd in table and Status change';
                    }else {
                        echo 'Error while updateing data in withdrawhistory';
                    }
                }else {
                    echo "No data present for <b>$TID</b>  mobile - <b>$mobileNo</b> Email -<b>  $EmailID</b> email <b>$amount</b>";
                }
            }

        }else {
            echo 'Some feilds are empty';
        }
    }else {
        echo 'feilds are Not SET';
    }





} else {
    header('Location: ../AdminLoginAuthentication.php');
}
?>