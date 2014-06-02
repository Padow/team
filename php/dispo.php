<?php
	require_once('pdo.class.php');
	require_once('dispo.class.php');
	$key = $_GET['key'];
	$dispoObjet = new Dispo();
	$dispoObjet->setDispo($key);
?>