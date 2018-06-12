<div id="mobile">
	<?php
		if($conLog == true && $opendDBConnection == true){
			if(!$isAdmin)
				echo "<b>Benvenuto: " .$username."</b>";
			else
				echo "<b>Benvenuto admin: ".$username."</b>";
		}
	?>
</div>