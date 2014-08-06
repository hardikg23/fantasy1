<?php
// INDEX page
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=0" />
        <link rel="stylesheet" href="css/jquery.mobile-1.4.2.min.css">
        <link rel="stylesheet" href="css/index.css">

    </head>
    <body>
        <div id="grad" class="body-container" >
            <?php
            include 'PHP/includes/header.php';
            ?>

            <br>
            <br>
            <div class="data-container" style="position: absolute;width: 90%;padding-left: 5%;padding-right: 5%;">
                <font style="font-size: 12px; color: #939393">EMAIL </font>
                <input type="text" data-clear-btn="true" id="email" value="<?php echo @$_COOKIE['emailID'];?>">
                <font style="font-size: 12px; color: #939393">PASSWORD</font> 
                <input type="password" data-clear-btn="true" id="pass" value="">

                <button class="ui-btn ui-btn-b" id="login">Login</button>

                <br><br>

                <div align="center">
                    To register, visit <b>fantasycricleague.com</b> from a computer
                    or click on <a href="http://www.fantasycricleague.com/fantasy" style="color: #0AB2B7;">Full site</a>.
                </div>
            </div>
        </div>

        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/mJquery.js"></script>
        <script type="text/javascript" src="js/index.js"></script>

    </body>
</html>
