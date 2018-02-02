<!DOCTYPE html>
<html>
<head>
	<title>Iscrizione - PHP</title>
</head>
<body>
	<?php
		if(isset($_POST['submit'])){
			require_once 'dbconnection.php';
            $dbaccess = new dbconnection();
            $opendDBConnection = $dbaccess->opendDBConnection();
            if($opendDBConnection == true){
                $con = $dbaccess->getConnessione();
// --------------------------------------------------------------------------------------------------------------------------------
				$var_email = $_REQUEST['email'];
				$var_titolo = $_REQUEST['titolo'];
				$var_contenuto = $_REQUEST['contenuto'];
				$var_data = $_REQUEST['data'];
// --------------------------------------------------------------------------------------------------------------------------------
				$var_email = stripcslashes(strip_tags($var_email));
				$var_titolo = stripcslashes(strip_tags($var_titolo));
				$var_contenuto = stripcslashes(strip_tags($var_contenuto));
		   		$var_data = stripcslashes(strip_tags($var_data));
// --------------------------------------------------------------------------------------------------------------------------------
		    	$var_email = addslashes($var_email);
		        $var_titolo = addslashes($var_titolo);
				$var_contenuto = addslashes($var_contenuto);
		        $var_data = addslashes($var_data);
// --------------------------------------------------------------------------------------------------------------------------------
		        $chek = $dbaccess->isArticoloAlreadyRegistered($var_email, $var_titolo);

	            if($chek == true)
	            { echo "Questo articolo: ".$var_titolo." e' gia' registrato"; }
	            else{
	            	$chek = $dbaccess->getArticolo($var_email,$var_titolo,$var_contenuto,$var_data);
	                if($chek == true)
	                	echo "Registrato!";
	            	else
						die("---> Errore nella query");
	            }

	            mysqli_close($con);
	        }
		}
	?>
</body>
</html>