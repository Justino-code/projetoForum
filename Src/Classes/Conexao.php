<?php
namespace Src\Classes;

use PDO;
use \PDOException;
use \Exception;

/**
 * abstract class
 * Classe CBD (ConexaoBancoDados) usa classe PDO
 *
 * Gerencia a conexão com o banco de dados e fornece métodos para executar consultas SQL.
 */
abstract class Conexao{
	private $con;
	private $result;

	/**
	 * @method construct
	 */
	public function __construct(string$host,string$db,string$user=null,string$pwd=null){
		try{
			$this->con = new PDO("mysql:host={$host};dbname={$db};charset=utf8",$user,$pwd,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

		}catch(\PDOException $e){
			$this->setErro("Erro ao se conectar com banco de dados código de erro [{$e->getCode()}]",UserDAO::NIVEL_CRITICAL);
			//exit;
		}
	}

	/**
	 *@param $sql recebe uma string com uma consulta sql
	 *@param $param recebe um array associativo contendo os parametros da consulta ex $param = ["nome" => "Justino"] ou $param = [$key => $value]
	 */
	protected function consulta(string$sql,array$param=null){
		try{
			$stm = $this->con;

			if (!$stm){
				$this->setErro('Erro! Objecto $pdo não foi inicializado. Verifique a sua conexão',UserDAO::NIVEL_CRITICAL);
				//echo 'Erro! obj nao foi inicializado';
				throw new \PDOException();
			}

			$std = $stm->prepare($sql);
			$ret = false;
			$count = 0;
			
			if ($param){
				$int_param = PDO::PARAM_INT;
				$str_param = PDO::PARAM_STR_CHAR;
				$key = array_keys($param);
				$value = array_values($param);
				for($i = 0; $i < count($param); $i++){
					if(is_int($value[$i])){
						$flag = $int_param;
					}else{
						$flag = $str_param;
				}
					$std->bindParam($key[$i],$value[$i],$flag);
					$count += 1;
					if($count == count($param)){
					
						$std->execute();
					}
				}
			}else{
				$std->execute();
		}
		
			$this->setResult($std);
			return true;

		}catch(\PDOException $e){
			$this->setErro("Erro ao fazer uma consulta sql, verifique o seu código sql. Código de erro [{$e->getCode()}]",UserDAO::NIVEL_ERROR);
			return false;
		}

	}

	private function setResult($result){
		$this->result = $result;
	}

       protected function getResult():bool|array{
		$result = $this->result;
		if ($result){
			return $result->fetchAll(PDO::FETCH_ASSOC);
		}else{
			return false;
		}
	}
	protected function iniciaTransacao(){
		return $this->con->beginTransaction();
	}
	protected function enviaTransacao(){
		return $this->con->commit();
	}
	protected function desfazTransacao(){
		return $this->con->rollBack();
	}
}
