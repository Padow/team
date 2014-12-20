<?php 
  ob_start();
	session_name('IDSESSION');
	session_start();
  if ((!isset($_SESSION['language'])) || (empty($_SESSION['language']))){
    require_once('language/default.php');
  }else{
    require_once('language/'.$_SESSION['language'].'.php');
  }
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
<div class="body">
  <?php  
  	require_once('php/pdo.class.php');
    require_once('php/login.class.php');
    require_once('php/links.class.php');
    require_once('php/language.class.php');
    $connexion = new Connexion();
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
           <li class="dropdown">
           <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span> <?php echo MENU_OPTIONS; ?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="setting.php">&rsaquo; <?php echo MENU_COMMONS; ?></a></li>
              <li><a href="player_setting.php">&rsaquo; <?php echo MENU_PLAYER; ?></a></li>
            </ul>
          </li>
          <li><a href="message_board.php"><span class="glyphicon glyphicon-comment"></span> <?php echo MENU_MESSAGES; ?></a></li>
          <li class="dropdown">
           <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list-alt"></span> <?php echo MENU_HISTORIC; ?> <b class="caret"></b></a>
          <ul class="dropdown-menu">
              <li><a href="historic.php">&rsaquo; <?php echo MENU_ADD; ?></a></li>
              <li><a href="historic_view.php">&rsaquo; <?php echo MENU_VIEW; ?></a></li>
          </ul>
          </li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>

    <div class="container">
    <?php 
      $lang = new Language($connexion->getConnexion());

      $login = new Login($connexion->getConnexion());
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

      <div class="col-md-2 pull-right langue" >
        <div class="form-group row">
          <label class="control-label langueselect"><?php echo LOGIN_LANGUAGE; ?></label>
          <select  id="languagesetting" class="languagesetting" onChange="setlanguage(this.id);">
            <option></option>
            <?php $opt = $lang->getLanguage(); 
            foreach ($opt as $value) {
              echo $value;
            }
            ?>
          </select>
        </div>
      </div>
    
    <div class="col-md-4">
    	<fieldset><legend class="legendh2"><?php echo LOGIN_LEGEND; ?></legend>
    		<form method="post" role="form">
    			<div class="form-group row">
    				<div class="col-md-12 padd"> 
    					 <input type="text" class="form-control" pattern="^((?![#@;]).)*$" title="Caractères interdis: #@;" maxlength="20" placeholder="<?php echo LOGIN_PSEUDO; ?>" name="pseudo" autofocus required>
              <div class="padd">
                <input type="password" name="password" class="form-control" placeholder="<?php echo LOGIN_PASSWORD; ?>" data-toggle="tooltip" title="Password par defaut = pseudo, /!\ sensible à la casse" required>
              </div>
              
              <label class="checkbox-inline log2" for="checkboxes-0">
                <input id="checkboxes-0" type="checkbox" name="checkboxe">
              </label>
              <label class="control-label log">
               <span class="chkbx" onClick="check()"><?php echo LOGIN_REMEMBER; ?></span>
              </label>
      			</div>
    			</div>
    			<div class="form row">
    				<div class="col-md-12"> 
    					<button name="login" type="submit" class="btn btn-default btn-primary btn-lg btn-block"><?php echo LOGIN_SUBMIT; ?> <span class="glyphicon glyphicon-log-in"></span></button>
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
  </div>
    <div class="del"></div>
  </body>
</html>
<?php ob_end_flush(); ?>