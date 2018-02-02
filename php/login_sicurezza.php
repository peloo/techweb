<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="it">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

		<link href="https://fonts.googleapis.com/css?family=Vollkorn" rel="stylesheet">

		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"/ media="handhel, screen"/>
		<link rel="stylesheet" type="text/css" href="../css/style.css" media="handheld, screen"/>
		<link rel="stylesheet" type="text/css" href="../css/sicurezza.css" media="handheld, screen"/>
		<link rel="stylesheet" type="text/css" href="../css/sicurezza_mobile.css" media="only screen and (max-device-width: 480px)"/>
		<link rel="stylesheet" type="text/css" href="../css/style_mobile.css" media=" screen and (max-width: 480px), only screen and (max-device-width: 480px)"/>
		<link rel="stylesheet" type="text/css" href="../css/style_print.css" media="print"> 
		
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allerta+Stencil" media="handheld, screen"/>

		<link rel='shortcut icon' type='image/x-icon' href='../php/images/logo.ico' />

		<script type="text/javascript" src="../JavaScript/alcohol.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    	<script type="text/javascript" src="../JavaScript/hamburgermenu.js"></script>

		<title>Sicurezza - Autosecurity</title>
	</head> 
	<body onresize="reset()">
		<div id="header">
			<!-- testa (logo) -->
			<a href="../php/index.php"><img id="logo" src="../images/logo.png" alt="logo auto security"/></a>
		</div>

		<!-- -------------------------------------------------------------------------- -->


		<div id="breadcrumb">
			<header>
				<button id="hamburger" onclick="dropdown()">&#9776;</button>
	    		<button id="cross" onclick="dropup()">&#735;</button>
	    	</header>

	    	<div id="div_search">
					<p id="search_bar">
						<input id="text_search" type="text" name="search" placeholder="cerca"/>
						<input type="button" id="button_search" value="Cerca"/>
					</p>
			</div>

			<ul class="nav" role="menubar">
			  <li id="home" class="link" role="menuitem"><a class="main" href="../php/index.php">Home</a></li>
			  <li id="art" class="link" role="menuitem"><a class="main" href="#">Articoli</a></li>
			  <li id="args" class="link" role="menuitem">
					<a class="main" href="#">Argomenti</a>
					<ul id="dropdown-content" role="menu">
						<li><a href="#">Alfa</a></li>
						<li><a href="#">Audi</a></li>
						<li><a href="#">BMW</a></li>
						<li><a href="#">Fiat</a></li>
					</ul>
			  </li>
			  <li id="sec" class="link" role="menuitem"><a class="main">Sicurezza</a></li>
			  <!-- solo per la versione mobile -->
			  <li id="acc" class="link" role="menuitem"><a class="main" href="../html/iscrizione.html">Accedi o Registrati</a></li>
			</ul>
			
		</div>

		<div id="content_menu"> 
			<div id="menu" class="w3-allerta">
				<!-- menu laterale -->
				<p id="location" class="w3-large">
					Ti trovi: Sicurezza<br/>
					Benvenuto: 
					<?php
						session_start();
						require_once 'dbconnection.php';
						$dbaccess = new dbconnection();
						$opendDBConnection = $dbaccess->opendDBConnection();
						if($opendDBConnection == true){
							$dati = $dbaccess->getDatiUser($_SESSION['email']);
							if($dati != false){
								$row = mysqli_fetch_array($dati);
								echo $row['username'];
							}
							else
								echo "Ops! Qualcosa e' andato storto";
						}
					?>
				</p>

				<form action="uscita.php" method="post">
					<p id="id_button_form">
						<input type="submit" id="button_form_accedi" name="submit" value="Esci"/>
					</p>		
				</form>

				<div id="form2">

					<div class="form3">
						<p class="location1" class="w3-large">Tag Frequenti</p>
					</div>

					<p>
						<ul class="nav">
						  <li><a href="#">Abarth</a></li>
						  <li><a href="#">Acura</a></li>
						  <li><a href="#">Alfa Romeo</a></li>
						  <li><a href="#">Alpina</a></li>
						  <li><a href="#">Aston</a></li>
						  <li><a href="#">Martin</a></li>
						  <li><a href="#">Audi</a></li>
						</ul>			
					</p>
				</div>
			</div>

			<!-- -------------------------------------------------------------------------- -->

			<div id="content">
				<div id="security">
					<h2><b>Perchè dovremmo fare sempre due calcoli prima di vover salire in auto?</b></h2>
					<p>"Non ti preoccupare, qui gli autovelox non ci sono o non funzionano", "Questa sera non bevo, se trovo i carabinieri mentre torno a casa sono fregato". Spesso sono questi i pensieri che nascono quando vogliamo metterci alla guida sperando che durante il viaggio di non incappare in alcuna complicazione. L'obiettivo di questa pagina non è tanto quella di convincervi a guidare sotto i limiti o che guidare da ubriachi nuoce a te e a che sta con te in auto, ma solo quella di rendervi un po' consapevoli di cosa comporta premere l'acceleratore in certe situazioni. Uno degli scopi di questo sito, Autosecurity, è appunto quello di rendere l'autista una persona, appunto, più Autonoma e consapevole in campo di sicurezza autostradale. Se siete interessati buon viaggio!</p><br/>

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

					<a id="articoli" href="articoli_sicurezza.html">Articoli sicurezza</a>
				</div>
			</div>
		</div>
		<!-- -------------------------------------------------------------------------- -->

		<div id="footer">
			<!-- fine pagina -->
			<ul class="nav">
				<!-- <li><a href="#">Home</a></li>
				<li><a href="#">Articoli</a></li>
				<li><a href="#">Sicurezza</a></li> -->
				<li id="chisiamo"><a href="../php/logout_weare.php">Chi Siamo</a></li>
				<li id="contacts"><a href="#">Contatti</a></li>
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