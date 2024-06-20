<?php
namespace App\Controllers;

use Src\Classes\Render;
use App\Models\User;

class ControllerUser extends Render{
	private $user;

	public function __construct(){
		$this->user = new User();
		$this->setDir('user');
		$this->setTitle('Perfil do Usuário');
		$this->setDescription('');
		$this->setKeywords('');

		$this->getInfo();

		$this->renderView();
	}

	private function getInfo(){
		$status = ['bloqueda','inativa','activa','suspensa','restrita'];
		$verify = ['Não verificada','Verificada'];
		$notify = ['Não','Sim'];
		if(isset($_SESSION['user_name'])){
			$this->user->setData(['user_accounts'=>['email','create_date','update_date','status','telefone','last_login','verify','post_notify'],'identidade'=>['nome','sobrenome','alcunha','foto_perfil','date_of_birth']]);
			$info = call_user_func_array('array_merge',$this->user->select_user($_SESSION['user_email']));
			if($info){
				if($info['status'] >= 0){
					$info ['status'] = $status[$info['status']];
				}
				if($info['post_notify'] >= 0){
					$info['post_notify'] = $notify[$info['post_notify']];
				}

				if($info['verify'] >= 0){
					$info['verify'] = $verify[$info['verify']];
				}
				foreach($info as $key => $value){
					$keys = strtoupper($key);
					if($value !== null){
						define($keys,$value);
					}else{
						define($keys,"");
					}
				}
			}
		}
	}
}
