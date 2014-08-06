$('#changePass').click(function(){
    var old=$('#old-pass').val();
    var new1=$('#new1-pass').val();
    var new2=$('#new2-pass').val();
    if(old=="" || new1 == "" || new2 == "")
    {
        $('#error_contariner').empty().append("ENTER ALL REQUIRED DATA");
    }
    else
    {
        if(new1.length>=8)
        {
            if(new1 != new2)
            {
                $('#error_contariner').empty().append("New password and confirm password not matching");
            }else{
                $.post('PHP/includes/changePassword.php',{
                    old:old,
                    new1:new1,
                    new2:new2
                },
                function(data){
                    $('#error_contariner').empty().html(data);
                });
            }
        } else{
            $('#error_contariner').empty().append("Password must be more then 7 characters");
        }
    }
});

$('#transactionID').focus(function(){
    $('#transactionID').css('border' , '1px solid silver');
});
$('#mobileno').focus(function(){
    $('#mobileno').css('border' , '1px solid silver');
    $('#mobileTD').css('opacity' , '0');
});
$('#withdrawAmont').focus(function(){
    $('#withdrawAmont').css('border' , '1px solid silver');
    $('#amontTD').css('opacity' , '0');
});
$('#validatePassword').focus(function(){
    $('#validatePassword').css('border' , '1px solid silver');
    $('#passwordTD').css('opacity' , '0');
});

$('#deposit-button').click(function(){
    var TID = $('#transactionID').val();
    if(TID == ''){
        $('#transactionID').css('border' , '1px solid #E20000');
    }
    else{
        $.post('PHP/addInDepositeWithdrawTable.php?seriesId='+seriesId,
        {
            TID:TID
        },
        function(data){
            if(data == 'done'){
             alert("Data recorded and amount will be added to your balance after verifying. Thank You.");
                location.reload();
            }else{
                alert(data);
            }
        });
    }
});

$('#withdraw-button').click(function(){
    var mobile = $('#mobileno').val();
    var withdrawAmount = $('#withdrawAmont').val();
    var password = $('#validatePassword').val();

    var type='withdraw';

    var flag = true;

    if(mobile == '' || mobile.length < 10){
        $('#mobileno').css('border' , '1px solid #E20000');
        $('#mobileTD').css('opacity' , '1');
        flag = false;
    }
    if(withdrawAmount == '' || withdrawAmount < 25 || withdrawAmount > 5000){
        $('#withdrawAmont').css('border' , '1px solid #E20000');
        $('#amontTD').css('opacity' , '1');
        flag = false;

    }
    if(password == '' || password < 8){
        $('#validatePassword').css('border' , '1px solid #E20000');
        $('#passwordTD').css('opacity' , '1');
        flag = false;
    }


    if(flag){
        $.post('PHP/addInDepositeWithdrawTable.php?seriesId='+seriesId,
        {
            mobile:mobile,
            withdrawAmount:withdrawAmount,
            password:password
        },
        function(data){
            if(data == 'done'){
                alert("Your request has been recorded successfully you will receive amount to your specified mobile number in 1-2 days. Thank You!");
                location.reload();
            }else{
                alert(data);
            }
        });
    }
});