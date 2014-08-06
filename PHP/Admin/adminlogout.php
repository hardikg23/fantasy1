
<?php
@session_start();
@session_destroy();
   echo "<script>window.location='AdminLoginAuthentication.php'</script> ";
//header('Location: AdminLoginAuthentication.php');

?>
