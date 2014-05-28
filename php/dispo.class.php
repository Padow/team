<?php  
	class Dispo extends Connexion{
		
		private $_dispo;
		private $_nbdispo;
		private $_listdispo;
		private $_date;
		private $_connexion; 
		private $_name;
		private $_disp;
		private $_clee;
		private $_lastclasse;

		public function __construct()
		{
			$this->_connexion  = parent::__construct();
			$date = date("Y-m-d");
			$sql = $this->_connexion->prepare("DELETE FROM dispo WHERE date < :date");
			$sql-> bindParam('date', $date, PDO::PARAM_STR);
			$sql-> execute();

			$sql2 = $this->_connexion->prepare("DELETE FROM matchs WHERE date < :date");
			$sql2-> bindParam('date', $date, PDO::PARAM_STR);
			$sql2-> execute();
		}

		public function getDispoList(){
			$sql = ("SELECT clee, dispo, date FROM dispo");
			$req = $this->_connexion-> query($sql);
			$rows = $req->fetchAll(PDO::FETCH_ASSOC);
			$this->_dispo = $rows;

		}

		public function getNbDispo($date){
			$oui = 'oui';
			$sql = $this->_connexion->prepare("SELECT pseudo FROM dispo WHERE date = :date AND dispo = :dispo");
			$sql-> bindParam('date', $date, PDO::PARAM_STR);
			$sql-> bindParam('dispo', $oui, PDO::PARAM_STR);
			$sql-> execute();
			$rows = $sql->fetchAll(PDO::FETCH_ASSOC);
			$this->_listdispo = $rows;
			$this->_nbdispo = count($rows);
		}

		public function getNumDispo(){
			return $this->_nbdispo;
		}

		public function getPseudo(){
			return $this->_listdispo;
		}

		/**
		*	getDate() retourne date formatée à partir de la clee
		*	@param String //Alab@29/03/2014#dispo
		*	@return String //2014-03-29
		*
		*/
		public function getDate($key){
			$date = explode('@', $key);
			$date = $date[1];
			$date = explode("#", $date);
			$date = $date[0];
			$date = explode('/', $date);
			$date = $date[2].'-'.$date[1].'-'.$date[0];
			$this->_date = $date;
			return $this->_date;
		}

		/**
		*	getName() retourne le pseudo à partir du paramètre
		*	@param String //Alab@29/03/2014#dispo
		*	@return String //Alab
		*
		*/
		public function getName($key){
			$name = explode("@", $key);
			$pseudo = $name[0];
			$this->_name = $pseudo;
			return $this->_name;
		}

		/**
		*	getDisp() retourne la dispo à partir du paramètre
		*	@param String //Alab@29/03/2014#dispo
		*	@return String //dispo
		*/
		public function getDisp($key){
			$dispc = explode("#", $key);
			$dispc = $dispc[1];
			$this->_disp = $dispc;
			return $this->_disp;
		}

		/**
		*	getClee() retourne la clee primaire BDD à partir du paramètre
		*	@param String //Alab@29/03/2014#dispo
		*	@return String //Alab@29/03/2014
		*/			
		public function getClee($key){
			$clee = explode("#", $key);
			$clee = $clee[0];
			$this->_clee = $clee;
			return $this->_clee;
		}

		public function setDispo($key){
			$clee = $this->getClee($key);
			$date = $this->getDate($key);
			$player = $this->getName($key);
			$disp = $this->getDisp($key);
			$sql = $this->_connexion->prepare("SELECT clee FROM dispo where clee = :key");
			$sql-> bindParam('key', $clee, PDO::PARAM_STR);
			$sql-> execute();

			$rows = $sql->fetchAll(PDO::FETCH_ASSOC);
			if(count($rows)==0)
			{
				$sql = $this->_connexion->prepare("INSERT INTO dispo(clee, dispo, date, pseudo) values(:key, :dispo, :date, :pseudo)");
				$sql-> bindParam('key', $clee, PDO::PARAM_STR);
				$sql-> bindParam('dispo', $disp, PDO::PARAM_STR);
				$sql-> bindParam('date', $date, PDO::PARAM_STR);
				$sql-> bindParam('pseudo', $player, PDO::PARAM_STR);
				$sql-> execute();
			}
			else
			{
				$sql = $this->_connexion->prepare("UPDATE dispo SET dispo = :dispo WHERE clee = :key");
				$sql-> bindParam('key', $clee, PDO::PARAM_STR);
				$sql-> bindParam('dispo', $disp, PDO::PARAM_STR);
				$sql-> execute();
			}
		}

		public function setDefaultDispo($defaultDispoInsert){
			foreach ($defaultDispoInsert as $key => $value) {
				$player = $this->getName($key);
				$date = $this->getDate($key);
				$sql = $this->_connexion->prepare("INSERT INTO dispo(clee, dispo, date, pseudo) values(:key, :dispo, :date, :pseudo)");
				$sql-> bindParam('key', $key, PDO::PARAM_STR);
				$sql-> bindParam('dispo', $value, PDO::PARAM_STR);
				$sql-> bindParam('date', $date, PDO::PARAM_STR);
				$sql-> bindParam('pseudo', $player, PDO::PARAM_STR);
				$sql-> execute();
			}
		}

		public function last6v6($array, $allPlayer){
			$dispclasse = array();
			foreach ($allPlayer as $value) {
				if(in_array($value['name'], $array)){
					$dispclasse[]=$value['classe'];
				}
			}
			$dispclasse = array_count_values($dispclasse);

			$neededclasse = Array();
			if(!isset($dispclasse['medic'])){
				$neededclasse[] = "medic";
			}

			if(!isset($dispclasse['demo'])){
					$neededclasse[] = "demo";
			}

			if(isset($dispclasse['soldier'])){
				if($dispclasse['soldier']<2){
					$neededclasse[] = "soldier";
				}
			}else{
				$neededclasse[] = "soldier";
				$neededclasse[] = "soldier";
			}

			if(isset($dispclasse['scout'])){
				if($dispclasse['scout']<2){
					$neededclasse[] = "scout";
				}
			}else{
				$neededclasse[] = "scout";
				$neededclasse[] = "scout";
			}
				
			$this->_lastclasse = $neededclasse;
			return $this->_lastclasse;
		}

		public function last9v9($array, $allPlayer){
			$dispclasse = array();
			foreach ($allPlayer as $value) {
				if(in_array($value['name'], $array)){
					$dispclasse[]=$value['classe'];
				}
			}
			$dispclasse = array_count_values($dispclasse);

			$neededclasse = Array();
			if(!isset($dispclasse['medic'])){
				$neededclasse[] = "medic";
			}

			if(!isset($dispclasse['demo'])){
					$neededclasse[] = "demo";
			}

			if(!isset($dispclasse['soldier'])){
					$neededclasse[] = "soldier";
			}

			if(!isset($dispclasse['scout'])){
					$neededclasse[] = "scout";
			}

			if(!isset($dispclasse['spy'])){
					$neededclasse[] = "spy";
			}

			if(!isset($dispclasse['pyro'])){
					$neededclasse[] = "pyro";
			}

			if(!isset($dispclasse['engineer'])){
					$neededclasse[] = "engineer";
			}

			if(!isset($dispclasse['sniper'])){
					$neededclasse[] = "sniper";
			}

			if(!isset($dispclasse['heavy'])){
					$neededclasse[] = "heavy";
			}
				
			$this->_lastclasse = $neededclasse;
			return $this->_lastclasse;
		}



		public function getDispo(){
			return $this->_dispo;
		}
				
	}
?>