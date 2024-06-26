<?php
namespace Src\Classes;

use Src\Traits\TraitURL;

class Route{
	use TraitURL;

	private $route;

	public function getRoute(){
		$url = $this->url();

		$index = $url[0];

		$this->route = array(
			"" => "ControllerHome",
			"home" => "ControllerHome",
			"post" => "ControllerPost",
			"user" => "ControllerUser",
			"admin" => "ControllerAdmin",
			"login"=>"ControllerLogin",
			"about"=>"ControllerAbout",
			"operation"=>"ControllerUserCRUD"
		);

		
		if(array_key_exists($index,$this->route)){
			if(file_exists(DIRREQ."/App/Controllers/{$this->route[$index]}.php")){
				return $this->route[$index];
			}else{
				return "ControllerHome";
			}
		}else{
			return "ControllerHome";
		}

	}
}
