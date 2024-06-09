<?php
namespace App\Controllers;

use Src\Classes\Render;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;

class ControllerHome extends Render{
	private $post;
	private $comment;
	private $user;
	private $response = [];

	public function __construct(){
		$this->post = new Post();
		$this->comment = new Comment();
		$this->user = new User();

		$this->setDir("home");
		$this->setTitle("Fórum de Discusão");
		$this->setDescription("Forum de noticias");
		$this->setKeywords("forum, notocias, debates");

		$this->renderView();
	}	
}
