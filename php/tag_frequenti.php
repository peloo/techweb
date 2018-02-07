<?php   
    require_once 'dbconnection.php';
    $dbaccess = new dbconnection();

    $visualizza = $dbaccess->getTag();
    if($visualizza != false){
    	echo "<ul class='nav'>";
    	while($row = mysqli_fetch_assoc($visualizza)){
    		?>
			<li><a href="#"><?php echo $row['nome'];?></a></li>
			<?php
    	}
    	echo "</ul>";
    }
?>