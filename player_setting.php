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
  if ((!isset($_SESSION['language'])) || (empty($_SESSION['language']))){
    require_once('language/default.php');
  }else{
    require_once('language/'.$_SESSION['language'].'.php');
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
	<link rel="stylesheet" href="selectpicker/bootstrap-select.css">
	<script src="selectpicker/bootstrap-select.js"></script>
</head>
<body>
<div class="body">  
<?php  
  	require_once('php/pdo.class.php');
  	require_once('php/player.class.php');
  	require_once('php/match.class.php');
  	require_once('php/setting.class.php');
  	require_once('php/links.class.php');
  	require_once('php/gamemode.class.php');
  	require_once('php/message.class.php');
  	require_once('php/language.class.php');
  	$connexion = new Connexion();
    $messages = new Message($connexion->getConnexion());
    $page = $messages->nbpage();

    $lang = new Language($connexion->getConnexion());
	$playerObjet = new Players($connexion->getConnexion());
	$settingObjet = new Setting($connexion->getConnexion());
	$matchObjet = new Match($connexion->getConnexion());
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
          <li><a href="./"><span class="glyphicon glyphicon-list"></span> <?php echo MENU_DISPO; ?></a></li>
          <li><a href="matchs.php"><span class="glyphicon glyphicon-wrench"></span> <?php echo MENU_MATCHS; ?></a></li>
           <li class="dropdown active">
           <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span> <?php echo MENU_OPTIONS; ?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="setting.php">&rsaquo; <?php echo MENU_COMMONS; ?></a></li>
              <li><a href="player_setting.php">&rsaquo; <?php echo MENU_PLAYER; ?></a></li>
            </ul>
          </li>
          <li><a href="message_board.php?page=<?php echo $page; ?>"><span class="glyphicon glyphicon-comment"></span> <?php echo MENU_MESSAGES; ?> <?php $messages->newMessage($_SESSION['logged']['name']); ?></a></li>
          <li class="dropdown">
           <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list-alt"></span> <?php echo MENU_HISTORIC; ?> <b class="caret"></b></a>
          <ul class="dropdown-menu">
              <li><a href="historic.php">&rsaquo; <?php echo MENU_ADD; ?></a></li>
              <li><a href="historic_view.php">&rsaquo; <?php echo MENU_VIEW; ?></a></li>
          </ul>
          </li>
          <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> <?php echo MENU_LOGOUT; ?></a></li>
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

			if(isset($_POST['setlangue'])){
				$_SESSION['language'] = $_POST['languesel'];
				$lang->setLanguage($_POST['languesel'], $_SESSION['logged']['name']);
			}


		?>
	<div class="col-md-4">
		<fieldset><legend class="legendh2"><?php echo PLAYER_DISPO_LEGEND; ?></legend>
		<form method="post" role="form">
			<div class="form-group row">
				<div class="col-md-12">
					<div id="lundi-group" class="btn-group col-md-12" data-toggle="buttons">
						<div class="col-md-12"><span class="strong"><?php echo PLAYER_MON; ?></span></div>
						<div class="control-label">
						    <label class="btn btn-success spacebt">
						      <input type="radio" name="Lun" value="oui"> <?php echo PLAYER_YES; ?>
						    </label>
						    <label class="btn btn-danger spacebt">
						      <input type="radio" name="Lun" value="non"> <?php echo PLAYER_NO; ?>
						    </label>
						    <label class="btn btn-info spacebt">
						      <input type="radio" name="Lun" value="idk"> <?php echo PLAYER_IDK; ?>
						    </label>
						    <label class="btn btn-default spacebt">
						      <input type="radio" name="Lun" value="" checked> <?php echo PLAYER_UNSET; ?>
						    </label>
						</div>
					</div>
					<div id="mardi-group" class="btn-group col-md-12" data-toggle="buttons">
						<div class="col-md-12"><?php echo PLAYER_TUE; ?></div>
						<div class="control-label">
						    <label class="btn btn-success spacebt">
						      <input type="radio" name="Mar" value="oui"> <?php echo PLAYER_YES; ?>
						    </label>
						    <label class="btn btn-danger spacebt">
						      <input type="radio" name="Mar" value="non"> <?php echo PLAYER_NO; ?>
						    </label>
						    <label class="btn btn-info spacebt">
						      <input type="radio" name="Mar" value="idk"> <?php echo PLAYER_IDK; ?>
						    </label>
						    <label class="btn btn-default spacebt">
						      <input type="radio" name="Mar" value="" checked> <?php echo PLAYER_UNSET; ?>
						    </label>
						</div>
					</div>
					<div id="mercredi-group" class="btn-group col-md-12" data-toggle="buttons">
						<div class="col-md-12"><?php echo PLAYER_WED; ?></div>
						<div class="control-label">
						    <label class="btn btn-success spacebt">
						      <input type="radio" name="Mer" value="oui"> <?php echo PLAYER_YES; ?>
						    </label>
						    <label class="btn btn-danger spacebt">
						      <input type="radio" name="Mer" value="non"> <?php echo PLAYER_NO; ?>
						    </label>
						    <label class="btn btn-info spacebt">
						      <input type="radio" name="Mer" value="idk"> <?php echo PLAYER_IDK; ?>
						    </label>
						    <label class="btn btn-default spacebt">
						      <input type="radio" name="Mer" value="" checked> <?php echo PLAYER_UNSET; ?>
						    </label>
						</div>
					</div>
					<div id="jeudi-group" class="btn-group col-md-12" data-toggle="buttons">
						<div class="col-md-12"><?php echo PLAYER_THU; ?></div>
						<div class="control-label">
						    <label class="btn btn-success spacebt">
						      <input type="radio" name="Jeu" value="oui"> <?php echo PLAYER_YES; ?>
						    </label>
						    <label class="btn btn-danger spacebt">
						      <input type="radio" name="Jeu" value="non"> <?php echo PLAYER_NO; ?>
						    </label>
						    <label class="btn btn-info spacebt">
						      <input type="radio" name="Jeu" value="idk"> <?php echo PLAYER_IDK; ?>
						    </label>
						    <label class="btn btn-default spacebt">
						      <input type="radio" name="Jeu" value="" checked> <?php echo PLAYER_UNSET; ?>
						    </label>
						</div>
					</div>
					<div id="vendredi-group" class="btn-group col-md-12" data-toggle="buttons">
						<div class="col-md-12"><?php echo PLAYER_FRI; ?></div>
						<div class="control-label">
						    <label class="btn btn-success spacebt">
						      <input type="radio" name="Ven" value="oui"> <?php echo PLAYER_YES; ?>
						    </label>
						    <label class="btn btn-danger spacebt">
						      <input type="radio" name="Ven" value="non"> <?php echo PLAYER_NO; ?>
						    </label>
						    <label class="btn btn-info spacebt">
						      <input type="radio" name="Ven" value="idk"> <?php echo PLAYER_IDK; ?>
						    </label>
						    <label class="btn btn-default spacebt">
						      <input type="radio" name="Ven" value="" checked> <?php echo PLAYER_UNSET; ?>
						    </label>
						</div>
					</div>
					<div id="samedi-group" class="btn-group col-md-12" data-toggle="buttons">
						<div class="col-md-12"><?php echo PLAYER_SAT; ?></div>
						<div class="control-label">
						    <label class="btn btn-success spacebt">
						      <input type="radio" name="Sam" value="oui"> <?php echo PLAYER_YES; ?>
						    </label>
						    <label class="btn btn-danger spacebt">
						      <input type="radio" name="Sam" value="non"> <?php echo PLAYER_NO; ?>
						    </label>
						    <label class="btn btn-info spacebt">
						      <input type="radio" name="Sam" value="idk"> <?php echo PLAYER_IDK; ?>
						    </label>
						    <label class="btn btn-default spacebt">
						      <input type="radio" name="Sam" value="" checked> <?php echo PLAYER_UNSET; ?>
						    </label>
						</div>
					</div>
					<div id="dimanche-group" class="btn-group col-md-12" data-toggle="buttons">
						<div class="col-md-12"><?php echo PLAYER_SUN; ?></div>
						<div class="control-label">
						    <label class="btn btn-success spacebt">
						      <input type="radio" name="Dim" value="oui"> <?php echo PLAYER_YES; ?>
						    </label>
						    <label class="btn btn-danger spacebt">
						      <input type="radio" name="Dim" value="non"> <?php echo PLAYER_NO; ?>
						    </label>
						    <label class="btn btn-info spacebt">
						      <input type="radio" name="Dim" value="idk"> <?php echo PLAYER_IDK; ?>
						    </label>
						    <label class="btn btn-default spacebt">
						      <input type="radio" name="Dim" value="" checked> <?php echo PLAYER_UNSET; ?>
						    </label>
						</div>
					</div>				
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-12"> 
					<button name="programmer" type="submit" class="btn btn-default btn-primary btn-lg btn-block"><?php echo PLAYER_DISPO_SUBMIT; ?> <span class="glyphicon glyphicon-save"></span></button>
				</div>  
			</div>
		</form>
	</fieldset>
	</div>
	<div class="col-md-2">
		&nbsp;
	</div>
	<div class="col-md-5">
		<fieldset><legend class="legendh2"><?php echo PLAYER_CLASS_LEGEND; ?></legend>
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
					<button name="valider" type="submit" class="btn btn-default btn-primary btn-lg btn-block"><?php echo PLAYER_CLASS_SUBMIT; ?> <span class="glyphicon glyphicon-ok"></span></button>
				</div>  
			</div> 
		</form>
		</fieldset>
	</div>
	<div class="col-md-2">
		&nbsp;
	</div>
	<div class="col-md-5 padd">
		<fieldset><legend class="legendh2"><?php echo PLAYER_PASSWORD_LEGEND; ?></legend>
		<form method="post" role="form" name="changepassword">
			<div class="form-group row">
				<div class="col-md-12">	
					<label class="control-label"><?php echo PLAYER_PASSWORD_NEW; ?></label>
					<input onKeyup="newpassword();" type="password" class="form-control" name="pass1" id="pass1" required>
					<label class="control-label"><?php echo PLAYER_PASSWORD_CONFIRM; ?></label>
					<div class="input-group">
						<input type="password" onKeyup="passwordCheck()" class="form-control" name="pass2" id="pass2" required disabled><span class="input-group-addon"><img class="check_icon" id="chkimg" src="style/images/default.png" alt=""></span>
					</div>
				</div>
			</div>	
			<div class="form-group row">
				<div class="col-md-12"> 
					<button name="changepw" id="changepw" type="submit" class="btn btn-default btn-primary btn-lg btn-block" disabled ><?php echo PLAYER_PASSWORD_SUBMIT; ?> <span class="glyphicon glyphicon-ok"></span></button>
				</div>  
			</div> 
		</form>
		</fieldset>
	</div>	
	<div class="col-md-2">
		&nbsp;
	</div>
	<div class="col-md-5">
		<fieldset><legend class="legendh2"><?php echo PLAYER_AVATAR_LEGEND; ?></legend>
		<form method="post" role="form" name="changeavatar" enctype="multipart/form-data">
			<div class="form-group row">
				<div class="col-md-12">	
					<input name="avatar" type="file" class="btn-default" accept="image/*" title="<?php echo PLAYER_AVATAR_BROWSE; ?>">
				</div>
			</div>	
			<div class="form-group row">
				<div class="col-md-12"> 
					<button name="setavatar" type="submit" class="btn btn-default btn-primary btn-lg btn-block" ><?php echo PLAYER_AVATAR_SUBMIT; ?> <span class="glyphicon glyphicon-ok"></span></button>
				</div>  
			</div> 
		</form>
		</fieldset>
	</div>
	<div class="col-md-5">
		<fieldset><legend class="legendh2"><?php echo PLAYER_LANGUAGE_LEGEND; ?></legend>
		<form method="post" role="form">
			<div class="form-group row">
				<div class="col-md-12">	
					<select name="languesel" class="form-control selectpicker" required>
						<option></option>
						<?php 
							$opt = $lang->getLanguage(); 
					         foreach ($opt as $value) {
					            echo $value;
					          }
						?>
					</select>
				</div>
			</div>	
			<div class="form-group row">
				<div class="col-md-12"> 
					<button name="setlangue" type="submit" class="btn btn-default btn-primary btn-lg btn-block" ><?php echo PLAYER_LANGUAGE_SUBMIT; ?> <span class="glyphicon glyphicon-ok"></span></button>
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
		$('.file-inputs').bootstrapFileInput();
		$('.selectpicker').selectpicker('render');
    </script>
</div>
    <div class="del"></div>
</body>
</html>
<?php ob_end_flush(); ?>