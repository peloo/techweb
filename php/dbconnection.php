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

		public function close(){mysqli_close($this->connessione);}

		public function runQuery($query){
			$this->connessione = mysqli_connect(static::var_server, static::var_username, static::var_password, static::var_dbname);
			$result = mysqli_query($this->connessione,$query);
			mysqli_close($this->connessione);
	        return $result;
		}

		public function canLog($mail, $pass){
			$this->connessione = mysqli_connect(static::var_server, static::var_username, static::var_password, static::var_dbname);
			$result = mysqli_query($this->connessione,"SELECT * FROM utente WHERE mail = '$mail' AND password = '$pass'");
	        $row = mysqli_fetch_array($result);
	        $num_rows = $result->num_rows;
	        mysqli_close($this->connessione);
	        if($num_rows == 1)
	        	return true;
	        else
	        	return false;
		}

		public function getRegistration($mail, $pass, $user, $nome, $cognome){
			$this->connessione = mysqli_connect(static::var_server, static::var_username, static::var_password, static::var_dbname);
			$result = mysqli_query($this->connessione,"INSERT INTO utente(mail,password,username,nome,cognome) VALUES ('$mail','$pass', '$user', '$nome', '$cognome')");
	        if($result){
	        	$result = mysqli_query($this->connessione,"INSERT INTO user(mail) VALUES ('$mail')");
	        	mysqli_close($this->connessione);
	        	if($result)
	        		return true;
	        	else
	        		return false;
	        }
	        mysqli_close($this->connessione);
	        return false;
		}

		public function isAlreadyRegistered($mail){
			$this->connessione = mysqli_connect(static::var_server, static::var_username, static::var_password, static::var_dbname);
			$result = mysqli_query($this->connessione,"SELECT * FROM utente WHERE mail = '$mail'");
	        $row = mysqli_fetch_array($result);
	        $num_rows = $result->num_rows;
	        mysqli_close($this->connessione);
	        if($num_rows == 1)
	        	return true;
	        else
	        	return false;
		}

		public function getArticolo($mail, $titolo, $contenuto, $data,$isAd){
			$this->connessione = mysqli_connect(static::var_server, static::var_username, static::var_password, static::var_dbname);
			$result = mysqli_query($this->connessione,"INSERT INTO articolo(mail,titolo,contenuto,data,approvato) VALUES ('$mail','$titolo','$contenuto','$data','$isAd')");
			mysqli_close($this->connessione);
	        if($result) 
	        	return true;
	        else
	        	return false;
		}

		public function prelevaArticolo($mail, $titolo){
			$this->connessione = mysqli_connect(static::var_server, static::var_username, static::var_password, static::var_dbname);
			$result = mysqli_query($this->connessione,"SELECT A.mail, A.titolo, A.contenuto, A.data, M.foto FROM articolo A JOIN articolo_media AM ON (A.mail = AM.mail AND A.titolo = AM.titolo) JOIN media M ON (AM.id = M.id) WHERE A.mail='$mail' AND A.titolo='$titolo'");
			mysqli_close($this->connessione);
			return $result;

			
		}

		public function add_image($img){
			$this->connessione = mysqli_connect(static::var_server, static::var_username, static::var_password, static::var_dbname);
			$insert_image="INSERT INTO media(link,foto,foto_video) VALUES (NULL,'$img',0)";
			if($this->connessione){
				$result = mysqli_query($this->connessione, $insert_image);
				mysqli_close($this->connessione);
				if($result) 
		        	return true;
		        else
		        	return false;
			}
			mysqli_close($this->connessione);
			return false;
		}

		public function getLasIdMedia(){
			$this->connessione = mysqli_connect(static::var_server, static::var_username, static::var_password, static::var_dbname);
			$result = mysqli_query($this->connessione,"SELECT id FROM media order by id DESC limit 1");
	        $num_rows = $result->num_rows;
	        mysqli_close($this->connessione);
	        if($num_rows == 1)
	        	return $result;
	        else
	        	return false;
		}

		public function setMediaToArticolo($id,$mail,$titolo){
			$this->connessione = mysqli_connect(static::var_server, static::var_username, static::var_password, static::var_dbname);
			$result = mysqli_query($this->connessione,"INSERT INTO articolo_media(mail,titolo,id) VALUES ('$mail','$titolo','$id')");
	        if($result){
	        	mysqli_close($this->connessione);
	        	return true;
	        }
        	echo("Error description: " . mysqli_error($this->connessione));
        	mysqli_close($this->connessione);
        	return false;
		}

		public function isArticoloAlreadyRegistered($mail, $titolo){
			$this->connessione = mysqli_connect(static::var_server, static::var_username, static::var_password, static::var_dbname);
			$result = mysqli_query($this->connessione,"SELECT * FROM articolo WHERE mail = '$mail' AND titolo = '$titolo'");
	        $row = mysqli_fetch_array($result);
	        $num_rows = $result->num_rows;
	        mysqli_close($this->connessione);
	        if($num_rows == 1)
	        	return true;
	        else
	        	return false;
		}

		public function getArticoli($limit, $offset, $ricerca=''){
			$this->connessione = mysqli_connect(static::var_server, static::var_username, static::var_password, static::var_dbname);
			
			if($ricerca!=''){
				$ricerca=ltrim($ricerca);
				$ricerca_tag=mysqli_query($this->connessione, "SELECT DISTINCT nome FROM tag");
				$tag_trovato='';
				foreach ($ricerca_tag as $row){
					if(strtolower($row['nome'])==strtolower($ricerca))
						$tag_trovato=$row['nome'];
				}
				if($tag_trovato==''){
					$ricerca=str_replace(" ", "%", $ricerca);
					$result = mysqli_query($this->connessione,"SELECT A.mail, A.titolo, A.contenuto, A.data, M.foto, A.approvato FROM articolo A JOIN articolo_media AM ON (A.mail = AM.mail AND A.titolo = AM.titolo) JOIN media M ON (AM.id = M.id) WHERE A.approvato=1 AND LOWER(A.titolo) LIKE LOWER('%".$ricerca."%') order by A.data DESC LIMIT ".$offset.",".$limit);
				}
				else
					$result = mysqli_query($this->connessione,"SELECT A.mail, A.titolo, A.contenuto, A.data, M.foto, A.approvato FROM articolo A JOIN articolo_media AM ON (A.mail = AM.mail AND A.titolo = AM.titolo) JOIN media M ON (AM.id = M.id) JOIN articolo_tag AR ON (AR.mail=A.mail AND AR.titolo=A.titolo) WHERE A.approvato=1 AND LOWER(AR.nome)=LOWER('".$tag_trovato."') order by A.data DESC LIMIT ".$offset.",".$limit);
			}
			else
				$result = mysqli_query($this->connessione,"SELECT A.mail, A.titolo, A.contenuto, A.data, M.foto, A.approvato FROM articolo A JOIN articolo_media AM ON (A.mail = AM.mail AND A.titolo = AM.titolo) JOIN media M ON (AM.id = M.id) WHERE A.approvato=1 ORDER BY A.data DESC LIMIT ".$offset.",".$limit);

	        $num_rows = $result->num_rows;
	        mysqli_close($this->connessione);
	        return $result;
		}

		public function getArticoliDaApprovare($limit, $offset){
			$this->connessione = mysqli_connect(static::var_server, static::var_username, static::var_password, static::var_dbname);
			$result = mysqli_query($this->connessione,"SELECT A.mail, A.titolo, A.contenuto, A.data, M.foto, A.approvato FROM articolo A JOIN articolo_media AM ON (A.mail = AM.mail AND A.titolo = AM.titolo) JOIN media M ON (AM.id = M.id) WHERE A.approvato=0 order by A.data DESC LIMIT ".$offset.",".$limit);
	        $num_rows = $result->num_rows;
	        mysqli_close($this->connessione);
	        return $result;
		}

		public function numArticoliDaApprovare(){
			$this->connessione = mysqli_connect(static::var_server, static::var_username, static::var_password, static::var_dbname);
			$result = mysqli_query($this->connessione,"SELECT A.mail FROM articolo A JOIN articolo_media AM ON (A.mail = AM.mail AND A.titolo = AM.titolo) JOIN media M ON (AM.id = M.id) WHERE A.approvato=0 order by A.data DESC");
			$num_rows = $result->num_rows;
	        mysqli_close($this->connessione);
	        return $num_rows;
		}

		public function getNumArticoli($ricerca){
			$result=$this->getArticoli(500, 0, $ricerca);
			$num_rows = $result->num_rows;
	        return $num_rows;
		}

		public function getArticoliUtente($mail){
			$this->connessione = mysqli_connect(static::var_server, static::var_username, static::var_password, static::var_dbname);
			$result = mysqli_query($this->connessione,"SELECT A.mail, A.titolo, A.contenuto, A.data, A.approvato,M.foto FROM articolo A JOIN articolo_media AM ON (A.mail = AM.mail AND A.titolo = AM.titolo) JOIN media M ON (AM.id = M.id) WHERE A.mail = '$mail'  order by A.data DESC");
	        $num_rows = $result->num_rows;
	        mysqli_close($this->connessione);
	        return $result;
		}

		public function getDatiUser($mail){
			$this->connessione = mysqli_connect(static::var_server, static::var_username, static::var_password, static::var_dbname);
			$result = mysqli_query($this->connessione,"SELECT * FROM utente WHERE mail = '$mail'");
	        $num_rows = $result->num_rows;
	        mysqli_close($this->connessione);
	        if($num_rows == 1)
	        	return $result;
	        else
	        	return false;
		}

		public function checkInfo($mail, $oggetto){
			$this->connessione = mysqli_connect(static::var_server, static::var_username, static::var_password, static::var_dbname);
			$result = mysqli_query($this->connessione,"SELECT * FROM utente WHERE mail = '$mail' AND oggetto = '$oggetto'");
			if(!$result)
	        	return false;
	        $row = mysqli_fetch_array($result);
	        $num_rows = $result->num_rows;
	        mysqli_close($this->connessione);
	        if($num_rows == 1)
	        	return true;
	        else
	        	return false;
		}

		public function getInfo($mail, $oggetto, $contenuto, $data){
			$this->connessione = mysqli_connect(static::var_server, static::var_username, static::var_password, static::var_dbname);
			$result = mysqli_query($this->connessione,"INSERT INTO info(mail,oggetto,contenuto,data) VALUES ('$mail','$oggetto','$contenuto','$data')");
			mysqli_close($this->connessione);
	        if($result) 
	        	return true;
	        else
	        	return false;
		}

		public function getTag($limite=10){
			$this->connessione = mysqli_connect(static::var_server, static::var_username, static::var_password, static::var_dbname);
			if($limite == 0)
				$result = mysqli_query($this->connessione,"SELECT nome FROM tag WHERE nome != 'NA' order by contatore DESC");
			else
				$result = mysqli_query($this->connessione,"SELECT nome FROM tag WHERE nome != 'NA' AND nome != 'ALTRO' order by contatore DESC limit 10");
	        $num_rows = $result->num_rows;
	        mysqli_close($this->connessione);
	        return $result;
		}

		public function setTagToArticolo($mail,$titolo,$tag){
			$this->connessione = mysqli_connect(static::var_server, static::var_username, static::var_password, static::var_dbname);
			$result = mysqli_query($this->connessione,"INSERT INTO articolo_tag(mail,titolo,nome) VALUES ('$mail','$titolo','$tag')");
	        if($result){
	        	$result = mysqli_query($this->connessione,"UPDATE tag SET contatore = contatore + 1 WHERE nome = '$tag'");
	        	if($result){
	        		mysqli_close($this->connessione);
	        		return true;
	        	}
	        	else{
	        		echo("Error description: " . mysqli_error($this->connessione));
	        		mysqli_close($this->connessione);
	        		return false;
	        	}
	        }
	        mysqli_close($this->connessione);
        	echo("[no set tag to articolo] Error description: " . mysqli_error($this->connessione) . "</br>");
        	return false;
		}

		public function isAdmin($mail){
			$this->connessione = mysqli_connect(static::var_server, static::var_username, static::var_password, static::var_dbname);
			$result = mysqli_query($this->connessione,"SELECT * FROM admin_redatore WHERE mail = '$mail'");        		
	        $row = mysqli_fetch_array($result);
	        $num_rows = $result->num_rows;
	        mysqli_close($this->connessione);
	        if($num_rows == 1)
	        	return true;
	        else
	        	return false;
			
		}

		public function dropArticolo($mail, $titolo){
			$this->connessione = mysqli_connect(static::var_server, static::var_username, static::var_password, static::var_dbname);
			$result = mysqli_query($this->connessione,"DELETE FROM articolo WHERE mail = '$mail' and titolo = '$titolo'");
			mysqli_close($this->connessione);
	        if($result) 
	        	return true;
	        else
	        	return false;
		}

		public function getTagArticolo($mail,$titolo){
			$this->connessione = mysqli_connect(static::var_server, static::var_username, static::var_password, static::var_dbname);
			$result = mysqli_query($this->connessione,"SELECT * FROM articolo_tag WHERE mail = '$mail' AND titolo = '$titolo' AND nome != 'NA'");
	        $num_rows = $result->num_rows;
	        mysqli_close($this->connessione);
	        return $result;
		}
	}
?>