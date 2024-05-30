<?php
namespace App\Controllers;

use Src\Classes\Render;

class ControllerHome extends Render{
	public function __construct(){
		$this->setDir("home");
		$this->setTitle("Fórum de Discusão");
		$this->setDescription("Forum de noticias");
		$this->setKeywords("forum, notocias, debates");

		$this->renderView();
	}

	public function register(){
		echo __FUNCTION__;
	}
}
