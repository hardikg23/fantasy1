<?php
include 'Header.php';
include 'PHP/includes/database_connectivity_includes.php';
@session_start();
include 'PHP/includes/session_setter.php';
include 'PHP/includes/seriedId_setter.php';
?>

<html>
    <head>
        <title>ACCOUNT SETTINGS</title>
        <link rel="stylesheet" type="text/css" href="css/AccountSetting.css">
        <link rel="stylesheet" type="text/css" href="css/footer.css">
    </head>
    <body>

        <div class="filler box-shadow-comman" style="position: absolute;width: 1000px;height: 35px;left: 176px;top: 150px;background-color: white">
        </div>

        <div class="main-body-container box-shadow-comman" style="position: absolute;width: 1000px;height: 1000px;left: 183px;top: 175px;background-color: white">

            <!--LOGIN and LOGOUT -->
            <?php include 'PHP/includes/login_and_logout_file_include.php'; ?>
            <!----------------->
            <!-- MAIN MENU -->
            <div style="position: absolute;left: 0px;top:40px;width:1000px;height: 30px;">
                <?php include 'PHP/includes/main_mune_finder_and _display.php'; ?>
            </div>
            <!---->
            <!-- SUBMENU ----->
            <?php include 'PHP/includes/sub_menu_display.php'; ?>
            <!--------------->
            <!------------------------------------------- MAIN BODY ---------------------------------->
            <div class="box-shadow-comman" style="position: absolute;width: 980px;height: 870px;left: 10px;top: 130px;background-color: ">
                <div class="black-header" style="font-size: 20px;font-weight: bold;height: 30px;">
                    ACCOUNT and SETTINGS
                </div>
                <br><br>
                <div style="font-size: 24px;font-weight: bold;height: 30px;color: #1980B7;padding-left: 15px">
                    <?php echo "HELLO, $session_email"; ?>
                </div >
                <br>
                <div style="font-size: 16px;font-weight: bold;height: 30px;color: #4B4E4F;padding-left: 25px">
                    This page is to check your cash account and to manage your accounts and settings.
                </div>


                <?php
                $amount = 0;
                if ($result_for_prize = mysql_query("SELECT sum(amount) from prize_winners_table where email_id = '$session_email'")) {

                    if (mysql_num_rows($result_for_prize) == 1) {

                        $amount = mysql_real_escape_string(htmlentities(mysql_result($result_for_prize, 0)));
                    }

                    if ($amount == '')
                        $amount = 0;
                    echo "<div class='prize-container'>
                                            <center>YOUR CASH COLLECTION : <font style='color:red;font-size:45px'>$amount</font></center>
                                      </div>";
                }
                ?>
                <br><br>
                <div style="width:900px ;font-size: 16px;font-weight: bold;height: 30px;color: #4B4E4F;padding-left: 25px">
                    &nbsp;&nbsp;&nbsp;&nbsp;Once your cash collection reaches Rs. 5,000 or above fantasycricleague.com admin will send you an email
                    to your original email address with which you have been registered to our site.
                    <br>
                    <font style="color: #FC3949;opacity:0.6;">
                        &nbsp;&nbsp;&nbsp;&nbsp;NOTE: invalid email address may cancelled your prize collection.
                        Also verification of your email address is required. All procedure will be described in mail.
                    </font>
                    <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;Once email address is verified and once you send all required details to us we will send you cash by your preferred option.
                </div>

                <div class="black-header" style="font-size: 20px;font-weight: bold;height: 30px;position: absolute;top:400px;width:400px;">
                    PASSWORD CHANGE:
                </div>
                <div style="font-weight: bold;height: 30px;position: absolute;top:450px;width:400px;">
                    <table class="pass-change">
                        <tr>
                            <td align="right" width="250px">OLD PASSWORD:</td>
                            <td align="left" width="250px"><input type="password" id="old-pass" placeholder="old password"></td>
                        </tr>
                        <tr>
                            <td align="right">NEW PASSWORD: </td>
                            <td align="left"><input type="password" id="new1-pass" placeholder="new password"></td>
                        </tr>
                        <tr>
                            <td align="right">CONFIRM PASSWORD:</td>
                            <td align="left"><input type="password" id="new2-pass" placeholder="confirm password"></td>
                        </tr>
                        <tr>
                            <td align="right"></td>
                            <td align="left"><div id="error_contariner" style="font-size: 9px;color: red;"></div></td>
                        </tr>
                        <tr>
                            <td align="right"></td>
                            <td align="left"><input type="button" value="change" id="changePass" placeholder="confirm password"></td>
                        </tr>
                    </table>
                </div>




                <!-- MODIFY -->
                <div class="black-header" style="font-size: 20px;font-weight: bold;height: 30px;position: absolute;left: 450px;top:400px;width:520px;">
                    PAY TO PLAY CASH ACCOUNT
                </div>

                <div style="font-weight: bold;height: 30px;position: absolute;left: 440px;top:450px;width:520px;">
                    <?php
                    if (isset($session_email) && !empty($session_email)) {
                        if ($queryToGetBalance = mysql_query("SELECT user_balance from paytoplaybalance where user_email = '$session_email'")) {
                            if (mysql_num_rows($queryToGetBalance) == 1) {
                                $balance = (int) mysql_real_escape_string(mysql_result($queryToGetBalance, 0, 0));
                            } else {
                                $balance = 0;
                            }

                            echo "<div class='prize-container'>
                                            <center>YOUR BALANCE : <font style='color:red;font-size:45px'>&#x20B9; $balance</font></center>
                                      </div>";
                        }
                    }
                    ?>
                    <br><br>
                    <div align="center">
                        <table width="110%" class="paytoplayBalance-table font-containt">
                            <tr align="center">
                                <td><font style="font-weight: bold;color:#797979;font-size: 12px;">Transaction No</font>
                                    <input type="text" style="width: 100px;height: 20px;" placeholder="eg. X-AH987" id="transactionID"></td>

                                <td>
                                    <table>
                                        <tr>
                                            <td>
                                                <font style="font-weight: bold;color:#797979;font-size: 12px; ">Mobile No</font>
                                            </td>
                                            <td>
                                                <input type="number" maxlength="15"  style="width:120px;height: 20px;" placeholder="eg. 9800000000" id="mobileno"><font style='font-size:11px;color:red;opacity:0;' id="mobileTD"> > 10 digit</font>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <font style="font-weight: bold;color:#797979;font-size: 12px; ">Amount</font>
                                            </td>
                                            <td>
                                                <input type="number" maxlength="4" style="width:120px;height: 20px;" placeholder="amount to be withdraw" id="withdrawAmont">&#x20B9; <font style='font-size:11px;color:red;opacity:0;' id="amontTD"> >25&#x20B9; & <5000&#x20B9;</font>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <font style="font-weight: bold;color:#797979;font-size: 12px; ">Password</font>
                                            </td>
                                            <td>
                                                <input type="password" maxlength="50"  style="width:120px;height: 20px;" placeholder="password" id="validatePassword"><font style='font-size:11px;color:red;opacity:0;' id="passwordTD"> < 8 char</font>
                                            </td>
                                        </tr>
                                    </table>

                                </td>
                            </tr>
                            <tr align="center">
                                <td><input type="button" value="DEPOSIT" id="deposit-button" class="deposit-button"></td>
                                <td><input type="button" value="WITHDRAW" id="withdraw-button" class="withdraw-button"></td>
                            </tr>
                        </table>
                    </div>
                    <br>
                    <hr>
                    <div align="center">
                        <font style="font-weight: bold;color:#797979;font-size: 12px; ">Last 5 transaction history. </font>
                        <table  width="100%" class="font-containt" style="font-weight: bold;color:#797979;font-size: 12px; ">
                            <tr align="center">
                                <td style="font-weight: bold;font-size: 14px;color: black;">Deposite History</td>
                                <td style="font-weight: bold;font-size: 14px;color: black;">Withdraw History</td>
                            </tr>
                            <tr align="center">
                                <td>
                                    <?php
                                    if($restuSetOfDeposite=mysql_query("SELECT * from depositehistory where user_email= '$session_email' Order by TimeAndDate DESC LIMIT 5")) {
                                        if(mysql_num_rows($restuSetOfDeposite) > 0) {

                                            echo '<table class="history-table" align="center" width="85%" style="font-weight: bold;color:#797979;font-size: 12px;">';
                                            $index = 1;
                                            while ($row = mysql_fetch_array($restuSetOfDeposite)) {
                                                $transactionID = htmlentities(mysql_real_escape_string($row['transacrtionID']));
                                                $Amount = htmlentities(mysql_real_escape_string($row['Amount']));
                                                $status =  htmlentities(mysql_real_escape_string($row['status']));
                                                $status = strtoupper($status);

                                                if($Amount == 0)
                                                    $Amount = 'X &#x20B9;';
                                                else
                                                    $Amount .= '&#x20B9;';
                                                
                                                if($status == 'V')
                                                    $status = '<font style="color:#AD0000">Verifying</font>';
                                                else if($status == 'R')
                                                    $status = '<font style="color:#AD0000">Rejected</font>';
                                                else
                                                    $status = '<font style="color:#007C15">Approved</font>';

                                                echo "<tr><td>$index</td><td align='left'>$transactionID</td><td>$Amount</td><td align='center'>$status</td></tr>";



                                                $index++;
                                            }
                                            echo '</table>';
                                        }else {
                                            echo 'No Transaction';
                                        }
                                    }else {
                                        echo 'Some error occurred';
                                    }

                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if($restuSetOfDeposite=mysql_query("SELECT * from withdrawhistory where user_email= '$session_email' Order by TimeAndDate DESC LIMIT 5")) {
                                        if(mysql_num_rows($restuSetOfDeposite) > 0) {

                                            echo '<table class="history-table" align="center" width="85%" style="font-weight: bold;color:#797979;font-size: 12px;">';
                                            $index = 1;
                                            while ($row = mysql_fetch_array($restuSetOfDeposite)) {
                                                $mobileno = htmlentities(mysql_real_escape_string($row['Mobileno']));
                                                $Amount = htmlentities(mysql_real_escape_string($row['Amount'])).'&#x20B9;';
                                                $status =  htmlentities(mysql_real_escape_string($row['status']));

                                                $status = strtoupper($status);

                                                if($status == 'V')
                                                    $status = '<font style="color:#AD0000">Verifying</font>';
                                                else if($status == 'R')
                                                    $status = '<font style="color:#007C15">Rejected</font>';
                                                else
                                                    $status = '<font style="color:#007C15">Approved</font>';
                                                echo "<tr><td>$index</td><td align='left'>$mobileno</td><td>$Amount</td><td align='center'>$status</td></tr>";



                                                $index++;
                                            }
                                            echo '</table>';
                                        }else {
                                            echo 'No Transaction';
                                        }
                                    }else {
                                        echo 'Some error occurred';
                                    }

                                    ?>
                                </td>
                            </tr>

                        </table>
                    </div>
                </div>


                <!-- MODIFY -->
            </div>
        </div>
        <div class="filler" style="position: absolute;width: 1000px;height: 45px;left: 176px;top: 1150px;background-color: white">
        </div>

        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/make_All_page_responsive.js"></script>
        <script type="text/javascript" src="js/AccountSetting.js"></script>
    </body>
</html>
<?php
include 'Footer.php';
?>
