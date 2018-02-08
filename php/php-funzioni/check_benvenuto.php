<?php
	if($conLog == true){
		if($opendDBConnection == true){
			$dati = $dbaccess->getDatiUser($_SESSION['email']);
			if($dati != false){
				$isAdmin = $dbaccess->isAdmin($_SESSION['email']);
				$row = mysqli_fetch_array($dati);
				$username=$row['username'];
				if(!$isAdmin)
					echo "</br>Benvenuto: " .$username;
				else
					echo "</br>Benvenuto admin: ".$username;
			}
		}
	}
?>