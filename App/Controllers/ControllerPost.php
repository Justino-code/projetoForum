<?php
namespace App\Controllers;
header('Content-Type: application/json');

use App\Models\Post;

class ControllerPost{
	private $post;
	private $response = [];

	public function __construct(){
		$this->post = new Post();
	}

	public function getPost(){
		$this->post->setData(['post'=>['*']]);
		$post = $this->post->select_post();
		$id_post = [];
		$new_post = [];
		$posts = [];
		
		if($post){
			foreach($post as $key => $values){
				$id = array_shift($values);
				array_push($id_post,$id);
				array_push($new_post,$values);
			}

			$this->post->setData(['identidade'=>['nome']]);
			$ident = [];
			$id = [];
			$count = 0;
			foreach($new_post as $value){
				$count++;
				$i = ($value['id_user']);
				$id[':id_user'] = $i;
				$result = call_user_func_array('array_merge',$this->post->select($id));

				array_pop($value);
				array_pop($value);
				$p = array_merge($value,$result);
				$posts["post{$count}"] = $p;
			}
			
			$this->response = json_encode($posts);
		}else{
			$this->response['message'] = "Não existe nenhum post";
		}

		echo json_encode($this->response,JSON_FORCE_OBJECT);
	}

	public function post(){
		$data_post = json_decode(file_get_contents('php://input'));

		if(isset($data_post)){
			extract($data_post);

			if(isset($title) && isset($content) && isset($category)){
				$this->post->setTitle($title);
				$this->post->setContent($content);
				$this->post->setCat($category);
			
			}else{
				$this->response['message'] = "Valores não definidos";
			}

		}else{
			$this->response['message'] = "Campos vazios";
			$this->response['status'] = false;
		}

		echo json_encode($this->response);
	}

	public function savePost(){
		$data_post = json_decode(file_get_contents('php://input'),true);

		var_dump($data_post);

		if(isset($data_post)){
			extract($data_post);

			if(isset($title) && isset($content) && isset($category)){
				$this->post->setTitle($title);
				$this->post->setContent($content);
				$this->post->setCat($category);
				$this->post->setUserId($_SESSION['user_id']);
				if($this->post->validate()){
					$this->post->setData(['post'=>[':title'=>$this->post->getTitle(),':content'=>htmlentities($this->post->getContent()),':id_user'=>htmlentities($this->post->getUserId()),':id_cat'=>$this->post->getCat()]]);
					print_r($this->post->getData());
				}
			}
		}

	}
	
}
