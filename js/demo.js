/*$(document).ready(function(){
	alert("hiiii");
});*/
$('.subs1 , .subs2 , .subs3 , .subs4').hide();
//$('.subs2').hide();
//$('.subs3').hide();
$('.subs1 , .subs2 , .subs3 , .subs4').addClass('highlight');
//$('.subs2').addClass('highlight');
//$('.subs3').addClass('highlight');
$('.hsubs1').click(function()
{
	//alert("hii");
	
	$('.subs2 , .subs3 , .subs4').hide();
	
	$('.subs1').animate({width: 'toggle' , opacity:0.6},'slow','swing').show().addClass('view1');
});
$('.hsubs2').click(function()
{
	//alert("hii");
	$('.subs1 , .subs3 , .subs4').hide();
	$('.subs2').animate({width: 'toggle' , opacity:0.75},'slow','swing').show().addClass('view2');
});
$('.hsubs3').click(function()
{
	//alert("hii");
	$('.subs1 , .subs2 , .subs4').hide();
	$('.subs3').animate({width: 'toggle' , opacity:0.75},'slow','swing').show().addClass('view3');
});

$('.hsubs4').click(function()
{
	//alert("hii");
	$('.subs1 , .subs2 , .subs3').hide();
	$('.subs4').animate({width: 'toggle' , opacity:0.75},'slow','swing').show().addClass('view4');
});

$('#ext , #ext1').click(function()
{
	//alert("hii");
	$('.subs1 , .subs2 , .subs3 , .subs4').hide();
	//$('.subs4').animate({width: 'toggle'},'slow','swing').show().addClass('view4');
});



