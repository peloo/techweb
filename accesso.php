<!DOCTYPE html>
<html>
<head>
	<title>Accesso - PHP</title>
</head>
<body>
	<?php
		if (isset($_POST['submit'])) 
		{ 
			include('connessione.php');
			$var_email = $_REQUEST['email'];
			$var_passw = $_REQUEST['password'];

			$var_email = stripcslashes(strip_tags($var_email));   //controllo che non ci siano tag nell'email
            $var_passw = stripcslashes(strip_tags($var_passw));   //controllo che non ci siano tag nella password

    	    $var_email = addslashes($var_email);
    	    $var_passw = addslashes($var_passw);	

    	    $result = mysqli_query($con,"SELECT * FROM utente WHERE mail = '$var_email' AND password = '$var_passw'");
    	    $row = mysqli_fetch_array($result);
            $num_rows = $result->num_rows;
            if($num_rows == 1){
            	$var_username = $row['username'];
            	header('Location: accesso_ok.html'); 
            	mysqli_free_result($result);
                mysqli_close($con);
            }
            else{
            	echo $var_email;
            	echo $var_passw;
            	echo "Accesso non valido";
            }
		}
	?>

</body>
</html>