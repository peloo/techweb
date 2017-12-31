<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="style.css" media="handheld, screen"/>
		<link rel='shortcut icon' type='image/x-icon' href='images/logo.ico' />

		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"/>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allerta+Stencil"/>
		<title>Home - Autosecurity</title>
	</head>
	<body>
		<div id="header">
			<!-- testa (logo) -->
			<a href="index.php"><img id="logo" src="images/logo.png" alt="logo auto security"/></a>
		</div>

		<!-- -------------------------------------------------------------------------- -->


		<div id="breadcrumb">
			<ul class="nav" role="menubar">
			  <li class="link" role="menuitem"><a class="main">Home</a></li>
			  <li class="link" role="menuitem"><a class="main" href="">Articoli</a></li>
			  <li class="link" role="menuitem">
					<a class="main" href="">Argomenti</a>
					<ul id="dropdown-content" role="menu">
						<li role="menuitem"><a href="#">Alfa</a></li>
						<li role="menuitem"><a href="#">Audi</a></li>
						<li role="menuitem"><a href="#">BMW</a></li>
						<li role="menuitem"><a href="#">Fiat</a></li>
					</ul>
			  </li>
			  <li class="link" role="menuitem"><a class="main" href="">Sicurezza</a></li>

			  <div id="div_search">
			  		<p id="search_bar">
			  			<input id="text_search" type="text" name="search" placeholder="cerca">
			  			<input type="button" id="button_search" value="Cerca">
			  		</p>
			  </div>
			</ul>
		</div>

		<div id="content_menu"> 
			<div id="menu" class="w3-allerta">
				<!-- menu laterale -->
				<p id="location" class="w3-large">Ti trovi in: Home</p>

				<div id="form">
					<form action="accesso.php" method="post">
						<div class="form3">
							<p class="location1" class="w3-large">Accesso</p>
						</div>
					
						<!-- <p id="info_form">E-mail:</p> -->
						<input class="text_form" type="text" name="email" placeholder="inserisci mail"/>
						<!-- <p id="info_form">Password:</p> -->
						<input class="text_form" type="password" name="password" placeholder="inserisci password"/>
						<br/>
						<p id="id_button_form">
							<input type="submit" id="button_form_accedi" name="submit" value="Accedi"/>
							<input type="button" id="button_form_registrati" value="Registrati" onclick="window.location.href='iscrizione.html'" />
						</p>
					</form>
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
										<p><?php echo $row['titolo'];?></p>
										<p><?php echo $row['contenuto'];?></p>
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
						for(; $i<5; $i++){
	                		$row = mysqli_fetch_assoc($visualizza);
							?>
							<div class="form_articolo">
	            				<?php $b64src = "data:"."image/jpeg".";base64," . base64_encode($row['foto']); ?>
	        					<img src= <?php echo $b64src;?> alt="Profilo" />
								<p><?php echo $row['titolo'];?></p>
								<p><?php echo $row['contenuto'];?></p>
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
		<!-- -------------------------------------------------------------------------- -->

		<div id="footer">
			<!-- fine pagina -->
			<ul class="nav">
				<li><a href="#">Home</a></li>
				<li><a href="#">Articoli</a></li>
				<li><a href="#">Sicurezza</a></li>
				<li><a href="#">Chi Siamo</a></li>
				<li><a href="#">Contatti</a></li>
			</ul>		
		</div>
	</body>
</html>