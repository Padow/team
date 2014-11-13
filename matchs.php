<?php 
  ob_start();
  session_name('IDSESSION');
  session_start();
  if ((!isset($_SESSION['logged'])) || (empty($_SESSION['logged'])))
  { 
    header ("location: login.php");
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
	<title>Matchs</title>
	<meta charset="utf-8" >
	<link rel="shortcut icon" href="style/favicon.ico" type="image/x-icon">
    <link rel="icon" href="style/favicon.ico" type="image/x-icon">
    <meta name="author" content="Padow" >
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
    <link rel="stylesheet" href="datepicker/css/datepicker3.css">
    
    <script src="datepicker/js/bootstrap-datepicker.js"></script>
    <?php 
        echo '<script src="datepicker/js/locales/bootstrap-datepicker.'.DATEPICKER_LANGUAGE.'.js" charset="UTF-8"></script>';
    ?>	
	<link rel="stylesheet" href="timepicker/css/bootstrap-timepicker.css">
	<script type="text/javascript"  src="timepicker/js/bootstrap-timepicker.js"></script>
	<link rel="stylesheet" href="style/index.css">
	<link rel="stylesheet" href="selectpicker/bootstrap-select.css">
	<script src="selectpicker/bootstrap-select.js"></script>
</head>
<body>
<div class="body">
  <?php  
  	require_once('php/pdo.class.php');
  	require_once('php/match.class.php');
  	require_once('php/links.class.php');
  	require_once('php/message.class.php');
    $messages = new Message();
    $page = $messages->nbpage();

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
          <li><a href="./"><span class="glyphicon glyphicon-list"></span> <?php echo MENU_DISPO; ?></a></li>
          <li class="active"><a href="matchs.php"><span class="glyphicon glyphicon-wrench"></span> <?php echo MENU_MATCHS; ?></a></li>
           <li class="dropdown">
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
		<div class="col-md-6">
			<fieldset><legend class="legendh2"><?php echo MATCHS_SET_LEGEND; ?></legend>
			<form method="post" role="form">
				<div class="form-group row">
					<div class="col-md-6"> 
						<label class="control-label"><?php echo MATCHS_DATE; ?></label>
						<div class="input-group date" id="dp3" data-date="" data-date-format="dd/mm/yyyy">
							<input class="form-control" type="text" name="date" required > 
							<span class="input-group-addon">
								<i class="glyphicon glyphicon-calendar"></i>
							</span> 
						</div> 
					</div> 
					<div class="col-md-6"> 
						<label class="control-label"><?php echo MATCHS_TIME; ?></label>
						 <div class="input-group time input-append bootstrap-timepicker">
				            <input id="timepicker1" type="text" class="test form-control" name="time" required >
				            <span class="input-group-addon add-on">
				            	<i class="glyphicon glyphicon-time"></i>
				            </span>
			        	</div> 
					</div> 
				</div>
				<div class="form-group row">
					<div class="col-md-6"> 
						<label class="control-label"><?php echo MATCHS_LEAGUE; ?></label>
						<select name="league" class="form-control selectpicker" required>
							<option></option>
							<?php 
								$matchObjet->getLeagueList();
								foreach ($matchObjet->getLeague() as  $value) {
									echo '<option>'.htmlspecialchars($value['name']).'</option>';
								}
							?>
						</select>
					</div> 
					<div class="col-md-6"> 
						<label class="control-label"><?php echo MATCHS_TEAM; ?></label>
						<input type="text" class="form-control" name="team" required>
					</div> 
				</div>
				<div class="form-group row">
					<div class="col-md-6"> 
						<label class="control-label"><?php echo MATCHS_MAP1; ?></label>
						<select name="map1" class="form-control selectpicker" required>
							<option></option>
							<?php  
								$matchObjet->getMapList();
								foreach ($matchObjet->getMap() as  $value) {
									echo '<option>'.htmlspecialchars($value['name']).'</option>';
								}
							?>
						</select>
					</div>  
					<div class="col-md-6"> 
						<label class="control-label"><?php echo MATCHS_MAP2; ?></label>
						<select name="map2" class="form-control selectpicker" required>
							<option></option>
							<?php  
								foreach ($matchObjet->getMap() as  $value) {
									echo '<option>'.htmlspecialchars($value['name']).'</option>';
								}
							?>
						</select>
					</div>  
				</div>
				<div class="form-group row">
					<div class="col-md-12"> 
						<button name="save" type="submit" class="btn btn-default btn-primary btn-lg btn-block"><?php echo MATCHS_SET_SUBMIT; ?> <span class="glyphicon glyphicon-save"></span></button>
					</div>  
				</div>
			</form>	
			<?php  
				if(isset($_POST['save'])){
					$error = "";
					if (!preg_match("/\S/", $_POST['date'])) {
                        $error .= '<ul>Veuillez sélectionner une date.</ul>';   
                    }
                    if (!preg_match("/\S/", $_POST['time'])) {
                        $error .= '<ul>Veuillez sélectionner une heure.</ul>';   
                    } 
                    if (!preg_match("/\S/", $_POST['league'])) {
                        $error .= '<ul>Veuillez sélectionner une league.</ul>';   
                    }
                    if (!preg_match("/\S/", $_POST['team'])) {
                        $error .= '<ul>Veuillez saisir une team.</ul>';   
                    }
                    if (!preg_match("/\S/", $_POST['map1'])) {
                        $error .= '<ul>Veuillez sélectionner une map.</ul>';   
                    }
                    if (!isset($error)) {
                    	$list = array('date'=>$_POST['date'], 'time'=>$_POST['time'], 'league'=>$_POST['league'], 'team'=>$_POST['team'], 'map1'=>$_POST['map1'], 'map2'=>$_POST['map2']);
					    $match = new Match();
					    $match->setMatch($list);
                    }
					
				}
			?>
		</fieldset>
		<?php if (isset($error)) { ?>
        <div class="alert alert-warning alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true" class="glyphicon glyphicon-remove"></span><span class="sr-only">Close</span></button>
          <p><strong>Attention !</strong><p>
          <p><?php echo $error; ?></p>
        </div>
        <?php } ?>
		</div>
		<div class="col-md-2">
			&nbsp;
		</div>
		<div class="col-md-4">
			<fieldset><legend class="legendh2"><?php echo MATCHS_UNSET_LEGEND; ?></legend>
			<form method="post" role="form">
				<div class="form-group row">
					<div class="col-md-8"> 
						<label class="control-label"><?php echo MATCHS_LIST; ?></label>
						<select name="matchdel" class="form-control selectpicker" required>
							<option></option>
							<?php  
								$matchObjet->getMatchList();
								if ($matchObjet->getMatch() != null) {
									foreach ($matchObjet->getMatch() as  $value) {
										echo '<option>'.$value['clee'].'</option>';
									}
								}
								
							?>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-md-8"> 
						<button name="delete" type="submit" class="btn btn-default btn-warning btn-lg btn-block"><?php echo MATCHS_UNSET_SUBMIT; ?> <span class="glyphicon glyphicon-trash"></span></button>
					</div>  
				</div>
			</form>
			<?php 
				if(isset($_POST['delete'])){
					$list = $_POST['matchdel'];
					$match = new Match();
					$match->DelMatch($list);
				}
			?>
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
    <script type="text/javascript">
        $('#timepicker1').timepicker({showMeridian: false, minuteStep: 5, defaultTime: false});
    </script>

	<script type="text/javascript">
    	$(".input-group.date").datepicker({ autoclose: true, todayHighlight: true, orientation: "top", isRTL: false, language: "<?php echo DATEPICKER_LANGUAGE ?>" });
    </script>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> -->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="style/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript">
		$('.selectpicker').selectpicker('render');
	</script>
</div>
    <div class="del"></div>
</body>
</html>
<?php ob_end_flush(); ?>