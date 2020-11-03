<?php

	$dbc = pg_connect("host=localhost port=5432 dbname=hansa user=postgres password=omicron481");
	if(!$dbc){
		echo "<script>console.log('Failed to connect, check if postgres is running or not');</script>";
		exit;
	}
	//check sheet
	if(isset($_GET['sheet'])){
		
		//INDEX SHEET
		if($_GET['sheet']=="index"){
			
			//check options
			if($_GET['sort']=="default"){
				$query_main = "SELECT public.vasarlas.*, public.bolt.nev FROM public.vasarlas INNER JOIN public.bolt ON public.vasarlas.boltid=public.bolt.id";
			}else if($_GET['sort']=="1asc"){
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
			
			$result = pg_query($dbc, $query_main);
		
			if (!$result) {
				echo "Could not get results from database";
				exit;
			}else{
				//print results into a csv file
				$file = fopen('results.csv', 'w');
				
				while($row = pg_fetch_row($result)) {
					
					fwrite($file, $row[0] . ';' . $row[1] . ';' . $row[2] . ';' . $row[3] . ';' . $row[4] . ';' . $row[5] . ';' . $row[6] . PHP_EOL);
					
				}
				fclose($file);
			}
			
		//ITEMS SHEET
		}else if($_GET['sheet']=="items"){
			
			if(isset($_GET['sort'])){
				$item_id = $_GET['sort'];
				$query_main = "SELECT public.vasarlas_tetel.* FROM public.vasarlas_tetel WHERE public.vasarlas_tetel.vasarlasid = '$item_id'";
			}else{
				echo "Missing SORT parameter";
			}
			
			$result = pg_query($dbc, $query_main);
		
			if (!$result) {
				echo "Could not get results from database";
				exit;
			}else{
				//print results into a csv file
				$file = fopen('results.csv', 'w');
				
				while($row = pg_fetch_row($result)) {
					
					fwrite($file, $row[0] . ';' . $row[1] . ';' . $row[2] . ';' . $row[3] . ';' . $row[4] . ';' . $row[5] . ';' . PHP_EOL);
					
				}
				fclose($file);
			}
			
		//MERCH SHEET
		}else if($_GET['sheet']=="merch"){
			
			if(isset($_GET['sort'])){
				$merch_id = $_GET['sort'];
				$query_main = "SELECT public.cikkek.* FROM public.cikkek WHERE public.cikkek.id = '$merch_id'";
			}else{
				echo "Missing SORT parameter";
			}
			
			$result = pg_query($dbc, $query_main);
		
			if (!$result) {
				echo "Could not get results from database";
				exit;
			}else{
				//print results into a csv file
				$file = fopen('results.csv', 'w');
				
				while($row = pg_fetch_row($result)) {
					
					fwrite($file, $row[0] . ';' . $row[1] . ';' . $row[2] . ';' . $row[3] . ';' . $row[4] . ';' . $row[5] . ';' . $row[6] . ';' . $row[7] . PHP_EOL);
					
				}
				fclose($file);
			}
			
		}else{
			echo "Missing SHEET parameter";
		}
		
		//download
		$filen = "results.csv";
		if(file_exists($filen)) {
			$f = fopen($filen, "r");
			// kényszerítjük a fájl letöltését (azaz, ne ágyazza be böngészőbe)
			header("Content-Type: application/force-download");
			// a letöltéshez megadjuk a fájl méretét
			header("Content-Length: " . filesize($filen));
			header("Content-Disposition: attachment; filename=results.csv");
			while(!feof($f)) {
				echo fread($f,filesize($filen));
			}
			fclose($f);
		}			
		
	}else{
		
		echo 'There is no sheet to print, check the parameters';
		
	}

?>