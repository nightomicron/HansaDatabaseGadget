
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
		
			<?php
				//set saving parameters
				if(isset($_GET['search'])){
					echo '<a href="save.php?sheet=items&sort='.$_GET['search'].'" target="_blank">SAVE TABLE</a>';
				}else{
					echo 'Something is not quiet right';
				}
				
			?>
		
			<table id="vasarlas">
				<tr>
					<th class="column">ID</th>
					<th class="column">Partnerctid</th>
					<th class="column">Vasarlas ID</th>
					<th class="column">Mennyiseg</th>
					<th class="column">Brutto</th>
					<th class="column">Partner ID</th>
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
					
					if(isset($_GET['search'])){
						//majd torold ki
						echo '<script>alert("it is set")</script>';
						
						$item_id = $_GET['search'];
						$query_main = "SELECT public.vasarlas_tetel.* FROM public.vasarlas_tetel WHERE public.vasarlas_tetel.vasarlasid = '$item_id'";
						
					}else{
						echo "could not find your data, im sad";
						//$query_main = "SELECT public.vasarlas.*, public.bolt.nev FROM public.vasarlas INNER JOIN public.bolt ON public.vasarlas.boltid=public.bolt.id";
					}
					
					$result = pg_query($dbc, $query_main);
					if (!$result) {
					  echo "Could not get results from database";
					  exit;
					}
										
					while($row = pg_fetch_row($result)) {
						//echo '<tr class="table_row" data-id="'.$row[0].'"><td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$row[2].'</td><td>'.$row[3].'</td><td>'.$row[4].'</td><td>'.$row[5].'</td><td>'.$row[6].'</td></tr>';
						echo '<tr class="table_row"><td>'.$row[0].'</td><td><a href="merch.php?search='. $row[1] .'" target="_blank"</a>'.$row[1].'</td><td>'.$row[2].'</td><td>'.$row[3].'</td><td>'.$row[4].'</td><td>'.$row[5].'</td></tr>';
					}
					
					pg_close($dbc);
				?>
			</table>
			
		</div>
		
	</body>

</html>