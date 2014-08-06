
  $(document).ready(function() {
  //select all of the "a" tags with name equal to modal, so that we can differentiate between normal links and links that we want to activate a modal
  $('a[name=modal]').click(function(e)
  {
	  //Cancel the default link behavior
	  e.preventDefault();
	  //Grab the "a" tag
	  var id = $(this).attr('href');
	  //Grab the screen height and width
	  var maskHeight = $(document).height();
	  var maskWidth = $(window).width();
	  //Set height and width to mask to fill up the whole screen
	  //$('#mask').css({'width':maskWidth,'height':maskHeight});
	  //transition effect. This gives our modal window a nice blurred background and has a nice transition on it, so that it isn't so choppy.
	 // $('#mask').fadeIn(400);
	  //$('#mask').fadeTo("slow",0.8);
	  //Get the window height and width
	  var winH = $(window).height();
	  var winW = $(window).width();
	  //Set the popup window to center
	  $(id).css('top', 50);
	  $(id).css('left', winW/2-$(id).width()/2);
	 // $(id).css('overflow', scroll);
	  //transition effect
	  $(id).fadeIn(400);
	  //$(id).css('overflow', scroll);
  });
  //if close button is clicked
	$('.window .close').click(function (e)
	{
	  //Cancel the link behavior
	  e.preventDefault();
	  $('#mask').hide(); $('.window').hide(); });
	  //if mask is clicked
	  $('#mask').click(function () {
	  $(this).hide(); $('.window').hide();
	  });
	  $(window).resize(function () {
	  var box = $('#box.window');
	  //Get the screen height and width
	  var maskHeight = $(document).height();
	  var maskWidth = $(window).width();
	  //Set height and width to mask to fill up the whole screen
	  $('#mask').css({'width':maskWidth,'height':maskHeight});
	  //Get the window height and width
	  var winH = $(window).height();
	  var winW = $(window).width();
	  //Set the popup window to center
	  box.css('top', winH/2 - box.height()/2);
	  box.css('left', winW/2 - box.width()/2);
	  });
  });


