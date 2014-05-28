<?php
	require_once('pdo.class.php');
	require_once('dispo.class.php');
	$key = $_COOKIE['key'];
	$dispoObjet = new Dispo();
	$dispoObjet->setDispo($key);
	setcookie("key", "", time()-3600, "/");
?>
<script type="text/javascript">
	window.location.reload();
</script>
