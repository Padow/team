<?php 
	require_once('pdo.class.php');
	require_once('player.class.php');
	$name = urldecode($_GET['key']);
	$p = new Players();
	$return_arr["status"] = ($p->isPlayerExist($name))?"success":"fail";
    echo json_encode($return_arr);
    exit();
?>