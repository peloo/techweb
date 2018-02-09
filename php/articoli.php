<?php require_once "php-funzioni/check_sessione.php"; ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="it">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

		<link href="https://fonts.googleapis.com/css?family=Vollkorn" rel="stylesheet">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"/ media="handheld, screen"/>
		<link rel="stylesheet" type="text/css" href="../css/style.css" media="handheld, screen"/>
		<link rel="stylesheet" type="text/css" href="../css/style_mobile.css" media=" screen and (max-width: 480px), only screen and (max-device-width: 480px)"/>
		<link rel="stylesheet" type="text/css" href="../css/style_print.css" media="print"/>
		<link rel="stylesheet" type="text/css" href="../css/articoli.css" media="screen, handheld"/>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allerta+Stencil" media="handheld, screen"/>
		<link rel='shortcut icon' type='image/x-icon' href='../images/logo.ico'/>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    	<script src="../JavaScript/hamburgermenu.js"></script>

		<title>Articoli - Autosecurity</title>
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
			

			<?php
				$ricerca='';
                if(isset($_GET['submit'])){
                	$ricerca=$_GET['search'];
                	$ricerca=str_replace("_", " ", $ricerca);
                }
                else if(isset($_GET['r']) && $_GET['r']!=''){
                	$ricerca=$_GET['r'];
                	$ricerca=str_replace("_", " ", $ricerca);
                }

                if($ricerca=='')
                	echo '<style>#art:hover, #art:focus, #art:active, #art a:hover, #art a:focus, #art a:active{background-color: #303841;}</style>';
			?>
			<ul class="nav" role="menubar">
			  <li id="home" class="link" role="menuitem"><a class="main" href="index.php">Home</a></li>
			  <li id="art" class="link" role="menuitem"><a class="main" <?php if($ricerca!='') echo 'href="articoli.php?p=0"';?> >Articoli</a></li>
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
									'<li id="esci" class="link" role="menuitem"><a class="main" href="uscita.php">Esci</a></li>';
					}
					else
						echo '<li id="acc" class="link" role="menuitem"><a class="main" href="../html/iscrizione.html">Accedi o Registrati</a></li>';
				?>
			</ul>
			
		</div>

		<div id="content_menu"> 
			<div id="menu" class="w3-allerta">
				<p id="location">Ti trovi in: Articoli
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
				<div id="articoli">
					<?php   
	                    require_once 'php-funzioni/dbconnection.php';
				        $dbaccess = new dbconnection();
	                    $pagina=$_GET['p'];

	                    $n_articoli_pagina=8;
	                    $riga=$pagina*$n_articoli_pagina;
	                    $n_articoli=$dbaccess->getNumArticoli($ricerca);
	                    $n_pagine=intval($n_articoli/$n_articoli_pagina);
	                    if($n_articoli%$n_articoli_pagina!=0)
	                    	$n_pagine++;

	                    $visualizza = $dbaccess->getArticoli($n_articoli_pagina, $riga, $ricerca);

	                    if($visualizza != false){
	                    	foreach ($visualizza as $row){
	                    		$titolo=$row['titolo'];
	                    		$link_titolo=str_replace(" ", "_", $titolo);
	                    		$nome=$row['mail'];
                    			echo '<a href="articolo.php?t='.$link_titolo.'&m='.$nome.'">
	                    			<div class="form_articolo">';
	                    				$b64src = "data:image/jpeg;base64," . base64_encode($row['foto']);
	                					echo '<img src="'.$b64src.'" alt="Profilo" />
										<h4 class="titolo" >'.$titolo.'</h4>
									</div>
								</a>';
	                    	}
	                    }

	                    if($n_articoli==0)
	                    	echo "<h2 style='text-align:center;'>Mi dispiace, non sono ancora stati pubblicati articoli</h2>";

	                    $link_ricerca=str_replace(" ", "&#160;", $ricerca);
	                    
	                    echo "<div id='pagine'>Pagine:<br>";
	                    if($pagina==0){
	                    	echo "<a>1</a>";
	                    	if($n_pagine>1){
	                    		echo "<a class='pagina' href='articoli.php?p=1&r=".$link_ricerca."'>2</a>";
	                    		if($n_pagine>2){
	                    			echo "<a class='pagina' href='articoli.php?p=2&r=".$link_ricerca."'>3</a>";
	                    			if($n_pagine>3)
	                    				echo "...";
	                    		}
	                    	}
	                    }
	                    else{
	                    	if($pagina>=2)
	                    		echo "...";
	                    	echo "<a class='pagina' href='articoli.php?p=".($pagina-1)."&r=".$link_ricerca."'>".$pagina."</a>"."<a>".($pagina+1)."</a>";
	                    	if($pagina+1<$n_pagine)
	                    		echo "<a class='pagina' href='articoli.php?p=".($pagina+1)."&r=".$link_ricerca."'>".($pagina+2)."</a>";
	                    	if($pagina+2<$n_pagine)
	                    		echo "...";
	                    }
	                    echo "</div>";
	                ?>
				</div>
			</div>
		</div>

		<div id="footer">
			<ul class="nav">
				<li id="chisiamo"><a href="weare.php">Chi Siamo</a></li>
				<li id="contacts"><a href="../php/contatti.php">Contatti</a></li>
			</ul>
		</div>
	</body>
</html>