<?php
	session_start();
	$login=false;
	if (isset($_SESSION['email']) && isset($_SESSION['password'])){
		require_once 'dbconnection.php';
        $dbaccess = new dbconnection();
        $opendDBConnection = $dbaccess->opendDBConnection();
        if($opendDBConnection == true){
            $con = $dbaccess->getConnessione();
         	$conLog = $dbaccess->canLog($_SESSION['email'],$_SESSION['password']);
         	
            if($conLog == true)
                $login=true;
        }
	}
?>