<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css" media="handheld, screen"/>
		<link rel='shortcut icon' type='image/x-icon' href='images/logo.ico' />

		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allerta+Stencil">
		<title>Home - Autosecurity</title>
	</head>
	<body>
		<div id="header">
			<!-- testa (logo) -->
			<a href="index.html"><img id="logo" src="images\logo.png" alt="logo auto security"></a>
		</div>

		<!-- -------------------------------------------------------------------------- -->


		<div id="breadcrumb">
		<ul>
		  <li><a id="nav">Home</a></li>
		  <li><a id="nav" href="">Articoli</a></li>
		  <li class="dropdown">
				<a id="nav" href="">Argomenti</a>
				<div class="dropdown-content">
					<a href="#">Alfa</a>
					<a href="#">Audi</a>
					<a href="#">BMW</a>
					<a href="#">Fiat</a>
				</div>
		  </li>
		  <li><a id="nav" href="">Sicurezza</a></li>

		  <div id="div_search">
		  		<p id="button_search">
		  			<input id="text_search" type="text" name="search" placeholder="cerca">
		  			<input type="button" class="button_search" value="Cerca">
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
					<div id="form3">
						<p id="location1" class="w3-large">Accesso</p>
					</div>
				
					<!-- <p id="info_form">E-mail:</p> -->
					<input id="text_form" type="text" name="email" placeholder="inserisci mail">
					<!-- <p id="info_form">Password:</p> -->
					<input id="text_form" type="password" name="password" placeholder="inserisci password">
					<br>
					<p id="id_button_form">
						<input type="submit" class="button_form_accedi" name="submit" value="Accedi">
						<input type="button" class="button_form_registrati" value="Registrati" onclick="window.location.href='iscrizione.html'" />
					</p>
				</form>
			</div>

			<div id="form2">

				<div id="form3">
					<p id="location1" class="w3-large">Tag Frequenti</p>
				</div>

				<p>
				<ul>
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
                    			<div id="form_articolo">
                    				<?php $b64src = "data:"."image/jpeg".";base64," . base64_encode($row['foto']); ?>
                					<img src= <?php echo $b64src;?> alt="Profilo" >
									<p><?php echo $row['titolo'];?></p>
									<p><?php echo $row['contenuto'];?><p>
									<div id="form_articolo_footer">
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
						<div id="form_articolo">
            				<?php $b64src = "data:"."image/jpeg".";base64," . base64_encode($row['foto']); ?>
        					<img src= <?php echo $b64src;?> alt="Profilo" >
							<p><?php echo $row['titolo'];?></p>
							<p><?php echo $row['contenuto'];?><p>
							<div id="form_articolo_footer">
								<a href="">Read more...</a>
							</div>
						</div>
						<?php
					}
				}
				?>
			</div>
		</div>
		<!-- -------------------------------------------------------------------------- -->

		<div id="footer">
			<!-- fine pagina -->
			<ul>
				<li><a href="#">Home</a></li>
				<li><a href="#">Articoli</a></li>
				<li><a href="#">Sicurezza</a></li>
				<li><a href="#">Chi Siamo</a></li>
				<li><a href="#">Contatti</a></li>
			</ul>		
		</div>

	</body>
</html>