$(document).ready(function(){
	$('.section-basic-details-next-btn').click(function(){
		$('.section-basic').css({'display' : 'none'});
		$('.section-edu').css({'display' : 'block'});
		$('.section-edu').addClass('educational-section');
	});
	$('.section-basic-details-previous-btn').click(function(){
		$('.section-edu').css({'display' : 'none'});
		$('.section-basic').css({'display' : 'block'});
		$('.section-basic').addClass('educational-section');
	});
});