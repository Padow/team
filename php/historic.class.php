<?php  
	class Historic extends Connexion{

		private $_date;
		private $_league;

		public function __construct()
		{
			$this->_connexion = parent::__construct();
		}

		public function getDate($key){
			$date = explode('/', $key);
			$date = $date[2].'-'.$date[1].'-'.$date[0];
			$this->_date = $date;
			return $this->_date;
		}

		public function score($s1, $s2){
			if ($s1 == $s2) {
				$result = "0";
			}elseif ($s1 > $s2) {
				$result = "1";
			}else{
				$result = "-1";
			}
			return $result;
		}

		public function comments($com){
			if ($com == "") {
				$comment = "none";
			}else{
				$comment = $com;
			}
			return $comment;
		}

		public function setHistoric($list){
			
			$result1 = $this->score($list['scoreteam1'], $list['scoreopponent1']);
			$result2 = $this->score($list['scoreteam2'], $list['scoreopponent2']);
			$comment = $this->comments($list['comment']);
			$date = $this->getDate($list['date']);
			$etf2lkey = $date.$list['time'].':00'.$list['team'];

			$sql = $this->_connexion->prepare("INSERT INTO  historic (date, etf2lkey, time, league, map1, scoreteam1, scoreopponent1, logs1, result1, map2, scoreteam2, scoreopponent2, logs2, result2, team, comments) VALUES(:date, :etf2lkey, :time, :league, :map1, :scoreteam1, :scoreopponent1, :logs1, :result1, :map2, :scoreteam2, :scoreopponent2, :logs2, :result2, :team, :comments)");
			$sql-> bindParam('date', $date, PDO::PARAM_STR);
			$sql-> bindParam('etf2lkey', $etf2lkey, PDO::PARAM_STR);
			$sql-> bindParam('time', $list['time'], PDO::PARAM_STR);
			$sql-> bindParam('league', $list['league'], PDO::PARAM_STR);

			$sql-> bindParam('map1', $list['map1'], PDO::PARAM_STR);
			$sql-> bindParam('scoreteam1', $list['scoreteam1'], PDO::PARAM_INT);
			$sql-> bindParam('scoreopponent1', $list['scoreopponent1'], PDO::PARAM_INT);
			$sql-> bindParam('result1', $result1, PDO::PARAM_STR);
			$sql-> bindParam('logs1', $list['logs1'], PDO::PARAM_STR);

			$sql-> bindParam('map2', $list['map2'], PDO::PARAM_STR);
			$sql-> bindParam('scoreteam2', $list['scoreteam2'], PDO::PARAM_INT);
			$sql-> bindParam('scoreopponent2', $list['scoreopponent2'], PDO::PARAM_INT);
			$sql-> bindParam('result2', $result2, PDO::PARAM_STR);
			$sql-> bindParam('logs2', $list['logs2'], PDO::PARAM_STR);

			$sql-> bindParam('team', $list['team'], PDO::PARAM_STR);
			$sql-> bindParam('comments', $comment, PDO::PARAM_STR);
			$sql-> execute();

			echo '
				<script type="text/javascript">
			        window.location.href="historic_view.php";
				</script>';
		}

		public function getLeagueList(){
			$sql = ("SELECT name FROM leagues");
			$req = $this->_connexion-> query($sql);
			$rows = $req->fetchAll(PDO::FETCH_ASSOC);
			$this->_league = $rows;
			return $this->_league;
		}

		public function filter($filtre){
			$league = $this->getLeagueList();
			echo '<ol class="breadcrumb">';
			if($filtre == "All"){
				echo '<li class="active">All</li>';
			}else{
				echo '<li><a href="historic_view.php">All</a></li>';
			}
			foreach ($league as $key => $value) {
				if($value['name'] == $filtre){
					echo '<li class="active">'.$value['name'].'</li>';
				}else{
					echo '<li><a href="historic_view.php?league='.urlencode($value['name']).'">'.$value['name'].'</a></li>';
				}
			}
			echo "</ol>";

		}

		public function dateTofr($datebdd){
			$tmp = explode("-", $datebdd);
			$datefr = $tmp[2].'/'.$tmp[1].'/'.$tmp[0];
			return $datefr;
		}

		public function heure($heurbdd){
			$tmp = explode(":", $heurbdd);
			$heure = $tmp[0].':'.$tmp[1];
			return $heure;
		}

		public function winner($s1, $s2){
			$winner = $this->score($s1, $s2);
			if($winner == 0)
				$pclass = "draw";
			elseif ($winner > 0)
				$pclass = "win";
			else
				$pclass = "lose";

			return $pclass;
		}

		public function getHistoric($filtre, $arraytrad){
			$league = $this->getLeagueList();
			$arr[] = "All";
			foreach ($league as $value) {
				$arr[] = $value['name'];
			}
			if(!in_array($filtre, $arr)){
				echo '
				<script type="text/javascript">
			        window.location.href="historic_view.php";
				</script>';
			}
			
			if($filtre == "All"){
				$sql = $this->_connexion->prepare("SELECT * FROM  historic ORDER BY date DESC, time DESC ");
				$sql-> execute();
				$rows = $sql->fetchAll(PDO::FETCH_ASSOC);
			}else{
				$sql = $this->_connexion->prepare("SELECT * FROM  historic WHERE league = :league ORDER BY date DESC, time DESC ");
				$sql-> bindParam('league', $filtre, PDO::PARAM_STR);
				$sql-> execute();
				$rows = $sql->fetchAll(PDO::FETCH_ASSOC);
			}
			
			echo '<div class="table-responsive col-md-12 no-padd">';
			echo '<table class="table bckg col-md-12"><tr>';
			echo '<th>'.$arraytrad['HISTORIC_VIEW_DATE'].'</th><th>'.$arraytrad['HISTORIC_VIEW_TIME'].'</th><th>'.$arraytrad['HISTORIC_VIEW_LEAGUE'].'</th><th>'.$arraytrad['HISTORIC_VIEW_TEAM'].'</th><th>'.$arraytrad['HISTORIC_VIEW_SCORE'].'</th><th>'.$arraytrad['HISTORIC_VIEW_MAPS'].'</th><th>'.$arraytrad['HISTORIC_VIEW_LOGS'].'</th><th>'.$arraytrad['HISTORIC_VIEW_INFO'].'</th><th></th></tr>';
			if ($rows !="") {
				foreach ($rows as  $value) {
					echo'<tr>';
					echo '<td>'.$this->dateTofr($value['date']).'</td>';
					echo '<td>'.$this->heure($value['time']).'</td>';
					echo '<td>'.htmlspecialchars($value['league']).'</td>';
					echo '<td>'.htmlspecialchars($value['team']).'</td>';
					if($value['map2'] == ""){
						$pclass1 = $this->winner($value['scoreteam1'], $value['scoreopponent1']);
						$pclass2 = "draw";
						echo '<td><p class="nobr '.$pclass1.'">'.$value['scoreteam1'].' - '.$value['scoreopponent1'].'</p></td>';
					}else{
						$pclass1 = $this->winner($value['scoreteam1'], $value['scoreopponent1']);
						$pclass2 = $this->winner($value['scoreteam2'], $value['scoreopponent2']);
						echo '<td><p class="nobr '.$pclass1.'">'.$value['scoreteam1'].' - '.$value['scoreopponent1'].'</p><p class="nobr '.$pclass2.'">'.$value['scoreteam2'].' - '.$value['scoreopponent2'].'</p></td>';
					}
					
					echo '<td><p class="nobr '.$pclass1.'">'.htmlspecialchars($value['map1']).'</p><p class="nobr '.$pclass2.'">'.htmlspecialchars($value['map2']).'</p></td>';
					if($value['logs1'] == "" && $value['logs2'] == "") 
						echo '<td><p class="nobr"><span>∅</span></p><p class="nobr"><span>∅</span></p></td>';
					elseif($value['logs1'] == "" && $value['logs2'] != "")
						echo '<td><p class="nobr"><span>∅</span></p><p class="nobr"><a href="'.$value['logs2'].'" target="_blank">Logs</a></p></td>';
					elseif($value['logs2'] == "" && $value['logs1'] != "")
						echo '<td><p class="nobr"><a href="'.$value['logs1'].'" target="_blank">Logs</a></p><p class="nobr"><span>∅</span></p></td>';
					else
						echo '<td><p class="nobr"><a href="'.$value['logs1'].'" target="_blank">Logs</a></p><p class="nobr"><a href="'.$value['logs2'].'" target="_blank">Logs</a></p></td>';

					echo '<td><span class="glyphicon glyphicon-info-sign tool" data-container="body" data-toggle="popover" data-placement="left" data-content="'.htmlspecialchars($value['comments']).'"></span></td>';
					echo '<td><span id="'.urlencode($value['etf2lkey']).'" onClick="suppr(this.id, '.$arraytrad['HISTORIC_VIEW_CONFIRM_MESSAGE'].');" class="glyphicon glyphicon-trash hand"></span></td></tr>';
				}
			}
			
			echo '</table>';
			echo '</div>';
		}

		public function deletefromhistoric($etf2lkey){
			$sql = $this->_connexion->prepare("DELETE FROM historic where etf2lkey = :etf2lkey");
			$sql-> bindParam('etf2lkey', $etf2lkey, PDO::PARAM_STR);
			$sql-> execute();
		}

	}

?>