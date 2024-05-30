<?php
require_once('../Src/vendor/autoload.php');
require_once('../config/config.php');

use App\ProcessHandler;
use App\Models\User;
use App\Models\Post;

$c = new Post();

$c->save();

//$ph = new ProcessHandler();
//
/*$s = new User();
$s->setEmail('jk6@gmail.com');
//$s->getId();

//$s->setIdentidade([':nome'=>"justino6",":sobrenome"=>"kotingo5", ":alcunha"=>"sedrik2",":foto_perfil"=>"perfil3.png"]);

$s->setUserData(['user_accounts'=>[':email'=>$s->getEmail(),':create_date' => '2021/12/06',':update_date'=>'2020/12/07'],/*'identidade'=>[':nome'=>'Justino',':sobrenome'=>'Kotingo'],'password'=>[':password'=>'16242324',':salt'=>'1010']*/]);
//print_r($s->getIdentidade());

//$s->setUserData(['user_accounts'=>[':email',':status']]);
//$s->register();
//$user = $s->select_user([':id_user'=>5]);

//$s->update_user(88);
//$s->remove_user($s->getEmail());
//$s->register();
//print_r($user);
//print_r($s->getResult());
//
//$a = $s->select_user($s->getEmail());

//print_r($a);
/*
$s->setPassword("16242324");
$data = new DateTime();
$data = $data->format('Y/m/d H:i:s');

$s->setLastLogin($data);

$s->login();
if($s->getErro()){
	print_r($s->getErro());
}

//echo ($_SESSION['user_id']);
//echo session_status();

$s->logout();
echo $s->pass_generate($s->getPassword());
//
//$data = new DateTime();

//$data = $data->format('Y-m-d H:i:s');
//echo $s->getLastLogin();

//echo $_SESSION['user_id'];

//use Src\Classes\User;
//use Src\Classes\Route;

//$route = new Route();

//$r = $route->getRoute();

//echo $r;

//$user = new User();

//$url = $_SERVER['REQUEST_URI'];

//echo $url;
//echo DIRPAGE.'<br>';
//echo DIRREQ;
//echo 'Ola'.$url;//$_GET['url'];
