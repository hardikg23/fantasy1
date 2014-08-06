<?php
include 'includes/database_connectivity_includes.php';
@session_start();
if(isset ($_SESSION['email'])&&isset ($_SESSION['password'])) {
    if(!empty ($_SESSION['email'])) {
        $session_email= $_SESSION['email'];
    }
    if(!empty ($_SESSION['password']))
        $session_password= $_SESSION['password'];
}
include 'includes/seriedId_setter.php';
if(isset ($_POST['item1']) && isset ($_POST['item2']) && isset ($_POST['item3'])) {
    $item1=mysql_real_escape_string($_POST['item1']);
    $item2=mysql_real_escape_string($_POST['item2']);
    $item3=mysql_real_escape_string($_POST['item3']);
    $s='s'.$seriesId.'_player_data';
    if(!empty ($_POST['item1']) && !empty ($_POST['item2']) && !empty ($_POST['item3'])) {
        $s='s'.$seriesId.'_player_data';
        if($item1=='all' && $item2=='all')
            $query="SELECT * from $s ORDER BY $item3 DESC";
        else if($item1 != 'all' && $item2=='all') {
            $query="SELECT * from $s where team='$item1' ORDER BY $item3 DESC";
        }
        else if($item1 == 'all' && $item2!='all') {
            if($item2=='batsman')
                $query="SELECT * from $s where style=1 OR style=2 ORDER BY $item3 DESC";
            elseif ($item2=='all-rounder')
                $query="SELECT * from $s where style=4 ORDER BY $item3 DESC";
            elseif ($item2=='weeket-keeper')
                $query="SELECT * from $s where style=3 OR style=2 ORDER BY $item3 DESC";
            elseif ($item2=='bowler')
                $query="SELECT * from $s where style=5 ORDER BY $item3 DESC";
        }
        else if($item1 != 'all' && $item2!='all') {
            if($item2=='batsman')
                $query="SELECT * from $s where team='$item1' AND (style=1 OR style=2) ORDER BY $item3 DESC";
            elseif ($item2=='all-rounder')
                $query="SELECT * from $s where team='$item1' AND style=4 ORDER BY $item3 DESC";
            elseif ($item2=='weeket-keeper')
                $query="SELECT * from $s where team='$item1' AND (style=3 OR style=2) ORDER BY $item3 DESC";
            elseif ($item2=='bowler')
                $query="SELECT * from $s where team='$item1' AND style=5 ORDER BY $item3 DESC";

        }

        $result=mysql_query($query) or die(mysql_error());
        echo '<table class="tablesorter stats-table"><thead>';

        if($item3=='total_point')
            echo '<tr><th>#</th><th>PLAYER</th><th>TEAM</th><th>PRICE</th><th>BATTING</th><th>BOWLING</th><th>FIELDING</th><th>BOUNCE</th><th>POINTS</th></tr></thead><tbody>';
        else {
            $it=strtoupper($item3);
            echo "<tr><th>#</th><th>PLAYER</th><th>TEAM</th><th>PRICE</th><th>BATTING</th><th>BOWLING</th><th>FIELDING</th><th>$it</th><th>POINTS</th></tr></thead><tbody>";
        }
        $inc=1;
        while($row=mysql_fetch_array($result)) {
            $name=mysql_real_escape_string($row['Name']);
            $team=mysql_real_escape_string($row['team']);
            $price=mysql_real_escape_string($row['price']);
            $batting_pts=mysql_real_escape_string($row['batting_pts']);
            $bowling_pts=mysql_real_escape_string($row['bowling_pts']);
            $fielding_pts=mysql_real_escape_string($row['fielding_pts']);
            $point=mysql_real_escape_string($row['total_point']);
            if($item3=='total_point')
                $col=mysql_real_escape_string($row['total_bonus']);
            else
                $col=mysql_real_escape_string($row[$item3]);
            if($item3=='selectedBy') {
                $s_user_eleven='s'.$seriesId.'_user_eleven';
                if(@$result2=mysql_query("SELECT count(DISTINCT user_id) from $s_user_eleven")) {
                    $data=mysql_result($result2, 0);
                    if($data >0 && $col>=0) {
                        $col=$col*100/$data;
                        $col=floor($col).'%';
                    }else {
                        $col='0%';
                    }
                }else {
                    $col='0%';
                }
            }
            echo '<tr>';
            echo '<td>'.$inc.'</td><td>'.$name.'</td><td>'.$team.'</td><td>'.$price.'</td><td>'.$batting_pts.'</td><td>'.$bowling_pts.'</td><td>'.$fielding_pts.'</td><td>'.$col.'</td><td>'.$point.'</td>';
            echo '</tr>';
            $inc++;
        }
        echo '</tbody></table>';



    }
    else {

    }
}
else {
    $s='s'.$seriesId.'_player_data';
    $result=mysql_query("SELECT * from $s ORDER BY total_point DESC") or die(mysql_error());
    echo '<table class="tablesorter stats-table"><thead>';
    echo '<tr><th>#</th><th>PLAYER</th><th>TEAM</th><th>PRICE</th><th>BATTING</th><th>BOWLING</th><th>FIELDING</th><th>BOUNCE</th><th>POINTS</th></tr></thead><tbody>';
    $inc=1;
    while($row=mysql_fetch_array($result)) {

        $name=mysql_real_escape_string($row['Name']);
        $team=mysql_real_escape_string($row['team']);
        $price=mysql_real_escape_string($row['price']);
        $batting_pts=mysql_real_escape_string($row['batting_pts']);
        $bowling_pts=mysql_real_escape_string($row['bowling_pts']);
        $fielding_pts=mysql_real_escape_string($row['fielding_pts']);
        $total_bonus=mysql_real_escape_string($row['total_bonus']);
        $point=mysql_real_escape_string($row['total_point']);
        echo '<tr>';
        echo '<td>'.$inc.'</td><td>'.$name.'</td><td>'.$team.'</td><td>'.$price.'</td><td>'.$batting_pts.'</td><td>'.$bowling_pts.'</td><td>'.$fielding_pts.'</td><td>'.$total_bonus.'</td><td>'.$point.'</td>';
        echo '</tr>';
        $inc++;
    }
    echo '</tbody></table>';
}
?>
<script type="text/javascript">
    $('.tablesorter').tablesorter();
</script>