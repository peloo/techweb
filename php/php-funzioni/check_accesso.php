<?php
	if($conLog==true){
		if($opendDBConnection == true){
				echo '<form action="php-funzioni/uscita.php" method="post">
					<p id="id_button_scrivi_esci">
						<input type="button" id="button_scrivi_articolo" value="Scrivi articolo" onclick="window.location.href=' ."'" ."new_articolo.php" ."'" .'"' .'>
						<input type="submit" class="button_form_accedi" name="submit" value="Esci"/>
					</p>		
				</form>';
			}
		else
			echo "Ops! Qualcosa e' andato storto";
	}
	else{
		echo '<form action="php-funzioni/accesso.php" method="post">
			<div class="form3">
				<p class="location1">Accesso</p>
			</div>
		
			<!-- <p id="info_form">E-mail:</p> -->
			<input class="text_form" type="text" name="email" placeholder="inserisci mail"/>
			<!-- <p id="info_form">Password:</p> -->
			<input class="text_form" type="password" name="password" placeholder="inserisci password"/>
			<br/>
			<p id="id_button_form">
				<input type="submit" class="button_form_accedi" name="submit" value="Accedi"/>
				<input type="button" id="button_form_registrati" value="Registrati" onclick="window.location.href=' ."'" ."../html/iscrizione.html" ."'" .'"' .'/>
			</p>
		</form>';
	}
?>