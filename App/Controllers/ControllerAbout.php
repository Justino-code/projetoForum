<?php
namespace App\Controllers;

use Src\Classes\Render;

class ControllerAbout extends Render{
	public function __construct(){
		$this->setDir('about');
                $this->setTitle("Sobre o Fórum de Discusão");
                $this->setDescription("Forum de Debates");
                $this->setKeywords("forum, notocias, debates");

                $this->renderView();
	}
}
