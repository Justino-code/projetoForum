<?php
namespace App\Controllers;

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

	public function register(){
		$data = $_POST;
		extract($data);
		$this->user->setNome($nome);
		$this->user->setSobrenome($sobrenome);

		echo $nome.'<br>'.$sobrenome;

		//print_r($_POST);
		//echo '<br> Ola estou aqui';
	}
}
