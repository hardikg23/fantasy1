<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
        <link rel="stylesheet" type="text/css" href="PHP/includes/css/diplay_4_type_of_player_at_bottem.css">
        <div class="font-containt box-shadow-comman" style="position: absolute;width: 233px;height: 260px;left: 10px;top: 594px;">
           <div class="black-header font-containt-bold">
               <caption>BATSMAN</caption>
           </div>
           <div align="center" style="background-color: #FF957F">
              <?php
                                    $s='s'.$seriesId.'_player_data';
                                    if($result=mysql_query("SELECT Name,price,total_point,imgSrc from $s where style=1 OR style =2 ORDER BY total_point DESC LIMIT 5"))
                                    {

                                        $name=mysql_real_escape_string(mysql_result($result, 0,'Name'));
                                        $price=mysql_real_escape_string(mysql_result($result, 0,'price'));
                                        $point=mysql_real_escape_string(mysql_result($result, 0,'total_point'));
                                        $playerImage=mysql_real_escape_string(mysql_result($result, 0,'imgSrc'));
                                        $playerImage='photos/players/'.$playerImage;

                                        echo '<img src="'.$playerImage.'" alt="player-image"  width="110px" height="120px" class="player-item">';
                                        echo '<table class="player-table" width=230px height=100px>';
                                        echo '<tr style="background-color: #9C2911;"><th>PLAYER</th><th>POINTS</th><th>PRICE</th></tr>';
                                        echo '<tr><td>'.$name.'</td><td>'.$point.'</td><td>'.$price.'</td></tr>';
                                        while($row=mysql_fetch_array($result)){
                                        $name=mysql_real_escape_string($row['Name']);
                                        $price=mysql_real_escape_string($row['price']);
                                        $point=mysql_real_escape_string($row['total_point']);
                                        echo '<tr>';
                                        echo '<td>'.$name.'</td><td>'.$point.'</td><td>'.$price.'</td>';
                                        echo '</tr>';

                                    }
                                    echo '</table>';
                                    }else
                                    {
                                        echo '<center>NO PLAYER INFORMATION FOUND</center>';
                                    }
                                 ?>
                         </div>
                     </div>

                     <div class="font-containt box-shadow-comman" style="position: absolute;width: 233px;height: 260px;left: 259px;top: 594px;">
                                <div class="black-header font-containt-bold">
                                    <caption>BOWLER</caption>
                                </div>
                         <div align="center" style="background-color: #FAEFB1">
                                <?php
                                    $s='s'.$seriesId.'_player_data';
                                    if($result=mysql_query("SELECT Name,price,total_point,imgSrc from $s where style=5 ORDER BY total_point DESC LIMIT 5"))
                                    {

                                        $name=mysql_real_escape_string(mysql_result($result, 0,'Name'));
                                        $price=mysql_real_escape_string(mysql_result($result, 0,'price'));
                                        $point=mysql_real_escape_string(mysql_result($result, 0,'total_point'));
                                        $playerImage=mysql_real_escape_string(mysql_result($result, 0,'imgSrc'));
                                        $playerImage='photos/players/'.$playerImage;

                                        echo '<img src="'.$playerImage.'" alt="player-image"  width="110px" height="120px" class="player-item">';
                                        echo '<table class="player-table" width=230px height=100px>';
                                        echo '<tr style="background-color: #A68E07;"><th>PLAYER</th><th>POINTS</th><th>PRICE</th></tr>';
                                        echo '<tr><td>'.$name.'</td><td>'.$point.'</td><td>'.$price.'</td></tr>';
                                        while($row=mysql_fetch_array($result)){
                                            $name=mysql_real_escape_string($row['Name']);
                                            $price=mysql_real_escape_string($row['price']);
                                            $point=mysql_real_escape_string($row['total_point']);
                                            echo '<tr>';
                                            echo '<td>'.$name.'</td><td>'.$point.'</td><td>'.$price.'</td>';
                                            echo '</tr>';

                                    }
                                    echo '</table>';
                                    }
                                    else
                                    {
                                        echo '<center>NO PLAYER INFORMATION FOUND</center>';
                                    }
                                 ?>
                         </div>
                     </div>

                     <div class="font-containt box-shadow-comman" style="position: absolute;width: 233px;height: 260px;left: 508px;top: 594px;">
                                <div class="black-header font-containt-bold">
                                    <caption>WEEKER-KEEPER</caption>
                                </div>
                         <div align="center" style="background-color: #FAA6B0">
                                <?php
                                    $s='s'.$seriesId.'_player_data';
                                    if($result=mysql_query("SELECT Name,price,total_point,imgSrc from $s where style=3 OR style=2 ORDER BY total_point DESC LIMIT 5"))
                                    {
                                        $name=mysql_real_escape_string(mysql_result($result, 0,'Name'));
                                        $price=mysql_real_escape_string(mysql_result($result, 0,'price'));
                                        $point=mysql_real_escape_string(mysql_result($result, 0,'total_point'));
                                        $playerImage=mysql_real_escape_string(mysql_result($result, 0,'imgSrc'));
                                        $playerImage='photos/players/'.$playerImage;

                                        echo '<img src="'.$playerImage.'" alt="player-image"  width="110px" height="120px" class="player-item">';
                                        echo '<table class="player-table" width=230px height=100px>';
                                        echo '<tr style="background-color: #AB091B;"><th>PLAYER</th><th>POINTS</th><th>PRICE</th></tr>';
                                        echo '<tr><td>'.$name.'</td><td>'.$point.'</td><td>'.$price.'</td></tr>';
                                        while($row=mysql_fetch_array($result)){
                                        $name=mysql_real_escape_string($row['Name']);
                                        $price=mysql_real_escape_string($row['price']);
                                        $point=mysql_real_escape_string($row['total_point']);
                                        echo '<tr>';
                                        echo '<td>'.$name.'</td><td>'.$point.'</td><td>'.$price.'</td>';
                                        echo '</tr>';
                                    }
                                    echo '</table>';
                                    }
                                    else
                                    {
                                        echo '<center>NO PLAYER INFORMATION FOUND</center>';
                                    }
                                 ?>
                         </div>
                     </div>

                     <div class="font-containt box-shadow-comman" style="position: absolute;width: 233px;height: 260px;left: 757px;top: 594px;">
                         <div class="black-header font-containt-bold">
                                <caption>ALL-ROUNDER</caption>
                         </div>
                         <div align="center" style="background-color: #F7B596">
                                <?php
                                    $s='s'.$seriesId.'_player_data';
                                    if($result=mysql_query("SELECT Name,price,total_point,imgSrc from $s where style=4 ORDER BY total_point DESC LIMIT 5"))
                                    {
                                        $name=mysql_real_escape_string(mysql_result($result, 0,'Name'));
                                        $price=mysql_real_escape_string(mysql_result($result, 0,'price'));
                                        $point=mysql_real_escape_string(mysql_result($result, 0,'total_point'));
                                        $playerImage=mysql_real_escape_string(mysql_result($result, 0,'imgSrc'));
                                        $playerImage='photos/players/'.$playerImage;

                                        echo '<img src="'.$playerImage.'" alt="player-image"  width="110px" height="120px" class="player-item">';
                                        echo '<table class="player-table" width=230px height=100px>';
                                        echo '<tr style="background-color: #DC4D0A;"><th>PLAYER</th><th>POINTS</th><th>PRICE</th></tr>';
                                        echo '<tr><td>'.$name.'</td><td>'.$point.'</td><td>'.$price.'</td></tr>';
                                        while($row=mysql_fetch_array($result)){
                                        $name=mysql_real_escape_string($row['Name']);
                                        $price=mysql_real_escape_string($row['price']);
                                        $point=mysql_real_escape_string($row['total_point']);
                                        echo '<tr>';
                                        echo '<td>'.$name.'</td><td>'.$point.'</td><td>'.$price.'</td>';
                                        echo '</tr>';
                                    }
                                    echo '</table>';
                                    }else
                                    {
                                        echo '<center>NO PLAYER INFORMATION FOUND</center>';
                                    }
                                 ?>
                         </div>
                     </div>