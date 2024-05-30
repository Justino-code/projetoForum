<?php
namespace Src\Traits;

trait TErro{
	private $erro = [];
	protected const NIVEL_CRITICAL = 0;
	protected const NIVEL_ERROR = 1;
	protected const NIVEL_WARNING = 2;
	protected const NIVEL_DEBUG = 3;
	protected const NIVEL_INFO = 4;


	protected function setErro($msg,$nivel= self::NIVEL_INFO){
		$erro = ['erro'=>['mesage'=>$msg,'nivel'=>$nivel]];
		array_push($this->erro,$erro);
	}

	public function getErro():array{
		return $this->erro;
	}
}
