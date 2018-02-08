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
		<link rel="stylesheet" type="text/css" href="../css/style_mobile.css" media=" screen and (max-width: 480px), only screen and (max-device-width: 480px)"/>
		<link rel="stylesheet" type="text/css" href="../css/style_print.css" media="print
		">
		<link rel="stylesheet" type="text/css" href="../css/articoli.css" media="screen, handheld">
		
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allerta+Stencil" media="handheld, screen"/>

		<link rel='shortcut icon' type='image/x-icon' href='../images/logo.ico' />

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    	<script type="text/javascript" src="../JavaScript/hamburgermenu.js"></script>

		<title>Miei articoli - Autosecurity</title>
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
					<form id="search_bar" method="get" action="articoli.php?p=0">
						<input id="text_search" type="text" name="search" placeholder="cerca"/>
						<input type="submit" name="submit" id="button_search" value="Cerca"/>
						<input type="hidden" name="p" value="0"/>
					</form>
			</div>

			<ul class="nav" role="menubar">
			  <li id="home" class="link" role="menuitem"><a class="main" href="index.php">Home</a></li>
			  <li id="art" class="link" role="menuitem"><a class="main" href="articoli.php?p=0">Articoli</a></li>
			  <li id="args" class="link" role="menuitem">
					<a class="main" href="#">Argomenti</a>
					<ul id="dropdown-content" role="menu">
						<li><a href="articoli.php?p=0&r=Alfa Romeo">Alfa</a></li>
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
									'<li id="esci" class="link" role="menuitem"><a class="main" href="uscita.php">Esci</a></li>';
					}
					else
						echo '<li id="acc" class="link" role="menuitem"><a class="main" href="../html/iscrizione.html">Accedi o Registrati</a></li>';
				?>
			</ul>
			
		</div>

		<div id="content_menu"> 
			<div id="menu" class="w3-allerta">
				<!-- menu laterale -->
				<p id="location" class="w3-large">Ti trovi in: I miei articoli
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
		                    require_once "tag_frequenti.php";
					    ?>
					</p>

				</div>
			</div>

			<!-- -------------------------------------------------------------------------- -->

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
				<div id="articoli">
					<?php   
	                    require_once 'dbconnection.php';
				        $dbaccess = new dbconnection();
	                    $i = 0;

		                    $visualizza = $dbaccess->getArticoliUtente($_SESSION['email']);
		                    if($visualizza != false){
		                    	foreach ($visualizza as $row){
		                    		$approvato=$row['approvato'];
		                    		$titolo=$row['titolo'];
		                    		$nome=$row['mail'];
		                    		if($approvato==1)
		                    			echo '<a href="articolo.php?t='.$titolo.'&m='.$nome.'">';
			            ?>
	            			<div class="form_articolo">
								<?php
									//echo "<form action='cancella_articolo.php?m=".$nome."&t=".$titolo." method='get'>";
	            					$b64src = "data:image/jpeg;base64," . base64_encode($row['foto']);
	            				?>
	        					<img src= <?php echo $b64src;?> alt="Profilo" />
	        					<input type="hidden" name="mail" value="<?php echo $_SESSION['email']; ?>"/>
	        					<input type="hidden" name="titolo_d" value="<?php echo $titolo; ?>"/>
								<h4 class="titolo"><?php echo $titolo; ?></h4>
								<?php
									if($approvato==0){
										echo '<a class="modifica" href="modifica_articolo.php?t='.$titolo.'&m='.$nome.'">Modifica</a>'.'<img class="approved" src="../images/articolo_no.jpg"/>';
										echo '<a class="button_cancella" href="cancella_articolo.php?m='.$nome.'&t='.$titolo.'">X</a>';
									}
									else
										echo "<img class='approved' src='../images/articolo_si.jpg'/>";

									
								?>
							
							</div>
		                <?php
		                		if($approvato==1)
		                			echo "</a>";
		                    	}
		                    }
		                ?>
	            	
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
				<li id="chisiamo"><a href="weare.php">Chi Siamo</a></li>
				<li id="contacts"><a href="../php/contatti.php">Contatti</a></li>
			</ul>
		</div>
	</body>
</html>