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
                <div style="background-color: black;padding-left: 5px;padding-right: 5px;padding-top: 5px;padding-bottom: 5px;">
                    <font style="color: white;font-size: 16px;">STATISTICS</font>
                </div>

                <div style="width: 100%;">
                    <?php
                    $s='s'.$seriesId.'_player_data';
                    $query="SELECT * from $s ORDER BY team,style,total_point DESC";
                    if($result=mysql_query($query)) {

                        echo '<table align="center" data-role="table" id="table-column-toggle" data-mode="columntoggle" class="ui-responsive table-stroke" style="color: #5F6060;font-size: 10px;">';
                        echo '<thead><tr>
                                  <th></th>
                                  <th>PLAYER</th>
                                  <th>TEAMS</th>
                                  <th>POINTS</th>
                                  <th data-priority="1">PRICE</th>
                                  <th data-priority="2">VALUE</th>
                                  <th data-priority="3">SELECTEDBY</th>
                              </tr></thead>';

                        $inc=1;
                        while($row=mysql_fetch_array($result)) {
                            $name=mysql_real_escape_string($row['Name']);
                            $team=mysql_real_escape_string($row['team']);
                            $price=mysql_real_escape_string($row['price']);
                            $style=mysql_real_escape_string($row['style']);
                            $point=mysql_real_escape_string($row['total_point']);
                            $value=mysql_real_escape_string($row['value']);

                            $value=intval($value);
                            $col=mysql_real_escape_string($row['selectedBy']);
                            $s_user_eleven='s'.$seriesId.'_user_eleven';
                            if(@$result2=mysql_query("SELECT count(DISTINCT user_id) from $s_user_eleven")) {
                                $data=mysql_result($result2, 0);
                                if($data >0 && $col>=0 ) {
                                    $col=$col*100/$data;
                                    $col=floor($col).'%';
                                }else {
                                    $col='0%';
                                }
                            }else {
                                $col='0%';
                            }

                            echo '<tr>';
                            echo '<td><img src="image/style/style'.$style.'.png" alt="$style" width="18px" height="18px"></td>
                                    <td>'.$name.'</td>
                                    <td>'.$team.'</td>
                                    <td>'.$point.'</td>
                                    <td>'.$price.'</td>
                                    <td>'.$value.'</td>
                                    <td>'.$col.'</td>';
                            echo '</tr>';
                            $inc++;
                        }
                        echo '</table>';


                    }else {
                        echo '<center>SOME ERROR OCCURED</center>';
                    }


                    ?>

                </div>

            </div>
            <div>
                <?php
                include 'PHP/includes/menu.php';
                ?>
            </div>

        </div>


        <script type="text/javascript" src="js/manageteam.js"></script>

    </body>
</html>
