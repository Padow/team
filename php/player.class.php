<?php
	require_once('secure.class.php');
	class Players{
		private $_players;
		private $_classe;
		private $_connexion;
		private $_hashpass;

		public function __construct($connexion){
			$this->_connexion = $connexion;
		}

		public function getPlayerList(){
			$sql = $this->_connexion->prepare("SELECT name, classe FROM players");
			$sql-> execute();
			$rows = $sql->fetchAll(PDO::FETCH_ASSOC);
			$this->_players = $rows;
		}

		public function isPlayerExist($name){
			$sql = $this->_connexion->prepare("SELECT name FROM players WHERE name = :name");
			$sql-> bindParam('name', $name, PDO::PARAM_STR);
			$sql-> execute();
			$rows = $sql->fetchAll(PDO::FETCH_ASSOC);
			return empty($rows);
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
										  <strong>Attention! : </strong>'.ADD_PLAYER_FAILURE_PRE.' <strong>'.htmlspecialchars($name).'</strong>'.ADD_PLAYER_FAILURE_POST.'
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
										  <strong>Well done! : </strong>'.ADD_PLAYER_SUCCESS_PRE.'<strong>'.htmlspecialchars($name).'</strong> '.ADD_PLAYER_SUCCESS_POST.'
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

		public function deletePlayer($name){
			$sql0 = $this->_connexion->prepare("DELETE FROM dispo WHERE pseudo = :name ");
			$sql0-> bindParam('name', $name, PDO::PARAM_STR);
			$sql = $this->_connexion->prepare("DELETE FROM players WHERE name = :name ");
			$sql-> bindParam('name', $name, PDO::PARAM_STR);
			$sql0-> execute();
			$sql-> execute();
			$dir = __DIR__;
			$dir = substr($dir, 0, -3);
			$dir .= "uploads/";
			if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
			    $arr = glob($dir.utf8_decode($name).".*");
			    if($arr){
			     	foreach ($arr as $avatar) {
			     		unlink($avatar);
			     	}
			    }
			}else{
			    $arr = glob($dir.$name.".*");
			    if($arr){
			     	foreach ($arr as $avatar) {
			     		unlink($avatar);
			     	}
			    }
			}
			echo '
							<script type="text/javascript">
		                        window.location.href="setting.php";
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
									  <strong>Well done! : </strong>'.CHANGE_PASSWORD_SUCCESS.'
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

		public function setAvatar($name, $file) {
	        /**
	         * Charger le fichier
	         */

	        $dir = __DIR__;
			$dir = substr($dir, 0, -3);
			$dir .= "uploads/";
	        $extensions = array('.png', '.gif', '.jpg', '.jpeg');
	        $maxsize  = 200000;
	        $filename = $file['tmp_name'];
	        $extension =  strtolower(strrchr($file['name'], '.'));
	        $size = $file['size'];

	        if (!file_exists($filename)) {
	            $error = FILE_NOT_FOUND;
	        }else{
	        	if(!in_array($extension, $extensions)){
			   	 	$error = SUPPORTED_EXTENTION;
				}
				if($size > $maxsize){
					$error = MAX_SIZE;//"Taille max : 100Ko ";
				}
	        }

			if(isset($error)){
				echo '
					<div class="col-md-12">
						<div class="alert alert-warning alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong>Attention! :</strong> '.$error.'
						</div>
					</div>';
			}else{
				if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
				    $fichier = utf8_decode($name.$extension);
				} else {
				   $fichier = $name.$extension;
				}

			     if(move_uploaded_file($filename, $dir.$fichier)){
			     	$arr = glob($dir.$name.".*");
			     	foreach ($arr as $avatar) {
			     		if($avatar != $dir.$fichier){
			     			unlink($avatar);
			     		}
			     	}

			     	echo '
					<div class="col-md-12">
						<div class="alert alert-success alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong>Well Done! :</strong> '.AVATAR_CHANGED.'
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

	    }


		public function getPlayersname(){
			return $this->_players;
		}

		public function getPlayerclasse(){
			return $this->_classe;
		}

	}
