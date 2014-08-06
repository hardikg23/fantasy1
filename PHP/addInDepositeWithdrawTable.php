<?php
include 'includes/database_connectivity_includes.php';
@session_start();
include 'includes/session_setter.php';
include 'includes/seriedId_setter.php';

if(isset ($_POST['TID'])) {
    $TID = htmlentities(mysql_real_escape_string($_POST['TID']));
    if(!empty ($TID)) {
        $datetime=date("Y-m-d H:i:s");
        if($compareTid=mysql_query("select transacrtionID from depositehistory where transacrtionID = '$TID'"))
            if(mysql_num_rows($compareTid)==0) {
                $query = "INSERT INTO depositehistory(TID,user_email,Amount,status,TimeAndDate,transacrtionID) VALUES ('','$session_email',0,'V','$datetime','$TID')";
                if(mysql_query($query)) {
                    echo 'done';
                    //echo 'Data recorded and amount will be added to your balance after verifying. Thank You.';
                }else {
                    echo 'Some Error occurred please try later. ';
                }
            }
            else
                {
                echo 'Transaction no. is already recorded and its under verification process.';
            }
    }
}

if(isset ($_POST['mobile']) && isset ($_POST['withdrawAmount']) &&isset ($_POST['password'])) {
    $mobile=htmlentities(mysql_real_escape_string($_POST['mobile']));
    $withAmont=htmlentities(mysql_real_escape_string($_POST['withdrawAmount']));
    $psward=htmlentities(mysql_real_escape_string($_POST['password']));

    if(!empty ($mobile) && !empty ($withAmont) && !empty ($psward) && ckeckFun($withAmont)) {
        if($result_to_get_salt=mysql_query("SELECT user_password,user_password_salt from users_data where user_email='$session_email'")) {
            if(mysql_num_rows($result_to_get_salt)==1) {
                $salt=mysql_real_escape_string(mysql_result($result_to_get_salt, 0,1));
            }
        }
        $psward = substr($salt, 0, 16) . $psward . substr($salt, 16, 16);
        $psward = hash("sha256", $psward);
        $psward = hash("sha256", $psward);

        if($psward != $session_password) {
            echo 'Please enter correct password';
        }
        else {

            $query="SELECT user_id,user_balance FROM paytoplaybalance WHERE user_email = '$session_email'";
            if($resutSet_to_find_balance=mysql_query($query)) {
                $balance = mysql_result($resutSet_to_find_balance, 0, 1);
            }

            if($balance >= $withAmont) {
                $datetime=date("Y-m-d H:i:s");
                $query = "INSERT INTO withdrawhistory(TID,user_email,Amount,status,TimeAndDate,TransactionID,Mobileno,oldBalance,newBalance)
                                                VALUES ('','$session_email',$withAmont,'V','$datetime','','$mobile',$balance,$balance-$withAmont)";

                $query2="UPDATE `paytoplaybalance` SET user_balance=user_balance - $withAmont WHERE user_email = '$session_email'";
                if(mysql_query($query2) && mysql_query($query)) {
                    echo 'done';
                    //echo 'Your request has been recorded successfully you will receive amount to your specified mobile number in 1-2 days. Thank You! ';
                }else {
                    echo 'Some Error occurred please try later. ';
                }
            }else {
                echo "You don't have sufficient balance to Withdraw $withAmont rs.";
            }
        }
    }else {
        echo 'Some Error occurred please try later. ';
    }
}

function ckeckFun($withAmont) {
    if($withAmont > 24 and $withAmont < 5001 )
        return true;
    else
        return false;
}


?>