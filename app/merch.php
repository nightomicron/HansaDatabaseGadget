<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Hansa - Database</title>
		<link href="general.css" rel="stylesheet" type="text/css" media="all">
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
					echo '<a href="save.php?sheet=merch&sort='.$_GET['search'].'" target="_blank">SAVE TABLE</a>';
				}else{
					echo 'No valid search parameter';
				}
				
			?>
		
			<table id="vasarlas">
				<tr>
					<th class="column">ID</th>
					<th class="column">Cikkszam</th>
					<th class="column">Vonalkod</th>
					<th class="column">Nev</th>
					<th class="column">Egyseg</th>
					<th class="column">Netto</th>
					<th class="column">Verzio</th>
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
						
						$merch_id = $_GET['search'];
						$query_main = "SELECT public.cikkek.* FROM public.cikkek WHERE public.cikkek.id = '$merch_id'";
						
					}else{
						echo "could not find your data, im sad";
					}
					
					$result = pg_query($dbc, $query_main);
					if (!$result) {
					  echo "Could not get results from database";
					  exit;
					}
										
					while($row = pg_fetch_row($result)) {
						echo '<tr class="table_row"><td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$row[2].'</td><td>'.$row[3].'</td><td>'.$row[4].'</td><td>'.$row[5].'</td><td>'.$row[6].'</td><td>'.$row[7].'</td></tr>';
					}
					
					pg_close($dbc);
				?>
			</table>
			
		</div>
		
	</body>

</html>