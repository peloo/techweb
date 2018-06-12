<?php
	if(isset($_POST['submit'])){					
		require_once 'dbconnection.php';
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
			$var_email = stripcslashes(strip_tags($var_email));				
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
                	echo "<br><br>Contatto inviato! ;)";
            	else
					echo "<br><br>Ops! Qualcosa non è andato: non sono riuscito a inviare il tuo messaggio :'(";
            }
            mysqli_close($con);
        }
	}
?>