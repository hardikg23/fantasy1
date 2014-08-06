<?php
error_reporting(0);
if(isset ($_SESSION['username']) && isset ($_SESSION['email']) && isset ($_SESSION['password']) &&isset ($_SESSION['country'])){
        if(!empty ($_SESSION['username']))
        $session_username= $_SESSION['username'];
        if(!empty ($_SESSION['email']))
        $session_email= $_SESSION['email'];
        if(!empty ($_SESSION['password']))
            $session_password= $_SESSION['password'];
         if(!empty ($_SESSION['country']))
            $session_country= $_SESSION['country'];
         if($updatestatus=mysql_query("select updatestatus from pointupdating LIMIT 1"))
         {
            $status=mysql_result($updatestatus, 0,0);
            if($status=='yes')
            {
                 echo("<script>window.location= 'Updating.php';</script>");
            }
          }
       
        }
        else
        {
                echo("<script>window.location= 'index.php';</script>");
        }
?>
