$(document).ready(function(){
    $('.href-tr').click(function(){
        window.location = $(this).attr('href');
        return false;
    });
});

$('.joinCLUB').click(function(){
    var match = $(this).attr('name');
    var code = $(this).attr('code');
    var pay = $(this).attr('pay');
    $('.daillog-text').append("Are you sure?");

    $(function() {
        $( "#dialog-confirm" ).dialog({
            resizable: false,
            height:140,
            modal: true,
            buttons: {
                "JOIN": function() {
                    $( this ).dialog( "close" );
                    $.post('PHP/joinInClub.php?seriesId='+seriesId, {
                        matchID:match,
                        Code : code,
                        pay : pay
                    },
                    function(data){
                        if(data == 'done')
                        {
                            alert("You are join in the Club and "+pay+"rs is deducted from your account.");
                            location.reload();
                        }else{
                            alert(data);
                        }
                    }
                    );


                },
                Cancel: function() {
                    $( this ).dialog( "close" );
                }
            }
        });
    });

});
$(document).ready(function (){
    var container = $('.fixture-div'),
    scrollTo = $('#current-tr');
    container.scrollTop(
        scrollTo.offset().top - container.offset().top + container.scrollTop() - 50
        );
});
