<?php
	require_once('secure.class.php');
	class Players extends Connexion{
		private $_players;
		private $_classe;
		private $_connexion;
		private $_hashpass;

		public function __construct()
		{
			$this->_connexion = parent::__construct();
		}

		public function getPlayerList(){
			$sql = ("SELECT name, classe FROM players");
			$req = $this->_connexion-> query($sql);
			$rows = $req->fetchAll(PDO::FETCH_ASSOC);
			$this->_players = $rows;
		}

		public function getPlayerDispoList(){
			$sql = ("SELECT name, Lun, Mar, Mer, Jeu, Ven, Sam, Dim FROM players ORDER BY name");
			$req = $this->_connexion-> query($sql);
			$rows = $req->fetchAll(PDO::FETCH_ASSOC);
			$this->_players = $rows;

		}

		public function easter_egg($var){
			if (strtolower($var) == "ron") {
				header('location: http://noelswf.info/swf/3200.swf');
				die();
			}
			if(strtolower($var) == "eddy"){
				header('location: http://www.youtube.com/watch?v=zLBwxTpHuog');
				die();
			}
		}


		public function addPlayer($name){
			if(!strstr($name, "@") && !strstr($name, "#") && !strstr($name, ";")){
				$this->easter_egg($name);
				$sql = $this->_connexion->prepare("SELECT name FROM  players WHERE name = :name ");
				$sql-> bindParam('name', $name, PDO::PARAM_STR);
				$sql-> execute();
				$rows = $sql->fetchAll(PDO::FETCH_ASSOC);

				if(count($rows)!=0){
					echo '
								<div class="col-md-12">
									<div class="alert alert-warning alert-dismissable">
										  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
										  <strong>Attention! : </strong> Joueur <strong>'.htmlspecialchars($name).'</strong> existe déjà.
									</div>
								</div>
							 ';
				}else{
					$pass = Secure::hash($name);
					$sql = $this->_connexion->prepare("INSERT INTO  players (name, password) VALUES (:name, :password) ");
					$sql-> bindParam('name', $name, PDO::PARAM_STR);
					$sql-> bindParam('password', $pass, PDO::PARAM_STR);
					$sql-> execute();
					echo '
								<div class="col-md-12">
									<div class="alert alert-success alert-dismissable">
										  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
										  <strong>Well done! : </strong> Joueur <strong>'.htmlspecialchars($name).'</strong> ajouté.
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

		public function deletePlayer($name){
			$sql0 = $this->_connexion->prepare("DELETE FROM dispo WHERE pseudo = :name ");
			$sql0-> bindParam('name', $name, PDO::PARAM_STR);
			$sql = $this->_connexion->prepare("DELETE FROM players WHERE name = :name ");
			$sql-> bindParam('name', $name, PDO::PARAM_STR);
			$sql0-> execute();
			$sql-> execute();
			echo '
							<div class="col-md-12">
								<div class="alert alert-success alert-dismissable">
									  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									  <strong>Well done! : </strong> Joueur <strong>'.htmlspecialchars($name).'</strong> Supprimé.
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

		public function changePassword($name, $newpassword){
			$newpass = Secure::hash($newpassword);
			$sql = $this->_connexion->prepare("UPDATE players SET password = :newpass WHERE name = :name");
			$sql-> bindParam('name', $name, PDO::PARAM_STR);
			$sql-> bindParam('newpass', $newpass, PDO::PARAM_STR);
			$sql-> execute();
			echo '
							<div class="col-md-12">
								<div class="alert alert-success alert-dismissable">
									  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									  <strong>Well done! :</strong> Mot de passe changé avec succes.
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

		public function getPlayersname(){
			return $this->_players;
		}

		public function getPlayerclasse(){
			return $this->_classe;
		}

	}
?>