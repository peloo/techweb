<?php require_once "php-funzioni/check_sessione.php"; ?>
<!DOCTYPE html>
<html lang="it">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

		<link href="https://fonts.googleapis.com/css?family=Vollkorn" rel="stylesheet"/>
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" media="handheld, screen"/>
		<link rel="stylesheet" type="text/css" href="../css/style.css" media="handheld, screen"/>
		<link rel="stylesheet" type="text/css" href="../css/home.css" media="handheld, screen"/>
		<link rel="stylesheet" type="text/css" href="../css/style_mobile.css" media=" screen and (max-width: 480px), only screen and (max-device-width: 480px)"/>
		<link rel="stylesheet" type="text/css" href="../css/style_print.css" media="print"/>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allerta+Stencil" media="handheld, screen"/>
		<link rel='shortcut icon' type='image/x-icon' href='../images/logo.ico' />

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    	<script src="../JavaScript/hamburgermenu.js"></script>

		<title>Home - Autosecurity</title>
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
				<li id="home" class="link" role="menuitem"><a class="main">Home</a></li>
				<li id="art" class="link" role="menuitem"><a class="main" href="articoli.php?p=0">Articoli</a></li>
				<li id="args" class="link" role="menuitem">
					<a class="main">Argomenti</a>
					<ul id="dropdown-content" role="menu">
						<li><a href="articoli.php?p=0&r=Alfa_Romeo;">Alfa</a></li>
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
				<p id="location">Ti trovi in: Home
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

				<div id="index">
					<div id="contenitore_l">
						<?php   
		                    require_once 'php-funzioni/dbconnection.php';
					        $dbaccess = new dbconnection();
		                    $i = 0;

		                    $visualizza = $dbaccess->getArticoli(6, 0);
		                    $num_row=mysqli_num_rows($visualizza);
		                    if($visualizza != false){
		                    	for(; $num_row>0 && $i<3; $num_row--){
		                    		$row = mysqli_fetch_assoc($visualizza);
		                    		$titolo=$row['titolo'];
		                    		$link_titolo=str_replace(" ", "&#160;", $titolo);
		                    		$contenuto=substr($row['contenuto'], 0, 300) . "...";
		                    		$mail=$row['mail'];
		                    		$i++;
		                    		?>
		                    			<a href="<?php echo 'articolo.php?t='.$link_titolo.'&m='.$mail;?>">
		                    				<div class="form_articolo">
			                    				<?php $b64src = "data:image/jpeg;base64," . base64_encode($row['foto']); ?>
			                					<img src="<?php echo $b64src;?>" alt="Profilo" />
												<h3 class="titolo" ><?php echo $titolo?></h3>
												<p class="contenuto_articolo" ><?php echo $contenuto;?></p>
												<div class="form_articolo_footer">
													Read more...
												</div>
											</div>
										</a>
		                    		<?php
		                    	}
		                    }
		                ?>
					</div>
					<div id="contenitore_r">
						<?php
						$i=0;
						if($visualizza != false){
							for(; $num_row>0 && $i<3; $num_row--){
		                		$row = mysqli_fetch_assoc($visualizza);
		                		$titolo=$row['titolo'];
		                		$link_titolo=str_replace(" ", "&#160;", $titolo);
	                    		$contenuto=substr($row['contenuto'], 0, 300) . "...";
	                    		$mail=$row['mail'];
		                		$i++;
								?>
								<a href="<?php echo 'articolo.php?t='.$link_titolo.'&m='.$mail;?>">
									<div class="form_articolo">
			            				<?php $b64src = "data:"."image/jpeg".";base64," . base64_encode($row['foto']); ?>
			        					<img src="<?php echo $b64src;?>" alt="Profilo" />
										<h3 class="titolo" ><?php echo $titolo;?></h3>
										<p class="contenuto_articolo" ><?php echo $contenuto;?></p>
										<div class="form_articolo_footer">
											Read more...
										</div>
									</div>
								</a>
								
								<?php
							}
						}
						?>
					</div>
				</div>
			</div>
		</div>

		<div id="footer">
			<ul class="nav">
				<li id="chisiamo"><a href="../php/weare.php">Chi Siamo</a></li>
				<li id="contacts"><a href="../php/contatti.php">Contatti</a></li>
			</ul>
		</div>
	</body>
</html>