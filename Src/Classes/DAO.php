<?php
namespace Src\Classes;

use Src\Classes\Conexao;

class DAO extends Conexao{

	public function __construct(){
		parent::__construct(HOST,DB,USER,PWD);
	}

	protected function register($user){
		$sql = "";
	}

	protected function update($user){
	
	}

	protected function delete_($user){
	
	}
}
