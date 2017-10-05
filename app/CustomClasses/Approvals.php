<?php

namespace App\CustomInteraces;

use LeavesInterface;

class Approvals implements LeavesInterface{


	public $numOfDays;
	public $remainingVacationLeaves;

	public function __construct($numOfDays, $rem_vl ){
		$this->numOfDays = $numOfDays;
		$this->remainingVacationLeaves = $rem_vl;
	}

	public function RemainingLeaves(){
		return $this->remainingVacationLeaves = $this->remainingVacationLeaves - $this->numOfDays;		
	}
}

?>