<?php
	require_once('pdo.class.php');
	require_once('player.class.php');
	$name = urldecode($_GET['key']);
	$connexion = new Connexion();
	$p = new Players($connexion::getInstance());
	$return_arr["status"] = ($p->isPlayerExist($name))?"success":"fail";
    echo json_encode($return_arr);
    exit();
?>
