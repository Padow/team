<?php  
	require_once('pdo.class.php');
	require_once('historic.class.php');
	$etf2lkey = urldecode($_GET['key']);
	$historic = new Historic();
	$historic->deletefromhistoric($etf2lkey);
?>
