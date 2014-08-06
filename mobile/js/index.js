/*$(document).ready(function() {
    var winH = $(window).height();
    var winW = $(window).width();
    $('.body-container').css('width',winW);
    $('.body-container').css('height',winH);

    $('.data-container').css('left', winW/2-$('.data-container').width()/2);
    if(winH/2.5-$('.data-container').height()/2 > 70)
        $('.data-container').css('top', winH/2.5-$('.data-container').height()/2);
    else
        $('.data-container').css('top', 70);

    $('.image_logo').css('left', winW/2-$('.data-container').width()/2);
    $('.text_logo').css('left', winW/2-$('.data-container').width()/2 + 50);


});

$(window).resize(function() {
    var winH = $(window).height();
    var winW = $(window).width();
    $('.body-container').css('width',winW);
    $('.body-container').css('height',winH);

    $('.data-container').css('left', winW/2-$('.data-container').width()/2);
    if(winH/2.5-$('.data-container').height()/2 > 70)
        $('.data-container').css('top', winH/2.5-$('.data-container').height()/2);
    else
        $('.data-container').css('top', 70);
        
    $('.image_logo').css('left', winW/2-$('.data-container').width()/2);  //logo LEFT position
    $('.text_logo').css('left', winW/2-$('.data-container').width()/2 + 50); //text LEFT position
});
*/
$('#login').click(function(){
    login_clicked();
});
function login_clicked(){

 
    var loginflag=true;
    var login_email=$('#email').val();
    var login_pass=$('#pass').val();
    if(login_email=="" && login_pass==""){
        //alert("Enter Email Address and Password");
        $('#email,#pass').css('border-color','red');
        $('#email,#pass').css('box-shadow', '0px 0px 5px red');

        loginflag=false;
    }
    else if(login_email==""){
        //alert("Enter Email Address");
        $('#email').css('border-color','red');
        $('#email').css('box-shadow', '0px 0px 5px red');
        loginflag=false;
    }
    else if(login_pass==""){
        //alert("Enter PassWord");
        $('#pass').css('border-color','red');
        $('#pass').css('box-shadow', '0px 0px 5px red');
        loginflag=false;
    }
    if(loginflag==true){
        $.post('PHP/login_validation.php',{
            login_email:login_email,
            login_pass:login_pass
        },
        function(data){
            if(data=="done"){
                window.location="manageteam.php";
                document.cookie="emailID="+login_email+"; expires=Thu, 18 Dec 2016 12:00:00 GMT";
            //document.cookie = "emailID=; expires=Thu, 01 Jan 1970 00:00:00 GMT";
            }
            else
            {
                alert(data);
            }
        });
    }
}



$('#email').focus(function(){
    $('#email').css('border-color','#12DEE5');
    $('#email').css('box-shadow', '0px 0px 5px #12DEE5');
});
$('#email').focusout(function(){
    $('#email').css('border-color','silver');
    $('#email').css('box-shadow', 'none');
});
$('#pass').focus(function(){
    $('#pass').css('border-color','#12DEE5');
    $('#pass').css('box-shadow', '0px 0px 5px #12DEE5');
});
$('#pass').focusout(function(){
    $('#pass').css('border-color','silver');
    $('#pass').css('box-shadow', 'none');
});

