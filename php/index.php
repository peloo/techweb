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
		<link rel="stylesheet" type="text/css" href="../css/home.css" media="handheld, screen"/>
		<link rel="stylesheet" type="text/css" href="../css/style_mobile.css" media=" screen and (max-width: 480px), only screen and (max-device-width: 480px)"/>
		<link rel="stylesheet" type="text/css" href="../css/style_print.css" media="print
		">
		
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allerta+Stencil" media="handheld, screen"/>

		<link rel='shortcut icon' type='image/x-icon' href='../images/logo.ico' />

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    	<script type="text/javascript" src="../JavaScript/hamburgermenu.js"></script>

		<title>Home - Autosecurity</title>
	</head> 
	<body onresize="reset()">
		<div id="header">
			<!-- testa (logo) -->
			<a href="index.php"><img id="logo" src="../images/logo.png" alt="logo auto security"/></a>
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
			  <li id="home" class="link" role="menuitem"><a class="main">Home</a></li>
			  <li id="art" class="link" role="menuitem"><a class="main" href="articoli.php">Articoli</a></li>
			  <li id="args" class="link" role="menuitem">
					<a class="main" href="#">Argomenti</a>
					<ul id="dropdown-content" role="menu">
						<li role="menuitem"><a href="#">Alfa</a></li>
						<li role="menuitem"><a href="#">Audi</a></li>
						<li role="menuitem"><a href="#">BMW</a></li>
						<li role="menuitem"><a href="#">Fiat</a></li>
					</ul>
			  </li>
			  <li id="sec" class="link" role="menuitem"><a class="main" href="sicurezza.php">Sicurezza</a></li>
			  <!-- solo per la versione mobile -->
			  <li id="acc" class="link" role="menuitem"><a class="main" href="../html/iscrizione.html">Accedi o Registrati</a></li>
			</ul>
			
		</div>

		<div id="content_menu"> 
			<div id="menu" class="w3-allerta">
				<!-- menu laterale -->
				<p id="location" class="w3-large">Ti trovi in: Home
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
				<div id="home">
					<div id="contenitore_l">
						<?php   
		                    require_once 'dbconnection.php';
					        $dbaccess = new dbconnection();
					        $opendDBConnection = $dbaccess->opendDBConnection();
		                    $i = 0;

		                    $visualizza = $dbaccess->getArticoliRecenti();
		                    if($visualizza != false){
		                    	for(; $i<3; $i++){
		                    		$row = mysqli_fetch_assoc($visualizza);
		                    		?>
		                    			<div class="form_articolo">
		                    				<?php $b64src = "data:"."image/jpeg".";base64," . base64_encode($row['foto']); ?>
		                					<img src= <?php echo $b64src;?> alt="Profilo" />
											<p class="titolo" ><?php echo $row['titolo'];?></p>
											<p class="contenuto_articolo" ><?php echo $row['contenuto'];?></p>
											<div class="form_articolo_footer">
												<a href="">Read more...</a>
											</div>
										</div>
		                    		<?php
		                    	}
		                    }
		                ?>
					</div>
					<div id="contenitore_r">
						<?php
						if($visualizza != false){
							for(; $i<6; $i++){
		                		$row = mysqli_fetch_assoc($visualizza);
								?>
								<div class="form_articolo">
		            				<?php $b64src = "data:"."image/jpeg".";base64," . base64_encode($row['foto']); ?>
		        					<img src= <?php echo $b64src;?> alt="Profilo" />
									<p class="titolo" ><?php echo $row['titolo'];?></p>
									<p class="contenuto_articolo" ><?php echo $row['contenuto'];?></p>
									<div class="form_articolo_footer">
										<a href="">Read more...</a>
									</div>
								</div>
								<?php
							}
						}
						?>
					</div>
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
				<li id="contacts"><a href="../html/contattaci.html">Contatti</a></li>
			</ul>
		</div>
	</body>
</html>