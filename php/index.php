<?php require_once "php-funzioni/check_sessione.php"; ?>
<!DOCTYPE html>
<html lang="it">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

		<link href="https://fonts.googleapis.com/css?family=Vollkorn" rel="stylesheet"/>
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" media="screen"/>
		<link rel="stylesheet" type="text/css" href="../css/style.css" media="screen"/>
		<link rel="stylesheet" type="text/css" href="../css/home.css" media="screen"/>
		<link rel="stylesheet" type="text/css" href="../css/style_mobile.css" media=" screen and (max-width: 945px), only screen and (max-width: 945px)"/>
		<link rel="stylesheet" type="text/css" href="../css/style_print.css" media="print"/>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allerta+Stencil" media="screen"/>
		<link rel='shortcut icon' type='image/x-icon' href='../images/logo.ico' />

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    	<script src="../JavaScript/hamburgermenu.js"></script>

		<title>Home - Autosecurity</title>
	</head> 
	<body onresize="reset()">

		<?php require_once "header.php"; ?>

		<div id="breadcrumb">
			<?php require_once "hamburger_search.php"; ?>

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

				<?php require_once "accesso_tag.php"; ?>
			</div>

			<div id="content">
				<?php require_once "mobile.php"; ?>

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
		                    		$link_titolo=str_replace(" ", "_", $titolo);
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
		                		$link_titolo=str_replace(" ", "_", $titolo);
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

		<?php require_once "footer.php"; ?>
	</body>
</html>