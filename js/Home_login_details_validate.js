$('#login').click(function(){
    login_clicked();

});

function runScript(e) {
    if (e.keyCode == 13) {
        login_clicked();
    }
}

function login_clicked(){

    var cookieFlag=false;
    if($('#keep-logged-in').is(":checked"))
        cookieFlag=true;

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
            login_pass:login_pass,
            cookieFlag:cookieFlag
        },
        function(data){
            if(data=="done"){
                if(cookieFlag == true)
                {
                    var exdate = new Date();
                    exdate.setDate(exdate.getDate() + 30);
                    document.cookie="emailID="+login_email+"; expires="+exdate;
                    document.cookie="password="+login_pass+"; expires="+exdate;
                }
                window.location="ManageTeam.php";
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
