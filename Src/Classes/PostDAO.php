<?php
namespace Src\Classes;

use \PDOException;

use Src\Classes\Conexao;
use Src\Traits\TErro;

abstract class PostDAO extends Conexao{
	use TErro;

	//protected $id_post = [];

	public function __construct(){
		parent::__construct(HOST,DB,USER,PWD);
	}

	protected function insert():bool{
		try{
			$this->iniciaTransacao();
			$entidade = $this->getData();
			$keys = array_keys($entidade);
			for($i = 0; $i < count($entidade); $i++){
				$key = $keys[$i];
				$param = array_keys($entidade[$key]);
				$param = implode(',',$param);
				$atr = str_replace(':','',$param);
				$sql = "INSERT INTO {$key} ({$atr}) VALUES({$param})";

				$consulta = $this->consulta($sql,$entidade[$key]);

				if(!$consulta){
					throw new PDOException();
				}
			}
			
			$this->enviaTransacao();
			return true;
	}catch(\PDOException $e){
		$this->desfazTransacao();
		$this->setErro("Erro! nao foi possível salvar post");
			return false;
		}
	}

	public function select($id=null):array|bool{
		try{
			$entidade = $this->getData();
			foreach($entidade as $key => $values){
				$param = array_values($values);
				$param = implode(',',$values);
				$atr = str_replace(':','',$param);

				$consulta;

				if($id){
					$cond_pesq = implode('',array_keys($id));
					$cond = str_replace(':','',$cond_pesq);
					$sql = "SELECT {$atr} FROM {$key} WHERE {$cond} = {$cond_pesq}";
					$consulta = $this->consulta($sql,$id);
				}else{
					$sql = "SELECT {$atr} FROM {$key}";
					$consulta = $this->consulta($sql);
				}
				if(!$consulta){
					throw new PDOException();
				}else{
					return $this->getResult();
					}
			}
		return false;	
		
		}catch(PDOException $e){
			$this->setErro("Erro! ao selecionar posts {$e->getMessage()}");
			return false;
		}
	}

	protected function update():bool{
		try{
			$this->iniciaTransacao();
			$entidade = $this->getData();
			$column = [];
			foreach($entidade as $key => $values){
				$keys = array_keys($values);
				for($i = 0; $i < count($values); $i++){
					$value = str_replace(':','',$keys[$i]).'='.$keys[$i];
					array_push($column,$value);
				}
				$values[':id_post'] = $this->getPostId();
				$values[':id_user'] = $this->getUserId();
				$column_str = implode(',',$column);
				$sql = "UPDATE {$key} SET {$column_str} WHERE id_post = :id_post AND id_user = :id_user";
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
			$this->setErro('Erro! na actualização do post');
			return false;
		}
	}

	protected function deleter():bool{
		try{
			$id_post = $this->getPostId();
			$id_user = $this->getUserId();
			$sql = "DELETE FROM post WHERE id_post = :id_post AND id_user = :id_user";
			$consulta = $this->consulta($sql,[':id_post'=>$id_post,':id_user'=>$id_user]);
			if(!$consulta){
				throw new PDOException();
			}else{
				return true;
			}
		}catch(\PDOException $e){
			$this->setErro('Erro! ao remover o post');
			return false;
		}
	
	}
	/*

	protected function setPostId($email){
		$sql = "SELECT id_user FROM user_accounts WHERE email = :email";
		$param = [':email'=>$email];

		$this->consulta($sql,$param);
		if($this->getResult()){
			$this->id_post = call_user_func_array('array_merge',$this->getResult());
		}
	}*/
}
