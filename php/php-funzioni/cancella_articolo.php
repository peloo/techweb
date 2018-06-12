<!DOCTYPE html>
<html>
<head>
	<title>Cancella Articolo - PHP</title>
</head>
<body>
	<?php
		require_once 'dbconnection.php';
        $dbaccess = new dbconnection();
        $opendDBConnection = $dbaccess->opendDBConnection();
        if($opendDBConnection == true){
            $con = $dbaccess->getConnessione();
// --------------------------------------------------------------------------------------------------------------------------------
			$var_email = $_GET['m'];
			$var_titolo = $_GET['t'];
			$var_titolo=str_replace("_", " ", $var_titolo);
// --------------------------------------------------------------------------------------------------------------------------------
			$var_email = stripcslashes(strip_tags($var_email));
			$var_titolo = stripcslashes(strip_tags($var_titolo));
// --------------------------------------------------------------------------------------------------------------------------------
	    	$var_email = addslashes($var_email);
	        $var_titolo = addslashes($var_titolo);

	        $check = $dbaccess->dropArticolo($var_email,$var_titolo);
	        
	        if($check == true)
	        	header('Location:'.$_SERVER["HTTP_REFERER"]);
	        else
	        	echo "Non sono riuscito ad eliminare l'articolo :(";
	        	
       		mysqli_close($con);
       	}
		else
			echo "Ops! Qualcosa non è andato: non sono riuscito a collegarmi al DB";
	?>
</body>
</html>