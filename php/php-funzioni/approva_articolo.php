<?php
	$mail=$_GET['m'];
	$titolo=$_GET['t'];
	$titolo=str_replace("_", " ", $titolo);
	$query="UPDATE articolo SET approvato=1 WHERE mail='".$mail."' AND titolo='".$titolo."'";
	require_once 'dbconnection.php';
	$dbaccess = new dbconnection();
	$dbaccess->runQuery($query);
	header('Location: ../articoli_da_approvare.php?p=0');
?>