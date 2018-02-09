<!DOCTYPE html>
<html>
<head>
	<title>Accesso - PHP</title>
</head>
<body>
	<?php
        session_start(); 
		if (isset($_POST['submit'])) 
		{ 
			require_once 'dbconnection.php';
            $dbaccess = new dbconnection();
            $opendDBConnection = $dbaccess->opendDBConnection();

            if($opendDBConnection == true){
                $con = $dbaccess->getConnessione();

                $var_email = $_REQUEST['email'];
                $var_passw = $_REQUEST['password'];

                $var_email = stripcslashes(strip_tags($var_email));   //controllo che non ci siano tag nell'email
                $var_passw = stripcslashes(strip_tags($var_passw));   //controllo che non ci siano tag nella password

                $var_email = addslashes($var_email);
                $var_passw = addslashes($var_passw);    
                $var_passw = md5($var_passw);
                
                /*-----------------------------------------------*/
                $conLog = $dbaccess->canLog($var_email,$var_passw);
                if($conLog == true){
                    $_SESSION['email']=$var_email;
                    $_SESSION['password']=$var_passw;
                    header('Location: ../index.php');
                    mysqli_close($con);
                }
                else{
                    ob_start();
                    echo "Accesso non valido";
                    header('refresh:2;url=../index.php');
                    ob_end_flush();
                }
            }
                //$dbaccess->close(); 
		}
	?>

</body>
</html>