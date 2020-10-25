$(document).ready(function() {
				
	/*popup position*/
	$('#popup').css({left: ($(window).width() / 2) - 500})
	$('#popup').css({top: ($(window).height() / 2) - 400})
				
	/*language menu functions*/
	var lang_open = false;
		
	$('#lang').on('click',function(){
		if(lang_open == false){
			$('#lang_switch').animate({"opacity": "show"},200);
			lang_open = true;
		}else{
			$('#lang_switch').animate({"opacity": "hide"},200);
			lang_open = false;
		}
	});
	
	$('#lang_switch').on('click',function(){
		window.location = 'index.html';
	});
				
	/*project button onclick function to open the popup menu and to play its corresponding animation also to reset the preview to default*/
	$('#projects').on('click',function(){
		$('#desc_text').html("");
		$('#pre_picture').html("");
		$('#blackscreen').animate({"opacity": "show"}, 500);
		$('#popup').animate({"opacity": "show", width:"800", height:"600",left: ($(window).width() / 2) - 400, top: ($(window).height() / 2) - 300}, 500);
		$('.popup_text').delay(500).animate({"opacity": "show"},500);
		$('#lang_switch').animate({"opacity": "hide"},200);
	});
				
	/*links*/
	$('#about').on("click", function(){
		window.location = 'index_hun.html';
	});
				
	$('#contact').on("click", function(){
		window.location = 'contact_hun.html';
	});
				
	/*function to close the popup menu and to play its corresponding animation*/
	$('#blackscreen').on('click',function(){
		$('.popup_text').animate({"opacity": "hide"},500);
		$(this).delay(500).animate({"opacity": "hide"}, 500);
		$('#popup').delay(500).animate({"opacity": "hide", width:"1000", height:"800", left: ($(window).width() / 2) - 500, top: ($(window).height() / 2) - 400}, 500);
	});
				
	/*functions to replace the preview of a project and to establish links between the project pages*/
	/*ROYAL GAME OF UR*/
	$('#ur').on("mouseover", function(){
		$('#desc_text').html('A Royal Game of Ur egy ősi társasjáték, amely próbára teszi a logikát és a szerencsét. Fogj öt bábut és kísérd el őket a célvonalba!<br><br>Képes leszel uralni a táblát és eltiporni az ellenfeleid?<br><br>Fontos: A játékhoz 2 játékos szükséges');
		$('#pre_picture').html('<img src="pictures/ur2.png" alt="test_picture" style="width:250px;height:250px;">');
	});
				
	$('#ur').on("click", function(){
		window.location = 'ur_hun.html';
	});
			
});