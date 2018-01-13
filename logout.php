<?php  

session_name('IDSESSION');
session_start();
setcookie("__rmbpn", "", time()-3600,'/');
setcookie("__rmblp", "", time()-3600,'/');
$_SESSION = array();
session_destroy();
header('location: index.php');
?> 
