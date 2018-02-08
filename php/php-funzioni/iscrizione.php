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
            if($opendDBConnection === true){
                $con = $dbaccess->getConnessione();
// --------------------------------------------------------------------------------------------------------------------------------
				$var_email = $_REQUEST['email'];
				$var_passw = $_REQUEST['password'];
				$var_nome = $_REQUEST['nome'];
				$var_cognome = $_REQUEST['cognome'];
				$var_nick = $_REQUEST['nickname'];
// --------------------------------------------------------------------------------------------------------------------------------
				$var_email = stripcslashes(strip_tags($var_email));			// toglie "\" e i tags
				$var_passw = stripcslashes(strip_tags($var_passw));
				$var_nome = stripcslashes(strip_tags($var_nome));
		   		$var_cognome = stripcslashes(strip_tags($var_cognome));
		    	$var_nick = stripcslashes(strip_tags($var_nick));
// --------------------------------------------------------------------------------------------------------------------------------
		    	$var_email = addslashes($var_email);
		        $var_passw = addslashes($var_passw);
				$var_nome = addslashes($var_nome);
		        $var_cognome = addslashes($var_cognome);
		        $var_nick = addslashes($var_nick);
// --------------------------------------------------------------------------------------------------------------------------------
		        $chek = $dbaccess->isAlreadyRegistered($var_email);

	            if($chek == true)
	            { echo "Questa mail: ".$var_email." e' gia' registrata"; }
	            else{
	            	$var_passw = md5($var_passw);
	            	$chek = $dbaccess->getRegistration($var_email,$var_passw,$var_nick,$var_nome,$var_cognome);
	                if($chek == true)
	                	header("location: ../php/reg_ok.php");
	            	else
						die("Ops! Qualcosa non va: non sono riuscito a eseguire la QUERY :'(");
	            }

	            mysqli_close($con);
	        }
		}
	?>
</body>
</html>