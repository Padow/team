<?php  
	class Setting extends Connexion{

		private $_connexion;
		private $_league;
		private $_map;

		public function __construct($connexion)
		{
			$this->_connexion = $connexion;
		}

		public function getLeagueList(){
			$sql = $this->_connexion->prepare("SELECT name FROM leagues");
			$sql-> execute();
			$rows = $sql->fetchAll(PDO::FETCH_ASSOC);
			$this->_league = $rows;
		}

		public function getLeagueName(){
			return $this->_league;
		}

		public function addLeague($name){
			if(!strstr($name, ";")){
				$sql = $this->_connexion->prepare("SELECT name FROM  leagues WHERE name = :name ");
				$sql-> bindParam('name', $name, PDO::PARAM_STR);
				$sql-> execute();
				$rows = $sql->fetchAll(PDO::FETCH_ASSOC);

				if(count($rows)!=0){
					echo '
								<div class="col-md-12">
									<div class="alert alert-warning alert-dismissable">
										  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
										  <strong>Attention! : </strong>'.ADD_LEAGUE_PRE.'<strong>'.htmlspecialchars($name).'</strong>'.ADD_LEAGUE_FAILURE_POST.'
									</div>
								</div>
							 ';
				}else{
					$sql = $this->_connexion->prepare("INSERT INTO  leagues (name) VALUES (:name) ");
					$sql-> bindParam('name', $name, PDO::PARAM_STR);
					$sql-> execute();
					echo '
								<div class="col-md-12">
									<div class="alert alert-success alert-dismissable">
										  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
										  <strong>Well done! : </strong>'.ADD_LEAGUE_PRE.'<strong>'.htmlspecialchars($name).'</strong>'.ADD_LEAGUE_POST.'
									</div>
								</div>
								<script type="text/javascript">
									setTimeout( function() 
			                        {
			                          window.location.href="setting.php";
			                        }, 3000);
								</script>
							 ';
				}
			}else{
				echo '
								<div class="col-md-12">
									<div class="alert alert-warning alert-dismissable">
										  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
										  <strong>Attention ! : </strong> Les caractères spéciaux sont interdis.
									</div>
								</div>
							 ';
			}		
		}

		public function deleteLeague($name){
			$sql = $this->_connexion->prepare("DELETE FROM leagues WHERE name = :name ");
			$sql-> bindParam('name', $name, PDO::PARAM_STR);
			$sql-> execute();
			echo '
							<script type="text/javascript">
		                          window.location.href="setting.php";
							</script>
						 ';
		}

		public function addMap($name){
			if(!strstr($name, ";")){
				$sql = $this->_connexion->prepare("SELECT name FROM maps WHERE name = :name ");
				$sql-> bindParam('name', $name, PDO::PARAM_STR);
				$sql-> execute();
				$rows = $sql->fetchAll(PDO::FETCH_ASSOC);

				if(count($rows)!=0){
					echo '
								<div class="col-md-12">
									<div class="alert alert-warning alert-dismissable">
										  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
										  <strong>Attention! : </strong>'.ADD_MAP_PRE.'<strong>'.htmlspecialchars($name).'</strong> '.ADD_MAP_FAILURE_POST.'
									</div>
								</div>
							 ';
				}else{
					$sql = $this->_connexion->prepare("INSERT INTO  maps (name) VALUES (:name) ");
					$sql-> bindParam('name', $name, PDO::PARAM_STR);
					$sql-> execute();
					echo '
								<div class="col-md-12">
									<div class="alert alert-success alert-dismissable">
										  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
										  <strong>Well done! : </strong>'.ADD_MAP_PRE.'<strong>'.htmlspecialchars($name).'</strong> '.ADD_MAP_POST.'
									</div>
								</div>
								<script type="text/javascript">
									setTimeout( function() 
			                        {
			                          window.location.href="setting.php";
			                        }, 3000);
								</script>
							 ';
				}
			}else{
				echo '
								<div class="col-md-12">
									<div class="alert alert-warning alert-dismissable">
										  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
										  <strong>Attention ! : </strong> '.ADD_PLAYER_SPECIAL_CHARS.'
									</div>
								</div>
							 ';
			}			
		}

		public function deleteMap($name){
			$sql = $this->_connexion->prepare("DELETE FROM maps WHERE name = :name ");
			$sql-> bindParam('name', $name, PDO::PARAM_STR);
			$sql-> execute();
			echo '
							<script type="text/javascript">
		                          window.location.href="setting.php";
							</script>
						 ';
		}

		public function setDefaultDispo($info){
			$name = $info['name'];
			$sql = $this->_connexion->prepare("UPDATE players SET Lun = :Lun, Mar = :Mar, Mer = :Mer, Jeu = :Jeu, Ven = :Ven, Sam = :Sam, Dim = :Dim WHERE name = :name");
			$sql-> bindParam('name', $info['name'], PDO::PARAM_STR);
			$sql-> bindParam('Lun', $info['Lun'], PDO::PARAM_STR);
			$sql-> bindParam('Mar', $info['Mar'], PDO::PARAM_STR);
			$sql-> bindParam('Mer', $info['Mer'], PDO::PARAM_STR);
			$sql-> bindParam('Jeu', $info['Jeu'], PDO::PARAM_STR);
			$sql-> bindParam('Ven', $info['Ven'], PDO::PARAM_STR);
			$sql-> bindParam('Sam', $info['Sam'], PDO::PARAM_STR);
			$sql-> bindParam('Dim', $info['Dim'], PDO::PARAM_STR);
			$sql-> execute();
			echo '
							<div class="col-md-12">
								<div class="alert alert-success alert-dismissable">
									  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									  <strong>Well done! : </strong>'.DEFAULT_DISPO_SUCCESS.'
								</div>
							</div>
							<script type="text/javascript">
								setTimeout( function() 
		                        {
		                          window.location.href="player_setting.php";
		                        }, 3000);
							</script>
						 ';
		}

		public function updateClasse($name, $classe){
			$sql = $this->_connexion->prepare("UPDATE players SET classe = :classe WHERE name = :name");
			$sql-> bindParam('classe', $classe, PDO::PARAM_STR);
			$sql-> bindParam('name', $name, PDO::PARAM_STR);
			$sql-> execute();
			echo '
							<div class="col-md-12">
								<div class="alert alert-success alert-dismissable">
									  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									  <strong>Well done! : </strong> '.CLASS_UPDATE_SUCCESS.'
								</div>
							</div>
							<script type="text/javascript">
								setTimeout( function() 
		                        {
		                          window.location.href="player_setting.php";
		                        }, 3000);
							</script>
						 ';
		}

	}
