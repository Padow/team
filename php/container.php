<div class="container">
<?php  
    require_once('pdo.class.php');
    require_once('week.class.php');
    require_once('player.class.php');
    require_once('dispo.class.php');
    require_once('match.class.php');
    require_once('server.class.php');
    require_once('gamemode.class.php');
    session_name('IDSESSION');
    session_start();
    $logged = $_SESSION['logged']['name'];

  $playerList = new Players();
  $playerList->getPlayerList();
  
  //check if at least one player exist
  if($playerList->getPlayersname() == null){
    echo '
    <div class="col-md-12">
      <div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <strong>Attention! : </strong>Veulliez ajouter au moins un joueur, puis vous logger avec ce pseudo.
      </div>
    </div>
   ';
   die();
  }
  // end if no one player exist

  $playerListDispo = new Players();
  $playerListDispo->getPlayerDispoList();

  $dispoObjet = new Dispo();
  $dispoObjet->getDispoList(); 

  $dayList = new Weeks();
  $dayList2 = new Weeks();

  $match = new Match();
  $match->getMatchList();

  $gamemode = new Game_mode();
  $gm = $gamemode->getmode();

  // get default dispo for each players
  foreach ($playerListDispo->getPlayersname() as $key => $value) {
    $idar = $value['name'];
    foreach ($value as $key2 => $value2) {
      if($key2 != 'name')
        $defaultDispo[$idar][$key2] = $value2;
    }
  }

  // get day and date of each progammable days
  foreach ($dayList2->getWeeks() as $key => $value) {
    $dayList3[$key] = $value;
  }
  
  // set array of dispo for each players for each programmable days
  foreach ($defaultDispo as $key => $value) {
    $idnom = $key;
    foreach ($value as $key3 => $value3) {
      $days = $key3;
      $disp = $value3;
      foreach ($dayList3 as $key4 => $value4) {
        $DayWeek = explode(" ", $key4);
        $DayWeek2 = $DayWeek[0];
        if($DayWeek2 == $days && $disp != null && $disp !=""){
          $defaultDispoList[$idnom.'@'.$value4] = $disp;
        }
      }
    }
  }

  // get each date where match is programmed 
  if($match->getMatch() != null){
    foreach ($match->getMatch() as $key => $value) {
      $date = explode("-", $value['date']);
      $date = $date[2].'/'.$date[1].'/'.$date[0];
      $array_match[$key] = $date;
    }
  }else{
    $array_match = array("null");
  }

  
  // get each setted dispo
  foreach ($dispoObjet->getDispo() as $value) {
      $dispoList[$value['clee']] = $value['dispo'];
  }

  // remove dispo from the array of dispo for each players for each programmable days, where dispo are already setted for the player and date
  if(isset($defaultDispoList)){
    if(isset($dispoList)){
      foreach ($defaultDispoList as $key => $value) {
        if(!in_array($key, array_keys($dispoList))){
          $defaultDispoInsert[$key] = $value;
        }
      }
    }else{
      $defaultDispoInsert = $defaultDispoList;
    }
  }

  // set dispo with the default dispo
  if(isset($defaultDispoInsert)){
    $dispoObjet->setDefaultDispo($defaultDispoInsert);
    echo '<script type="text/javascript">
            window.location.reload();
          </script>
          ';
  }

?>

	<div class="table-responsive col-md-9 no-padd">
	    <div class="col-md-12 no-padd">
	    	<table class="table bckg col-md-12">
	    		<tr>
		    		<th class="th_dispo">Date</th>
            <th class="th_dispo"></th>
		    		<?php
              
              /**
                  logged player table headline
              */
  						foreach ($playerList->getPlayersname() as $value) {
                if(strtoupper($logged) == strtoupper($value['name'])){
                  if($value['classe'] == ""){
                    $value['classe'] = "last";
                  }
                  echo '<th class="th_dispo"><img class="classe_icon" src="style/classes/'.$value['classe'].'.png" alt=""> '.htmlspecialchars($value['name']).'</th>';
                }     
  						}
              /**
                  other player table headline
              */
              foreach ($playerList->getPlayersname() as $value) {
                if(strtoupper($logged) != strtoupper($value['name'])){
                  if($value['classe'] == ""){
                    $value['classe'] = "last";
                  }
                  echo '<th class="th_dispo"><img class="classe_icon" src="style/classes/'.$value['classe'].'.png" alt=""> '.htmlspecialchars($value['name']).'</th>';
                }
              }
