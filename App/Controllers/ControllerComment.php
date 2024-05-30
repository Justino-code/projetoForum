<?php
namespace App\Controllers;

class ControllerComment{
	public function __construct(){
		echo __CLASS__;
	}

	public function tM(){
		echo "<br><br>metodo realmente existe<br><br>";
	}

	function soma($a,$b){
		echo $a+$b;
	}
}
