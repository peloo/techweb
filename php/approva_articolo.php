<<<<<<< HEAD
<?php
	$mail=$_GET['m'];
	$titolo=$_GET['t'];
	$query="UPDATE articolo SET approvato=1 WHERE mail='".$mail."' AND titolo='".$titolo."'";
	require_once 'dbconnection.php';
	$dbaccess = new dbconnection();
	$dbaccess->runQuery($query);
	header('Location: articoli_da_approvare.php?p=0');
=======
<?php
	$mail=$_GET['m'];
	$titolo=$_GET['t'];
	$query="UPDATE articolo SET approvato=1 WHERE mail='".$mail."' AND titolo='".$titolo."'";
	require_once 'dbconnection.php';
	$dbaccess = new dbconnection();
	$dbaccess->runQuery($query);
	header('Location: articoli_da_approvare.php?p=0');
>>>>>>> 6a0961e7718cca2f87261164f39075ec10ad5217
?>