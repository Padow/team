<?php	
		define("PRE","EzG");
		define("POST","Gaming");
 
		class Secure {
		 
			  /**
			   * Hash un mot de passe.
			   * @param Mot de passe en clair.
			   * @return Mot de passe hashé.
			   */
			public static function hash($password){
				return hash("whirlpool", PRE . $password . POST);
			}
		 
		}
?>