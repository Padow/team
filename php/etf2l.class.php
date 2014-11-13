<?php 
class Etf2l extends Connexion{
	public function __construct(){
		$this->_connexion = parent::__construct();
	    $path = __DIR__;
	    $path = substr($path, 0, -3);
	    $path .= "config/teamid.json";		
		if (file_exists($path)) {
        	$array = json_decode(file_get_contents($path));
        	$etf2lteamid = $array->{'team'}->{'id'};
		}
	    if($etf2lteamid){
	    	$this->etf2lmatch($etf2lteamid);	
	    }
	}

	public function jsonparser($etf2lteamid){
		$url = "http://api.etf2l.org/team/" . $etf2lteamid . "/matches.json?&only_scheduled=1";
		if(@$json = file_get_contents($url)){
			$etf2lschdul = json_decode($json, true);
		}else{
	    	$etf2lschdul = null;
	    }
	    return $etf2lschdul;
	}

	public function etf2lmatch($etf2lteamid){
		$shedull = $this->jsonparser($etf2lteamid);
	    	if($shedull['matches']){
	    		$etf2l = 1;
	    		$sql = $this->_connexion->prepare("DELETE FROM matchs where etf2l = :etf2l");
				$sql-> bindParam('etf2l', $etf2l, PDO::PARAM_STR);
				$sql-> execute();
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
		$tmptime = explode(":", $list['time']);
		$keytime = $tmptime[0].':'.$tmptime[1];
		$key = $keydate.'@'.$keytime;
		$date = $list['date'];
		$etf2l = 1;

		$sql = $this->_connexion->prepare("INSERT INTO matchs (clee, date, time, league, team, map1, map2, etf2l) values(:clee, :date, :time, :league, :team, :map1, :map2, :etf2l)");
		$sql-> bindParam('clee', $key, PDO::PARAM_STR);
		$sql-> bindParam('date', $date, PDO::PARAM_STR);
		$sql-> bindParam('time', $list['time'], PDO::PARAM_STR);
		$sql-> bindParam('league', $list['league'], PDO::PARAM_STR);
		$sql-> bindParam('team', $list['team'], PDO::PARAM_STR);
		$sql-> bindParam('map1', $list['map1'], PDO::PARAM_STR);
		$sql-> bindParam('map2', $list['map2'], PDO::PARAM_STR);			
		$sql-> bindParam('etf2l', $etf2l, PDO::PARAM_STR);			
		$sql-> execute();
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
