<?php
	class dbconnection{
		const var_server = "localhost";
		const var_username = "root";
		const var_password = "";
		const var_dbname = "techweb";
		public $connessione;

		public function opendDBConnection(){
		// restituisce un oggetto connessione che servira' per fare le query 
		$this->connessione = mysqli_connect(static::var_server, static::var_username, static::var_password, static::var_dbname);
		if(!$this->connessione)
			return false;
		else
			return true; 
		}

		public function getConnessione(){ return $this->connessione; }

		public function runQuery($query){
			$result = mysqli_query($this->connessione,$query);
	        return $result;
		}

		public function canLog($mail, $pass){
			$result = mysqli_query($this->connessione,"SELECT * FROM utente WHERE mail = '$mail' AND password = '$pass'");
	        $row = mysqli_fetch_array($result);
	        $num_rows = $result->num_rows;
	        if($num_rows == 1)
	        	return true;
	        else
	        	return false;
		}

		public function getRegistration($mail, $pass, $user, $nome, $cognome){
			$result = mysqli_query($this->connessione,"INSERT INTO utente(mail,password,username,nome,cognome) VALUES ('$mail','$pass', '$user', '$nome', '$cognome')");
	        if($result) 
	        	return true;
	        else
	        	return false;
		}

		public function isAlreadyRegistered($mail){
			$result = mysqli_query($this->connessione,"SELECT * FROM utente WHERE mail = '$mail'");
	        $row = mysqli_fetch_array($result);
	        $num_rows = $result->num_rows;
	        if($num_rows == 1)
	        	return true;
	        else
	        	return false;
		}

		public function getArticolo($mail, $titolo, $contenuto, $data){
			$result = mysqli_query($this->connessione,"INSERT INTO articolo(mail,titolo,contenuto,data) VALUES ('$mail','$titolo','$contenuto','$data')");
	        if($result) 
	        	return true;
	        else
	        	return false;
		}

		public function add_image($img){
			$insert_image="INSERT INTO media(link,foto,foto_video) VALUES (NULL,'$img',0)";
			$this->connessione = mysqli_connect(static::var_server, static::var_username, static::var_password, static::var_dbname);
			if($this->connessione){
				$result = mysqli_query($this->connessione, $insert_image);
				if($result) 
		        	return true;
		        else
		        	return false;
			}
			else
				return false;
		}

		public function getLasIdMedia(){
			$result = mysqli_query($this->connessione,"SELECT id FROM media order by id DESC limit 1");
	        $num_rows = $result->num_rows;
	        if($num_rows == 1)
	        	return $result;
	        else
	        	return false;
		}

		public function setMediaToArticolo($id,$mail,$titolo){
			$result = mysqli_query($this->connessione,"INSERT INTO articolo_media(mail,titolo,id) VALUES ('$mail','$titolo','$id')");
	        if($result) 
	        	return true;
	        else{
	        	echo("Error description: " . mysqli_error($this->connessione));
	        	return false;
	        }
		}

		public function isArticoloAlreadyRegistered($mail, $titolo){
			$result = mysqli_query($this->connessione,"SELECT * FROM articolo WHERE mail = '$mail' AND titolo = '$titolo'");
	        $row = mysqli_fetch_array($result);
	        $num_rows = $result->num_rows;
	        if($num_rows == 1)
	        	return true;
	        else
	        	return false;
		}

		public function getArticoliRecenti(){
			$result = mysqli_query($this->connessione,"SELECT * FROM articolo A JOIN articolo_media AM ON (A.mail = AM.mail AND A.titolo = AM.titolo) JOIN media M ON (AM.id = M.id) order by A.data DESC limit 6");
	        mysqli_close($this->connessione);
	        $num_rows = $result->num_rows;
	        if($num_rows >= 1)
	        	return $result;
	        else
	        	return false;
		}

		public function getArticoliUtente($mail){
			$result = mysqli_query($this->connessione,"SELECT * FROM articolo A JOIN articolo_media AM ON (A.mail = AM.mail AND A.titolo = AM.titolo) JOIN media M ON (AM.id = M.id) WHERE A.mail = '$mail'  order by A.data DESC");
	        mysqli_close($this->connessione);
	        $num_rows = $result->num_rows;
	        if($num_rows >= 1)
	        	return $result;
	        else
	        	return false;
		}

		public function getDatiUser($mail){	
			$result = mysqli_query($this->connessione,"SELECT * FROM utente WHERE mail = '$mail'");
	        mysqli_close($this->connessione);
	        $num_rows = $result->num_rows;
	        if($num_rows == 1)
	        	return $result;
	        else
	        	return false;
		}

		public function checkInfo($mail, $oggetto){
			$result = mysqli_query($this->connessione,"SELECT * FROM utente WHERE mail = '$mail' AND oggetto = '$oggetto'");
			if(!$result)
	        	return false;
	        $row = mysqli_fetch_array($result);
	        $num_rows = $result->num_rows;
	        if($num_rows == 1)
	        	return true;
	        else
	        	return false;
		}

		public function getInfo($mail, $oggetto, $contenuto, $data){
			$result = mysqli_query($this->connessione,"INSERT INTO info(mail,oggetto,contenuto,data) VALUES ('$mail','$oggetto','$contenuto','$data')");
	        if($result) 
	        	return true;
	        else
	        	return false;
		}

		public function getTag(){
			$result = mysqli_query($this->connessione,"SELECT nome FROM tag order by nome");
	        mysqli_close($this->connessione);
	        $num_rows = $result->num_rows;
	        if($num_rows >= 1)
	        	return $result;
	        else
	        	return false;
		}
	}
?>