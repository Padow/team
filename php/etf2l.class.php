<?php 
class Etf2l extends Connexion{
	public function __construct(){
		$this->_connexion = parent::__construct();
		$teamid = __DIR__."../../config/teamid.ini";
	    if(@$id = parse_ini_file($teamid)){
	    	foreach ($id as $value) {
	        	$etf2lid = $value;
	        }
	        $etf2lteamid = $etf2lid;
	    }else{
	    	$etf2lteamid = false;
	    }
	    if($etf2lteamid){
	    	$shedull = $this->jsonparser($etf2lteamid);
	    	if($shedull['matches']){
	    		foreach ($shedull['matches'] as $key => $value) {
		    		$tess[$key] = $value;
		    		foreach ($tess as $key => $value) {
		    			$maps = $value['maps'];
		    			$datetime = date('d/m/Y H:i:s', $value['time']);
		    			$tmpdate = explode(" ", $datetime);
		    			$tmpday = explode("/", $tmpdate[0]);
		    			$day = $tmpday[2].'-'.$tmpday[1].'-'.$tmpday[0];
		    			$time = $tmpdate[1];
		    			if($value['clan1']['id'] != $etf2lteamid){
		    				$team = $value['clan1']['name'];
		    			}else{
		    				$team = $value['clan2']['name'];
		    			}

		    			$league = 'ETF2L';
		    			$list = array('date'=>$day, 'time'=>$time, 'league'=>$league, 'team'=>$team, 'map1'=>$maps[0], 'map2'=>$maps[1]);
		    			foreach ($maps as $value) {
		    				$this->addMap($value);
		    			}
		    			$this->addLeague($league);

		    			$this->setMatch($list);

		    		}
		    	}
	    	}
	    	
	    }
	}

	public function jsonparser($etf2lteamid){
		$url = "http://api.etf2l.org/team/" . $etf2lteamid . "/matches.json?&only_scheduled=1";
		$json = file_get_contents($url);
	    $array = json_decode($json, true); 	    
	    if($array) {
	        $etf2lschdul = $array;
	    }else{
	    	$etf2lschdul = null;
	    }

	    return $etf2lschdul;

	}

	public function addMap($name){
		if(!strstr($name, ";")){
			$sql = $this->_connexion->prepare("SELECT name FROM maps WHERE name = :name ");
			$sql-> bindParam('name', $name, PDO::PARAM_STR);
			$sql-> execute();
			$rows = $sql->fetchAll(PDO::FETCH_ASSOC);

			if(count($rows)==0){
				$sql = $this->_connexion->prepare("INSERT INTO  maps (name) VALUES (:name) ");
				$sql-> bindParam('name', $name, PDO::PARAM_STR);
				$sql-> execute();
			}
		}		
	}

	public function setMatch($list){
		$tmp = explode("-", $list['date']);
		$keydate = $tmp[2].'/'.$tmp[1].'/'.$tmp[0];
		$key = $keydate.'@'.$list['time'];
		$date = $list['date'];
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
		}
	}

	public function addLeague($name){
		if(!strstr($name, ";")){
			$sql = $this->_connexion->prepare("SELECT name FROM  leagues WHERE name = :name ");
			$sql-> bindParam('name', $name, PDO::PARAM_STR);
			$sql-> execute();
			$rows = $sql->fetchAll(PDO::FETCH_ASSOC);

			if(count($rows) == 0){
				$sql = $this->_connexion->prepare("INSERT INTO  leagues (name) VALUES (:name) ");
				$sql-> bindParam('name', $name, PDO::PARAM_STR);
				$sql-> execute();

			}
		}
	}
}
?>