<?php
	$dbserver = "localhost";  	// host del database
	$dbusername = "root";     	// utente che accede al db
	$dbpassword = "";
	$dbdatabase = "tecweb";   	// nome del database

	// connessione a MySQL tramite mysql_connect()
	$con=mysqli_connect($dbserver,$dbusername,$dbpassword,$dbdatabase);
    // Check connection
    if (mysqli_connect_errno())
    { die("Failed to connect to MySQL: " . mysqli_connect_error()); }
?>
