$(document).ready(function(){
    var loc = window.location.href;
    //alert(loc);
    if(loc.indexOf("Home.php") != -1)
    {
        $('.SubLargeElement').removeClass('SubLargeElement');
        $('.a-home').addClass('SubLargeElement');
    }else if(loc.indexOf("ManageTeam.php") != -1){
        $('.SubLargeElement').removeClass('SubLargeElement');
        $('.a-manage').addClass('SubLargeElement');
    }else if(loc.indexOf("PointHistory.php") != -1 || loc.indexOf("ViewPoints.php") != -1 ){
        $('.SubLargeElement').removeClass('SubLargeElement');
        $('.a-pointhistory').addClass('SubLargeElement');
    }else if(loc.indexOf("League.php") != -1){
        $('.SubLargeElement').removeClass('SubLargeElement');
        $('.a-league').addClass('SubLargeElement');
    }else if(loc.indexOf("Leaderboard.php") != -1){
        $('.SubLargeElement').removeClass('SubLargeElement');
        $('.a-leaderboard').addClass('SubLargeElement');
    }else if(loc.indexOf("Stats.php") != -1){
        $('.SubLargeElement').removeClass('SubLargeElement');
        $('.a-stats').addClass('SubLargeElement');
    }else if(loc.indexOf("Fixture.php") != -1){
        $('.SubLargeElement').removeClass('SubLargeElement');
        $('.a-fixture').addClass('SubLargeElement');
    }else if(loc.indexOf("DailyChallenge.php") != -1){
        $('.SubLargeElement').removeClass('SubLargeElement');
        $('.a-daily').addClass('SubLargeElement');
    }
    else if(loc.indexOf("paytoplay.php") != -1){
        $('.SubLargeElement').removeClass('SubLargeElement');
        $('.a-play').addClass('SubLargeElement');
    }
});
