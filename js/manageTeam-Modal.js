$(document).ready(function() {
$('.save_modalID').click(function(e){
     $('#displayModelErrorMsg').empty();
     var validating_team=team_balance(styleIDs);
     if(validating_team &&  budgetVar>=0)
     {
         $('#displayModelErrorMsg').append("<div style='color:white;background-color: #0A650B;height:100%;'><font > &nbsp;&nbsp;&nbsp;&nbsp;  YOUR TEAM LOOKS PERFECT  &nbsp;&nbsp;&nbsp;&nbsp; </font></div>");
     }else{
     if(!validating_team && budgetVar<0)
      {
          $('#displayModelErrorMsg').append("<div style='color:white;background-color: #8B0618;height:100%;'><font >&nbsp;&nbsp;&nbsp;&nbsp;YOUR TEAM IS NOT BALANCED and <br> &nbsp;&nbsp;&nbsp;&nbsp;YOUR TEAM VALUE IS MORE THAN 100m$&nbsp;&nbsp;&nbsp;&nbsp</font></div>");
      }
      else if(!validating_team)
         $('#displayModelErrorMsg').append("<div style='color:white;background-color: #8B0618;height:100%;'><font style='color:white;background-color: #8B0618;'>&nbsp;&nbsp;&nbsp;&nbsp;YOUR TEAM IS NOT BALANCED&nbsp;&nbsp;&nbsp;&nbsp;</font></div>");
      else if(budgetVar<0)
         $('#displayModelErrorMsg').append("<div style='color:white;background-color: #8B0618;height:100%;'><font style='color:white;background-color: #8B0618;'>&nbsp;&nbsp;&nbsp;&nbsp;YOUR TEAM VALUE IS MORE THAN 100m$&nbsp;&nbsp;&nbsp;&nbsp;</font></div>");
      }

     $('#displayTransfersMade').empty();
     $('#displayTransfersMade').append("<div style='font-size:14px;background-color:#B20404;color:white;padding-left:10px;'>TRANSFER OUT</div><div>");
       var splitedDataINCon=new Array();
          splitedDataINCon=appendedData[0].split("@#@");
          var displayOldCaptain="-";
          var displayNewCaptain=splitedDataINCon[1];
          var flag=false;
          for(var i=0;i<copyappendedData.length;i++)
          {
               var playerIndex=appendedData.indexOf(copyappendedData[i]);
               splitedDataINCon=copyappendedData[i].split("@#@");

               if(splitedDataINCon[5]==copyCaptain)
               {
                   displayOldCaptain=splitedDataINCon[1];
               }
               if(playerIndex == -1)
               {
                   flag=true;
                    $('#displayTransfersMade').append("<div style='padding-left:15px'>"+splitedDataINCon[1]+"</div>");
                }
          }
        if(flag==false)
          {
              $('#displayTransfersMade').append("-");
          }

        $('#displayTransfersMade').append("</div>");
        
        $('#displayTransfersMade').append("<br>");

        $('#displayTransfersMade').append("<div style='font-size:14px;background-color:#329B09;color:white;padding-left:10px;'>TRANSFER IN</div><div style='padding-left:15px'>");
          for(var i=0;i<appendedData.length;i++)
          {
               playerIndex=copyappendedData.indexOf(appendedData[i]);
               splitedDataINCon=appendedData[i].split("@#@");
               if(splitedDataINCon[5]==captain)
               {
                   displayNewCaptain=splitedDataINCon[1];
               }
               if(playerIndex == -1)
               {
                   
                   $('#displayTransfersMade').append("<div style='padding-left:15px'>"+splitedDataINCon[1]+"</div>");

               }
          }

        if(flag==false)
        {
           $('#displayTransfersMade').append("-");
        }
        $('#displayTransfersMade').append("</div>");
        $('#displayTransfersMade').append("<br><br><div>");
          $('#displayTransfersMade').append("<table width='460px' style='font-size:12px;color:white;font-weight:bold;'><tr>\n\
                              <td align='left' bgcolor='#6D0CC2' height='25px' style='padding-left:5px'>OLD CAPTAIN : "+displayOldCaptain+"</td>\n\
                              <td align='right' bgcolor='#E14A13' style='padding-right:5px;'>NEW CAPTAIN : "+displayNewCaptain+"</td>\n\
                              </tr></table>");
          $('#displayTransfersMade').append("</div><br><br>");

          
          e.preventDefault();
	  var id = $(this).attr('href');
	  var maskHeight = $(document).height();
	  var maskWidth = $(window).width();
	  var winH = $(window).height();
	  var winW = $(window).width();
              $(id).css('top', 50);
              $(id).css('left', winW/2-$(id).width()/2);
            $(id).fadeIn(400);

  });
  
  //if close button is clicked
	$('.window .close').click(function (e)
	{
         e.preventDefault();
	  $('#mask').hide(); $('.window').hide(); });
	  $('#mask').click(function () {
	  $(this).hide(); $('.window').hide();
	  });
	  $(window).resize(function () {
	  var box = $('#box.window');
	  var maskHeight = $(document).height();
	  var maskWidth = $(window).width();
	  $('#mask').css({'width':maskWidth,'height':maskHeight});
	  var winH = $(window).height();
	  var winW = $(window).width();
	  box.css('top', winH/2 - box.height()/2);
	  box.css('left', winW/2 - box.width()/2);
	  });
  });


