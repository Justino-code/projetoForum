<?php
namespace App\Controllers;

use App\Models\User;

class ControllerUserCRUD{
	private $user;
	private $response = [];

	public function __construct(){
		$this->user = new User();
	}

	public function remove(){
		$result = $this->user->remove_user($_SESSION['user_email']);
		if($result){
		$this->response['status'] = true;
		$this->response['message'] = 'A sua conta foi removida com sucesso';
		$this->user->logout();
		}else{
			$this->response['message'] = "Não foi possível eliminar esta conta";
			$this->response['status'] = false;
		}

		echo json_encode($this->response);
	}

	public function update(){
		$data = json_decode(file_get_contents('php://input'),true);

		if(isset($data)){
			extract($data);
			if(isset($email)){
				$this->user->setEmail($email);
			}
			if(isset($nome)){
				$this->user->setNome($nome);
			}
			if(isset($sobrenome)){
				$this->user->setSobrenome($sobrenome);
			}
			if(isset($alcunha)){
				$alcunha = htmlentities($alcunha);
				$this->user->setAlcunha($alcunha);
			}
			if(isset($password) && isset($confirm)){
				if($password === $confirm){
					$this->user->setPassword($password);
				}else{
					$this->response['status'] = false;
					$this->response['message'] = "palavra passe diferente";
				}
			}
			if(isset($birth)){
				$this->user->setDateOfBirth($birth);
			}

			if($this->user->verify_update()){
				$nome = $this->user->getNome();
				$email = $this->user->getEmail();
				$sobrenome = $this->user->getSobrenome();
				$alcunha = $this->user->getAlcunha();
				$password = "";
				
				$date_of_birth = $this->user->getDateOfBirth();
				if(!empty($date_of_birth)){
					$date_of_birth = $date_of_birth->format('Y-m-d');
				}
				
				if($this->user->getPassword()){
					$password = $this->user->pass_generate();
				}
				
				$data_update = ['user_accounts'=>[':email'=>$email,':password'=>$password],'identidade'=>[':nome'=>$nome,':sobrenome'=>$sobrenome,':alcunha'=>$alcunha,':date_of_birth'=>$date_of_birth]];

					$data_update_filtered = $this->user->removeEmptyElements($data_update);

					$this->user->setData($data_update_filtered);
				}

				$result = $this->user->update_user($_SESSION['user_email']);

				if($result){
					$this->response['status'] = true;
					$this->response['message'] = "Dados actualizados com sucesso";
				}else{
					$this->response['status'] = false;
					$this->response['message'] = $this->user->displayErro();
				}
			}else{
				$this->response['status'] = false;
				$this->response['message'] = "Dados Encorretos";
			}
		/*}else{
			$this->response['status'] = false;
			$this->response['message'] = "Sem dados para actualizar";
			}*/

		echo json_encode($this->response);
	}

	public function notify(){
		$data = json_decode(file_get_contents('php://input'),true);

		if(isset($data)){
			extract($data);

			if(isset($status)){
				$this->user->setData(['user_accounts'=>[':post_notify'=>$status]]);
				$result = $this->user->update_user($_SESSION['user_email']);
				if($result){
					$this->response['status'] = true;
		}else{
			$this->response['status'] = false;
		}
			}
		}
	}

	public function  notice(){
		$nome = $_SESSION['user_name'];
		$this->response['message'] = 
			<<<EOT
<h3>Por que você não deve remover sua conta</h3>

<p>Olá, $nome. Entendemos que você pode estar considerando remover sua conta em nosso fórum. No entanto, queremos persuadi-lo a reconsiderar essa decisão.</p>

<p>Nosso fórum é uma comunidade vibrante e diversa, e sua participação é essencial para mantê-la ativa e engajada. Sua perspectiva única, conhecimento e interações enriquecem os debates e ajudam outros membros a aprender e crescer.</p>

<p>Além disso, sua conta contém um histórico valioso de suas contribuições e interações ao longo do tempo. Esse registro é importante não apenas para você, mas também para a comunidade como um todo, pois permite que outros vejam sua evolução e apreciem sua valiosa participação.</p>

<p>Portanto, encorajamos você a manter sua conta ativa e continuar a participar de nosso fórum. Sua presença é apreciada e faz uma diferença real. Se você tiver alguma preocupação ou sugestão, ficaremos felizes em ouvi-las e trabalhar junto com você para melhorar sua experiência.</p>

<p>Agradecemos sua consideração e esperamos que você fique conosco por muito tempo.</p>

<p>Atenciosamente,
A equipe do fórum</p>
EOT;
		echo json_encode($this->response);

	}
}
