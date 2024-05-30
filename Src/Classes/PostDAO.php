<?php
namespace Src\Classes;

use \PDOException;

use Src\Classes\Conexao;
use Src\Traits\TErro;

abstract class PostDAO extends Conexao{
	use TErro;

	protected $id_post = [];

	public function __construct(){
		parent::__construct(HOST,DB,USER,PWD);
	}

	protected function insert($email):bool{
		try{
			$this->iniciaTransacao();
			$entidade = $this->getUserData();
			$keys = array_keys($entidade);
			for($i = 0; $i < count($entidade); $i++){
				$key = $keys[$i];
				$param = array_keys($entidade[$key]);
				$param = implode(',',$param);
				$atr = str_replace(':','',$param);
				$sql = "INSERT INTO {$key} ({$atr}) VALUES({$param})";
				$consult;

				if($key != "user_accounts"){
					$this->setUserId($this->getEmail());
					$id = $this->getUserId()['id_user'];
					$new_entidade =  array_merge($entidade[$key],[':id_user'=>$id]);
					$param = array_keys($new_entidade);                                                           $param = implode(',',$param);                                                                   $atr = str_replace(':','',$param);

					$sql = "INSERT INTO {$key} ({$atr}) VALUES({$param})";

					$consulta = $this->consulta($sql,$new_entidade);
				}else{
					$consulta = $this->consulta($sql,$entidade[$key]);
				}
				if(!$consulta){
					throw new PDOException();
				}
			}
			
			$this->enviaTransacao();
			return true;
	}catch(\PDOException $e){
		$this->desfazTransacao();
		$this->setErro("Erro! nao foi possovel registar");
			return false;
		}
	}

	protected function select($id_user):array|bool{
		try{
			$entidade = $this->getUserData();
			foreach($entidade as $key => $values){
				$param = array_values($values);
				$param = implode(',',$values);
				$atr = str_replace(':','',$param);
				$cond_pesq = implode('',array_keys($id_user));
				$cond = str_replace(':','',$cond_pesq);

				$sql = "SELECT {$atr} FROM {$key} WHERE {$cond} = {$cond_pesq}";
				$consulta = $this->consulta($sql,$id_user);
				if(!$consulta){
					throw new PDOException();
				}else{
					return $this->getResult();
					}
			}	
		
		}catch(PDOException $e){
			$this->setErro("Erro! ao selecionar usuario {$e->getMessage()}");
			return false;
		}
	}

	function select_complex($id_user){
		try{
			$elements = $this->getUserData();
			$key = array_keys($elements);
			$entidade = implode(',',$key);
			$param = [];
			foreach($elements as $value){
				$keys = array_values($value);
				array_push($param,$keys);
			}
			
			$atr = call_user_func_array('array_merge',$param);
			$atr = implode(',',$atr);
			$atr = str_replace(':','',$atr);
			$sql = "SELECT {$atr} FROM {$entidade} WHERE post.id_post = :id_post";
			$consulta = $this->consulta($sql,[':id_post'=>$id_user]);
			if(!$consulta){
				throw new PDOException();
			}else{
				return $this->getResult();
			}
		}catch(\PDOException $e){
			$this->setErro('Erro! Aobuscar');
			return false;
		}
	}

	protected function update(int$id_user):bool{
		try{
			$this->iniciaTransacao();
			$entidade = $this->getUserData();
			$column = [];
			foreach($entidade as $key => $values){
				$keys = array_keys($values);
				for($i = 0; $i < count($values); $i++){
					$value = str_replace(':','',$keys[$i]).'='.$keys[$i];
					array_push($column,$value);
				}
				$values[':id_post'] = $id_user;
				$column_str = implode(',',$column);
				$sql = "UPDATE {$key} SET {$column_str} WHERE id_post = :id_post";
				$consulta = $this->consulta($sql,$values);
				if(!$consulta){
					throw new PDOException();
				}else{
					$this->enviaTransacao();
					return true;
				}
			}
		}catch(\PDOException $e){
			$this->desfazTransacao();
			$this->setErro('Erro! na actualização do usuário');
			return false;
		}
	}

	protected function deleter($id_ppst):bool{
		try{
			$sql = "DELETE FROM user_accounts WHERE id_post = :id_post";
			$consulta = $this->consulta($sql,[':id_post'=>$id_post]);
			if(!$consulta){
				throw new PDOException();
			}else{
				return true;
			}
		}catch(\PDOException $e){
			$this->setErro('Erro! ao remover o comentario');
			return false;
		}
	
	}

	protected function setPostId($email){
		$sql = "SELECT id_user FROM user_accounts WHERE email = :email";
		$param = [':email'=>$email];

		$this->consulta($sql,$param);
		if($this->getResult()){
			$this->id_post = call_user_func_array('array_merge',$this->getResult());
		}
	}
}
