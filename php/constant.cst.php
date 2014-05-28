<?php
	$config = __DIR__."../../config/config.ini";
	if(@$ini_array = parse_ini_file($config)){
		define("CONFIG", $config);
		foreach ($ini_array as $key => $value) {
			if(strtoupper($key) == "DATABASELOCATION"){
				if(!$value){
					define("DBLOCALISATION", null);
				}else{
					define("DBLOCALISATION", $value);
				}	
			}
			if(strtoupper($key) == "DATABASENAME"){
				if(!$value){
					define("DBNAME", null);
				}else{
					define("DBNAME", $value);
				}	
			}
			if(strtoupper($key) == "DATABASEUSER"){
				if(!$value){

					define("DBUSER", null);
				}else{
					define("DBUSER", $value);
				}	
			}
			if(strtoupper($key) == "DATABASEPASSWORD"){
				if(!$value){

					define("DBPASSWORD", null);
				}else{
					define("DBPASSWORD", $value);
				}	
			}

		}
	}else{
		define("DBLOCALISATION", null);
		define("DBUSER", null);
		define("DBPASSWORD", null);
		define("DBNAME", null);
		define("CONFIG", "/config/config.ini");
	}
?>