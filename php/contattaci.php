<!DOCTYPE html>
<html>
<head>
	<title>Iscrizione - PHP</title>
</head>
<body>
	<?php
		if(isset($_POST['submit'])){//se il bottone di submit è stato clikkato
			require_once 'dbconnection.php';//includi una volta sola, se non ci riesce mostra un errore
            $dbaccess = new dbconnection();
            $opendDBConnection = $dbaccess->opendDBConnection();
            if($opendDBConnection === true){
                $con = $dbaccess->getConnessione();
// --------------------------------------------------------------------------------------------------------------------------------
				$var_email = $_REQUEST['email'];
				$var_ogg = $_REQUEST['oggetto'];
				$var_contenuto = $_REQUEST['contenuto'];
				$var_data = $_REQUEST['data'];
// --------------------------------------------------------------------------------------------------------------------------------
				$var_email = stripcslashes(strip_tags($var_email));				// toglie "\" e i tags
				$var_ogg = stripcslashes(strip_tags($var_ogg));
				$var_contenuto = stripcslashes(strip_tags($var_contenuto));
		   		$var_data = stripcslashes(strip_tags($var_data));
// --------------------------------------------------------------------------------------------------------------------------------
		    	$var_email = addslashes($var_email);
		        $var_ogg = addslashes($var_ogg);
				$var_contenuto = addslashes($var_contenuto);
		        $var_data = stripcslashes(strip_tags($var_data));
// --------------------------------------------------------------------------------------------------------------------------------
		        $chek = $dbaccess->checkInfo($var_email,$var_ogg);
	            if($chek === true)
	            { echo "Questa info: ".$var_ogg." e' gia' registrata"; }
	            else{
	            	$chek = $dbaccess->getInfo($var_email,$var_ogg,$var_contenuto,$var_data);
	                if($chek == true)
	                	echo "Contatto inviato! ;)";
	            	else
						die("Ops! Qualcosa non va: non sono riuscito a eseguire la QUERY :'(");
	            }

	            mysqli_close($con);
	        }
		}
		else
			echo "Ops! Qualcosa non va :(";
	?>
</body>
</html>