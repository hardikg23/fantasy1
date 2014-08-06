<?php
?>
<style>
    a{
        text-decoration: none;
    }
</style>

<br>
<div style="width: 100%">
    <a class="menu-link" href="manageteam.php?seriesId=<?php echo $seriesId;?>"><button class="ui-btn ui-btn-b" style="height: 28px;font-size: 15px;padding-top: 2px;">MANAGE TEAM</button></a>
    <a class="menu-link" href="PointHistory.php?seriesId=<?php echo $seriesId;?>"><button class="ui-btn ui-btn-b" style="height: 28px;font-size: 15px;padding-top: 2px;">VIEW POINTS</button></a>
    <a class="menu-link" href="leaderboard.php?seriesId=<?php echo $seriesId;?>"><button class="ui-btn ui-btn-b" style="height: 28px;font-size: 15px;padding-top: 2px;">LEADERBOARD</button></a>
    <a class="menu-link" href="Fixture.php?seriesId=<?php echo $seriesId;?>"><button class="ui-btn ui-btn-b" style="height: 28px;font-size: 15px;padding-top: 2px;">FIXTURE</button></a>
    <a class="menu-link" href="Stats.php?seriesId=<?php echo $seriesId;?>"><button class="ui-btn ui-btn-b" style="height: 28px;font-size: 15px;padding-top: 2px;">STATISTICS</button></a>

    <div align="center" style="font-size: 10px;color:#EA3608;">
        <a href="http://www.fantasycricleague.com/fantasy/" style="color:#EA3608;">full site</a> |
        <a href="logout.php" style="color:#EA3608;">logout</a>
    </div>
</div>
<script type="text/javascript">
    $('.menu-link').click(function(){
      $(this).attr('disabled', 'disabled');
    });
</script>