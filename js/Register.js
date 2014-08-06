var userNameFlag=true;
/*
$('#user_name').keyup(function(){
    var uName=jQuery.trim($(this).val());
    $.post('PHP/includes/userName_Available_check.php',{userName:uName} ,
    
    function(data1){
        data1=data1+"";
        if(data1.indexOf('User Name is not available')!=-1)
        {
            userNameFlag=false;
            $('#user_name_status').html(data1);
            $('#user_name').css('border','1px solid red');
            $('#user_name').css('box-shadow', '0px 0px 5px red');
       }else{
            userNameFlag=true;
            $('#user_name_status').html("");
            
       }
    });
});*/
$('#user_name').focus(function(){
    $('#user_name_status').html("");
});
$('#user_name').blur(function(){
    var uName=jQuery.trim($(this).val());
    $.post('PHP/includes/userName_Available_check.php',{userName:uName} ,

    function(data1){
        data1=data1+"";
        if(data1.indexOf('User Name is not available')!=-1)
        {
            userNameFlag=false;
            $('#user_name_status').html(data1);
            $('#user_name').css('border','1px solid red');
            $('#user_name').css('box-shadow', '0px 0px 5px red');
       }else{
            userNameFlag=true;
            $('#user_name_status').html("");
       }
    });
});






var userEmailFlag=true;
$('#user_email').focus(function(){
    $('#user_email_status').html("");
});
$('#user_email').blur(function(){
    var uEmail=jQuery.trim($(this).val());
    $.post('PHP/includes/userEmail_Available_check.php',{userEmail:uEmail} ,
    
    function(data1){
        data1=data1+"";
        if(data1.indexOf('Email Address is Already in use')!=-1)
        {
            userEmailFlag=false;
            $('#user_email_status').html(data1);
            $('#user_email').css('border','1px solid red');
            $('#user_email').css('box-shadow', '0px 0px 5px red');
       }else{
           userEmailFlag=true;
           $('#user_email_status').html("");
       }
    });
});




$('#refreshsecuritycode').click(function()
{
    $.post('register_database.php',{ref:'refresh'},
   function(data)
   {
       
   });
   $('#codeimage').empty().html("<img src='Generate.php'>");
}); 
 
 
$('#submit').click(function(){

	if(validateForm()==true && userNameFlag && userEmailFlag)
             {
                var u_name=$('#user_name').val();
                var f_name=$('#first_name').val();
                var l_name=$('#last_name').val();
                var gender=$('input:radio[name=gender_name]:checked').val();
                var email=$('#user_email').val();
                var password=$('#user_password').val();
                var country=$('#country option:selected').text();
                var sec_qus=$('#quest option:selected').text();
                var sec_ans=$('#sec_quest_ans').val();
                var code=$('#secure_code').val();
                $.post('register_database.php',{input1:u_name,input2:f_name,input3:l_name,input4:gender,input5:email,input6:password,input7:country,input8:sec_qus,input9:sec_ans,input10:code},
                function(data){
                   if(data=='success')
                    {
                        alert("Activation Email Sent to you");
                        window.location="index.php";
                    }
                    else if(data=='<img src="Generate.php">')
                    {
                        document.getElementById("WrongCode").style.display="block";
                        $('#codeimage').empty().html(data);
                    }else{
                       var arr=new Array();
                       arr=data.split("#@#");
                       $('#codeimage').empty().html(arr[1]);
                       alert(arr[0]);

                    }
                });
            }else{
                if(!userNameFlag)
                {
                    $('#user_name').css('border','1px solid red');
                    $('#user_name').css('box-shadow', '0px 0px 5px red');
                    
                }
                if(!userEmailFlag)
                {
                    $('#user_email').css('border','1px solid red');
                    $('#user_email').css('box-shadow', '0px 0px 5px red');
                }
                
            }
});