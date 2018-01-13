<?php 
 
	$key = $_GET['key'];
	session_name('IDSESSION');
	session_start();
	$_SESSION['language'] = $key;
?>