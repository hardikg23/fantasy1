<?php

include 'PHP/includes/database_connectivity_includes.php';

session_start();
$sendData1 = "Required : ";
$sendData2 = "";
$u_name;
$f_name;
$l_name;
$gender;
$email;
$psward;
$country;
$sec_qus;
$sec_ans;
$code;
$refresh = '';
if (isset($_POST['ref'])) {
    $refresh = $_POST['ref'];
    if ($refresh == "refresh") {
        $_SESSION['secure'] = rand(10000, 99999);
    }
} else {
    if (isset($_POST['input1'], $_POST['input2'], $_POST['input3'], $_POST['input4'], $_POST['input5'], $_POST['input6'], $_POST['input7'], $_POST['input8'], $_POST['input9'], $_POST['input9'])) {
        $u_name = $_POST['input1'];
        $f_name = $_POST['input2'];
        $l_name = $_POST['input3'];
        $gender = $_POST['input4'];
        $email = $_POST['input5'];
        $psward = $_POST['input6'];
        $country = $_POST['input7'];
        $sec_qus = $_POST['input8'];
        $sec_ans = $_POST['input9'];
        $code = $_POST['input10'];
        if ($gender == 'Male')
            $gender = 1;
        else
            $gender = 0;

        //echo 'First time'.$email.' '.$country.' '.$sec_qus.'<br>';
    }
    if ($u_name == "" && $f_name == "" && $l_name == "" && $gender == "" && $email == "" && $email == "" && $psward == "" && $country == "" && $sec_qus == "" && $sec_ans = "" && $code = "") {
        if ($u_name == "")
            $sendData = +"User name ";
        if ($f_name == "")
            $sendData = +" First name ";
        if ($l_name == "")
            $sendData = +" Last name ";
        if ($gender == "")
            $sendData = +" Gender ";
        if ($email == "")
            $sendData = +" Email ";
        if ($psward == "")
            $sendData = +" Password ";
        if ($country == "")
            $sendData = +" Country ";
        if ($sec_qus == "")
            $sendData = +" Security qestion ";
        if ($sec_ans == "")
            $sendData = +" Security ans ";
        if ($code == "")
            $sendData = +"Security Code";
        echo $sendData1;
    }
    else {
        if ($_SESSION['secure'] == $code) { // if CAPCHA correct
            $date = date('Y/m/d H:i:s');
            $activation = md5(uniqid(rand(), true));
            if ($ResultSet_of_emailAdd = mysql_query("SELECT user_email from users_data where user_email = '$email'")) { // not registred
                if (mysql_num_rows($ResultSet_of_emailAdd) == 0) {//no registred
                    
                    /*
                     * md5 code.....
                    */
                    $salt = uniqid(mt_rand(), true);
                    $salt = substr($salt, 0, 32);
                    $psward = substr($salt, 0, 16) . $psward . substr($salt, 16, 16);
                    $psward = hash("sha256", $psward);
                    $psward = hash("sha256", $psward);
                    
                    $query_insert = "insert into users_data_temp values('$activation','$u_name','$f_name','$l_name','$gender','$email','$psward','$country','$sec_qus','$sec_ans','$date','$salt')";
                    if (@$query_insert_run = mysql_query($query_insert)) { // insert user
                        echo 'success';
                        $message = "Hello, $f_name $l_name \n";
                        $message .="To activate to your account, Click on the below link \n\n";
                        $headers = "From:  <no-reply@fantasycricleague.com>";
                        $message .= "http://fantasycricleague.com/fantasy/activate.php?email=" . urlencode($email) . "&key=$activation";
                        $message .= "\n\n\n";
                        $message .= "YOU EMAIL ADDREDD : $email \n";
                        $message .= "YOU USER NAME : $u_name \n";
                        mail($email, 'Registration Confirmation', $message, $headers);
                    }
                    else
                        echo 'error';
                }
                else {
                    echo 'Email address already registered.#@#<img src="Generate.php">';
                }
            }
        } else {
            $_SESSION['secure'] = rand(10000, 99999);
            echo '<img src="Generate.php">';
        }
    }
}