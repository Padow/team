<?php 
	session_name('IDSESSION');
	session_start();
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
  	<title>Dispo team</title>
    <link rel="shortcut icon" href="style/favicon.ico" type="image/x-icon">
    <link rel="icon" href="style/favicon.ico" type="image/x-icon">
    <meta name="author" content="Padow" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="style/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="style/index.css">
    <script src="jquery/jquery.js"></script>
    <script src="jquery/index.js"></script>
  </head>
<body>
  <?php  
  	require_once('php/pdo.class.php');
  	require_once('php/week.class.php');
  	require_once('php/player.class.php');
  	require_once('php/dispo.class.php');
    require_once('php/match.class.php');
    require_once('php/login.class.php');
    require_once('php/links.class.php');

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
            <li class=""><a href="./"><span class="glyphicon glyphicon-list"></span> Dispo</a></li>
            <li class=""><a href="matchs.php"><span class="glyphicon glyphicon-wrench"></span> Matchs</a></li>
            <li><a href="setting.php"><span class="glyphicon glyphicon-cog"></span> Settings</a></li>
            <li><a href="player_setting.php"><span class="glyphicon glyphicon-cog"></span> Player</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>

    <div class="container">
    <?php 
      $login = new Login();
      $login->checkRemind();
    	if(isset($_POST['login'])){	
    		
        if(isset($_POST["checkboxe"])){
          $remember = true;
        }else{
          $remember = false;
        }
    		$login->checkLogin($_POST['pseudo'], $_POST['password'], $remember);		
    	}
    ?>
    <div class="col-md-4">
    	<fieldset><legend class="legendh2">login</legend>
    		<form method="post" role="form">
    			<div class="form-group row">
    				<div class="col-md-12 padd"> 
    					<input type="text" class="form-control" pattern="^((?![#@;]).)*$" title="Caractères interdis: #@;" maxlength="20" placeholder="Pseudo" name="pseudo" autofocus required>
              <div class="padd">
                <input type="password" name="password" class="form-control" placeholder="password" data-toggle="tooltip" title="Password par defaut = pseudo, /!\ sensible à la casse" required>
              </div>
              
              <label class="checkbox-inline log2" for="checkboxes-0">
                <input id="checkboxes-0" type="checkbox" name="checkboxe">
              </label>
              <label class="control-label log">
               <span class="chkbx" onClick="check()">Toujours connecté</span>
              </label>
      			</div>
    			</div>
    			<div class="form row">
    				<div class="col-md-12"> 
    					<button name="login" type="submit" class="btn btn-default btn-primary btn-lg btn-block">login <span class="glyphicon glyphicon-log-in"></span></button>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="style/bootstrap/js/bootstrap.min.js"></script>
    <div class="del"></div>
  </body>
</html>