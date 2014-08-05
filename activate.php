<?php
        include 'PHP/includes/database_connectivity_includes.php';
        @session_start();
        include 'PHP/includes/seriedId_setter.php';

        if(isset ($_GET['email'])&&!empty($_GET['email'])){
            $email=mysql_real_escape_string(urldecode($_GET['email']));
        }
        if(isset($_GET['key']) && (strlen($_GET['key'])==32)){
            $key=mysql_real_escape_string($_GET['key']);
        }
        

        if(isset($email) && isset($key)  &&  !empty ($email) && !empty ($key)){
            $result=mysql_query("SELECT * from users_data_temp where user_email='$email' AND activation_key='$key'") or die(mysql_error());
            
            if(mysql_num_rows($result) == 1){
            while($row=mysql_fetch_array($result)){  //to get all data.....
                $uname=mysql_real_escape_string($row['user_name']);
                $fname=mysql_real_escape_string($row['first_name']);
                $lname=mysql_real_escape_string($row['last_name']);
                $gender=mysql_real_escape_string($row['gender']);
                $email=mysql_real_escape_string($row['user_email']);
                $password=mysql_real_escape_string($row['user_password']);
                $country=mysql_real_escape_string($row['user_country']);
                $usq=mysql_real_escape_string($row['user_security_question']);
                $usa=mysql_real_escape_string($row['user_security_ans']);
                $date=mysql_real_escape_string($row['date_join']);
		$salt=mysql_real_escape_string($row['user_password_salt']);
            }
            $result2=mysql_query("delete from users_data_temp where user_email='$email' ");
            if($gender==1)
            $result1=mysql_query("insert into users_data values('','$date','$uname','$fname','$lname','$gender','$email','$password','$country','$usq','$usa','','$salt')") or die(mysql_error());
            if($gender==0)
             $result1=mysql_query("insert into users_data values('','$date','$uname','$fname','$lname','$gender','$email','$password','$country','$usq','$usa','','$salt')") or die(mysql_error());
            if(!$result1){
                echo "Oops! your acount could not be activated!!!";
            }   else{
                header('Location:index.php');
            }
           }else{
               echo 'Invalid link: You might have already clicked this link once, try login to site or improper data is provided while registering.';
           }
        }

?>
