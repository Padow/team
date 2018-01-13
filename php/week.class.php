<?php
class Weeks{
	private $_weeks;
	private $_days;
	private $_day;

	/**
	* @param array() // $days_of_the_week = array(MONDAY, TUESDAY, WEDNESDAY, THURSDAY, FRIDAY, SATURDAY, SUNDAY); cste definie par la langue choisie
	* @return array() // key=> jourdelasemaine(selon la langue choisie) 10/08 value => date d/m/Y   
	*/
	public function __construct($days_of_the_week){
		for ($i=0; $i <21 ; $i++) { 
	    	$arr[$this->dayOfTheWeek(date('Y-m-d',strtotime('+'.$i.' days')), $days_of_the_week)] = date('d/m/Y',strtotime('+'.$i.' days')); 
	    }
	    $this->_weeks = $arr;
	}

	/**
	* traduit le jour de la semaine en fonction de la langue choisie
	* @param String, array()
	* @return String
	*/
	public function translated($dayToTranslate, $days_of_the_week){
		$dd = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');
		$frenchDay = str_replace($dd, $days_of_the_week, $dayToTranslate);
		$this->_days = $frenchDay;
		return $this->_days;
	}

	/**
	* @param String, Array()
	* @return String // exemple : lun 08/10
	*/
	public function dayOfTheWeek($tempDate, $days_of_the_week){
		$dayOfTheWeek =  date('D', strtotime( $tempDate));
		$dayOfTheWeek = $this->translated($dayOfTheWeek, $days_of_the_week);
		$date = $dayOfTheWeek.' '.date("d/m", strtotime($tempDate));
		$this->_day = $date;
		return $this->_day;
	}

	/**
	* retourne le jour de la semaine en français
	* @param String, Array()
	* @return String
	*/
	public function translatedfrfrom($toTranslate, $days_of_the_week){
		$days = array('Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim');
		$translatedDate = str_replace($days_of_the_week, $days, $toTranslate);
		return $translatedDate;


	}

	public function getWeeks(){
		return $this->_weeks;
	}
}
