<?php 
namespace Src\Traits;

use \DateTime;

trait Implementation{
	private $date;
	protected $id_user = [];
	private $id_post;
	private $id_com;
	private $id_cat;
	private $content;
	private $data = [];


	public function get_date(){
		$this->date = new DateTime();
		return $this->date->format('Y-m-d H:i:s');
	}

	public function setUserId($id){
		$this->id_user = $id;
	
	}
	public function getUserId(){
		return $this->id_user;
	}

	public function setPostId($id){
		$this->id_post = $id;
	}
	public function getPostId(){
		return $this->id_post;
	}

	public function setComId($id){
		$this->id_com = $id;
	}
	public function getComId(){
		return $this->id_com;
	}

	public function setCatId($id){
		$this->id_cat = $id;
	}
	public function getCatId(){
		return $this->id_cat;
	}

	public function setContent($content){
		$this->content = $content;
	}
	public function getContent(){
		return $this->content;
	}

	public function setData(array$data){
		$this->data = $data;
	}
	public function getData():array{
		return $this->data;
	}
}
