<?php
@session_start();

if (isset($_SESSION['setadminpassword']) && isset($_SESSION['setdatabasepassword'])) {
    include '../../includes/database_connectivity_includes.php';
    ?>
<html>
    <head>

    </head>
    <bodyd>
        <form name="form" method="post" action="EnterDatainDepositeTable.php">
            <table width="30%" style="height: 100px;">
                <tr>
                    <td>Transaction ID</td><td>EMAIL</td><td>AMOUNT</td><td>ACTION</td>
                </tr>
                <tr>
                    <td><input type="text" name="TID"></td>
                    <td><input type="text" name="email"></td>
                    <td><input type="text" name="amount"></td>
                    <td><select name="opration"><option value="A">Accpt</option><option value="R">Reject</option></select></td>
                </tr>
                <tr>
                    <td></td><td><input type="submit" value="ENTER"></td><td></td>
                </tr>
            </table>

        </form>
    </body>
</html>
    <?php

    if(isset ($_POST['TID']) && isset ($_POST['email']) && isset ($_POST['amount']) && isset ($_POST['opration']) ) {
        if(!empty ($_POST['TID']) && !empty($_POST['email']) && !empty($_POST['opration'])) {
            $TID=mysql_real_escape_string($_POST['TID']);
            $EmailID=mysql_real_escape_string($_POST['email']);
            $amount=mysql_real_escape_string($_POST['amount']);
            $opration=mysql_real_escape_string($_POST['opration']);

            if($restlSet = mysql_query("SELECT status from depositehistory where user_email = '$EmailID' and transacrtionID = '$TID'")) {

                if(mysql_num_rows($restlSet) == 1)
                    $stst = mysql_result($restlSet, 0);
                else
                    echo 'No such transaction id with email name';

                if($stst == 'V') {

                    $query="SELECT user_balance FROM paytoplaybalance WHERE user_email = '$EmailID'";
                    if($resutSet_to_find_balance=mysql_query($query)) {
                        if(mysql_num_rows($resutSet_to_find_balance) == 1) {
                            $balance = mysql_result($resutSet_to_find_balance, 0, 0);
                        }else {
                            if($resultSettoFindUserID = mysql_query("SELECT user_id from users_data where user_email = '$EmailID'")) {
                                $userId=mysql_result($resultSettoFindUserID, 0);
                            }
                            @mysql_query("insert into paytoplaybalance values($userId,'$EmailID',0,0,0)");
                            $balance = 0;
                        }
                    }else {
                        echo 'balance not found';
                    }


                    $query1 ="UPDATE depositehistory SET Amount=$amount,status='$opration',oldBalance=$balance,newBalance=$balance+$amount
                            WHERE user_email = '$EmailID' and transacrtionID = '$TID'";
                    $query2 = "UPDATE paytoplaybalance SET user_balance = $balance+$amount where user_email = '$EmailID'";
                    if(mysql_query($query1)) {
                        if(mysql_query($query2)) {
                            echo 'Data Enterd  in '.$EmailID. 'Account <b> OLD BAlance : '.$balance.' NEW BALANCE '.($balance+$amount).'</b>';
                        }else {
                            echo 'Error while inserting data in paytoplaybalance';
                        }
                    }else {
                        echo 'Error while inserting data in depositehistory';
                    }



                }else {
                    if($stst == 'A')
                        echo 'TID is alredy Verified and added';
                    else if($stst == 'R')
                        echo 'TID is alredy Rejected';
                    else
                        echo 'Status is audefined';
                }
            }else {
                echo 'ERROR';
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