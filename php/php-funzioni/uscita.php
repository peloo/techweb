<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<body>
	<?php
		session_unset(); 	// remove all session variables
		session_destroy();	// destroy the session
		header('Location: index.php');
		echo "Tutte le variabili di sessione sono state cacellate e la sessione stessa distrutta(chiusa)." 
	?>
	</body>
</html>