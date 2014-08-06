<html>
    <head>
        <!-- CSS for style LOGIN LOGOUT -->
        <link rel="stylesheet" type="text/css" href="PHP/includes/css/Login_Logout.css">
        <!-------------------------------->
        <link rel="stylesheet" href="css/jquery-ui-1.10.3.custom.css">
        <link rel="stylesheet" href="css/jquery-ui-1.10.3.custom.min.css">
        <link rel="stylesheet" type="text/css" href="css/modal.css">

    </head>
    <body>
        <!-- If Session is not SET then email and password feild is visible -->
        <?php
        include 'PHP/includes/seriedId_setter.php';
        if(empty ($session_email) && empty ($session_password)) {
            //echo 'session is'.$_SESSION['seriesId'];
            $cookeiEmail="";
            $cookeiPassword="";
            if (isset($_COOKIE['emailID'])) {
                $cookeiEmail=$_COOKIE['emailID'];
            }
            if (isset($_COOKIE['password'])) {
                $cookeiPassword=$_COOKIE['password'];
            }
            ?>
        <!-- Email And password-->
        <div class="Login_Logout" style="position: absolute;left: 0px;top:-5px;width: 1000px;">
            <div class="Login_Logout_Content" style="padding-left: 20px;">
                <font style="position: absolute;left:10px;" class="font-containt-bold">Email Address: </font>
                <input style="position: absolute;left:115px;" type="text" class="email-text" id="email" value="<?php echo $cookeiEmail;?>">

                <font style="position: absolute;left:275px;" class="font-containt-bold">Password: </font>
                <input style="position: absolute;left:347px;" type="password" class="password-text" id="pass" onkeypress="runScript(event)" value="<?php echo $cookeiPassword;?>">

                <input style="position: absolute;left:500px;top:-2px;" type="submit" value="login" id="login" class="login-button font-containt-bold">

                <a  href="#forgotpass" id="forgotpassword" name="modal" style="position: absolute;left:560px;top:5px;cursor: pointer;">
                    <font class="forget-text font-containt">Forgot Password? |</font>
                </a>

                <font style="position: absolute;left:680px;top:5px;" class="register-text font-containt">New User?</font>
                <a style="position: absolute;left:740px;top:5px;" id="home_register" href="Register.php?seriesId=<?php echo $seriesId;?>">

                    <font class="register-text font-containt-bold">click here to Register!</font>
                </a>
            </div>


            <div style="position: absolute;left: 355px;top:27px;">
                <input type="checkbox" name="keep-logged-in" id="keep-logged-in">
            </div>
            <div style="position: absolute;left: 370px;top:27px;font-size: 10px;opacity:0.8;">
                Remember me
            </div>
        </div>

        <!-- If Session is  SET then LOGOUT is visible -->
    <?php
}else {

            ?>
        <!-- Login Button-->
        <div class="font-containt-bold" align="right" style="position: absolute;width: 1000px;height: 30px;">
            <a id="logout_after_login" class="login-setting" href="QPWinners.php">Master Mind</a>
            <a id="logout_after_login" class="login-setting" href="AccountSetting.php">MyAccount</a>
            <a id="logout_after_login" class="login-setting" href="logout.php">Logout</a>

        </div>
        <div class="font-containt-bold" align="right" style="position: absolute;width: 1000px;height: 30px;top: 22px;">

        </div>
    <?php
}
        ?>


        <div id="box">
            <!--************************   MODEL for Forget Password  **********************************-->
            <div id="forgotpass" class="window" style="visibility: hidden">

                <a href="#" class="close">
                    <img src="photos/ModelClose.png" alt="close" style="position: absolute;left:725px;top:5px;" height="20px" left="20px">
                </a><br/>
                <div style="position: absolute;font-size: 30px;font-weight: lighter;font-family: 'Myriad Pro', sans-serif;top:50px;left:240px;">Get Your Password</div>
                <table class="" id="tableforgotpass" style="position: absolute;left: 220px;top: 100px;width:300px;" cellpadding=2>
                    <tr>
                        <td height="30px">
                            Email:<input style="margin-left: 13px;" type="text"  id="user_email" placeholder="Email" name="user_email" onBlur="validate_Email()">

                        </td>
                        <td rowspan="3">
                            <input type="button" style="margin-top: -25px;" class="login-button font-containt-bold" id="go" value="Go" name="go">

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div style="height:10px">

                                <p style="display:none;margin-left: 52px;font-size: 12px; color:red" id="emptyEmailError">
                                    <i class="">Please Enter your Email!</i>
                                </p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div style="height:10px;margin-left: 52px;color:red;font-size: 12px;font-style: italic" id="wrongEmailError">

                            </div
                        </td>
                    </tr>

                </table>
            </div>
        </div>

        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/jquery-ui.js"></script>
        <script type="text/javascript" src="js/modal.js"></script>
        <script type="text/javascript" src="js/ForgotPassword.js"></script>
        <!--<script type="text/javascript" src="js/modal-ui.js"></script>-->
        <script type="text/javascript">
            function validateForPass()
            {
                var s1=validate_Email();
                if(s1)
                {
                    return true;
                }
                return false;
            }
            function validate_Email()
            {
                var e=document.getElementById("user_email").value;
                if(e=="")
                {
                    $('#wrongEmailError').empty();
                    $('#user_email').css('border','1px solid red');
                    $('#user_email').css('box-shadow', '0px 0px 5px red');

                    return false;
                }
                else
                {
                    // var rule=/^[a-zA-Z]+(\.[0-9]+[a-zA-Z]|_[0-9]+|_[0-9]+[a-zA-Z]+|[0-9]+_[a-zA-Z]+|_[a-zA-Z]+|\.[0-9]+|[0-9]+|[0-9]+[a-zA-Z]+|[a-zA-Z]*|\.[a-zA-Z]+|\.[a-zA-Z]+[0-9]+)(@)[a-zA-Z]+\.([a-zA-Z]+|[a-zA-Z]+\.[a-z]{2})$/;
                    var rule= /^[a-zA-Z0-9_\.]+(@)[a-zA-Z]+\.([a-zA-Z]{2,3}|[a-zA-Z]+\.[a-z]{2})$/;
                    if(!e.match(rule))
                    {
                        $('#wrongEmailError').empty();
                        $('#wrongEmailError').append("Enter Proper Email Id");
                        $('#user_email').css('border','1px solid red');
                        $('#user_email').css('box-shadow', '0px 0px 5px red');
                        return false;
                    }
                    else
                    {
                        $('#wrongEmailError').empty();
                        $('#user_email').css('border','1px solid green');
                        $('#user_email').css('box-shadow', '0px 0px 5px green');
                        return true;

                    }

                }
            }

        </script>

    </body>
</html>