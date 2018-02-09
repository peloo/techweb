<!DOCTYPE html>
<html>
<head>
	<title>Inserisci Articolo - PHP</title>
</head>
<body>
	<?php
		if(isset($_POST['submit'])){
			require_once 'dbconnection.php';
            $dbaccess = new dbconnection();
            $opendDBConnection = $dbaccess->opendDBConnection();
            if($opendDBConnection == true){
                $con = $dbaccess->getConnessione();

                if($_POST['submit']=="Modifica"){
		        	$titolo=$_GET['t'];
		        	$mail=$_GET['m'];
		        	if(mysqli_query($con, "DELETE FROM articolo WHERE mail='$mail' AND titolo='$titolo'"))
		        		echo "Eliminazione andata a buon fine";
	        	}
                $uploadOk = 1;
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

		        $tag = $_REQUEST['tag_scelto'];
		        $isAdmin = $dbaccess->isAdmin($var_email);

//----------------------------------------------------------------------------------------------------------------------------------

		        //$check = getimagesize($_FILES["myimage"]["tmp_name"]);
		        if(!getimagesize($_FILES["myimage"]["tmp_name"]) || $_FILES["myimage"]["size"] > 500000)
		        	$uploadOk = 0;


		    	if($uploadOk == 1){

					$imagetmp=addslashes (file_get_contents($_FILES['myimage']['tmp_name']));
			        if($dbaccess->isArticoloAlreadyRegistered($var_email, $var_titolo))	
			        	$uploadOk = 0;
			        //$check = $dbaccess->isArticoloAlreadyRegistered($var_email, $var_titolo);

		            if($uploadOk == 0)
		            	echo "HEY! questo articolo: ".$var_titolo." e' gia' registrato! :P"; 
		            else{

		            	$check = $dbaccess->add_image($imagetmp);
				        if(!$check)
				        	echo "Ops! Ho provato a caricare l'immagine ma non ci sono riuscito :(";


		            	$check = $dbaccess->getArticolo($var_email,$var_titolo,$var_contenuto,$var_data,$isAdmin);
		                if($check == true){

		                	$idMedia = $dbaccess->getLasIdMedia();
				        	$row = mysqli_fetch_assoc($idMedia);

				        	$check = $dbaccess->setMediaToArticolo($row['id'],$var_email,$var_titolo);


				        	foreach ($tag as $tag_scelto){
				        		$check = $dbaccess->setTagToArticolo($var_email,$var_titolo,$tag_scelto);
				        		if(!$check)
				        			echo "Ops! Non ho collegato il tag al articolo :(";
							}

				        	if(!$check)
				        		echo "Ops! Non ho collegato la foto al articolo :(";
				        	else{
				        		$link_titolo=str_replace(" ", "_", $var_titolo);
		                		echo "YEE! Ho caricato il tuo articolo e anche l'immagine a esso associato ;)";
		                		header('Location: ../articolo.php?t='.$link_titolo.'&m='.$var_email);

				        	}
		                }
		            	else
							die("Ops! Qualcosa non va: non sono riuscito a eseguire la QUERY :'(");
		            }
		    	}
		    	else
		    		echo "Ops! Qualcosa non è andato: potresti aver scelto un immagine troppo grande";
	        }
	        mysqli_close($con);
		}
		else
			echo "Ops! Qualcosa non è andato: non sono riuscito a collegarmi al DB";
	?>
</body>
</html>