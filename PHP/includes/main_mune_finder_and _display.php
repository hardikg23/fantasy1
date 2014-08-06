<html>
    <head>
          <link rel="stylesheet" type="text/css" href="PHP/includes/css/Main_Menu.css">
    </head>
    <body>
<?php

    echo '<div class="MainMenu font-containt">';
    //if(empty ($session_email) && empty ($session_password))
    //{
            if($result=mysql_query("SELECT * from series_data where status=1"))
            {
            while($row=mysql_fetch_array($result)) {  //to get all data.....
                    $name=mysql_real_escape_string($row['name']);
                    $id=mysql_real_escape_string($row['id']);
                    echo '<a id=series'.$id.' class="MainMenuElement" href=Home.php?seriesId='.$id.'>'.$name.'</a>';
                }
            }else{
                echo 'No On-Going Series';
            }
    echo '</div>';
                
?>
    <input type="text" id="seriesId_hidden" hidden="hidden" value="<?php echo $seriesId?>" >
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="PHP/includes/js/Main_Menu.js"></script>
    </body>
</html>