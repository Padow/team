<?php 
require_once('constant.cst.php');
class Connexion{
	private $_connexion;
	public function __construct(){
		try
		{
			
		    @$connexion = new PDO('mysql:host='.DBLOCALISATION.';dbname='.DBNAME.'', DBUSER, DBPASSWORD);
		    $this->_connexion = $connexion;
		}
		catch(Exception $e)
		{
			echo 'Erreur : '.$e->getMessage().'<br />';
			echo 'N° : '.$e->getCode();
			echo '<div class="alert alert-danger"><strong>Warning!</strong> Database is not configured please watch : "'.CONFIG.'"</div>';
			die();
		}
		return $this->_connexion;
	}
}	

?>