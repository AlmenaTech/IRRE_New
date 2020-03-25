$(document).ready(function(){
$('.sidebar_content').click(function(){
	
		$(this).children(".sub_menu").slideToggle("slow");
	});


 $('.sidebar_open_close').click(function(){
 	if($('.sidebar').is(':visible'))
 	{
 		
	 	$('.sidebar').css('display','none');
	 	$('.sidebar').css('transition','2s');
	 	$('.rightbar').css('width','100%');
	 	// $('.rightbar').css('width','100%');
	}
	else
	{
		var sidebarWidth = $('.sidebar').width();
		var rightbarWidth = $('.rightbar').width();
		var finalWidth = rightbarWidth - sidebarWidth;
		$('.sidebar').css('display','block');
		$('.rightbar').css('width',finalWidth);
		
	}
 });
 $('.user_log_btn').click(function(e){
 	var opacity = $('.user_log_div').css('opacity');
 	// console.log(opacity);
 	if(opacity == '1')
 	{
 		$('.user_log_div').css({
	 		'opacity': '0',
	 		'transition': '0.5s',
	 		'z-index': '-999'
	 	});
 	}
 	else if(opacity == '0')
 	{
 		$('.user_log_div').css({
	 		'opacity': '1',
	 		'transition': '0.5s',
	 		'z-index': '999'
 		});
 	}
 	
 	 
 	
 });
  


});

		