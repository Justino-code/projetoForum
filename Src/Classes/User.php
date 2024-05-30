<?php
namespace Src\Classes;

use Src\Traits\TraitURL;

class User{
	protected $id;
	protected $nome = [];
	protected $email;
	protected $data_create;
	protected $data_update;
	protected $passwd;

	use TraitURL;
	protected function login($email,$pass):bool{
	
	}

	protected function register($user):bool{

	}

	protected function updatePerfil($user):bool{

	}

	protected function isActive():bool{
		return true;
	}

	//abstract protected function accessAdmin():bool;
	
	function __construct (){
		$url = $this->url();
		var_dump($url);	
		//print_r($url);
	}

	
}
