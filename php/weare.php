<?php require_once "php-funzioni/check_sessione.php"; ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="it">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

		<link href="https://fonts.googleapis.com/css?family=Vollkorn" rel="stylesheet"/>
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" media="handheld, screen"/>
		<link rel="stylesheet" type="text/css" href="../css/style.css" media="handheld, screen"/>
		<link rel="stylesheet" type="text/css" href="../css/style_mobile.css" media=" screen and (max-width: 480px), only screen and (max-device-width: 480px)"/>
		<link rel="stylesheet" type="text/css" href="../css/style_print.css" media="print"/>
		<link rel="stylesheet" type="text/css" href="../css/chisiamo.css" media="handheld, screen"/>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allerta+Stencil" media="handheld, screen"/>
		<link rel='shortcut icon' type='image/x-icon' href='../images/logo.ico' />

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    	<script src="../JavaScript/hamburgermenu.js"></script>

		<title>Chi Siamo - Autosecurity</title>
	</head> 
	<body onresize="reset()">
		<div id="header">
			<a href="index.php"><img id="logo" src="../images/logo.png" alt="logo auto security"/></a>
		</div>

		<div id="breadcrumb">
			<div id="hamburger_menu">
				<button id="hamburger" onclick="dropdown()">&#9776;</button>
	    		<button id="cross" onclick="dropup()">&#735;</button>
	    	</div>

	    	
			<form id="search_bar" method="get" action="articoli.php?p=0">
				<input id="text_search" type="text" name="search" placeholder="cerca"/>
				<input type="submit" name="submit" id="button_search" value="Cerca"/>
				<input type="hidden" name="p" value="0"/>
			</form>
			

			<ul class="nav" role="menubar">
			  <li id="home" class="link" role="menuitem"><a class="main" href="index.php">Home</a></li>
			  <li id="art" class="link" role="menuitem"><a class="main" href="articoli.php?p=0">Articoli</a></li>
			  <li id="args" class="link" role="menuitem">
					<a class="main">Argomenti</a>
					<ul id="dropdown-content" role="menu">
						<li><a href="articoli.php?p=0&r=Alfa_Romeo">Alfa</a></li>
						<li><a href="articoli.php?p=0&r=Audi">Audi</a></li>
						<li><a href="articoli.php?p=0&r=BMW">BMW</a></li>
						<li><a href="articoli.php?p=0&r=Fiat">Fiat</a></li>
					</ul>
			  </li>
			  <li id="sec" class="link" role="menuitem"><a class="main" href="sicurezza.php">Sicurezza</a></li>
			  <!-- solo per la versione mobile -->
			  <?php
					if($conLog==true){
						if($opendDBConnection == true)
								echo '<li id="scrivi" class="link" role="menuitem"><a class="main" href="new_articolo.php">Scrivi articolo</a></li>'.
									'<li id="esci" class="link" role="menuitem"><a class="main" href="php-funzioni/uscita.php">Esci</a></li>';
					}
					else
						echo '<li id="acc" class="link" role="menuitem"><a class="main" href="../html/iscrizione.html">Accedi o Registrati</a></li>';
				?>
			</ul>
			
		</div>

		<div id="content_menu"> 
			<div id="menu" class="w3-allerta">
				<p id="location">Ti trovi in: Chi siamo
					<?php require_once "php-funzioni/check_benvenuto.php"; ?>
				</p>

				<div id="form" <?php if($conLog==true) echo "style='border:0;'"?>>
					<?php require_once "php-funzioni/check_accesso.php"; ?>
				</div>

				<div id="form2">

					<div class="form3">
						<p class="location1">Tag Frequenti</p>
					</div>

					<?php require_once "php-funzioni/tag_frequenti.php"; ?>

				</div>
			</div>

			<div id="content">
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
				<div id="weare">	
					<div id="generalita_sito">
						<h2><b>IL SITO</b></h2>
						<p> Nato come progetto per il corso "Tecnologie Web 17-18" questo sito ha lo scopo di essere un punto di riferimento per gli automobilisti, fornendo articoli sulle ultime novit&agrave; in campo automobilistico e sulla sicurezza stradale.</p>
					</div>
					
					<div id="respons">
						<h2><b>RESPONSABILI</b></h2>
						<div id="mat">
							<h3>Matteo Pellanda </h3>
							<img id="pelo" src="../images/pelo.jpg" alt="immagine profilo Matteo">
							<p> Matteo Pellanda &egrave; il responsabile della parte PHP, Database e della homepage<br/>
		                    </p>
						</div>
						
		                <div id="doge">
                            <h3>Enrico Trinco</h3>
							<img id="dog" src="../images/doge.jpg" alt="immagine profilo Enrico">
							<p> Enrico Trinco, l'elemento del gruppo che mostra curiosit&agrave; ma non si applica. Responsabile delle pagine "Chi Siamo", "Contattaci", "Log-in" del Javascript </p>
						</div>
		                
						<div id="nico">
							<h3>Nicola Carlesso </h3>
							<img id="nic" src="../images/nico.jpg" alt="immagine profilo Nicola">
                            <p> Nicola Carlesso. Responsabile del CSS desktop, mobile, stampa e della parte di sicurezza e relativo Javascrip.</p>	
                        </div>
						
					</div>
				</div>
			</div>
		</div>

		<div id="footer">
			<ul class="nav">
				<li id="chisiamo"><a>Chi Siamo</a></li>
				<li id="contacts"><a href="../php/contatti.php">Contatti</a></li>
			</ul>
		</div>
	</body>
</html>