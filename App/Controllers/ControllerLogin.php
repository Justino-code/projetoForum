<?php
namespace App\Controllers;

use App\Models\User;

class ControllerLogin{
	private $user;
	private $response = [];

	public function __construct(){
		$this->user = new User();
	}

	public function login(){

		$data_login = json_decode(file_get_contents('php://input'),true);

		if(isset($data_login)){
			extract($data_login);
			$this->user->setEmail($email);
			$this->user->setPassword($password);
			if($this->user->verify_login()){
				$login = $this->user->login();
				if($login){
					$this->response["message"] = true;
				}else{
					$this->response['message'] = $this->displayErro();
				}
			}else{
				$this->response['message'] = $this->displayErro();
			}
		}else{
			$this->response['message'] = "Campos Vazio";
		}

		echo json_encode($this->response);
	}

	private function displayErro(){
		$erro = [];
		foreach($this->user->getErro() as $values){
			foreach($values as $key => $value){
				extract($value);
				
				if($nivel == 4){
					array_push($erro,$mesage);
				}
			}
		}

		return $erro;
	}
	
	public function register(){
		$response = [];
		$data_register = json_decode(file_get_contents('php://input'),true);

		if(isset($data_register)){
			extract($data_register);;
			if(isset($nome) && isset($sobrenome) && isset($email) && isset($password) && isset($confirm)){
				$this->user->setNome($nome);
				$this->user->setSobrenome($sobrenome);
				$this->user->setEmail($email);
				if($password == $confirm){
					$this->user->setPassword($password);
				}else{
					$this->response['message'] = 'senha diferente';
					echo json_encode($this->response);
					return false;
				}

				if($this->user->verify_register()){
					$register = $this->user->register();
					if($register){
						$this->response['message'] = true;
					}else{
						$this->response['message'] = $this->displayErro();
					}
				}else{
					$this->response['message'] = $this->displayErro();
				}
			}else{
				$this->response['message'] = $this->displayErro();
			}
		}else{
			$this->response['message'] = 'Campos vazios';
		}

		echo json_encode($this->response);
	}

	public function logout(){
		$this->user->logout();
	}	
}
