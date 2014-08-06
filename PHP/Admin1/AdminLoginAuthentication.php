<?php
include '../includes/database_connectivity_includes.php';
    @session_start();
?>
<html>
    <head>
        
        <title>Authenticate</title>
        <style type="text/css">
                    .login-div-container{
                        font-family: "Lao UI";
                         box-shadow:1px 1px 1px 1px #504848;
                        -webkit-box-shadow: 1px 1px 1px 1px #504848;
                        -moz-box-shadow:1px 1px 1px 1px #504848;
                    }
                    .login-but-div{
                            width: 75px;
                            height: 30px;
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
        <div class="login-div-container" align="center" style="border: 1px solid silver;position:absolute;left: 600px;top: 300px;width: 300px;height: 150px;">
            
        <form name="f" method="post" action="AdminLoginAuthentication.php">
         <table style="border-spacing: 0 0.5em;">
             <tr style="background-color: #000000;color:white;"> 
                 <td colspan="2" align="center">
                  AdminLogin
                 </td>
             
             </tr>
            <tr>
                <td>
                    AdminPassword:
                </td>
                <td>
                    <input type="password" name="adminpassword" >
                </td>
            </tr>
            <tr>
                <td>
                DatabasePassword:
                </td>
                <td>
                    <input type="password" name="databasepassword" >
                </td>
             </tr>
             <tr>
                 <td colspan="2" align="center">
                <input type="submit" value="Login" class="login-but-div">
                 </td>
             </tr>
         </table>
        </form>
        </div>
    </body>
</html>



<?php

    if(isset($_POST['adminpassword'])&&isset($_POST['databasepassword']))
    {
        if(!empty($_POST['adminpassword'])&&!empty($_POST['databasepassword']))
        {
            $adminpass=mysql_real_escape_string(htmlentities($_POST['adminpassword']));
            $databasepass=mysql_real_escape_string(htmlentities($_POST['databasepassword']));
            
            
            $adminsalt='8489501975318780ee94624.87777517';
            $adminhashpassword='40dd53e1ed150b6998a7c99de2aa9efd6b902bea05bbd8690b5868002909fa4d';
            
            
            
            //$datasalt='1978679514531878a2b1b8d5.8835870';
            //$datahashpassword='e1ac7c0c0f8aa3c4cb937f0fd4421bcab102c847f523254cd2101d433cf10cf8';
            $databaselogin=  mysql_query("select * from databaselogin_details");
            while($row =  mysql_fetch_array($databaselogin))
            {
                $datasalt=mysql_real_escape_string($row['data_salt']);
                $datahashpassword=mysql_real_escape_string($row['data_hash_password']);
            }
            
    
            //echo $salt.'<br/>';
            $adminverifypassword = substr($adminsalt, 0, 16) . $adminpass . substr($adminsalt, 16, 16);
            $adminverifypassword = hash("sha256", $adminverifypassword);
            $adminverifypassword = hash("sha256", $adminverifypassword);
            
            //echo 'adminhash='.$adminverifypassword.'<br/>';
            
            $databaseverifypassword = substr($datasalt, 0, 16) . $databasepass . substr($datasalt, 16, 16);
            $databaseverifypassword = hash("sha256", $databaseverifypassword);
            $databaseverifypassword = hash("sha256", $databaseverifypassword);
            
            
            //echo 'database='.$databaseverifypassword.'</br>';
            
            
            if($adminhashpassword==$adminverifypassword&&$datahashpassword==$databaseverifypassword)
            {
                $_SESSION['setadminpassword']=$adminpass;
                $_SESSION['setdatabasepassword']=$databasepass;
                header('Location: lockTeam.php');
            }
            else
            {
                echo 'Wrong password';
            }
            
        }
    }




?>
