<?php
namespace App\Controllers;

use App\Models\User;

class ControllerAdmin{
	private $user;

	public function __construct(){
		$this->user = new User();
	}

	public function getUser(){
		$this->user->setData(['user_accounts'=>[':email',':nome']]);
		$result = $this->user->getAllUser();
		var_dump($result);
	}
}
