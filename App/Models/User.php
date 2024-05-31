<?php
namespace App\Models;

use Src\Classes\UserDAO;
use App\Models\Post;
use App\Models\Comment;
use Src\Traits\Implementation;

class User extends UserDAO{
	use Implementation;

	private $password;
	private $nome;
	private $sobrenome;
	private $alcunha;
	private $email;
	private $status;
	private $verify;
	private $last_login;
	private $phone_user;

	private $post;
	private $comment;

	public function getUserId(){
		return $this->id_user;
	}

	public function register($email){
		$this->insert($email);
	}

	public function remove_user($email):bool{
		$this->setUserId($email);
		$id = $this->getUserId();

		if(array_key_exists('id_user',$id)){
			$this->deleter($id['id_user']);
			return true;
		}else{
			$this->setErro('Erro! Usuário não existe');
			return false;
		}
	}

	public function update_user($email):bool{
		$this->setUserId($email);
                $id = $this->getUserId();                                                                       if(array_key_exists('id_user',$id)){
                        $this->update($id['id_user']);
			return true;
		}else{
                        $this->setErro('Erro! Usuário não existe');                                                     return false;
                }
	}

	public function select_user($email){
		$this->setUserId($email);
		$id = $this->getUserId();

		if(array_key_exists('id_user',$id)){
			$result = $this->select_complex($id['id_user']);
			return $result;
		}else{
                        $this->setErro('Erro! Usuário não existe');                                                     return false;
                }
	}

	public function login(){
		$email = $this->getEmail();
		$pass = $this->getPassword();

		$this->setUserData(['user_accounts'=>[':email',':password'],'identidade'=>[':nome']]);
		$user = $this->select_user($email);
		if($user){
			$user = call_user_func_array('array_merge',$user);

			$pass_verify = $this->pass_verify($pass, $user['password']);
			if($pass_verify == true && $user['email'] == $email && !isset($_SESSION['user_name'])){
				session_start();
				$this->setUserData(['user_accounts'=>[':last_login'=>$this->getLastLogin()]]);
				$this->update_user($email);
				$_SESSION['user_name'] = $user['email'];
				$_SESSION['user_id'] = $this->getUserId()['id_user'];
				$_SESSION['token'] = 1;
				$_SESSION['nome'] = $user['nome'];
				return true;
			}else{
				$this->setErro("Erro! Ao fazer login senha ou email errado");
				return false;
			}
		}else{
			$this->setErro("Erro! Ao  fazer login do usuário");
			return false;
		}
	}

	public function logout(){
		if(isset($_SESSION['token'])){
			//session_unset();
			session_write_close();
		}
	}

	public function createPost($id_user){
		$this->post;
	}

	public function comment(){
	
	}

	public function setPassword($pass){
		$this->password = $pass;
	}
	public function getPassword():string{
		return $this->password;
	}

	private function pass_verify($pass,$hash):bool{
		return password_verify($pass,$hash);
	}

	public function pass_generate($pass){
		return password_hash($pass,PASSWORD_DEFAULT);
	}
	public function setNome(string$nome){                       $this->nome = $nome;
	}
	public function getNome():string{                             return $this->nome;
	}
	public function setSobrenome(string$sobrenome){
		$this->sobrenome = $sobrenome;
	}                                               public function getSobrenome():string{                       return $this->sobrenome;
	}
	public function setAlcunha(string$alcinha){
		$this->alcunha = $alcunha;
	}
	public function getAlcunha():string{
		return $this->alcunha;
	}

	public function setEmail($email){
		$this->email = $email;
	}
	public function getEmail(){
		return $this->email;
	}

	public function setStatus(bool$status){
		$this->status = $status;
	}
	public function getStatus():bool{
		return $this->status;
	}

	public function setVerify(bool$v){
		$this->verify = $v;
	}
	public function getVerify():bool{
		return $this->verify;
	}

	public function setLastLogin($date){
		$this->last_login = $date;
	}
	public function getLastLogin(){
		return $this->last_login;
	}}
}
