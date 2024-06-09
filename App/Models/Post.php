<?php
namespace App\Models;

use Src\Classes\PostDAO;
use Src\Traits\Implementation;

class Post extends PostDAO{
	use Implementation;
	private $title;
	private $categoria;

	public function save(){
		$this->insert();
	}

	public function delete_post(){
		return $this->deleter();
	
	}

	public function update_post(){
		return $this->update();
	}

	public function select_post($cond_pesq = null){
		return $this->select($cond_pesq);
	}

	public function setTitle($title){
		$this->title = htmlentities($title,ENT_QUOTES);
	}
	public function getTitle(){
		return $this->title;
	}
	public function setCat($id){
		$this->category = $id;
	}
	public function getCat(){
		return $this->category;
	}

	public function validate(){
		if(empty(trim($this->getTitle()))){
			return false;
		}

		else if(empty(trim($this->getContent()))){
			return false;
		}
		else if(empty(trim($this->getPostData()))){
			return false;
		}else{
			return true;
		}
	}
}
