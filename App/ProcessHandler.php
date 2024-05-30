<?php
namespace App;

use Src\Classes\Route;
use \Exception;
use \Throwable;

class ProcessHandler extends Route{
	private $obj;
	private $method;
	private $param = [];
	private $route;

	public function __construct(){
		$this->route = $this->url();
		self::add_controller();
	}

	public function add_controller(){
		$controller = $this->getRoute();
		$classController = "App\\Controllers\\{$controller}";
		$this->obj = new $classController;
		if(isset($this->route[1])){
			self::add_method();
		}
	}

	public function add_method(){
		$method = $this->route[1];
		if(method_exists($this->obj,$method)){
			$this->setMethod($method);
			self::add_param();
			try{

				call_user_func_array([$this->obj,$this->getMethod()],$this->getParam());
			}catch(\Throwable $e){
				echo '<br>erro!<br>'.$e->getMessage();
			}
		}	
	}

	public function add_param(){
		$param = $this->route;

		if(isset($param[2])){
			array_shift($param);
			array_shift($param);

			$this->setParam($param);
		}
	}

	public function setMethod($method){
		$this->method = $method;
	}

	protected function getMethod():string{
		return $this->method;
	}

	public function setParam($param){
		$this->param = $param;
	}

	protected function getParam():array{
		return $this->param;
	}
}
