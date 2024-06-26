<?php
namespace App\Models;

session_start();

use Src\Classes\UserDAO;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;

use Src\Traits\Implementation;
use Src\Traits\TVUser;
use Src\Traits\Utils;

class User extends UserDAO{
	use Implementation;
	use TVUser;
	use Utils;

	private $password;
	private $nome;
	private $sobrenome;
	private $alcunha;
	private $email;
	private $status;
	private $verify;
	private $last_login;
	private $phone_user;
	private $date_of_birth;

	protected $post;
	protected $comment;
	protected $category;

	public function __construct(){
		parent::__construct();
		$this->post = new Post();
		$this->comment = new Comment();
		$this->category = new Category();
	}

	public function register(int$type=1){
		$this->setData(['user_accounts'=>[':email'=>$this->getEmail(),':user_type'=>$type,':create_date'=>$this->get_date(),':update_date'=>$this->get_date(),':password'=>$this->pass_generate()],'identidade'=>[':nome'=>$this->getNome(),':sobrenome'=>$this->getSobrenome()]]);

		$result = $this->insert();
		if($result){
			return true;
		}else{
			return false;
		}
	}


	public function remove_user($email):bool{
		$this->setUId($email);
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
		$this->setUId($email);
		$id = $this->getUserId();
		
		if(array_key_exists('id_user',$id)){
			$result = $this->update($id['id_user']);
			if($result)
				return true;
			else{
				return false;
			}
		}else{
                        $this->setErro('Erro! Usuário não existe');                                                     return false;
                }
	}

	public function select_user($email){
		$this->setUId($email);
		$id = $this->getUserId();

		if(array_key_exists('id_user',$id)){
			$result = $this->select_complex($id['id_user']);
			return $result;
		}else{
                        //$this->setErro('Erro! Usuário não existe');                                                     return false;
                }
	}

	public function login(){
		$email = $this->getEmail();
		$pass = $this->getPassword();

		$this->setData(['user_accounts'=>[':email',':password'],'identidade'=>[':nome']]);
		$user = $this->select_user('jkotingo0@gmail.com');

		if($user){
			$user = call_user_func_array('array_merge',$user);

			$pass_verify = $this->pass_verify($pass, $user['password']);
			if($pass_verify == true && $user['email'] == $email && !isset($_SESSION['user_email'])){
				$_SESSION['user_email'] = $user['email'];
				$_SESSION['user_id'] = $this->getUserId()['id_user'];
				$_SESSION['token'] = bin2hex(random_bytes(16));
				$_SESSION['user_name'] = $user['nome'];
				return true;
			}else{
				$this->setErro("Erro! Senha ou Email errado");
				return false;
			}
		}else{
			$this->setErro("Erro! Ao  fazer login do usuário");
			return false;
		}
	}

	public function verify_login(){
		if(!empty(trim($this->getEmail())) && !empty(trim($this->getPassword()))){
			if(!$this->validarEmail()){
				$this->setErro('Email do usuário não corespondem ao formato pedido');
				return false;
			}
			else if(!$this->validarPassword()){
				$this->setErro('Senha Tem que tem no mínimo 8 caracteres com letras e números. Ex: 1233aff2');
				return false;
			}else{
				return true;
			}
		}else{
			$this->setErro('Os dados do usuário estão vazio');
			return false;
		}
	}

	public function logout(){
		if(isset($_SESSION['token'])){
			$email = $_SESSION['user_email'];
			$this->setLastLogin($this->get_date());
			$this->setData(['user_accounts'=>[':last_login'=>$this->getLastLogin()]]);                                                                      $this->update_user($email);
			session_unset();
		}
	}

	public function verify_register(){
		if(!empty(trim($this->getEmail())) && !empty(trim($this->getNome())) && !empty(trim($this->getSobrenome())) && !empty(trim($this->getPassword()))){
			if(!$this->validarNome()){
				$this->setErro('Nome do usuario não corresponde ao formato esperado. O nome deve ter apenas letras');
				return false;
			}
			else if(!$this->validarNome($this->getSobrenome())){
				$this->setErro('Sobrenome do usuario não corresponde ao formato esperado. O sobrenome deve ter apenas letras');
				return false;
			}
			else if(!$this->validarEmail()){
				$this->setErro('Email invalido!');
				return false;
			}
			else if(!$this->validarPassword()){
				$this->setErro('Senha não corresponde ao formato esperado');
				return false;
			}else{
				return true;
			}
		}else{
			$this->setErro('Os dados do usuário estão vazios');
			return false;
		}
	}

	public function verify_update(){
		$count = 0;
		if(!empty($this->getNome())){
			if(!$this->validarNome()){
				$this->setErro('Nome do usuario não corresponde ao formato esperado. O nome deve ter apenas letras');
				return false;
			}else{
				$count +=1;
			}
		}
		
		if(!empty($this->getSobrenome())){
			if(!$this->validarNome($this->getSobrenome())){
				$this->setErro('Sobrenome do usuario não corresponde ao formato esperado. O sobrenome deve ter apenas letras');
				return false;
			}else{
				$count +=1;
			}
		}
		
		if(!empty($this->getPassword())){
			if(!$this->validarPassword()){
				$this->setErro('Senha não corresponde ao formato esperado');
				return false;
			}else{
				$count +=1;
			}
		}
		if(!empty($this->getAlcunha()) || !empty($this->getDateOfBirth())){
			return true;
		}
		
		if($count > 0){
			return true;
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
	public function getPassword(){
		return $this->password;
	}

	private function pass_verify($pass,$hash):bool{
		return password_verify($pass,$hash);
	}

	public function pass_generate(){
		return password_hash($this->getPassword(),PASSWORD_DEFAULT);
	}
	public function setNome(string$nome){
		$this->nome = $nome;
	}
	public function getNome(){
		return $this->nome;
	}
	public function setSobrenome(string$sobrenome){
		$this->sobrenome = $sobrenome;
	}                                               public function getSobrenome(){
		return $this->sobrenome;
	}
	public function setAlcunha(string$alcunha=""){
		$this->alcunha = $alcunha;
	}
	public function getAlcunha(){
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
	}

	public function setDateOfBirth($date){
		$this->date_of_birth = new \DateTime($date);
	}
	public function getDateOfBirth(){
		return $this->date_of_birth;
	}


	public function displayErro(){
		
		$erro = [];
		foreach($this->getErro() as $values){
			foreach($values as $key => $value){
				extract($value);
				
				if($nivel == 4){
					array_push($erro,$mesage);
				}
			}
		}
		
		return $erro;
	}


	public function getAllUser($cond_pesq=null){
		$this->select_all($cond_pesq);

		print_r($this->getErro());
	}
}