/**
    loop to build table cells
*/
  						foreach ($dayList->getWeeks() as $key => $value) {	
  							$idDate = $value;
                /**
                    new row
                */
  							echo '<tr id="'.$value.'">';
                /**
                    check if match exist for the date
                    first col
                */
                if(in_array($value, $array_match)){
                  echo '<td class="war">'.$key.'</td>';
                }else{
                  echo '<td>'.$key.'</td>';
                }
                /**
                    get the number of dispo dor the date
                    second col
                */
                $tempdate =explode("/", $idDate);
                $dateday = $tempdate[2].'-'.$tempdate[1].'-;'.$tempdate[0];
                $dispoObjet->getNbDispo($dateday);
                $nbd = $dispoObjet->getNumDispo();
                if($gm == "9v9")
                  $gamemode->num9v9($nbd);
                else
                  $gamemode->num6v6($nbd);
  							
                /**
                    logged player cells
                    third col
                */
  							foreach ($playerList->getPlayersname() as $value) {
                  if(strtoupper($logged) == strtoupper($value['name'])){
  								  $comp = $value['name'].'@'.$idDate;
  								  $nameButton = $value['name'];
  									if(isset($dispoList[$comp]))
  									{
  										if($dispoList[$comp]=="oui")
  										{
  											echo '<td class="green">';
  										}if($dispoList[$comp]=="non"){
  											echo '<td class="red">';
  										}if($dispoList[$comp]=="idk"){
  											echo '<td class="blue">';
  										}
  									}else{
  										echo '<td class="white">';
  									}	
      								echo '
      								<button onClick="SetDispo(this.id);" id="'.htmlspecialchars($nameButton).'@'.htmlspecialchars($idDate).'#oui" class="btn btn-default btn-success btn-xs"><span class="glyphicon glyphicon-ok-sign"></span></button> 
      								<button onClick="SetDispo(this.id);" id="'.htmlspecialchars($nameButton).'@'.htmlspecialchars($idDate).'#non" class="btn btn-default btn-danger btn-xs"><span class="glyphicon glyphicon-remove-sign"></span></button> 
      								<button onClick="SetDispo(this.id);" id="'.htmlspecialchars($nameButton).'@'.htmlspecialchars($idDate).'#idk" class="btn btn-default btn-info btn-xs"><span class="glyphicon glyphicon-question-sign"></span></button></td>';

                  }
  							}
                /**
                    other player cells
                    rest of the cols
                */
                foreach ($playerList->getPlayersname() as $value) {
                  if(strtoupper($logged) != strtoupper($value['name'])){
                    $comp = $value['name'].'@'.$idDate;
                    if(isset($dispoList[$comp]))
                    {
                      if($value['classe'] == ""){
                        $value['classe'] = "last";
                      }
                      if($dispoList[$comp]=="oui")
                      {
                        echo '<td class="green"></td>';
                      }if($dispoList[$comp]=="non"){
                        echo '<td class="red2"><img class="classe_icon" src="style/classes/'.$value['classe'].'.png" alt=""></td>';
                      }if($dispoList[$comp]=="idk"){
                        echo '<td class="blue"></td>';
                      }
                    }else{
                      echo '<td class="white"></td>';
                    }      
                  }
                }

                /**
                    end of row
                */
  							echo '</tr>';

                /**
                    weeks delimiter
                */
                if (preg_match("/Dim/i", $key)) {
                  echo '<tr><td class="separateur"></td>'; //date
                  echo '<td class="separateur"></td>'; //nb dispo
                  foreach ($playerList->getPlayersname() as $value) {
                    echo '<td class="separateur"></td>'; // each player
                  }
                  echo '</tr>'; 
                }
  						}

		    		?>
	    	</table>
		</div>
   	</div>
    <div class="col-md-3">
      <?php 
        /**
            check if matchs are programmed
        */
        if($match->getMatch() != null){ 
      ?>
      <div class="panel-group" id="accordion">
    	<?php  
        $nbdispo = $dispoObjet;
        $matchdate = new Weeks();
        $cpt = 0;
          /**
            loops to get info for each matchs
          */
          foreach ($match->getMatch() as $value) {

            $listejoueur = array();
            $nbdispo->getNbDispo($value['date']);
            $nb = $nbdispo->getNumDispo();
            $hour = explode(':', $value['time']);
            $hour = $hour[0].'h'.$hour[1];


            $datematche = $matchdate->dayOfTheWeek($value['date']);

            // get name of the aiviable players
            foreach ($nbdispo->getPseudo() as $values) {
              $listejoueur[] =  $values['pseudo'];         
            }
            // get last classe needed
            $allPlayer = $playerList->getPlayersname();
            if($gm == "9v9")
              $last = $nbdispo->last9v9($listejoueur, $allPlayer);
            else
              $last = $nbdispo->last6v6($listejoueur, $allPlayer);
            /**
                first loop
            */
            if($cpt == 0){
        ?>
              <div class="panel panel-default">
        <?php
              if($value['date'] == date("Y-m-d"))
                echo '<div class="panel-heading today">';
              else
                echo '<div class="panel-heading">';
        ?> 
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $cpt; ?>">
                      <?php echo $datematche.' à '.$hour; ?>
                    </a>
                  </h4>
                </div>
                <div id="<?php echo $cpt; ?>" class="panel-collapse collapse in">
                  <div class="panel-body">
                    <?php 
                      echo '<p class="infomatch"><strong>League : </strong>'.htmlspecialchars($value['league']).'</p>';
                      echo '<p class="infomatch"><strong>Team : </strong>'.htmlspecialchars($value['team']).'</p>';
                      echo '<p class="infomatch"><strong>Maps : </strong>'.htmlspecialchars($value['map1']).' / '.htmlspecialchars($value['map2']).'</p>';
                      echo '<p class="infomatch"><strong>Joueurs dispo('.$nb.') : </strong>';
                      foreach ($listejoueur as $pseudodsip) {
                        if ($pseudodsip === end($listejoueur))
                          echo htmlspecialchars($pseudodsip).'</p>';
                        else
                          echo htmlspecialchars($pseudodsip).' / ';
                      }
                      if(!empty($last)){
                        echo '<p class="infomatch"><strong>Manque : </strong>';
                        foreach ($last as $classelast) {
                          echo '<img class="classe_icon" src="style/classes/'.$classelast.'.png" alt=""> ';
                        }
                      }
                    ?>
                  </div>
                </div>
              </div>
        <?php
            $cpt++;
            /**
              rest of the loops
            */
            }else{
        ?>
              <div class="panel panel-default">
        <?php
              if($value['date'] == date("Y-m-d"))
                echo '<div class="panel-heading today">';
              else
                 echo '<div class="panel-heading">';
        ?>
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $cpt; ?>">
                      <?php echo $datematche.' à '.$hour; ?>
                    </a>
                  </h4>
                </div>
                <div id="<?php echo $cpt; ?>" class="panel-collapse collapse">
                  <div class="panel-body">
                    <?php 
                      echo '<p class="infomatch"><strong>League : </strong>'.htmlspecialchars($value['league']).'</p>';
                      echo '<p class="infomatch"><strong>Team : </strong>'.htmlspecialchars($value['team']).'</p>';
                      echo '<p class="infomatch"><strong>Maps : </strong>'.htmlspecialchars($value['map1']).' / '.htmlspecialchars($value['map2']).'</p>';
                      echo '<p class="infomatch"><strong>Joueurs dispo('.$nb.') : </strong>';
                      foreach ($listejoueur as $pseudodsip) {
                        if ($pseudodsip === end($listejoueur))
                          echo htmlspecialchars($pseudodsip).'</p>';
                        else
                          echo htmlspecialchars($pseudodsip).' / ';
                      }
                      if(!empty($last)){
                        echo '<p class="infomatch"><strong>Manque : </strong>';
                        foreach ($last as $classelast) {
                          echo '<img class="classe_icon" src="style/classes/'.$classelast.'.png" alt=""> ';
                        }
                      }
                    ?>
                  </div>
                </div>
              </div>
        <?php
            $cpt++;
            }
            
          }
      /**
          if no one match is programmed
      */
      ?>
</div>
<?php }else{
  echo "<h3>Pas de match programmé.</h3>";
} 
  $serv = new Server();
?>
    </div>
</div>
<span class="del"></span>
<script type="text/javascript">
  $('.del').nextAll().remove();
</script>

