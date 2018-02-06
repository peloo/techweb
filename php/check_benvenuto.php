<?php
	if($conLog == true){
		echo "<br/>Benvenuto: ";
		if($opendDBConnection == true){
			$dati = $dbaccess->getDatiUser($_SESSION['email']);
			if($dati != false){
				$row = mysqli_fetch_array($dati);
				echo $row['username'];
			}
		}
	}
?>