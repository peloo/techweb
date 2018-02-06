<?php
	require_once "check_sessione.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="it">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="https://fonts.googleapis.com/css?family=Vollkorn" rel="stylesheet">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"/ media="handhel, screen"/>
		<link rel="stylesheet" type="text/css" href="../css/style.css" media="handheld, screen"/>
		<link rel="stylesheet" type="text/css" href="../css/contattaci.css" media="handheld, screen"/>
		<link rel="stylesheet" type="text/css" href="../css/style_mobile.css" media=" screen and (max-width: 480px), only screen and (max-device-width: 480px)"/>

		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allerta+Stencil" media="handheld, screen"/>

		<link rel='shortcut icon' type='image/x-icon' href='../images/logo.ico' />

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    	<script type="text/javascript" src="../JavaScript/hamburgermenu.js"></script>
        <script type="text/javascript" src="../JavaScript/checkPass.js"></script>

		<title>Contatti - Autosecurity</title>
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
			  <li id="art" class="link" role="menuitem"><a class="main" href="../php/articoli.php">Articoli</a></li>
			  <li id="args" class="link" role="menuitem">
					<a class="main" href="#">Argomenti</a>
					<ul id="dropdown-content" role="menu">
						<li role="menuitem"><a href="#">Alfa</a></li>
						<li role="menuitem"><a href="#">Audi</a></li>
						<li role="menuitem"><a href="#">BMW</a></li>
						<li role="menuitem"><a href="#">Fiat</a></li>
					</ul>
			  </li>
			  <li id="sec" class="link" role="menuitem"><a class="main" href="../php/sicurezza.php">Sicurezza</a></li>
			  <!-- solo per la versione mobile -->
			  <li id="acc" class="link" role="menuitem"><a class="main" href="iscrizione.html">Accedi o Registrati</a></li>
			</ul>
			
		</div>

		<div id="content_menu"> 
			<div id="menu" class="w3-allerta">
				<!-- menu laterale -->
				<p id="location" class="w3-large">Ti trovi in: Contatti

				<?php
					require_once "check_benvenuto.php";
				?>
				</p>

				<div id="form" style='<?php if($conLog==true) echo "border:0;"?>'>
					<?php
						require_once "check_accesso.php";
					?>
				</div>

				<div id="form2">

					<div class="form3">
						<p class="location1" class="w3-large">Tag Frequenti</p>
					</div>

					<p>
						<?php   
		                    require_once 'dbconnection.php';
					        $dbaccess = new dbconnection();
					        $opendDBConnection = $dbaccess->opendDBConnection();

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
					</p>	
					
				</div>
			</div>

			<!-- -------------------------------------------------------------------------- -->

			<div id="content">
				<div id="contattaci">
                    <h2> CONTATTACI </h2>
                    <p> Hai riscontrato problemi con il sito oppure vuoi metterti in contatto con uno dei responsabili? Inviaci un'email ed uno di loro ti risponderà il prima possibile</p>
				
                    <form id="invia_email" name="invia_email" action="../php/contattaci.php" method="post" onsubmit="return CheckContatti()">
						<br>
	                    <label for="email">Email:</label><br>
	                    <input type="text" name="email" id="email" placeholder="inserisci qui la mail"><br><br>
	                    
	                    <label for="oggetto">Oggetto:</label><br>
	                    <textarea rows="1" cols="50" name="oggetto" placeholder="inserisci qui l'oggetto"></textarea><br><br>

	                    <label for="contenuto">Contenuto dell'email:</label><br>
	                    <textarea rows="4" cols="50" name="contenuto" placeholder="inserisci qui il contenuto dell'email"></textarea><br><br>

	                    <p>
	                		<label>Data di oggi: </label><label id="data_corrente"></label>  
	                	</p>
	                	<input type="hidden" name="data" id="data_corrente2" value=""/>
						<script>
							var d = new Date();
						    var day = d.getDate();
						  	var month = d.getMonth()+1;
						  	var year = d.getFullYear();
						    document.getElementById("data_corrente").innerHTML = day + '-' + month + '-' + year;
						    document.getElementById("data_corrente2").value = year + '-' +  month + '-' + day;
						</script>

	                    <input type="submit" name="submit" id="invia" value="Contattaci">
            		</form><br><br>
                    
                    <p>In alternativa, se preferisci scrivere ad un specifico responsabile puoi contattarlo ad una delle seguenti email: </p><br>
                <ul>
                    <li>Matteo: pellandamatteo@autosecurity.it</li>
                    <li>Nicola: carlessonicola@autosecurity.it</li>
                    <li>Enrico: trincoenrico@autosecurity.it</li>
                </ul>
                    
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
				<li id="chisiamo"><a href="../php/weare.php">Chi Siamo</a></li>
				<li id="contacts"><a>Contatti</a></li>
			</ul>
		</div>
	</body>
</html>