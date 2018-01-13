<?php 
  ob_start();
  session_name('IDSESSION');
  session_start();
  if ((!isset($_SESSION['logged'])) || (empty($_SESSION['logged'])))
  { 
    header ("location: login");
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
	<title>Historic</title>
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
    <script src="datepicker/js/locales/bootstrap-datepicker.fr.js" charset="UTF-8"></script>
	
	<link rel="stylesheet" href="timepicker/css/bootstrap-timepicker.css">
	<script type="text/javascript"  src="timepicker/js/bootstrap-timepicker.js"></script>
	 <link rel="stylesheet" href="style/index.css">
</head>
<body>
<div class="body">
  <?php  
  	require_once('php/pdo.class.php');
  	require_once('php/match.class.php');
  	require_once('php/links.class.php');
  	require_once('php/historic.class.php');
  	require_once('php/message.class.php');
    $connexion = new Connexion();
    $messages = new Message($connexion::getInstance());
    $page = $messages->nbpage();

	$matchObjet = new Match($connexion::getInstance());
	$historic = new Historic($connexion::getInstance());

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
          <li><a href="matchs"><span class="glyphicon glyphicon-wrench"></span> <?php echo MENU_MATCHS; ?></a></li>
           <li class="dropdown">
           <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span> <?php echo MENU_OPTIONS; ?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="setting">&rsaquo; <?php echo MENU_COMMONS; ?></a></li>
              <li><a href="player_setting">&rsaquo; <?php echo MENU_PLAYER; ?></a></li>
            </ul>
          </li>
          <li><a href="message_board?page=<?php echo $page; ?>"><span class="glyphicon glyphicon-comment"></span> <?php echo MENU_MESSAGES; ?> <?php $messages->newMessage($_SESSION['logged']['name']); ?></a></li>
          <li class="dropdown active">
           <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list-alt"></span> <?php echo MENU_HISTORIC; ?> <b class="caret"></b></a>
          <ul class="dropdown-menu">
              <li><a href="historic">&rsaquo; <?php echo MENU_ADD; ?></a></li>
              <li><a href="historic_view">&rsaquo; <?php echo MENU_VIEW; ?></a></li>
          </ul>
          </li>
          <li><a href="logout"><span class="glyphicon glyphicon-log-out"></span> <?php echo MENU_LOGOUT; ?></a></li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>

	<div class="container">
		<div class="col-md-12">
			<?php  
				if(isset($_GET['league'])){
					$filtre = $_GET['league'];
				}else{
					$filtre = "All";
				}
				$historic->filter($filtre);
			?>
		</div>
		<div class="col-md-12">
			<?php
        $arraytrad = array("HISTORIC_VIEW_DATE" => HISTORIC_VIEW_DATE,
                           "HISTORIC_VIEW_TIME" => HISTORIC_VIEW_TIME, 
                           "HISTORIC_VIEW_LEAGUE" => HISTORIC_VIEW_LEAGUE, 
                           "HISTORIC_VIEW_TEAM" => HISTORIC_VIEW_TEAM, 
                           "HISTORIC_VIEW_SCORE" => HISTORIC_VIEW_SCORE, 
                           "HISTORIC_VIEW_MAPS" => HISTORIC_VIEW_MAPS, 
                           "HISTORIC_VIEW_LOGS" => HISTORIC_VIEW_LOGS, 
                           "HISTORIC_VIEW_INFO" => HISTORIC_VIEW_INFO, 
                           "HISTORIC_VIEW_CONFIRM_MESSAGE" => HISTORIC_VIEW_CONFIRM_MESSAGE
                           ); 
				$historic->getHistoric($filtre, $arraytrad);
			?>
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
    	$(".input-group.date").datepicker({ autoclose: true, todayHighlight: true, orientation: "top", language: "fr" });
    </script>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> -->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="style/bootstrap/js/bootstrap.min.js"></script>
    <script>
		$(document).ready(function(){
			$('span').popover();
		});


	</script>
</div>
    <div class="del"></div>
</body>
</html>
<?php ob_end_flush(); ?>