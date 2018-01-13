<?php
	require_once('pdo.class.php');
	require_once('dispo.class.php');
	$key = $_GET['key'];
	$connexion = new Connexion();
	$dispoObjet = new Dispo($connexion::getInstance());
	$dispoObjet->setDispo($key);
?>