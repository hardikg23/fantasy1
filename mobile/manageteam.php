<?php
/*
 *  MANAGETEAM
*/
include 'PHP/includes/database_connectivity_includes.php';
@session_start();
include 'PHP/includes/session_setter.php';
include 'PHP/includes/seriedId_setter.php';

?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=0" />
        <link rel="stylesheet" href="css/jquery.mobile-1.4.2.min.css">
        <link rel="stylesheet" href="css/manageteam.css">
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/mJquery.js"></script>

    </head>
    <body>
        <div id="grad" class="body-container" >
            <?php
            include 'PHP/includes/header.php';
            ?>
            <div class="data-container" style="width: 100%;">
                <br>
                Manage Team Page
            </div>
            <div>
                <?php
                //echo $_COOKIE['emailID'];
                include 'PHP/includes/menu.php';
                ?>
            </div>

        </div>


        <script type="text/javascript" src="js/manageteam.js"></script>

    </body>
</html>
