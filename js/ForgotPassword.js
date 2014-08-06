$('#forgotpassword').click(function(){
    $('#forgotpass').css('visibility','visible');
    document.getElementById('user_email').value = "";
    document.getElementById("emptyEmailError").style.display="none";
    $('#user_email').css('border-color','none');
    $('#user_email').css('box-shadow', '0px 0px 0px');
    $('#user_email').css('border', '1px solid #CCC');
    $('#wrongEmailError').empty();

});

$('#go').click(function(){
    if(validateForPass()==true)
    {
         var email=$('#user_email').val();
         $.post('PHP/ForgotPassword.php',{input1:email},
         function(data)
         {
           if(data=='NOTHING')
           {
			   $('#wrongEmailError').empty();
               $('#wrongEmailError').append("Email Doesn't Match");
               $('#user_email').css('border','1px solid red');
               $('#user_email').css('box-shadow', '0px 0px 5px red');
           }
           else
           {
               alert(data);
               $('#user_email').css('border','1px solid green');
               $('#user_email').css('box-shadow', '0px 0px 5px green');
	       $('#forgotpass').css('visibility','hidden');

           }
         });
    }
});
