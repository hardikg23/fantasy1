$(document).ready(function(){
    $('#countdown').countdown({date: matchTime , currentDate : now});
    $('#prediction_error').empty();
});


var rule=/^([0-9]*\.[0-9]*)$/;
var overnbowl=new Array();
var overnpoint=new Array();
$('#battingcalculate').click(function(){
   var matchtype=document.getElementById("matchtype").value;
   var batpoints=0;
   var run=$('#run').val();
   var bowl=$('#bowlplay').val();
   var six=$('#six').val();
   var catch1=$('#catch').val();
   var runout=$('#runout').val();
   var manofmatch=document.getElementById("manofthematch").value;
        if(run==""||six==""||bowl==""||catch1==""||runout=="")
        {
            //alert("Enter All the Fields...");
            $('#prediction_error').empty();
            $('#prediction_error').append("Enter All the Fields for Batting Prediction.......");
        }
        else if(isNaN(run)||isNaN(bowl)||isNaN(six)||isNaN(catch1)||isNaN(runout))
        {
            //alert("Enter only Integer value");
            $('#prediction_error').empty();
            $('#prediction_error').append("Enter Only Integer Value for Batting Prediction.......");
        }
        else if(run.match(rule)||bowl.match(rule)||catch1.match(rule)||runout.match(rule)||six.match(rule))
        {
            //alert("Enter Integer value only");
            $('#prediction_error').empty();
            $('#prediction_error').append("Enter only Integer Value for Batting Prediction.......");
        }
        else
        {
            $('#prediction_error').empty();
           if(runout>=10)
           {
                catch1=0;
                runout=0;
           }
           else if(runout<10)
           {
               var c=10-runout;
               if(catch1>c)
               {
                   catch1=c;
               }
           }
           var b=parseInt(run/4);
           if(bowl<b)
           {
               bowl=b;
               $('#bowlplay').val(bowl);
           }


           if(run<six*6)
           {
               run=six*6;
           }
           $('#catch').val(catch1);
           $('#runout').val(runout);
           $('#run').val(run);
           batpoints+=parseInt(catch1*15+runout*15);
           if(matchtype=="ODI")
           {
                if(run==0)
                {
                    batpoints-=20;
                    batpoints-=parseInt(bowl);
                }
                else
                {
                    batpoints+=parseInt(run);
                    batpoints+=parseInt(six*5);
                    batpoints+=parseInt(Math.floor((run/10))*5);
                    batpoints+=parseInt((run*1.2-bowl));
                   if(manofmatch=="yes")
                   {
                        batpoints+=parseInt(50);
                    }
                }
                $('#points').val(batpoints);
            }
            else if(matchtype=="T20")
            {
               if(run==0)
               {
                    batpoints-=20;
                    batpoints-=parseInt(bowl);
                }
                else
                {
                    batpoints+=parseInt(run);
                    batpoints+=parseInt(six*6);
                    batpoints+=parseInt(Math.floor((run/10))*5);
                    batpoints+=parseInt((run*1.2-bowl));
                    if(manofmatch=="yes")
                    {
                        batpoints+=parseInt(50);
                    }
                    if(six>=5)
                    {
                        batpoints+=15;
                    }
                }
                $('#points').val(batpoints);
            }
            else if(matchtype=="TEST")
            {
                if(run==0)
                {
                    batpoints-=30;
                    batpoints-=parseInt(bowl);
                }
                else
                {
                    batpoints+=parseInt(run);
                    batpoints+=parseInt(six*8);
                    batpoints+=parseInt(Math.floor((run/25))*10);
                    batpoints+=parseInt((run*1.5-bowl));
                    batpoints+=parseInt(Math.floor(bowl/5));
                    if(manofmatch=="yes")
                    {
                        batpoints+=parseInt(100);
                    }
                    if(six>=5)
                    {
                        batpoints+=25;
                    }
                }
                $('#points').val(batpoints);
            }
        }
});
$('#battingreset').click(function(){
    $('#run').val("");
    $('#bowlplay').val("");
    $('#six').val("");
    $('#points').val("");
    $('#catch').val("");
    $('#runout').val("");
});
 var splited=new Array();
