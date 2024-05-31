<?php
namespace App\Models;

use Src\Classes\CommentDAO;
use Src\Traits\Implementation;

class Comment extends CommentDAO{
	use Implementation;

	public function comment(){
		return $this->insert();
	}

	public function delete_com(){
		return $this->deleter();
	}

	public function select_com(array$id=null){
		return $this->select($id);
	}

	public function update_com(){
		return $this->update();
	}

	public function validate(){
		if(empty(trim($this->getContent()))){
			return true;
                }
		else if(empty(trim($this->getData()))){
			return true;
		}else{
			return false;
		}
	}
}


