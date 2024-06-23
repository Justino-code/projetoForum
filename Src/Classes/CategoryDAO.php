<?php
namespace Src\Classes;

use Src\Classes\Conexao;

class CategoryDAO extends Conexao{

	public function __construct(){
		parent::__construct(HOST,DB,USER,PWD);                                                  }
}
