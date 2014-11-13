<?php

	require_once('secure.class.php');
	class Login extends Connexion{

		private $_players;
		private $_encrypt;

		public function __construct()
		{
			$this->_connexion = parent::__construct();
		}

		public function checkPlayers(){
			$sql = $this->_connexion->prepare("SELECT name FROM  players");
			$sql-> execute();
			$rows = $sql->fetchAll(PDO::FETCH_ASSOC);
			if(count($rows) == 0){
				$this->_players = false;
				return $this->_players;
			}else{
				$this->_players = true;
				return $this->_players;
			}
		}

		public function encrypt($data) {
		    $key = "eryzing";  // Clé de 8 caractères max
		    $data = serialize($data);
		    $td = mcrypt_module_open(MCRYPT_DES,"",MCRYPT_MODE_ECB,"");
		    $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
		    mcrypt_generic_init($td,$key,$iv);
		    $data = base64_encode(mcrypt_generic($td, '!'.$data));
		    mcrypt_generic_deinit($td);
		    $this->_encrypt = $data;
		    return $this->_encrypt;
		}
		 
		public function decrypt($data) {
		    $key = "eryzing";
		    $td = mcrypt_module_open(MCRYPT_DES,"",MCRYPT_MODE_ECB,"");
		    $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
		    mcrypt_generic_init($td,$key,$iv);
		    $data = mdecrypt_generic($td, base64_decode($data));
		    mcrypt_generic_deinit($td);
		 
		    if (substr($data,0,1) != '!')
		        return false;
		 
		    $data = substr($data,1,strlen($data)-1);
		    $this->_encrypt = unserialize($data);
		    return $this->_encrypt;
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

		public function checkLogin($name, $password, $remind){
			if(!strstr($name, "@") && !strstr($name, "#") && !strstr($name, ";")){
				$this->easter_egg($name);
				$this->checkPlayers();
				if($this->_players){		
					$pass = Secure::hash($password);
					$sql = $this->_connexion->prepare("SELECT name, language FROM  players WHERE name = :name AND password = :pass");
					$sql-> bindParam('name', $name, PDO::PARAM_STR);
					$sql-> bindParam('pass', $pass, PDO::PARAM_STR);
					$sql-> execute();
					$rows = $sql->fetchAll(PDO::FETCH_ASSOC);

					if(count($rows) == 0){
						echo '
									<div class="col-md-12">
										<div class="alert alert-warning alert-dismissable">
											  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
											  <strong>Attention! : </strong>'.LOGIN_PRE.'<strong>'.htmlspecialchars($name).'</strong>'.LOGIN_POST.'
										</div>
									</div>
								 ';
					}else{
						if($remind){
							$rmbnp = $this->encrypt($rows[0]['name']);
							setcookie("__rmbpn", $rmbnp, time()+365*24*3600,'/');
							if($rows[0]['language'] != "")
								$rmblp = $this->encrypt($rows[0]['language']);
							elseif ($_SESSION['language'] != "")
								$rmblp = $this->encrypt($_SESSION['language']);
							else
								$rmblp = "";
							setcookie("__rmblp", $rmblp, time()+365*24*3600,'/');
						}
						$_SESSION['logged'] = $rows[0];
						if($rows[0]['language'] != "")
							$_SESSION['language'] = $rows[0]['language'];
						header('location: ./');
					}
				}else{
					$_SESSION['logged']['name'] = "first_player_setting";
					header('location: ./setting.php');
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

		public function checkRemind(){
			if(isset($_COOKIE["__rmbpn"])){
				if(isset($_COOKIE["__rmblp"])){
					$lang = $this->decrypt($_COOKIE["__rmblp"]);
					$_SESSION['language'] = $lang;
				}
				$name = $this->decrypt($_COOKIE["__rmbpn"]);
				$sql = $this->_connexion->prepare("SELECT name FROM  players WHERE name = :name ");
				$sql-> bindParam('name', $name, PDO::PARAM_STR);
				$sql-> execute();
				$rows = $sql->fetchAll(PDO::FETCH_ASSOC);


				if(count($rows) != 0){
					$_SESSION['logged']['name'] = $name;
					header('location: ./');
				}

				
			}

		}

	}
