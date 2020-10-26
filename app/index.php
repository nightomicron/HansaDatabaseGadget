<?php
	
	//connecting to database
	/*$dbc = pg_connect("host=localhost port=5432 dbname=hansa user=postgres password=omicron481");
	if($dbc){
		echo "<script>console.log('Success oh ye');</script>";
	}else{
		echo "<script>console.log('Failed to connect, check if postgres is running or not');</script>";
		exit;
	}
	
	$query_main = "SELECT * FROM public.vasarlas";
	$result = pg_query($dbc, $query_main);
	if (!$result) {
	  echo "Valami gaz van ffs\n";
	  exit;
	}
	
	echo "<table>";
	
	while($row = pg_fetch_row($result)) {
		echo "<tr><td>$row[0]</td><td>$row[1]</td></tr>";
	}
	
	echo "</table>";*/
	
	

?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Hansa - Database</title>
		<link href="general.css" rel="stylesheet" type="text/css" media="all">
		<script src="js/jquery-3.3.1.min.js"></script>
		<!--<script src="js/menu_eng.js"></script>-->
		<script>
		window.onload = function() {
	
			blackscreen.style.display = "none";
			/*blackscreen.style.display = "block";
			popup.style.display = "block";
			project_list.style.display = "block";
			preview.style.display = "block";*/
			
			/*add.onclick = function() {
				blackscreen.style.display = "block";
				popup.style.display = "block";
				project_list.style.display = "block";
				preview.style.display = "block";
			}*/
						
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
			

			
			/*click on table row*/
			/*
			$('.table_row').on("click", function(){
				
				var id = $(this).find('td').first().text();
				alert(id);
			});
			*/
		}
		</script>
	</head>
	
	<body>
		<!--header menu-->
		<div id="menu">
			Hansa Database Gadget
		</div>
		<div id="blackscreen"></div>
		<div id="popup">
			<div id="project_list" class="popup_text">
				
				
				
				<!--list for the project links-->
				<ul>
					<li id="ur" class="popup_item">Royal Game of Ur</li>
				</ul>
			</div>
			
			<div id="preview" class="popup_text">
				<!--container for the chosen project's preview-->
				<div id="pre_description"><p id="desc_text"></p></div>
				<div id="pre_picture"></div>	
			</div>
		</div>

		<div id="screen">
			<table id="vasarlas">
				<tr>
					<th class="column">Vasarlas ID</th>
					<th class="column">Esemeny Datumido</th>
					<th class="column">Vasarlas Osszeg</th>
					<th class="column">Penztargep ID</th>
					<th class="column">partner ID</th>
					<th class="column">Bolt ID</th>
					<th class="column">Bolt Neve</th>
				</tr>
				<?php
					
					//connecting to database
					$dbc = pg_connect("host=localhost port=5432 dbname=hansa user=postgres password=omicron481");
					if($dbc){
						echo "<script>console.log('Success oh ye');</script>";
					}else{
						echo "<script>console.log('Failed to connect, check if postgres is running or not');</script>";
						exit;
					}
					
					$query_main = "SELECT public.vasarlas.*, public.bolt.nev FROM public.vasarlas INNER JOIN public.bolt ON public.vasarlas.boltid=public.bolt.id";
					$result = pg_query($dbc, $query_main);
					if (!$result) {
					  echo "Valami gaz van ffs\n";
					  exit;
					}
					
					function showDetails($pur_id) {
						echo "<script>alert($pur_id)</script>";
					}
										
					while($row = pg_fetch_row($result)) {
						//echo '<tr class="table_row" data-id="'.$row[0].'"><td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$row[2].'</td><td>'.$row[3].'</td><td>'.$row[4].'</td><td>'.$row[5].'</td><td>'.$row[6].'</td></tr>';
						echo '<tr class="table_row" onclick="showDetails('.$row[0].')"><td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$row[2].'</td><td>'.$row[3].'</td><td>'.$row[4].'</td><td>'.$row[5].'</td><td>'.$row[6].'</td></tr>';
					}
					

				?>
			</table>
			
		</div>
		
	</body>

</html>