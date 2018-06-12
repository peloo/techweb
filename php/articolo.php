<?php require_once "php-funzioni/check_sessione.php"; ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="it">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

		<link href="https://fonts.googleapis.com/css?family=Vollkorn" rel="stylesheet"/>
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" media="screen"/>
		<link rel="stylesheet" type="text/css" href="../css/style.css" media="screen"/>
		<link rel="stylesheet" type="text/css" href="../css/style_mobile.css" media=" screen and (max-width: 945px), only screen and (max-width: 945px)"/>
		<link rel="stylesheet" type="text/css" href="../css/style_print.css" media="print"/>
		<link rel="stylesheet" type="text/css" href="../css/articolo.css" media="screen"/>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allerta+Stencil" media="screen"/>
		<link rel='shortcut icon' type='image/x-icon' href='../images/logo.ico' />

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    	<script src="../JavaScript/hamburgermenu.js"></script>

		<title>Articolo - Autosecurity</title>
	</head> 
	<body onresize="reset()">
		<?php require_once "header.php"; ?>

		<div id="breadcrumb">
			<?php require_once "hamburger_search.php"; ?>
			

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
				<p id="location">Ti trovi in: Articolo
					<?php require_once "php-funzioni/check_benvenuto.php"; ?>
				</p>

				<?php require_once "accesso_tag.php"; ?>
			</div>

			<div id="content">
				<?php require_once "mobile.php"; ?>
				<div id="articolo">
					<?php
						require_once 'php-funzioni/dbconnection.php';
				        $dbaccess = new dbconnection();
				        $titolo=$_GET['t'];
				        $titolo=str_replace("_", " ", $titolo);
				        $mail=$_GET['m'];

				        $username = $dbaccess->getUsername($mail);
				        $username = mysqli_fetch_assoc($username);
				        $username = $username['username'];
				        
				        $row=$dbaccess->prelevaArticolo($mail, $titolo);
				        if(mysqli_num_rows($row)==1){
					        $row=mysqli_fetch_assoc($row);
					        $titolo=$row['titolo'];
					        $mail=$row['mail'];
					        $contenuto=$row['contenuto'];
					        $data=$row['data'];
					        $foto = "data:image/jpeg;base64," . base64_encode($row['foto']);
					    }
					?>
					<h2><b><?php echo $titolo?></b></h2>
					<div id="immagine_testo">
						<img id="immagine" src="<?php echo $foto?>" alt="foto profilo articolo">
						<p id="testo">
							<?php
								$eols = array("\n","\r\n");
								$text = str_replace($eols,'<br>',$contenuto);
								echo $text; 
							?>
					</div>
					<div id="data_autore">
						<p id="data"><?php echo $data?></p>
						<p id="author"><?php echo $username?></p>
					</div>
					<div id="lista_tag">
						Tag: 
						<?php
							require_once 'php-funzioni/dbconnection.php';
					        $dbaccess = new dbconnection();
					        $opendDBConnection = $dbaccess->opendDBConnection();
					        $visualizza = $dbaccess->getTagArticolo($mail, $titolo);
	                    	if($visualizza != false){
		                    	foreach ($visualizza as $row){
		                    		$nome=$row['nome'];
		                    		$link_nome=str_replace(" ", "_", $nome);
									echo "<a href='articoli.php?p=0&r=".$link_nome."'>".$nome."</a> - ";
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