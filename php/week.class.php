<?php
class Weeks{
	private $_weeks;
	private $_days;
	private $_day;

	public function __construct(){
		for ($i=0; $i <21 ; $i++) { 
	    	$arr[$this->dayOfTheWeek(date('Y-m-d',strtotime('+'.$i.' days')))] = date('d/m/Y',strtotime('+'.$i.' days')); 
	    }
	    $this->_weeks = $arr;
	}

	public function translated($dayToTranslate){
		$dd = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');
		$jj = array('Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim');
		$frenchDay = str_replace($dd, $jj, $dayToTranslate);
		$this->_days = $frenchDay;
		return $this->_days;
	}

	public function dayOfTheWeek($tempDate){
		$dayOfTheWeek =  date('D', strtotime( $tempDate));
		$dayOfTheWeek = $this->translated($dayOfTheWeek);
		$date = $dayOfTheWeek.' '.date("d/m", strtotime($tempDate));
		$this->_day = $date;
		return $this->_day;
	}

	public function getWeeks(){
		return $this->_weeks;
	}
}
?>