<?php
@session_start();
include '../../includes/database_connectivity_includes.php';

if (isset($_SESSION['setadminpassword']) && isset($_SESSION['setdatabasepassword'])) {
    ?>

    <html>
        <head>

            <style>
                .deposite-table{
                    border: 1px solid silver;
                }
                .deposite-table td{
                    padding-left: 20px;
                    border-bottom:  1px solid silver;
                }
            </style>
        </head>
        <body>
            <form name="form" method="post" action="depositePage.php">

                SELECT OPTION<select name="select-option">
                    <option value="V" selected="selected">Verifing</option>
                    <option value="A">Accepted</option>
                    <option value="R">Rejected</option>
                    <option value="B">ALL</option>
                    
                </select>
                <input type="submit" value="GO">
            </form>
            <?php
            if (isset($_POST['select-option']) && !empty($_POST['select-option'])) {
                $option = mysql_real_escape_string($_POST['select-option']);

               

                if ($option != 'B')
                    $query = "SELECT * FROM `depositehistory` WHERE `status` = '$option' order by TimeAndDate";
                else
                    $query = "SELECT * FROM `depositehistory`  order by TimeAndDate";
                if ($restlSet = mysql_query($query)) {

                    if (mysql_num_rows($restlSet) > 0) {
                        echo '<table class="deposite-table" solid silver" width = "80%">';
                        echo "<tr>
                                    <th>USER EMAIL ID</th>
                                    <th>AMOUNT</th>
                                    <th>TRANSACTION ID</th>
                                    <th>Time</th>
                                    <th>Status</th>
                               </tr>";
                        while ($row = mysql_fetch_array($restlSet)) {

                            $user_email = mysql_real_escape_string($row['user_email']);
                            $amount = mysql_real_escape_string($row['Amount']);
                            $transcationID = mysql_real_escape_string($row['transacrtionID']);
                            $timedate = mysql_real_escape_string($row['TimeAndDate']);
                            $status = mysql_real_escape_string($row['status']);

                            echo "<tr>
                                    <td>$user_email</td>
                                    <td>$amount</td>
                                    <td>$transcationID</td>
                                    <td>$timedate</td>
                                    <td>$status</td>
                               </tr>";
                        }
                        echo '</table>';
                    } else {
                        echo 'Not data to verify';
                    }
                } else {
                    echo 'can not access table';
                }
            } else {
                echo 'enter select option';
            }
    ?>
       </body>
    </html>

    <?php
} else {
    header('Location: ../AdminLoginAuthentication.php');
}
?>