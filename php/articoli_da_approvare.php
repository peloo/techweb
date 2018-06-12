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
		<link rel="stylesheet" type="text/css" href="../css/articoli.css" media="screen"/>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allerta+Stencil" media="screen"/>
		<link rel='shortcut icon' type='image/x-icon' href='../images/logo.ico' />

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    	<script src="../JavaScript/hamburgermenu.js"></script>

		<title>Articoli da approvare - Autosecurity</title>
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
				<!-- menu laterale -->
				<p id="location" >Ti trovi in: Articoli da approvare
					<?php require_once "php-funzioni/check_benvenuto.php"; ?>
				</p>

				<?php require_once "accesso_tag.php"; ?>
			</div>

			<div id="content">
				<?php require_once "mobile.php"; ?>

				<div id="articoli">
						<?php   
		                    require_once 'php-funzioni/dbconnection.php';
					        $dbaccess = new dbconnection();
		                    $i = 0;
		                    $pagina=$_GET['p'];
		                    $n_articoli_pagina=8;
		                    $riga=$pagina*$n_articoli_pagina;
		                    $n_articoli=$dbaccess->numArticoliDaApprovare();
		                    $n_pagine=intval($n_articoli/$n_articoli_pagina);
		                    if($n_articoli%$n_articoli_pagina!=0)
	                    		$n_pagine++;

	                    	$visualizza = $dbaccess->getArticoliDaApprovare($n_articoli_pagina, $riga);
		                    if($visualizza != false){
		                    	foreach ($visualizza as $row){
		                    		$approvato=$row['approvato'];
		                    		$titolo=$row['titolo'];
		                    		$link_titolo=str_replace(" ", "_", $titolo);
		                    		$nome=$row['mail'];
		                    		if($approvato==1)
		                    			echo '<a href="articolo.php?t='.$link_titolo.'&m='.$nome.'">';
			            ?>
			            <div class="form_articolo">
			            	
								<?php $b64src = "data:image/jpeg;base64," . base64_encode($row['foto']); ?>
	        					<img src="<?php echo $b64src;?>" alt="Profilo" />
	        					<input type="hidden" name="mail" value="<?php echo $_SESSION['email']; ?>"/>
	        					<input type="hidden" name="titolo_d" value="<?php echo $titolo; ?>"/>
								<?php echo '<a href="articolo.php?t='.$link_titolo.'&m='.$nome.'">'; ?><h4 class="titolo"><?php echo $titolo; ?></h4></a>
							
							<?php
								if($approvato==0){
									echo '<a class="button_approva" href="php-funzioni/approva_articolo.php?t='.$link_titolo.'&m='.$nome.'">Approva</a>'.'<img class="approved" src="../images/articolo_no.jpg" alt="articolo non approvato"/>';
									echo '<a class="button_cancella" href="php-funzioni/cancella_articolo.php?m='.$nome.'&t='.$link_titolo.'">X</a>';
								}
								else
									echo '<img class="approved" src="../images/articolo_si.jpg" alt="articolo approvato"/>';
							?>
						</div>
		                <?php
		                		if($approvato==1)
		                			echo "</a>";
		                    	}
		                    }

		                    if($n_articoli==0)
	                    	echo "<h2 style='text-align:center;'>Non sono più presenti articoli da approvare</h2>";
	                    
		                    echo "<div id='pagine'>Pagine:<br>";
		                    if($pagina==0){
		                    	echo "<a>1</a>";
		                    	if($n_pagine>1){
		                    		echo "<a class='pagina' href='articoli_da_approvare.php?p=1'>2</a>";
		                    		if($n_pagine>2){
		                    			echo "<a class='pagina' href='articoli_da_approvare.php?p=2'>3</a>";
		                    			if($n_pagine>3)
		                    				echo "...";
		                    		}
		                    	}
		                    }
		                    else{
		                    	if($pagina>=2)
		                    		echo "...";
		                    	echo "<a class='pagina' href='articoli_da_approvare.php?p=".($pagina-1)."'>".$pagina."</a>"."<a>".($pagina+1)."</a>";
		                    	if($pagina+1<$n_pagine)
		                    		echo "<a class='pagina' href='articoli_da_approvare.php?p=".($pagina+1)."'>".($pagina+2)."</a>";
		                    	if($pagina+2<$n_pagine)
		                    		echo "...";
		                    }
		                    echo "</div>";
		                ?>
	            	
				</div>
			</div>
		</div>

		<?php require_once "footer.php"; ?>
	</body>
</html>