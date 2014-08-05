
<html>
	<head>
		<title>Login</title>
                <style type="text/css">
                    .login-div-container{
                        font-family: "Lao UI";
                         box-shadow:1px 1px 1px 1px #504848;
                        -webkit-box-shadow: 1px 1px 1px 1px #504848;
                        -moz-box-shadow:1px 1px 1px 1px #504848;
                    }
                    .login-hraeder-div{
                      font-size: 14px;
                      background-color: black;
                      color: white;
                     height: 22px;
                     padding-left: 10px;
                    }
                    .ligin-div-table{
                        font-size: 11px;
                    }
                    .register-button-div{
                            width: 75px;
                            height: 20px;
                            border-radius:3px;
                            color: white;
                            font-size: 14px;
                            font-weight: bolder;
                            cursor: pointer;
                            background-color: #B01212;
                            border: 1px solid black;
                            box-shadow:1px 1px 1px 1px #504848;
                            -webkit-box-shadow: 1px 1px 1px 1px #504848;
                            -moz-box-shadow:1px 1px 1px 1px #504848;
                            text-decoration: none;
                    }
                    .login-but-div{
                            width: 75px;
                            height: 20px;
                            border-radius:3px;
                            color: white;
                            font-size: 14px;
                            font-weight: bolder;
                            cursor: pointer;
                            background-color: #167C07;
                            border: 1px solid black;
                            box-shadow:1px 1px 1px 1px #504848;
                            -webkit-box-shadow: 1px 1px 1px 1px #504848;
                            -moz-box-shadow:1px 1px 1px 1px #504848;
                    }

                </style>
	</head>
	<body>
            <div class="login-div-container" style="padding:20px ;margin:100px auto;width: 300px;height: 200px;border: 1px solid silver">
                <div class="login-hraeder-div">Please Login : </div><br>
                <table  class="ligin-div-table">
                    <tr>
                        <td align="right">EMAIL ADDRESS: </td><td align="left"> <input type="text" id="email"> </td>
                    </tr>
                    <tr>
                        <td align="right">PASSWORD : </td><td align="left"><input type="password" id="pass" onkeypress="runScript(event)"></td>
                    </tr>
                     <tr>
                        <td align="right"></td>
                        <td align="left">
                            <input type="submit" value="login" id="login" class="login-but-div">
                            <br><br>
                            <a href="Register.php" ><div class="register-button-div" align="center">Register</div></a>
                        </td>
                    </tr>
                </table>
           </div>

                <script type="text/javascript" src="js/jquery.js"></script>
                <script>
                 $('#login').click(function(){
                        login_clicked();

                    });

                    function runScript(e) {
                        if (e.keyCode == 13) {
                            login_clicked();
                        }
                    }
   
                   function login_clicked(){
                        var loginflag=true;
                        var login_email=$('#email').val();
                        var login_pass=$('#pass').val();
                        if(login_email=="" && login_pass==""){
                            alert("Enter Email ID And Password");
                            loginflag=false;
                        }
                        else if(login_email==""){
                            alert("Enter Email ID");
                            loginflag=false;
                        }
                        else if(login_pass==""){
                            alert("Enter PassWord");
                            loginflag=false;
                        }
                        if(loginflag==true){
                            $.post('PHP/login_validation.php',{login_email:login_email,login_pass:login_pass,cookieFlag:'false'},
                                    function(data){
                                        if(data=="done"){
                                            window.location="ManageTeam.php";
                                        }
                                        else
                                         {
                                            alert(data);
                                         }
                                });
                        }
                    }
                
                </script>
	</body>
</html>
