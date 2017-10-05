<?php

namespace App\CustomClasses;

use App\CustomInterfaces\LeavesInterface;

class EmployeeSick implements LeavesInterface{


	public $numOfDays;
	public $remainingSickLeaves;

	public function __construct($numOfDays, $rem_sl){
		$this->numOfDays = $numOfDays;
		$this->remainingSickLeaves = $rem_sl;
	}

	public function RemainingLeaves(){
		return $this->remainingSickLeaves = $this->remainingSickLeaves - $this->numOfDays;		
	}
}

?>