$('#bowlercalculate').click(function(){
   var matchtype=document.getElementById("bowlmatchtype").value;
   var bowlpoints=0;
   var bowl=0;
   var over=$('#over').val();
   var wicket=$('#wicket').val();
   var rungiven=$('#rungiven').val();
   var dotball=$('#dotball').val();
   var catch2=$('#bowlercatch').val();
   var runout=$('#bowlerrunout').val();
   var manofmatch=document.getElementById("bowlermanofthematch").value;
   if(over==""||wicket==""||rungiven==""||dotball==""||catch2==""||runout=="")
   {
       //alert("Enter all the Fields..");
       $('#prediction_error').empty();
       $('#prediction_error').append("Enter All the Fields for Bowling Prediction.......");
   }
   else if(isNaN(over)||isNaN(wicket)||isNaN(rungiven)||isNaN(catch2)||isNaN(runout)||isNaN(dotball))
   {
           //alert("Enter only Numeric value");
           $('#prediction_error').empty();
            $('#prediction_error').append("Enter Only Integer Value for Bowling Prediction.......");
   }
   else if(wicket.match(rule)||rungiven.match(rule)||catch2.match(rule)||runout.match(rule)||dotball.match(rule))
   {
        //alert("enter Integer value except over");
        $('#prediction_error').empty();
        $('#prediction_error').append("Enter Integer Value expeect Overs for Bowling Prediction.......");
   }
   else
   {
       $('#prediction_error').empty();
                if(parseInt(wicket)+parseInt(runout)>10)
                {
                    if(wicket>=10)
                    {
                        wicket=10;
                        runout=0;
                    }
                    if(wicket<10)
                        runout=10-wicket;
                }
                var c=10-runout;
                if(catch2>c)
                {
                    catch2=10-runout;
                }
                $('#wicket').val(wicket);
                $('#bowlerrunout').val(runout);
                $('#bowlercatch').val(catch2);
                bowlpoints+=parseInt(catch2*15+runout*15);
                if(matchtype=="ODI")
                {
                    over=Math.round(over*10)/10;
                    overnbowl=countbowlforODI(over);
                    $('#over').val(overnbowl[0]);
                        bowl=overnbowl[1];
                        bowlpoints+=parseInt(dotball);
                        bowlpoints+=parseInt(wicket*25);
                        var extra=0;
                        for(i=2;i<=wicket;i++)
                        {
                            if(i==2)
                            extra+=5;
                            if(i==3)
                            extra+=10;
                            if(i>=4)
                            extra+=15;
                        }
                        if(manofmatch=="yes")
                            bowlpoints+=parseInt(50);
                        bowlpoints+=parseInt(extra);
                        bowl=parseInt(bowl);
                        bowlpoints+=parseInt((bowl-rungiven)*2);
                        $('#bowlerpoints').val(bowlpoints);
                  }
                  else if(matchtype=="T20")
                  {
                        over=Math.round(over*10)/10;
                        overnbowl=countbowlforT20(over);
                        $('#over').val(overnbowl[0]);
                        bowl=overnbowl[1];
                            bowlpoints+=parseInt(dotball);
                            bowlpoints+=parseInt(wicket*25);
                            var extra=0;
                            for(i=2;i<=wicket;i++)
                            {
                                if(i==2)
                                extra+=5;
                                if(i==3)
                                extra+=10;
                                if(i>=4)
                                extra+=15;
                            }
                            if(manofmatch=="yes")
                                bowlpoints+=parseInt(50);
                            bowlpoints+=parseInt(extra);
                            bowlpoints+=parseInt((bowl*1.5-rungiven)*2);
                            $('#bowlerpoints').val(bowlpoints);
                    }
                    else if(matchtype=="TEST")
                    {
                        overnpoint=testbowlpoint(over, wicket);
                        $('#over').val(overnpoint[0]);
                        $('#dotball').val(0);
                        bowlpoints+=overnpoint[1];
                        if(manofmatch=="yes")
                                bowlpoints+=parseInt(100);
                        $('#bowlerpoints').val(bowlpoints);
                    }
   }
});
$('#bowlerreset').click(function(){
    $('#over').val("");
    $('#wicket').val("");
    $('#rungiven').val("");
    $('#dotball').val("");
    $('#bowlercatch').val("");
    $('#bowlerrunout').val("");
    $('#bowlerpoints').val("");
});
$('#allcalculate').click(function(){
   var matchtype=document.getElementById("allmatchtype").value;
   var run=$('#allrun').val();
   var bowlp=$('#allbowlplay').val();
   var six=$('#allsix').val();
   var over=$('#allover').val();
   var wicket=$('#allwicket').val();
   var rungiven=$('#allrungiven').val();
   var catch3=$('#allcatch').val();
   var runout=$('#allrunout').val();
   var allpoints=0;
   var bowl=0;
   var batpoints=0;
   var bowlpoints=0;
   var manofmatch=document.getElementById("allmanofthematch").value;
   if(run==""||bowlp==""||six==""||over==""||wicket==""||rungiven==""||catch3==""||runout=="")
   {
       //alert("Enter all the Fields..");
       $('#prediction_error').empty();
        $('#prediction_error').append("Enter All the Fields for AllRounder Prediction.......");
   }
   else if(isNaN(run)||isNaN(bowlp)||isNaN(six)||isNaN(over)||isNaN(wicket)||isNaN(rungiven)||isNaN(catch3)||isNaN(runout))
   {
       //alert("Enter only Numeric value");
       $('#prediction_error').empty();
        $('#prediction_error').append("Enter Integer Value Only for AllRounder Prediction.......");
   }
   else if(run.match(rule)||bowlp.match(rule)||six.match(rule)||wicket.match(rule)||rungiven.match(rule)||catch3.match(rule)||runout.match(rule))
   {
        //alert("enter Integer value except over");
        $('#prediction_error').empty();
        $('#prediction_error').append("Enter Integer Value expeect Overs for AllRounder Prediction.......");
   }
   else
   {
       $('#prediction_error').empty();
           if(run<six*6)
           {
               run=six*6;
           }
           $('#allrun').val(run);
           if(parseInt(wicket)+parseInt(runout)>10)
           {
                if(wicket>=10)
                {
                        wicket=10;
                        runout=0;
                }
                if(wicket<10)
                        runout=10-wicket;
            }
            var c=10-runout;
            if(catch3>c)
            {
                    catch3=10-runout;
            }
            $('#allwicket').val(wicket);
            $('#allrunout').val(runout);
            $('#allcatch').val(catch3)
            batpoints+=parseInt(catch3*15+runout*15);
       if(matchtype=="ODI")
       {
           over=Math.round(over*10)/10;
            overnbowl=countbowlforODI(over);
            $('#allover').val(overnbowl[0]);
            bowl=overnbowl[1];
           bowlpoints+=parseInt(wicket*25);
              var extra=0;
              for(i=2;i<=wicket;i++)
              {
                    if(i==2)
                        extra+=5;
                    if(i==3)
                        extra+=10;
                    if(i>=4)
                        extra+=15;
              }
              bowlpoints+=parseInt(extra);
              bowl=parseInt(bowl);
              bowlpoints+=parseInt((bowl-rungiven)*2);
                if(run==0)
                {
                    batpoints-=20;
                    batpoints-=parseInt(bowlp);
                }
                else
                {
                    batpoints+=parseInt(run);
                    batpoints+=parseInt(six*5);
                    batpoints+=parseInt(Math.floor((run/10))*5);
                    batpoints+=parseInt((run*1.2-bowlp));
                   if(manofmatch=="yes")
                   {
                        batpoints+=parseInt(50);
                    }
                }
                $('#allpoints').val(parseInt(batpoints)+parseInt(bowlpoints));
       }
       else if(matchtype=="T20")
       {
           over=Math.round(over*10)/10;
            overnbowl=countbowlforT20(over);
            $('#allover').val(overnbowl[0]);
            bowl=overnbowl[1];
           bowlpoints+=parseInt(wicket*25);
              var extra=0;
              for(i=2;i<=wicket;i++)
              {
                    if(i==2)
                        extra+=5;
                    if(i==3)
                        extra+=10;
                    if(i>=4)
                        extra+=15;
              }
              bowlpoints+=parseInt(extra);
              bowl=parseInt(bowl);
              bowlpoints+=parseInt((bowl*1.5-rungiven)*2);
                if(run==0)
                {
                    batpoints-=20;
                    batpoints-=parseInt(bowlp);
                }
                else
                {
                    batpoints+=parseInt(run);
                    batpoints+=parseInt(six*6);
                    batpoints+=parseInt(Math.floor((run/10))*5);
                    batpoints+=parseInt((run*1.4-bowlp));
                   if(manofmatch=="yes")
                   {
                        batpoints+=parseInt(50);
                    }
                    if(six>=5)
                    {
                        batpoints+=15;
                    }
                }
                $('#allpoints').val(parseInt(batpoints)+parseInt(bowlpoints));
       }
       else if(matchtype=="TEST")
       {
                if(run==0)
                {
                    batpoints-=30;
                    batpoints-=parseInt(bowlp);
                }
                else
                {
                    batpoints+=parseInt(run);
                    batpoints+=parseInt(six*8);
                    batpoints+=parseInt(Math.floor((run/25))*10);
                    batpoints+=parseInt((run*1.5-bowlp));
                    batpoints+=parseInt(Math.floor(bowlp/5));
                    if(manofmatch=="yes")
                    {
                        batpoints+=parseInt(100);
                    }
                    if(six>=5)
                    {
                        batpoints+=25;
                    }
                }
                overnpoint=testbowlpoint(over, wicket);
                        $('#allover').val(overnpoint[0]);
                        bowlpoints+=overnpoint[1];
                $('#allpoints').val(parseInt(batpoints)+parseInt(bowlpoints));
       }
   }
});
$('#allreset').click(function(){
   $('#allrun').val("");
   $('#allbowlplay').val("");
   $('#allsix').val("");
   $('#allover').val("");
   $('#allwicket').val("");
   $('#allrungiven').val("");
   $('#allcatch').val("");
   $('#allrunout').val("");
   $('#allpoints').val("");
});
function testbowlpoint(over, wicket)
{
    over=Math.round(over*10)/10;
    var point=0;
                        data=over+"";
                        splited =data.split(".");
                        if(over>=100)
                            over=100;
                        else if(splited[1]<=6)
                        {
                            over=splited[0]+"."+splited[1];
                        }
                        else if(splited[1]>=6)
                        {
                            over=parseInt(splited[0])+1;
                        }
                        point+=parseInt(wicket*25);
                        var extras=0;
                        if(wicket==3)
                            extras += 30;
                        if(wicket==5)
                            extras += 45;
                        if(wicket>=7)
                            extras += 55;
                        point+=parseInt(extras);
                        var data2=new Array(over,point);
                    return data2;
}
function countbowlforODI(over)
{
    var over=Math.round(over*10)/10;
    var bowl=0;
              data=over+"";
                    splited =data.split(".");
                    if(over>=10)
                    {
                         over=10;
                         bowl+=parseInt(over*6);
                    }
                    else if(splited[0]<=9&&splited[1]<=6)
                    {
                        over=splited[0]+"."+splited[1];
                        bowl+=parseInt(splited[0]*6);
                        bowl+=parseInt(splited[1]);
                    }
                    else if(splited[0]<=9&&splited[1]>=6)
                    {
                        over=parseInt(splited[0])+1;
                        bowl+=parseInt(over*6);
                    }
                    else if(splited.length==1&&splited[0]<=9)
                    {
                           bowl+=parseInt(splited[0]*6);
                    }
                    var data=new Array(over,bowl);
                    return data;
}
function countbowlforT20(over)
{
    var over=Math.round(over*10)/10;
           var bowl=0;
                        data=over+"";
                        splited =data.split(".");
                        if(over>=4)
                        {
                            over=4;
                            bowl+=parseInt(over*6);
                        }
                        else if(splited[0]<=4&&splited[1]<=6)
                        {
                            over=splited[0]+"."+splited[1];
                            bowl+=parseInt(splited[0]*6);
                            bowl+=parseInt(splited[1]);
                        }
                        else if(splited[0]<=4&&splited[1]>=6)
                        {
                            over=parseInt(splited[0])+1;
                            bowl+=parseInt(over*6);
                        }
                        else if(splited.length==1&&splited[0]<=4)
                        {
                           bowl+=parseInt(splited[0]*6);
                        }
                     var data1=new Array(over,bowl);
                    return data1;
}

