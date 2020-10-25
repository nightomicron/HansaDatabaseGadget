$(document).ready(function() {
				
	/*special project screen position*/
	$('#screen').css({left: ($(window).width() / 2) - 583});
				
	/*function to slide the pictures periodically*/
	var s = $('#slider').find('#slider_pictures');
	var position = 0;
	s.find('#slider_first').clone().appendTo(s);
				
	setInterval(slide,4000);
				
	function slide(){
		if(position<3){
			s.animate({'top':'-=300px'},400);
			position++;
					
		}else{
			s.css('top','0');
			position = 1;
			s.animate({'top':'-=300px'},400);
		}
					
	}
});