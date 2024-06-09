<?php
namespace Src\Traits;

trait TVUser{
	public function validarNome($nome=null,$type = true):bool{
		if(!$nome){
			$nome  = $this->getNome();
		}
		if($type === false){
			$pattern = "/^[a-zA-Z\s]/i";
		}else{
			$pattern = "/^[a-zA-Z]+$/i";
		}
		
		if(preg_match($pattern,$nome)){                               return true;
                }else{
			return false;
		}
	}

	public function validarPassword():bool{
		$pass = $this->getPassword();

		$count = strlen($pass);
		$pattern = "/^[a-zA-Z0-9]/i";
		
		if($count > 8 && $count < 20 ){
			return true;
		}else{
			return false;
		}
	}
	
	public function validarEmail():bool{
		$email = $this->getEmail();
		$email = filter_var($email,FILTER_SANITIZE_EMAIL);
		$email = filter_var($email,FILTER_VALIDATE_EMAIL);
		return $email?true:false;
	}
}
