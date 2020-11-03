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
				if(isset($_GET['sort'])){
					echo '<a href="save.php?sheet=index&sort='.$_GET['sort'].'" target="_blank">SAVE TABLE</a>';
				}else{
					echo '<a href="save.php?sheet=index&sort=default" target="_blank">SAVE TABLE</a>';
				}
				
				
			?>
			
			<table id="vasarlas">
				<tr>
					<th class="column">Vasarlas ID <a href="index.php?sort=1asc">A</a> <a href="index.php?sort=1dsc">V</a></th>
					<th class="column">Esemeny Ido <a href="index.php?sort=2asc">A</a> <a href="index.php?sort=2dsc">V</a></th>
					<th class="column">Vasarlas Osszeg <a href="index.php?sort=3asc">A</a> <a href="index.php?sort=3dsc">V</a></th>
					<th class="column">Penztargep ID <a href="index.php?sort=4asc">A</a> <a href="index.php?sort=4dsc">V</a></th>
					<th class="column">partner ID <a href="index.php?sort=5asc">A</a> <a href="index.php?sort=5dsc">V</a></th>
					<th class="column">Bolt ID <a href="index.php?sort=6asc">A</a> <a href="index.php?sort=6dsc">V</a></th>
					<th class="column">Bolt Neve <a href="index.php?sort=7asc">A</a> <a href="index.php?sort=7dsc">V</a></th>
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
					
					if(isset($_GET['sort'])){
						
						if($_GET['sort']=="1asc"){
							$query_main = "SELECT public.vasarlas.*, public.bolt.nev FROM public.vasarlas INNER JOIN public.bolt ON public.vasarlas.boltid=public.bolt.id ORDER BY public.vasarlas.id ASC";
						}else if($_GET['sort']=="1dsc"){
							$query_main = "SELECT public.vasarlas.*, public.bolt.nev FROM public.vasarlas INNER JOIN public.bolt ON public.vasarlas.boltid=public.bolt.id ORDER BY public.vasarlas.id DESC";
						}else if($_GET['sort']=="2asc"){
							$query_main = "SELECT public.vasarlas.*, public.bolt.nev FROM public.vasarlas INNER JOIN public.bolt ON public.vasarlas.boltid=public.bolt.id ORDER BY public.vasarlas.esemenydatumido ASC";
						}else if($_GET['sort']=="2dsc"){
							$query_main = "SELECT public.vasarlas.*, public.bolt.nev FROM public.vasarlas INNER JOIN public.bolt ON public.vasarlas.boltid=public.bolt.id ORDER BY public.vasarlas.esemenydatumido DESC";
						}else if($_GET['sort']=="3asc"){
							$query_main = "SELECT public.vasarlas.*, public.bolt.nev FROM public.vasarlas INNER JOIN public.bolt ON public.vasarlas.boltid=public.bolt.id ORDER BY public.vasarlas.vasarlasosszeg ASC";
						}else if($_GET['sort']=="3dsc"){
							$query_main = "SELECT public.vasarlas.*, public.bolt.nev FROM public.vasarlas INNER JOIN public.bolt ON public.vasarlas.boltid=public.bolt.id ORDER BY public.vasarlas.vasarlasosszeg DESC";
						}else if($_GET['sort']=="4asc"){
							$query_main = "SELECT public.vasarlas.*, public.bolt.nev FROM public.vasarlas INNER JOIN public.bolt ON public.vasarlas.boltid=public.bolt.id ORDER BY public.vasarlas.penztargepazonosito ASC";
						}else if($_GET['sort']=="4dsc"){
							$query_main = "SELECT public.vasarlas.*, public.bolt.nev FROM public.vasarlas INNER JOIN public.bolt ON public.vasarlas.boltid=public.bolt.id ORDER BY public.vasarlas.penztargepazonosito DESC";
						}else if($_GET['sort']=="5asc"){
							$query_main = "SELECT public.vasarlas.*, public.bolt.nev FROM public.vasarlas INNER JOIN public.bolt ON public.vasarlas.boltid=public.bolt.id ORDER BY public.vasarlas.partnerid ASC";
						}else if($_GET['sort']=="5dsc"){
							$query_main = "SELECT public.vasarlas.*, public.bolt.nev FROM public.vasarlas INNER JOIN public.bolt ON public.vasarlas.boltid=public.bolt.id ORDER BY public.vasarlas.partnerid DESC";
						}else if($_GET['sort']=="6asc"){
							$query_main = "SELECT public.vasarlas.*, public.bolt.nev FROM public.vasarlas INNER JOIN public.bolt ON public.vasarlas.boltid=public.bolt.id ORDER BY public.vasarlas.boltid ASC";
						}else if($_GET['sort']=="6dsc"){
							$query_main = "SELECT public.vasarlas.*, public.bolt.nev FROM public.vasarlas INNER JOIN public.bolt ON public.vasarlas.boltid=public.bolt.id ORDER BY public.vasarlas.boltid DESC";
						}else if($_GET['sort']=="7asc"){
							$query_main = "SELECT public.vasarlas.*, public.bolt.nev FROM public.vasarlas INNER JOIN public.bolt ON public.vasarlas.boltid=public.bolt.id ORDER BY public.bolt.nev ASC";
						}else if($_GET['sort']=="7dsc"){
							$query_main = "SELECT public.vasarlas.*, public.bolt.nev FROM public.vasarlas INNER JOIN public.bolt ON public.vasarlas.boltid=public.bolt.id ORDER BY public.bolt.nev DESC";
						}else{
							$query_main = "SELECT public.vasarlas.*, public.bolt.nev FROM public.vasarlas INNER JOIN public.bolt ON public.vasarlas.boltid=public.bolt.id";
						}
						
					}else{
						$query_main = "SELECT public.vasarlas.*, public.bolt.nev FROM public.vasarlas INNER JOIN public.bolt ON public.vasarlas.boltid=public.bolt.id";
					}
					
					$result = pg_query($dbc, $query_main);
					if (!$result) {
					  echo "Could not get results from database";
					  exit;
					}
										
					while($row = pg_fetch_row($result)) {
						echo '<tr class="table_row" ><td><a href="items.php?search='. $row[0] .'" target="_blank"</a>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$row[2].'</td><td>'.$row[3].'</td><td>'.$row[4].'</td><td>'.$row[5].'</td><td>'.$row[6].'</td></tr>';
					}
					
					pg_close($dbc);

				?>
			</table>
			
		</div>
		
	</body>

</html>