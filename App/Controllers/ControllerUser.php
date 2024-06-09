<?php
namespace App\Controllers;
header('Content-Type: application/json');

use Src\Classes\Render;
use App\Models\User;

class ControllerUser extends Render{
	private $user;

	public function __construct(){
		$this->user = new User();
		$this->setDir('user');
		$this->setTitle('Justino');
		$this->setDescription('');
		$this->setKeywords('');

		$this->renderView();
	}
}
