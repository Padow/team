<?php 
  session_name('IDSESSION');
  session_start();
  if ((!isset($_SESSION['logged'])) || (empty($_SESSION['logged'])))
  { 
    header ("location: login.php");
  }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Settings</title>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="style/favicon.ico" type="image/x-icon">
    <link rel="icon" href="style/favicon.ico" type="image/x-icon">
    <meta name="author" content="Padow" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <link href="style/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
   
    
    <script src="jquery/jquery.js"></script>
    <script type="text/javascript" src="jquery/index.js"></script>
    <link rel="stylesheet" href="style/index.css">
</head>
<body>  
<?php  
  	require_once('php/pdo.class.php');
  	require_once('php/week.class.php');
  	require_once('php/player.class.php');
  	require_once('php/dispo.class.php');
  	require_once('php/match.class.php');
  	require_once('php/setting.class.php');
  	require_once('php/links.class.php');

	$playerObjet = new Players();
	$settingObjet = new Setting();
	$matchObjet = new Match();
	
?>
<div class="wrap">
  <div class="content">
<nav class="navbar navbar-inverse" role="navigation">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="./"><span class="glyphicon glyphicon-home"></span></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="./"><span class="glyphicon glyphicon-list"></span> Dispo</a></li>
        <li><a href="matchs.php"><span class="glyphicon glyphicon-wrench"></span> Matchs</a></li>
        <li class="active"><a href="setting.php"><span class="glyphicon glyphicon-cog"></span> Settings</a></li>
        <li><a href="player_setting.php"><span class="glyphicon glyphicon-cog"></span> Player</a></li>
       	<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="container">
	<?php  
			if(isset($_POST['addplayer'])){
				$playerObjet->addPlayer($_POST['pseudo']);
			}

			if(isset($_POST['deleteplayer'])){
				$playerObjet->deletePlayer($_POST['playerdel']);
			}

			if(isset($_POST['addleague'])){
				$settingObjet->addLeague($_POST['league']);
			}

			if(isset($_POST['deleteleague'])){
				$settingObjet->deleteLeague($_POST['listleague']);
			}

			if(isset($_POST['addmap'])){
				$settingObjet->addMap($_POST['map']);
			}

			if(isset($_POST['deletemap'])){
				$settingObjet->deleteMap($_POST['listmap']);
			}
	?>
	<div class="col-md-4">
		<fieldset><legend class="legendh2">Ajouter Joueur</legend>
		<form method="post" role="form">
			<div class="form-group row">
				<div class="col-md-12"> 
					<label class="control-label">Pseudo</label>
					<span class="glyphicon glyphicon-info-sign tool" data-toggle="tooltip" data-placement="right" title="Password = Pseudo"></span>
					<input type="text" class="form-control"  maxlength="25" name="pseudo" pattern="^((?![#@;]).)*$" title="Caractères interdis: #@;" required>
				</div> 
			</div>
			<div class="form-group row">
				<div class="col-md-12"> 
					<button name="addplayer" type="submit" class="btn btn-default btn-primary btn-lg btn-block">Ajouter <span class="glyphicon glyphicon-save"></span></button>
				</div>  
			</div>
		</form>	
		</fieldset>
	</div>
	<div class="col-md-4">
		<fieldset><legend class="legendh2">Supprimer Joueur</legend>
		<form method="post" role="form">
			<div class="form-group row">
				<div class="col-md-12"> 
					<label class="control-label">Player list</label>
					<select name="playerdel" class="form-control" required>
						<option></option>
						<?php  
							$playerObjet->getPlayerList();
							foreach ($playerObjet->getPlayersname() as  $name) {
								echo '<option>'.htmlspecialchars($name['name']).'</option>';
							}
						?>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-12"> 
					<button name="deleteplayer" type="submit" class="btn btn-default btn-warning btn-lg btn-block">Delete <span class="glyphicon glyphicon-trash"></span></button>
				</div>  
			</div>
		</form>
		</fieldset>	
	</div>
	<div class="col-md-4">
		<fieldset><legend class="legendh2">Ajouter league</legend>
		<form method="post" role="form">
			<div class="form-group row">
				<div class="col-md-12"> 
					<label class="control-label">League</label>
					<input type="text" class="form-control" name="league" pattern="^((?![#@;]).)*$" title="Caractères interdis: #@;" required>
				</div> 
			</div>
			<div class="form-group row">
				<div class="col-md-12"> 
					<button name="addleague" type="submit" class="btn btn-default btn-primary btn-lg btn-block">Ajouter <span class="glyphicon glyphicon-save"></span></button>
				</div>  
			</div>
		</form>
		</fieldset>	
	</div>
	<div class="col-md-4">
		<fieldset><legend class="legendh2">Supprimer league</legend>
		<form method="post" role="form">
			<div class="form-group row">
				<div class="col-md-12"> 
					<label class="control-label">League list</label>
					<select name="listleague" class="form-control" required>
						<option></option>
						<?php  
							$settingObjet->getLeagueList();
							foreach ($settingObjet->getLeagueName() as  $leagename) {
								echo '<option>'.htmlspecialchars($leagename['name']).'</option>';
							}
						?>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-12"> 
					<button name="deleteleague" type="submit" class="btn btn-default btn-warning btn-lg btn-block">Delete <span class="glyphicon glyphicon-trash"></span></button>
				</div>  
			</div>
		</form>
		</fieldset>
	</div>
	<div class="col-md-4">
		<fieldset><legend class="legendh2">Ajouter map</legend>
		<form method="post" role="form">
			<div class="form-group row">
				<div class="col-md-12"> 
					<label class="control-label">Map</label>
					<input type="text" class="form-control" name="map" pattern="^((?![#@;]).)*$" title="Caractères interdis: #@;" required>
				</div> 
			</div>
			<div class="form-group row">
				<div class="col-md-12"> 
					<button name="addmap" type="submit" class="btn btn-default btn-primary btn-lg btn-block">Ajouter <span class="glyphicon glyphicon-save"></span></button>
				</div>  
			</div>
		</form>	
		</fieldset>
	</div>
	<div class="col-md-4">
		<fieldset><legend class="legendh2">Supprimer map</legend>
		<form method="post" role="form">
			<div class="form-group row">
				<div class="col-md-12"> 
					<label class="control-label">Map list</label>
					<select name="listmap" class="form-control" required>
						<option></option>
						<?php  
							$matchObjet->getMapList();
							foreach ($matchObjet->getMap() as  $value) {
								echo '<option>'.htmlspecialchars($value['name']).'</option>';
							}
						?>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-12"> 
					<button name="deletemap" type="submit" class="btn btn-default btn-warning btn-lg btn-block">Delete <span class="glyphicon glyphicon-trash"></span></button>
				</div>  
			</div>
		</form>
	</fieldset>
	</div>
</div>
</div>
  <div class="bottompage">
    <div class="container">
      <div class="col-md-12 padd">
        <div class="col-md-8">  
        <?php  
          $links = new Links();
        ?> 
        </div>
        <div class="col-md-4 pull-right">
          © 2014 <a href="http://steamcommunity.com/id/padow/" target="_blank">Padow</a>. All rights reserved.
        </div>
      </div>
    </div>
  </div>
</div>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> -->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="style/bootstrap/js/bootstrap.min.js"></script>
	<script>
		$(document).ready(function(){
			$('span').tooltip();
		});
	</script>
    <div class="del"></div>
</body>
</html>