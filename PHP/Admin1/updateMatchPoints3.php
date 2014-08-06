<?php
include '../includes/database_connectivity_includes.php';

if(isset ($_POST['seriesId']) && isset ($_POST['matchId']) && isset ($_POST['matchType']) && isset ($_POST['playerData']))
{
    if(!empty ($_POST['seriesId']) && !empty ($_POST['matchId']) && !empty ($_POST['matchType']) && !empty ($_POST['playerData']))
    {
        $seriesId=mysql_real_escape_string(htmlentities($_POST['seriesId']));
        $matchId=mysql_real_escape_string(htmlentities($_POST['matchId']));
        $matchType=mysql_real_escape_string(htmlentities($_POST['matchType']));
        $playerID=mysql_real_escape_string(htmlentities($_POST['playerData']));
        echo "series id :$seriesId<br><br>";
        echo "Match id :$matchId<br><br>";
        echo "Match type :$matchType<br><br>";
        echo "player ID :$playerID<br><br>";
        $playerTable='s'.$seriesId.'_player_data';


        if(isset ($_POST['runs'])  &&
           isset ($_POST['duck'])  &&
           isset ($_POST['balls'])  &&
           isset ($_POST['sixs'])  &&
           isset ($_POST['overs'])  &&
           isset ($_POST['minOvers'])  &&
           isset ($_POST['maiden'])  &&
           isset ($_POST['ballRuns'])  &&
           isset ($_POST['wiket'])  &&
           isset ($_POST['dotBall'])  &&
           isset ($_POST['catch'])  &&
           isset ($_POST['runout']) &&
           isset ($_POST['mom'])  &&
           isset ($_POST['winMatch'])) {
           $runs=0;
           $duck='no';
           $balls=0;
           $sixs=0;
           $overs=0;
           $minOvers=0;
           $maiden=0;
           $ballRuns=0;
           $wiket=0;
           $hattrik='no';
           $dotBall=0;
           $catch=0;
           $runout=0;
           $mom='no';
           $winMatch='no';
           
            if(!empty ($_POST['runs'])) { $runs=mysql_real_escape_string(htmlentities($_POST['runs']));}
            if(!empty ($_POST['duck'])) { $duck=mysql_real_escape_string(htmlentities($_POST['duck']));}
            if(!empty ($_POST['balls'])) { $balls=mysql_real_escape_string(htmlentities($_POST['balls']));}
            if(!empty ($_POST['sixs'])) { $sixs=mysql_real_escape_string(htmlentities($_POST['sixs']));}
            if(!empty ($_POST['overs'])) { $overs=mysql_real_escape_string(htmlentities($_POST['overs']));}
            if(!empty ($_POST['minOvers'])) {  $minOvers=mysql_real_escape_string(htmlentities($_POST['minOvers']));}
            if(!empty ($_POST['maiden'])) { $maiden=mysql_real_escape_string(htmlentities($_POST['maiden']));}
            if(!empty ($_POST['ballRuns'])) { $ballRuns=mysql_real_escape_string(htmlentities($_POST['ballRuns']));}
            if(!empty ($_POST['wiket'])) { $wiket=mysql_real_escape_string(htmlentities($_POST['wiket']));}
            if(!empty ($_POST['hattrik'])) { $hattrik=mysql_real_escape_string(htmlentities($_POST['hattrik']));}
            if(!empty ($_POST['dotBall'])) { $dotBall=mysql_real_escape_string(htmlentities($_POST['dotBall']));}
            if(!empty ($_POST['catch'])) { $catch=mysql_real_escape_string(htmlentities($_POST['catch']));}
            if(!empty ($_POST['runout'])) { $runout=mysql_real_escape_string(htmlentities($_POST['runout']));}
            if(!empty ($_POST['mom'])) { $mom=mysql_real_escape_string(htmlentities($_POST['mom']));}
            if(!empty ($_POST['winMatch'])) { $winMatch=mysql_real_escape_string(htmlentities($_POST['winMatch']));}


            echo '<table width="60%">';
            echo "<tr><td>RUNS SCPRED : $runs   DUCK: $duck       </td><td>BALLs PLAYED : $balls       </td><td>SIX         : $sixs</td></tr>";
            echo "<tr><td>OVERS BALWED: $overs        </td><td>BALLs PLAYED : $minOvers    </td><td>MAIDEN OVES : $maiden</td></tr>";
            echo "<tr><td>RUN GIVEN   : $ballRuns     </td><td>WIKET TAKEN  : $wiket   HATTRICK: $hattrik    </td><td>DOT BALLS   : $dotBall</td></tr>";
            echo "<tr><td>CATCHES     : $catch        </td><td>RUNOUTS      : $runout</td></tr>";
            echo "<tr><td>MOM         : $mom          </td><td>WON MATCH    : $winMatch</td></tr>";
            echo '</table>';


            if($ResutlSet_of_player_info=mysql_query("SELECT id,style,Name,match$matchId from $playerTable where id=$playerID LIMIT 1")){
                $id=mysql_result($ResutlSet_of_player_info, 0,'id');
                $style=mysql_result($ResutlSet_of_player_info, 0,'style');
                $name=mysql_result($ResutlSet_of_player_info, 0,'Name');
                $matchPoints=mysql_result($ResutlSet_of_player_info, 0,'match'.$matchId);
                echo "Player ID : $id<br>Player Style : $style <br> Player Name : $name  <br> Player Match Points : $matchPoints";

                //function to calculate match points.................
                updatePlyerPoints($id,$style,$matchType,$runs,$duck,$balls,$sixs,$overs,$minOvers,
                $maiden,$ballRuns,$wiket,$hattrik,$dotBall,$catch,$runout,$mom,$winMatch,$seriesId,$matchId);



            }else {
                    echo 'ERROR while retriving data...';
            }
           }
         }
}
// FUNCTION TO check No OF Player in TEAM And CAPTAIN ********************************************************
function updatePlyerPoints($id,$style,$matchType,$runs,$duck,$balls,$sixs,$overs,$minOvers,
                $maiden,$ballRuns,$wiket,$hattrik,$dotBall,$catch,$runout,$mom,$winMatch,$seriesId,$matchId) {

    $batPoints=0;$ballPoints=0;$fieldPoints=0;$bonusPoints=0;$totalPoints=0;

    if(strtoupper($matchType) == 'ODI')
    {
        if($style != 5)
        {
            $batPoints += $runs;
        }else if($style == 5)
            $batPoints += ($runs*2);

        //echo "batPoints$batPoints<br>";
        $batPoints += $sixs*5;
        //echo "batPoints$batPoints<br>";
        $batPoints += floor(($runs/10))*5;
        //echo "batPoints$batPoints<br>";
        $batPoints += round(($runs * 1.2 - $balls));
        //echo "batPoints$batPoints<br>";

        if(strtoupper($duck) == 'YES' && $style != 5)
            $batPoints -= 20;


        if($style == 5 || $style == 4)
        {
            $ballPoints += $wiket*25;
        }else
            $ballPoints += $wiket*30;


            if(strtoupper($hattrik) == 'YES')
                $ballPoints += 30;
//echo "batPointsWik$ballPoints<br>";
        $ballingExtras=0;
        for($i=2;$i<=$wiket;$i++)
        {
            if($i==2)
                $ballingExtras += 5;
            if($i==3)
                $ballingExtras += 10;
            if($i>=4)
                $ballingExtras += 15;
        }
        
         $ballPoints += $ballingExtras;
         //echo "batPointsEXT$ballPoints<br>";
         $ballPoints += $maiden*12;
         //echo "batPointsMEd$ballPoints<br>";
         $ballPoints = $ballPoints + (($overs*6+$minOvers)-$ballRuns) * 2;
         //echo "batPointsrate$ballPoints<br>";


         $fieldPoints = $catch*15 + $runout*15 + $fieldPoints;

         if(strtoupper($mom)=='YES')
             $bonusPoints += 50;
         if(strtoupper($winMatch) == 'YES')
             $bonusPoints += 10;


             $totalPoints=$batPoints+$ballPoints+$fieldPoints+$bonusPoints;
             echo $pointString="<br>$batPoints#@#$ballPoints#@#$fieldPoints#@#$bonusPoints";
             echo "<br>TOTAL POINTS: $totalPoints";

    }else if(strtoupper($matchType) == 'T20')
    {
        if($style != 5)
        {
           $batPoints += $runs;
        }else if($style == 5)
           $batPoints += ($runs*2);

        echo "<br> BATTING POINTS $batPoints";
        $batPoints += $sixs*6;
        echo "<br> BATTING + SIX hits $batPoints";
        $batPoints += floor(($runs/10))*5;
        echo "<br> BATTING + SIX + 10 points extra $batPoints";
        $batPoints += round(($runs * 1.2 - $balls));
        echo "<br> BATTING + SIX + 10 points + STRIK RATE $batPoints <br>";
        if(strtoupper($duck) == 'YES' && $style != 5)
         $batPoints -= 20;


        if($style == 5 || $style == 4)
        {
            $ballPoints += $wiket*25;
        }else
            $ballPoints += $wiket*30;
             echo "<br> WICKET TAKEN POINTS $ballPoints";
        if(strtoupper($hattrik) == 'YES')
        $ballPoints += 30;
        $ballPoints += $maiden*15;
        $ballPoints += $dotBall;
        echo "<br> WICKET TAKEN + MAIDEN + DOT BALL $ballPoints";

        $ballingExtras=0;
        for($i=2;$i<=$wiket;$i++)
        {
            if($i==2)
                $ballingExtras += 5;
            if($i==3)
                $ballingExtras += 10;
            if($i>=4)
                $ballingExtras += 15;
        }
        

         $ballPoints += $ballingExtras;
         echo "<br> WICKET TAKEN + MAIDEN + DOT BALL + EXTRAS on WIKETs $ballPoints";

         $ballPoints = $ballPoints + round((($overs*6+$minOvers)*1.5-$ballRuns) * 2);
         echo "<br> WICKET TAKEN + MAIDEN + DOT BALL + EXTRAS +economi $ballPoints <br>";

         $fieldPoints = $catch*15 + $runout*15 + $fieldPoints;

         if(strtoupper($mom)=='YES')
             $bonusPoints += 50;
         if(strtoupper($winMatch) == 'YES')
             $bonusPoints += 10;

        $totalPoints=$batPoints+$ballPoints+$fieldPoints+$bonusPoints;
          echo $pointString="<br>$batPoints#@#$ballPoints#@#$fieldPoints#@#$bonusPoints";
         echo "<br>TOTAL POINTS: $totalPoints";


    }else if(strtoupper($matchType) == 'TEST')
    {
       
        $batPoints += $runs;
        //echo "batPoints$batPoints<br>";
        $batPoints += $sixs*8;
        $batPoints += floor(($balls/5));
        //echo "batPoints$batPoints<br>";
        $batPoints += floor(($runs/25))*10;
        //echo "batPoints$batPoints<br>";
        $batPoints += round(($runs * 1.5 - $balls));
        //echo "batPoints$batPoints<br>";

         if(strtoupper($duck) == 'YES' && $style != 5)
            $batPoints -= 30;


        if($style == 5 || $style == 4)
        {
            $ballPoints += $wiket*25;
        }else
            $ballPoints += $wiket*35;

            echo "batPointsWik$ballPoints<br>";
        $ballingExtras=0;
            if($wiket==3)
                $ballingExtras += 30;
            if($wiket==5)
                $ballingExtras += 45;
            if($wiket>=7)
                $ballingExtras += 55;
            
          if(strtoupper($hattrik) == 'YES')
              $ballPoints += 30;

         $ballPoints += $ballingExtras;
         echo "batPointsEXT$ballPoints<br>";
         $ballPoints += $overs*2;
         echo "batPointsMEd$ballPoints<br>";
         //echo "batPointsrate$ballPoints<br>";


         $fieldPoints = $catch*15 + $runout*15 + $fieldPoints;

         if(strtoupper($mom)=='YES')
             $bonusPoints += 100;
         if(strtoupper($winMatch) == 'YES')
             $bonusPoints += 10;


             $totalPoints=$batPoints+$ballPoints+$fieldPoints+$bonusPoints;
             echo $pointString="$batPoints#@#$ballPoints#@#$fieldPoints#@#$bonusPoints";
             echo "<br>TOTAL POINTS: $totalPoints";
             

    }

    $playerTable='s'.$seriesId.'_player_data';
    $updatestring="UPDATE $playerTable
            SET match$matchId='$pointString',
                batting_pts=batting_pts+$batPoints,
                bowling_pts=bowling_pts+$ballPoints,
                fielding_pts=fielding_pts+$fieldPoints,
                total_bonus=total_bonus+$bonusPoints,
                total_point=total_point+$totalPoints
            WHERE id=$id ;";
    echo '<br/>'.$updatestring;
    
}
//************************************************************************************************
?>
