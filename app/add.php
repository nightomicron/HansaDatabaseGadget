<?php

	if(isset($_GET['save']) && isset($_GET['id']) && isset($_GET['quantity']) && isset($_GET['gross']) && isset($_GET['partnerid']) && isset($_GET['merch']) && isset($_GET['search'])) {
		
		$dbc = pg_connect("host=localhost port=5432 dbname=hansa user=postgres password=omicron481");
		if($dbc){
			echo "<script>console.log('Success oh ye');</script>";
		}else{
			echo "<script>console.log('Failed to connect, check if postgres is running or not');</script>";
			exit;
		}
		
		$id = $_GET['id'];
		$merch = $_GET['merch'];
		$search = $_GET['search'];
		$quantity = $_GET['quantity'];
		$gross = $_GET['gross'];
		$partnerid = $_GET['partnerid'];
		
		$query_main = "INSERT INTO public.vasarlas_tetel(id, partnerctid, vasarlasid, mennyiseg, brutto, partnerid) VALUES ($id, $merch, $search, $quantity, $gross, $partnerid)";
		pg_query($dbc, $query_main);
		pg_close($dbc);
	}

?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Hansa - Database</title>
		<link href="general.css" rel="stylesheet" type="text/css" media="all">
		<script src="js/jquery-3.3.1.min.js"></script>
	</head>
	
	<body>
		<!--header menu-->
		<div id="menu">
			Hansa Database Gadget
		</div>
		
		<div id="screen">
			<h1>Add New Row</h1>
			<form method="get" action="add.php">
				<fieldset>
					<label for="id">ID:</label><br>
					<input type="number" name="id" min="1" id="id"><br><br>
					<label for="quantity">Mennyiseg:</label><br>
					<input type="number" name="quantity" min="1" id="quantity"><br><br>
					<label for="gross">Brutto:</label><br>
					<input type="number" name="gross" min="0" id="gross"><br><br>
					<label for="partnerid">Partner ID:</label><br>
					<input type="number" name="partnerid" min="0" id="partnerid"><br><br>
					<?php
						//set button and merch parameters
						if(isset($_GET['search'])){
							
							//get merch list
							$dbc = pg_connect("host=localhost port=5432 dbname=hansa user=postgres password=omicron481");
							if($dbc){
								echo "<script>console.log('Success oh ye');</script>";
							}else{
								echo "<script>console.log('Failed to connect, check if postgres is running or not');</script>";
								exit;
							}
							
							$query_merch = "SELECT id, nev FROM public.cikkek";
							$result_merch = pg_query($dbc, $query_merch);
							
							if (!$result_merch) {
								echo "Could not get results from database";
								exit;
							}else{
								
								echo '<select id="merch" name="merch" size="6">';
								while($row = pg_fetch_row($result_merch)) {
									echo '<option value="'. $row[0] .'">'. $row[1] .'</option>';
								}
								echo '</select><br><br>';
								
							}
							
							//set search parameter
							echo '<label for="search">Vasarlas ID:</label><br>';
							echo '<input type="number" name="search" id="search" value="'.$_GET['search'].'" readonly="readonly"><br><br>';
							
							pg_close($dbc);
							
						}else{
							echo 'No valid search parameter';
						}
						
						
					?>
					<input type="submit" name="save" value="Add">
				</fieldset>
			</form>
		</div>
		
	</body>

</html>