<?php 
class Game_mode{
	private $_mode;
	public function __construct(){
		$mode = __DIR__."../../config/game_mode.ini";
	    if(@$selected_mode = parse_ini_file($mode)){
	    	foreach ($selected_mode as $value) {
	        	$choose_mode = $value;
	        }
	        $this->_mode = $choose_mode;
	    }else{
	    	$this->_mode = "6v6";
	    }
		
	}

	public function getmode(){
		return $this->_mode;
	}

	public function classe6v6(){
		echo '				
			<label class="btn btn-default spacebt">
		      <input type="radio" name="playerclasse" value="medic"> <img class="classe_icon" src="style/classes/medic.png" alt="">
		    </label>
		    <label class="btn btn-default spacebt">
		      <input type="radio" name="playerclasse" value="demo"> <img class="classe_icon" src="style/classes/demo.png" alt="">
		    </label>
		    <label class="btn btn-default spacebt">
		      <input type="radio" name="playerclasse" value="soldier"> <img class="classe_icon" src="style/classes/soldier.png" alt="">
		    </label>
		    <label class="btn btn-default spacebt">
		      <input type="radio" name="playerclasse" value="scout" > <img class="classe_icon" src="style/classes/scout.png" alt="">
		    </label>
		    <label class="btn btn-default spacebt">
		      <input type="radio" name="playerclasse" value="last" required > <img class="classe_icon" src="style/classes/last.png" alt="">
		    </label>';
	}

	public function classe9v9(){
		echo '				
			<label class="btn btn-default spacebt">
		      <input type="radio" name="playerclasse" value="medic"> <img class="classe_icon" src="style/classes/medic.png" alt="">
		    </label>
		    <label class="btn btn-default spacebt">
		      <input type="radio" name="playerclasse" value="demo"> <img class="classe_icon" src="style/classes/demo.png" alt="">
		    </label>
		    <label class="btn btn-default spacebt">
		      <input type="radio" name="playerclasse" value="soldier"> <img class="classe_icon" src="style/classes/soldier.png" alt="">
		    </label>
		    <label class="btn btn-default spacebt">
		      <input type="radio" name="playerclasse" value="scout" > <img class="classe_icon" src="style/classes/scout.png" alt="">
		    </label>
		    <label class="btn btn-default spacebt">
		      <input type="radio" name="playerclasse" value="spy" > <img class="classe_icon" src="style/classes/spy.png" alt="">
		    </label>
		    <label class="btn btn-default spacebt">
		      <input type="radio" name="playerclasse" value="engineer" > <img class="classe_icon" src="style/classes/engineer.png" alt="">
		    </label>
		    <label class="btn btn-default spacebt">
		      <input type="radio" name="playerclasse" value="heavy" > <img class="classe_icon" src="style/classes/heavy.png" alt="">
		    </label>
		    <label class="btn btn-default spacebt">
		      <input type="radio" name="playerclasse" value="pyro" > <img class="classe_icon" src="style/classes/pyro.png" alt="">
		    </label>
		    <label class="btn btn-default spacebt">
		      <input type="radio" name="playerclasse" value="sniper" > <img class="classe_icon" src="style/classes/sniper.png" alt="">
		    </label>
		    <label class="btn btn-default spacebt">
		      <input type="radio" name="playerclasse" value="last" required > <img class="classe_icon" src="style/classes/last.png" alt="">
		    </label>';
	}

	public function num6v6($nbd){
		if ($nbd < 2) {
	      echo '<td class="white"><span class="badge nbd">'.$nbd.'</span></td>';
	    }
	    if (($nbd > 1) && ($nbd < 3)) {
	      echo '<td class="nb1"><span class="badge nbd">'.$nbd.'</span></td>';
	    }
	    if (($nbd > 2) && ($nbd < 4)) {
	      echo '<td class="nb2"><span class="badge nbd">'.$nbd.'</span></td>';
	    }
	    if (($nbd > 3) && ($nbd < 5)) {
	      echo '<td class="nb3"><span class="badge nbd">'.$nbd.'</span></td>';
	    }
	    if (($nbd > 4) && ($nbd < 6)) {
	      echo '<td class="nb4"><span class="badge nbd">'.$nbd.'</span></td>';
	    }
	    if ($nbd > 5 ) {
	     echo '<td class="war"><span class="badge nbd">'.$nbd.'</span></td>';
	    }
	}

	public function num9v9($nbd){
		if ($nbd < 3) {
	      echo '<td class="white"><span class="badge nbd">'.$nbd.'</span></td>';
	    }
	    if (($nbd > 2) && ($nbd < 4)) {
	      echo '<td class="nb1"><span class="badge nbd">'.$nbd.'</span></td>';
	    }
	    if (($nbd > 3) && ($nbd < 6)) {
	      echo '<td class="nb2"><span class="badge nbd">'.$nbd.'</span></td>';
	    }
	    if (($nbd > 5) && ($nbd < 7)) {
	      echo '<td class="nb3"><span class="badge nbd">'.$nbd.'</span></td>';
	    }
	    if (($nbd > 6) && ($nbd < 9)) {
	      echo '<td class="nb4"><span class="badge nbd">'.$nbd.'</span></td>';
	    }
	    if ($nbd > 8 ) {
	     echo '<td class="war"><span class="badge nbd">'.$nbd.'</span></td>';
	    }
	}


}	

?>