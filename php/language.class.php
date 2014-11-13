<?php 

	class Language extends Connexion{
		private $_options;
		
		public function __construct()
		{
			$this->_connexion = parent::__construct();
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

		public function getLanguage(){
			$dir = __DIR__;

			$dir = substr($dir, 0, -3);
			$dir .= 'language';

			$ListIgnore = array ('.','..','default.php');

			$files = scandir($dir);
			foreach ($files as $value) {
				if (!in_array($value, $ListIgnore)) 
				{	
					$tmp = explode(".", $value);
					$avaible_language[] = $tmp[0];
				}
			}

			foreach ($avaible_language as  $value) {
				$option[] =  '<option>'.$value.'</option>';
			}

			$this->_options = $option;
			return $this->_options;
		}

		public function setLanguage($lang, $name){
			$sql = $this->_connexion->prepare("UPDATE players SET language = :language WHERE name = :name");
			$sql-> bindParam('name', $name, PDO::PARAM_STR);
			$sql-> bindParam('language', $lang, PDO::PARAM_STR);
			$sql-> execute();
			$lang_cookie = $this->encrypt($lang);
			setcookie("__rmblp", $lang_cookie, time()+365*24*3600,'/');
			echo '
					<script type="text/javascript">
                          window.location.href="player_setting.php";
					</script>
					';
		}
	}
