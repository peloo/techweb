<?php
	require_once 'dbconnection.php';
	$dbaccess = new dbconnection();
								
	$peso=intval($_REQUEST['p']);;
	$bevanda=strval($_REQUEST['b']);
	$table=strval($_REQUEST['t']);

	if($table!=""){
		$sql="SELECT A.$peso FROM $table AS A WHERE A.bevanda='$bevanda'";
		$result=$dbaccess->runQuery($sql);
		$result=mysqli_fetch_array($result);
		echo $result["$peso"];
	}
?>