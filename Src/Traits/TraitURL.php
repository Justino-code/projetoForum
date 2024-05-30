<?php
namespace Src\Traits;

trait TraitURL{
	protected function url(){
		$url = $_SERVER['REQUEST_URI'];

		if(substr($url,-1) != '/'){
			$url .= '/';
		}

		$url_parse = explode('/',rtrim($url),FILTER_SANITIZE_URL);

		array_shift($url_parse);
		array_shift($url_parse);
		array_pop($url_parse);

		if(!$url_parse){
			$url_parse = [""];
		}
		return $url_parse;
	}
}
