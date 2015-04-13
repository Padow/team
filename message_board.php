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
  	<title>Message Board</title>
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
<body> 
<div class="body">
  <?php  
  	require_once('php/pdo.class.php');
    require_once('php/links.class.php');
    require_once('php/message.class.php');
    $connexion = new Connexion();
    $messages = new Message($connexion->getConnexion());
    $page = $messages->nbpage();
    $messages->lastmess($_SESSION['logged']['name']);

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
          <li class="active"><a href="message_board?page=<?php echo $page; ?>"><span class="glyphicon glyphicon-comment"></span> <?php echo MENU_MESSAGES; ?> <?php $messages->newMessage($_SESSION['logged']['name']); ?></a></li>
          <li class="dropdown">
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
          $messages->pagination($_GET['page']); 
        ?>
      </div>
      <div class="col-md-12">
        <div id="query2"></div>
        <?php  
          $messages->getMessages($_GET['page'], $_SESSION['logged']['name'], CLASS_MESSAGE_QUOTED);
          if (isset($_POST['send'])) {
            if (!preg_match("/\S/", $_POST['comment'])) {
              $error = 'Le message ne peut être vide.';   
            } else {
              $messages->setMessage($_SESSION['logged']['name'], $_POST['comment']);
            }
          }
        ?>
      </div>
      <div class="col-md-12">
        <?php  
          $messages->pagination($_GET['page']); 
        ?>
      </div>
      <div class="col-md-12">
        <?php if (isset($error)) { ?>
        <div class="alert alert-warning alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true" class="glyphicon glyphicon-remove"></span><span class="sr-only">Close</span></button>
          <p><strong>Attention !</strong><p>
          <p><?php echo $error; ?></p>
        </div>
        <?php } ?>
        <div class="col-md-12 btstyle">    
          <button title="<?php echo MESSAGE_BOLD; ?>" onclick="formatText(form_Commentaire,'b','b')" class="btn btn-sm btn-default" style="background: transparent; border: none;"><span class="glyphicon glyphicon-bold"></span> </button>
          <button title="<?php echo MESSAGE_ITALIC; ?>" onclick="formatText(form_Commentaire,'i','i')" class="btn btn-sm btn-default" style="background: transparent; border: none;"><span class="glyphicon glyphicon-italic"></span> </button>
          <button title="<?php echo MESSAGE_UNDERLINE; ?>" onclick="formatText(form_Commentaire,'u','u')" class="btn btn-sm btn-default" style="background: transparent; border: none;"><span><img class="underline_icon" src="style/images/icon_underline.png" alt=""></span> </button> 
          <span class="infomatch">|</span> 
          <button title="<?php echo MESSAGE_IMAGE; ?>" onclick="formatText(form_Commentaire,'img','img')" class="btn btn-sm btn-default" style="background: transparent; border: none;"><span class="glyphicon glyphicon-picture"></span> </button>
          <button title="<?php echo MESSAGE_LINK; ?>" onclick="formatText(form_Commentaire,'url','url')" class="btn btn-sm btn-default" style="background: transparent; border: none;"><span class="glyphicon glyphicon-link"></span> </button>
          <button title="<?php echo MESSAGE_QUOTE_FORM; ?>" onclick="formatText(form_Commentaire,'quote','quote')" class="btn btn-sm btn-default" style="background: transparent; border: none;"><span class="glyphicon glyphicon-comment"></span> </button>
        </div>

        <form method="post">
          <div class="col-md-12 no-padd">
            <textarea id="form_Commentaire" class="textarea form-control" wrap="soft" name="comment" required></textarea>
          </div>

          <div class="col-md-3 no-padd">
            <button type="submit" name="send" class="btn btn-sm btn-primary btn-block" style="margin-top: 10px;"><span class="glyphicon glyphicon-send"></span> <?php echo MESSAGE_SEND; ?></button>
          </div>

        </form>
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
    <script type="text/javascript"> 
    
      

if(readCookie('scroll') == 1){
  $('.body').animate({
      scrollTop: ($('#anchor').offset().top)
  },100);
   createCookie('scroll', "", -1);
}

if(readCookie('scrollto')){
  var id = readCookie('scrollto');
  $('.body').animate({
      scrollTop: ($('#'+id).offset().top)
  },100);
   createCookie('scrollto', "", -1);
}

$(function(){
   function responsive(){
        $('.messb').each( function(){
            var heighttmp = $( this ).children('.messbp').height();
            var heighttmp2 = $( this ).children('.messbm').height();

            var widthttmp = $( this ).children('.messbp').width(); 
            var widthttmp2 = $( this ).children('.messbm').width();
         
             if (heighttmp<heighttmp2) {
              var height = heighttmp2;
             }else{
              var height = heighttmp;
             };
             if (widthttmp != widthttmp2) {
                $( this).children('.messbp').height(height);      
             }else{
                $( this ).children('.messbp').height('auto');
                $( this ).children('.messbm').height('auto');
             }

        });


   };
   window.setTimeout( responsive, 100 ); 
});

      $( window ).resize(function() {
        $('.messb').each( function(){
           var heighttmp = $( this ).children('.messbp').height(); 
           var heighttmp2 = $( this ).children('.messbm').height(); 

           var widthttmp = $( this ).children('.messbp').width(); 
           var widthttmp2 = $( this ).children('.messbm').width(); 
         
           if (heighttmp<heighttmp2) {
            var height = heighttmp2;
           }else{
            var height = heighttmp;
           };
           if (widthttmp != widthttmp2) {
            $( this ).children().height(height);
           }else{
            $( this ).children('.messbp').height('auto');
            $( this ).children('.messbm').height('auto');
           };      
        } );
      });
      
    </script>
  </div>
    <div class="del"></div>
  </body>
</html>
<?php ob_end_flush(); ?>