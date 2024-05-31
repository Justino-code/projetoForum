<?php
namespace App\Models;

use Src\Classes\PostDAO;

class Post extends PostDAO{
	private $id_post;
	private $title;
	private $content;
	private $catrgoria;
	private $post_data = [];
	private $id_user;

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
	public function setContent($content){
		$this->content = $content;
	}
	public function getContent(){
		return $this->content;
	}

	public function setPostData(array$data){
		$this->post_data = $data;
	}
	public function getPostData(){
		return $this->post_data;
	}

	public function setPostId($id){
		$this->id_post = $id;
	}
	public function getPostId(){
		return $this->id_post;
	}

	public function setUserId($id){
		$this->id_user = $id;
	}
	public function getUserId(){
		return $this->id_user;
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
