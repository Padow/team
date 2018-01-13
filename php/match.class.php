<?php
	class Match{

		private $_connexion;
		private $_map;
		private $_league;
		private $_date;
		private $_match;

		public function __construct($connexion)
		{
			$this->_connexion = $connexion;
		}

		public function getMapList(){
			$sql = ("SELECT name FROM maps");
			$req = $this->_connexion-> query($sql);
			$rows = $req->fetchAll(PDO::FETCH_ASSOC);
			$this->_map = $rows;
		}

		public function getLeagueList(){
			$sql = ("SELECT name FROM leagues");
			$req = $this->_connexion-> query($sql);
			$rows = $req->fetchAll(PDO::FETCH_ASSOC);
			$this->_league = $rows;
		}

		public function getDate($key){
			$date = explode('/', $key);
			$date = $date[2].'-'.$date[1].'-'.$date[0];
			$this->_date = $date;
			return $this->_date;
		}

		public function setMatch($list){
			$key = $list['date'].'@'.$list['time'];
			$date = $this->getDate($list['date']);
			$sql = $this->_connexion->prepare("SELECT clee FROM matchs where clee = :key");
			$sql-> bindParam('key', $key, PDO::PARAM_STR);
			$sql-> execute();

			$rows = $sql->fetchAll(PDO::FETCH_ASSOC);
			if(count($rows)==0)
			{
				$sql = $this->_connexion->prepare("INSERT INTO matchs (clee, date, time, league, team, map1, map2) values(:clee, :date, :time, :league, :team, :map1, :map2)");
				$sql-> bindParam('clee', $key, PDO::PARAM_STR);
				$sql-> bindParam('date', $date, PDO::PARAM_STR);
				$sql-> bindParam('time', $list['time'], PDO::PARAM_STR);
				$sql-> bindParam('league', $list['league'], PDO::PARAM_STR);
				$sql-> bindParam('team', $list['team'], PDO::PARAM_STR);
				$sql-> bindParam('map1', $list['map1'], PDO::PARAM_STR);
				$sql-> bindParam('map2', $list['map2'], PDO::PARAM_STR);			
				$sql-> execute();
				echo '
						<div class="col-md-12">
							<div class="alert alert-success alert-dismissable">
								  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								  <strong>Well done : </strong> '.MATCHS_SCHEDULE_SUCCESS.' 
							</div>
						</div>
						<script type="text/javascript">
							setTimeout( function() 
	                        {
	                          window.location.href="matchs.php";
	                        }, 3000);
						</script>
					 ';
			}
			else
			{
				echo '
						<div class="col-md-12">
							<div class="alert alert-warning alert-dismissable">
								  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								  <strong>Alerte : </strong> '.MATCHS_SCHEDULE_FAILURE.' 
							</div>
						</div>
					 ';

			}
		}

		public function delMatch($list){
			$sql = $this->_connexion->prepare("DELETE FROM matchs WHERE clee = :clee");
			$sql-> bindParam('clee', $list, PDO::PARAM_STR);
			$sql-> execute();
			echo '
						<script type="text/javascript">
	                          window.location.href="matchs.php";
						</script>
					 ';
		}

		public function getMatchList(){
			$sql = ("SELECT * FROM matchs ORDER BY date, time");
			$req = $this->_connexion-> query($sql);
			$rows = $req->fetchAll(PDO::FETCH_ASSOC);
			if(count($rows)!=0)
				$this->_match = $rows;
			else
				$this->_match = null;
		}

		public function getMatch(){
			return $this->_match;
		}

		public function getMap(){
			return $this->_map;
		}

		public function getLeague(){
			return $this->_league;
		}
	
	}
