<?php
namespace App\Models;

class Post{
	private $title;
	private $content;
	private $catrgoria;

	public function save(){
		$email = $this->getEmail();
		$this->setUserId($email);                       $id = $this->getUserId();
		$this->insert($id);
	}

	public function delete_post(){
		$email = $this->getEmail();
		$this->setUserId($email);
		$id = $this->getUserId();

		$this->deleter($id);
	
	}

	public function update_post(){
		$email = $this->getEmail();
		$this->setUserId($email);
		$id = $this->getUserId();

		$this->update($id);
	}

	public function select_post(){
		$email = $this->getEmail();
		$this->setUserId($email);
		$id = $this->getUserId();

		$this->select_complex($id);
	}
}
