<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="it">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"/ media="handhel, screen"/>
		<link rel="stylesheet" type="text/css" href="../css/style.css" media="handheld, screen"/>
		<link rel="stylesheet" type="text/css" href="../css/add_articolo.css" media="handheld, screen"/>
		<link rel="stylesheet" type="text/css" href="../css/style_mobile.css" media=" screen and (max-width: 480px), only screen and (max-device-width: 480px)"/>

		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allerta+Stencil" media="handheld, screen"/>

		<link rel='shortcut icon' type='image/x-icon' href='../images/logo.ico' />

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    	<script type="text/javascript" src="../JavaScript/hamburgermenu.js"></script>

		<title>Nome pagina - Autosecurity</title>
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
						<li role="menuitem"><a href="#">Alfa</a></li>
						<li role="menuitem"><a href="#">Audi</a></li>
						<li role="menuitem"><a href="#">BMW</a></li>
						<li role="menuitem"><a href="#">Fiat</a></li>
					</ul>
			  </li>
			  <li id="sec" class="link" role="menuitem"><a class="main" href="sicurezza.html">Sicurezza</a></li>
			  <!-- solo per la versione mobile -->
			  <li id="acc" class="link" role="menuitem"><a class="main" href="iscrizione.html">Accedi o Registrati</a></li>
			</ul>
			
		</div>

		<div id="content_menu"> 
			<div id="menu" class="w3-allerta">
				<!-- menu laterale -->
				<p id="location" class="w3-large">
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
					<p id="id_button_scrivi_esci">
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
				<div id="form_add_articolo">
				<form name="" action="add_articolo.php" method="post" onsubmit="return checkForm()">
					<br><br>
                    Email:<input type="hidden" name="email"> <?php echo $_SESSION['email']; ?></input><br><br>
                    
                    <label for="titolo">Titolo del articolo:</label><br>
                    <textarea rows="1" cols="50" name="titolo" placeholder="inserisci qui un titolo"></textarea><br><br>

                    <label for="contenuto">Contenuto del articolo:</label><br>
                    <textarea rows="4" cols="50" name="contenuto" placeholder="inserisci qui il contenuto del articolo"></textarea><br><br>

                	<label for="data">Data del articolo:</label><br>
                    <input name="data" type="date"><br><br>
                    <input type="submit" name="submit" id="button_form_scrivi" value="Scrivi">
            	</form>
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
				<li id="chisiamo"><a href="weare.html">Chi Siamo</a></li>
				<li id="contacts"><a href="#">Contatti</a></li>
			</ul>
		</div>
	</body>
</html>