<?php   
    require_once 'dbconnection.php';
    $dbaccess = new dbconnection();

    $visualizza = $dbaccess->getTag();
    if($visualizza != false){
    	echo "<ul class='nav'>";
    	while($row = mysqli_fetch_assoc($visualizza)){
            $nome=$row['nome'];
            $link_nome=str_replace(" ", "_", $nome);
			echo "<li><a href='articoli.php?p=0&amp;r=".$link_nome."'>".$nome."</a></li>";
    	}
    	echo "</ul>";
    }
?>