window.onload = function() {
	
	blackscreen.style.display = "none";
	/*blackscreen.style.display = "block";
	popup.style.display = "block";
	project_list.style.display = "block";
	preview.style.display = "block";*/
	
	add.onclick = function() {
		blackscreen.style.display = "block";
		popup.style.display = "block";
		project_list.style.display = "block";
		preview.style.display = "block";
	}
				
	/*links*/
	$('#index').on("click", function(){
		window.location = 'index.html';
	});
				
	$('#purchases').on("click", function(){
		window.location = 'contact.html';
	});
		
	blackscreen.onclick = function() {
		blackscreen.style.display = "none";
		popup.style.display = "none";
		project_list.style.display = "none";
		preview.style.display = "none";
	}
		
	/*functions to establish links between the insert pages*/
	$('#ur').on("click", function(){
		window.location = 'ur.html';
	});
			
}