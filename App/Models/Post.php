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
		$this->title = $title;
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
			return true;
		}

		else if(empty(trim($this->getContent()))){
			return true;
		}
		else if(empty(trim($this->getPostData()))){
			return true;
		}else{
			return false;
		}
	}
}
