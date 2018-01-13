<?php

$path = __DIR__;
$path = substr($path, 0, -3);
$path .= "config/mysql.json";
define("CONFIG", $path);
if (file_exists($path)) {
	$array = json_decode(file_get_contents($path));
	define("DBHOST", $array->{'mysql'}->{'host'});
	define("DBUSER", $array->{'mysql'}->{'user'});
	define("DBPASSWORD", $array->{'mysql'}->{'password'});
	define("DBNAME", $array->{'mysql'}->{'database'});
}
class Connexion{
	private static $_connexion;
	public static function getInstance(){
		if (self::$_connexion == null) {
			try	{
			    self::$_connexion = new PDO('mysql:host='.DBHOST.';dbname='.DBNAME.'', DBUSER, DBPASSWORD);
			}	catch(Exception $e)	{
				echo 'Erreur : '.$e->getMessage().'<br />';
				echo 'N° : '.$e->getCode();
				echo '<div class="alert alert-danger"><strong>Warning!</strong> Database is not configured please watch : "'.CONFIG.'"</div>';
				die();
			}
		}
		return self::$_connexion;
	}
}
