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
		<link rel="stylesheet" type="text/css" href="../css/sicurezza.css" media="handheld, screen"/>
		<link rel="stylesheet" type="text/css" href="../css/sicurezza_mobile.css" media="only screen and (max-device-width: 480px)"/>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allerta+Stencil" media="handheld, screen"/>
		<link rel='shortcut icon' type='image/x-icon' href='../images/logo.ico' />

		<script src="../JavaScript/alcohol.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    	<script src="../JavaScript/hamburgermenu.js"></script>

		<title>Sicurezza - Autosecurity</title>
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
								echo '<li id="scrivi" class="link" role="menuitem"><a class="main" href="new_articolo.php"/>Scrivi articolo</a></li>'.
									'<li id="esci" class="link" role="menuitem"><a class="main" href="php-funzioni/uscita.php">Esci</a></li>';
					}
					else
						echo '<li id="acc" class="link" role="menuitem"><a class="main" href="../html/iscrizione.html">Accedi o Registrati</a></li>';
				?>
			</ul>
			
		</div>

		<div id="content_menu"> 
			<div id="menu" class="w3-allerta">
				<p id="location">Ti trovi in: Sicurezza
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
				<div id="security">
					<h2><b>Perchè dovremmo fare sempre due calcoli prima di vover salire in auto?</b></h2>
					<p>"Non ti preoccupare, qui gli autovelox non ci sono o non funzionano", "Questa sera non bevo, se trovo i carabinieri mentre torno a casa sono fregato". Spesso sono questi i pensieri che nascono quando vogliamo metterci alla guida sperando durante il viaggio di non incappare in alcuna complicazione. L'obiettivo di questa pagina non è tanto quella di convincervi a guidare sotto i limiti o che guidare da ubriachi nuoce a te e a che sta con te in auto, ma solo quella di rendervi un po' consapevoli di cosa comporta premere l'acceleratore in certe situazioni. Uno degli scopi di questo sito, Autosecurity, è appunto quello di rendere l'autista una persona, appunto, più Autonoma e consapevole in campo di sicurezza autostradale. Se siete interessati buon viaggio!</p><br/>

					<h3>Lo spazio di frenata:</h3>
					<p>Farsi un'idea dello spazio di arresto è decisamente importante per non incappare in uno sconveniente e, può purtroppo accadere, pericoloso incidente. Vi forniamo dunque uno strumento per darvi un'idea di quale dovrebbe essere lo spazio di arresto della vostra auto ad una data velocità, con una data condizione del manto stradale e con una data grado di condizione che l'autista assume. Si presuppone che i freni del veicolo siano perfettamente funzionanti. Ricordiamo che lo spazio di arresto è dato dallo spazio di frenata più lo spazio di reazione.</p><br/>
					<div id="velocita">
						<p>Selezionare la condizione del manto stradale</p>
						<select id="street">
							<option value="buono" selected>Buono</option>
							<option value="bagnato">Bagnato</option>
							<option value="ghiacciato">Ghiacciato</option>
						</select>
						<p>Selezionare la condizione dell'autista</p>
						<select id="condition">
							<option value="normale" selected>Normale</option>
							<option value="over_0.5">Con più di 0.5g/l di alcol in corpo</option>
							<option value="cellulare">Guardando il cellulare</option>
							<option value="bevuto">Dopo aver bevuto, ma con meno di 0.6g/l in corpo</option>
							<option value="messaggio">Mandando un SMS</option>
							<option value="fumato">Dopo aver fumato (non una normale sigaretta)</option>
							<option value="cannabis">Dopo aver assunto Cannabis</option>
						</select>
						<p>Selezionare la velocità in km/h</p>
						<input type="number" id="speed" min="0">
						<button id="calculate" onclick="spazio_frenata()">Calcola</button>
						<p id="risultato_1"></p>
					</div><br/>

					<h3>Limite alcolico:</h3>
					<p>Vi mettiamo ora a disposizione ora uno strumento per capire se dopo aver bevuto una certa quantità di alcolici sarete ancora nella possibilità, legale e cognitiva, di poter guidare. Ricordate che il limite di alcol nel sangue è di 0.5 g/l, e per i neo-patentati (cioè per coloro che hanno la patente da meno di tre anni) è di 0 g/l.</p><br/>
					<div id="alcol">
						<p>Indicare il sesso, se si è a stomaco pieno o vuoto, ed il proprio peso</p>
						<form id="genere">Sesso:
							<input type="radio" name="gender" id="male" value="uomo">
							<label for="male">Uomo</label>
							<input type="radio" name="gender" id="female" value="donna">
							<label for="female">Donna</label>
						</form>
						<form id="stomaco">Stomaco:
							<input type="radio" name="stomach" id="full" value="pieno">
							<label for="full">Pieno</label>
							<input type="radio" name="stomach" id="empty" value="vuoto">
							<label for="empty">Vuoto</label>
						</form>
						<form id="peso">Peso:
							<input type="radio" name="weight" id="weight45" value="45">
							<label for="weight45">45 Kg</label>
							<input type="radio" name="weight" id="weight55" value="55">
							<label for="weight55">55 Kg</label>
							<input type="radio" name="weight" id="weight60" value="60">
							<label for="weight60">60 Kg</label>
							<input type="radio" name="weight" id="weight65" value="65">
							<label for="weight65">65 Kg</label>
							<input type="radio" name="weight" id="weight75" value="75">
							<label for="weight75">75 Kg</label>
							<input type="radio" name="weight" id="weight85" value="80">
							<label for="weight85">80 Kg</label>
						</form>
						<p>Indicare le bevande assunte (è presente il loro grado alcolico)</p>
						<select id="bevanda">
							<option value="birra_analcolica">Birra analcolica, 0.5%</option>
							<option value="birra_leggera">Birra leggera, 3.5%</option>
							<option value="birra_normale">Birra normale, 5%</option>
							<option value="birra_speciale">Birra speciale, 8%</option>
							<option value="birra_doppio_malto">Birra doppio malto, 10%</option>
							<option value="vino">Vino, 12%</option>
							<option value="vini_liquorosi/aperitivi">Vini liquorosi/Aperitivi, 18%</option>
							<option value="digestivi_1">Digestivi, 25%</option>
							<option value="digestivi_2">Digestivi, 30%</option>
							<option value="superalcolici_1">Superalcolici, 35%</option>
							<option value="superalcolici_2">Superalcolici, 45%</option>
							<option value="superalcolici_3">Superalcolici, 60%</option>
							<option value="champagne/spumante">Champagne/Spumante, 11%</option>
							<option value="ready_to_drink_1">Ready to drink, 2.8%</option>
							<option value="ready_to_drink_2">Ready to drink, 5%</option>
						</select>
						<button id="add" onclick="aggiungi_bevanda()">Aggiungi</button>
						<ul id="risultato_2"></ul>
						<p id="risultato_3"></p>
					</div><br/>

					<a id="articoli_sicurezza" href="articoli.php?p=0&r=Sicurezza">Articoli sicurezza</a>
				</div>
			</div>
		</div>

		<div id="footer">
			<ul class="nav">
				<li id="chisiamo"><a href="weare.php">Chi Siamo</a></li>
				<li id="contacts"><a href="../php/contatti.php">Contatti</a></li>
			</ul>
		</div>

		<script>
		var input = document.getElementById("speed");
		input.addEventListener("keyup", function(event) {
		    event.preventDefault();
		    if (event.keyCode === 13) {
		        spazio_frenata();
		    }
		});
		</script>
	</body>
</html>