<?php  
	require_once('pdo.class.php');
	require_once('historic.class.php');
	$connexion = new Connexion();
	$etf2lkey = urldecode($_GET['key']);
	$historic = new Historic($connexion->getConnexion());
	$historic->deletefromhistoric($etf2lkey);
?>
