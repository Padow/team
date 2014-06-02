<?php 
  ob_start();
  session_name('IDSESSION');
  session_start();
  if ((!isset($_SESSION['logged'])) || (empty($_SESSION['logged'])))
  { 
    header ("location: login.php");
  }
  if ($_SESSION['logged']['name'] == "first_player_setting") {
  	header ("location: setting.php");
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
  	require_once('php/player.class.php');
  	require_once('php/match.class.php');
  	require_once('php/setting.class.php');
  	require_once('php/links.class.php');
  	require_once('php/gamemode.class.php');
  	require_once('php/message.class.php');
    $messages = new Message();
    $page = $messages->nbpage();

	$playerObjet = new Players();
	$settingObjet = new Setting();
	$matchObjet = new Match();
	$gamemode = new Game_mode();
	$gm = $gamemode->getmode();
	
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
        <li><a href="setting.php"><span class="glyphicon glyphicon-cog"></span> Settings</a></li>
        <li class="active"><a href="player_setting.php"><span class="glyphicon glyphicon-cog"></span> Player</a></li>
        <li><a href="message_board.php?page=<?php echo $page; ?>"><span class="glyphicon glyphicon-comment"></span> Message Board <?php $messages->newMessage($_SESSION['logged']['name']); ?></a></li>
       	<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="container">
	<?php  
			if(isset($_POST['programmer'])){
				$info = array('name'=>$_SESSION['logged']['name'], 'Lun'=>$_POST['Lun'], 'Mar'=>$_POST['Mar'], 'Mer'=>$_POST['Mer'], 'Jeu'=>$_POST['Jeu'], 'Ven'=>$_POST['Ven'], 'Sam'=>$_POST['Sam'], 'Dim'=>$_POST['Dim']);
				$settingObjet->setDefaultDispo($info);
			}
			if(isset($_POST['valider'])){
				$settingObjet->updateClasse($_SESSION['logged']['name'], $_POST['playerclasse']);
			}
			if(isset($_POST['changepw'])){
				$playerObjet->changePassword($_SESSION['logged']['name'], $_POST['pass2']);
			}

			if(isset($_POST['setavatar'])){
				$playerObjet->setAvatar($_SESSION['logged']['name'], $_FILES['avatar']);
			}


		?>
	<div class="col-md-4">
		<fieldset><legend class="legendh2">Dispo par défaut</legend>
		<form method="post" role="form">
			<div class="form-group row">
				<div class="col-md-12">
					<div id="lundi-group" class="btn-group col-md-12" data-toggle="buttons">
						<div class="col-md-12"><span class="strong">Lundi</span></div>
						<div class="control-label">
						    <label class="btn btn-success spacebt">
						      <input type="radio" name="Lun" value="oui"> Oui
						    </label>
						    <label class="btn btn-danger spacebt">
						      <input type="radio" name="Lun" value="non"> Non
						    </label>
						    <label class="btn btn-info spacebt">
						      <input type="radio" name="Lun" value="idk"> Idk
						    </label>
						    <label class="btn btn-default spacebt">
						      <input type="radio" name="Lun" value="" checked> Vide
						    </label>
						</div>
					</div>
					<div id="mardi-group" class="btn-group col-md-12" data-toggle="buttons">
						<div class="col-md-12">Mardi</div>
						<div class="control-label">
						    <label class="btn btn-success spacebt">
						      <input type="radio" name="Mar" value="oui"> Oui
						    </label>
						    <label class="btn btn-danger spacebt">
						      <input type="radio" name="Mar" value="non"> Non
						    </label>
						    <label class="btn btn-info spacebt">
						      <input type="radio" name="Mar" value="idk"> Idk
						    </label>
						    <label class="btn btn-default spacebt">
						      <input type="radio" name="Mar" value="" checked> Vide
						    </label>
						</div>
					</div>
					<div id="mercredi-group" class="btn-group col-md-12" data-toggle="buttons">
						<div class="col-md-12">Mercredi</div>
						<div class="control-label">
						    <label class="btn btn-success spacebt">
						      <input type="radio" name="Mer" value="oui"> Oui
						    </label>
						    <label class="btn btn-danger spacebt">
						      <input type="radio" name="Mer" value="non"> Non
						    </label>
						    <label class="btn btn-info spacebt">
						      <input type="radio" name="Mer" value="idk"> Idk
						    </label>
						    <label class="btn btn-default spacebt">
						      <input type="radio" name="Mer" value="" checked> Vide
						    </label>
						</div>
					</div>
					<div id="jeudi-group" class="btn-group col-md-12" data-toggle="buttons">
						<div class="col-md-12">Jeudi</div>
						<div class="control-label">
						    <label class="btn btn-success spacebt">
						      <input type="radio" name="Jeu" value="oui"> Oui
						    </label>
						    <label class="btn btn-danger spacebt">
						      <input type="radio" name="Jeu" value="non"> Non
						    </label>
						    <label class="btn btn-info spacebt">
						      <input type="radio" name="Jeu" value="idk"> Idk
						    </label>
						    <label class="btn btn-default spacebt">
						      <input type="radio" name="Jeu" value="" checked> Vide
						    </label>
						</div>
					</div>
					<div id="vendredi-group" class="btn-group col-md-12" data-toggle="buttons">
						<div class="col-md-12">Vendredi</div>
						<div class="control-label">
						    <label class="btn btn-success spacebt">
						      <input type="radio" name="Ven" value="oui"> Oui
						    </label>
						    <label class="btn btn-danger spacebt">
						      <input type="radio" name="Ven" value="non"> Non
						    </label>
						    <label class="btn btn-info spacebt">
						      <input type="radio" name="Ven" value="idk"> Idk
						    </label>
						    <label class="btn btn-default spacebt">
						      <input type="radio" name="Ven" value="" checked> Vide
						    </label>
						</div>
					</div>
					<div id="samedi-group" class="btn-group col-md-12" data-toggle="buttons">
						<div class="col-md-12">Samedi</div>
						<div class="control-label">
						    <label class="btn btn-success spacebt">
						      <input type="radio" name="Sam" value="oui"> Oui
						    </label>
						    <label class="btn btn-danger spacebt">
						      <input type="radio" name="Sam" value="non"> Non
						    </label>
						    <label class="btn btn-info spacebt">
						      <input type="radio" name="Sam" value="idk"> Idk
						    </label>
						    <label class="btn btn-default spacebt">
						      <input type="radio" name="Sam" value="" checked> Vide
						    </label>
						</div>
					</div>
					<div id="dimanche-group" class="btn-group col-md-12" data-toggle="buttons">
						<div class="col-md-12">Dimanche</div>
						<div class="control-label">
						    <label class="btn btn-success spacebt">
						      <input type="radio" name="Dim" value="oui"> Oui
						    </label>
						    <label class="btn btn-danger spacebt">
						      <input type="radio" name="Dim" value="non"> Non
						    </label>
						    <label class="btn btn-info spacebt">
						      <input type="radio" name="Dim" value="idk"> Idk
						    </label>
						    <label class="btn btn-default spacebt">
						      <input type="radio" name="Dim" value="" checked> Vide
						    </label>
						</div>
					</div>				
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-12"> 
					<button name="programmer" type="submit" class="btn btn-default btn-primary btn-lg btn-block">Programmer <span class="glyphicon glyphicon-save"></span></button>
				</div>  
			</div>
		</form>
	</fieldset>
	</div>
	<div class="col-md-2">
		&nbsp;
	</div>
	<div class="col-md-5">
		<fieldset><legend class="legendh2">Classe</legend>
		<form method="post" role="form">
			<div class="form-group row">
				<div class="col-md-12">
					<div id="playerclasse" class="btn-group col-md-12" data-toggle="buttons">
						<div class="classe_icon_group">
						    <?php 
						    	if($gm == "9v9")
						    		$gamemode->classe9v9();
						    	else
						    		$gamemode->classe6v6();
						     ?>
						</div>
					</div>
				</div>
			</div>	
			<div class="form-group row">
				<div class="col-md-12"> 
					<button name="valider" type="submit" class="btn btn-default btn-primary btn-lg btn-block">Valider <span class="glyphicon glyphicon-ok"></span></button>
				</div>  
			</div> 
		</form>
		</fieldset>
	</div>
	<div class="col-md-2">
		&nbsp;
	</div>
	<div class="col-md-5 padd">
		<fieldset><legend class="legendh2">Changer mot de passe</legend>
		<form method="post" role="form" name="changepassword">
			<div class="form-group row">
				<div class="col-md-12">	
					<label class="control-label">Nouveau mot de passe</label>
					<input onKeyup="newpassword();" type="password" class="form-control" name="pass1" id="pass1" required>
					<label class="control-label">Confirmez mot de passe</label>
					<div class="input-group">
						<input type="password" onKeyup="passwordCheck()" class="form-control" name="pass2" id="pass2" required disabled><span class="input-group-addon"><img class="check_icon" id="chkimg" src="style/images/default.png" alt=""></span>
					</div>
				</div>
			</div>	
			<div class="form-group row">
				<div class="col-md-12"> 
					<button name="changepw" id="changepw" type="submit" class="btn btn-default btn-primary btn-lg btn-block" disabled >Changer <span class="glyphicon glyphicon-ok"></span></button>
				</div>  
			</div> 
		</form>
		</fieldset>
	</div>	
	<div class="col-md-2">
		&nbsp;
	</div>
	<div class="col-md-5">
		<fieldset><legend class="legendh2">Avatar</legend>
		<form method="post" role="form" name="changeavatar" enctype="multipart/form-data">
			<div class="form-group row">
				<div class="col-md-12">	
					<input name="avatar" type="file" class="btn-default" accept="image/*" title="Parcourir">
				</div>
			</div>	
			<div class="form-group row">
				<div class="col-md-12"> 
					<button name="setavatar" type="submit" class="btn btn-default btn-primary btn-lg btn-block" >Valider <span class="glyphicon glyphicon-ok"></span></button>
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
    <script src="jquery/bootstrapfileinput.js"></script>
    <script type="text/javascript">
    	$('input[type=file]').bootstrapFileInput();
		$('.file-inputs').bootstrapFileInput()
    </script>
    <div class="del"></div>
</body>
</html>
<?php ob_end_flush(); ?>