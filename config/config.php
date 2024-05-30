<?php
$pasta_interna = "APLP";

//configurações de caminhos de directorios

define('DIRPAGE',"http://{$_SERVER['HTTP_HOST']}/{$pasta_interna}");
if(substr($_SERVER['DOCUMENT_ROOT'],-1) === '/'){
	define('DIRREQ',"{$_SERVER['DOCUMENT_ROOT']}{$pasta_interna}");
}else{
	define('DIRREQ',"{$_SERVER['DOCUMENT_ROOT']}/{$pasta_interna}");
}

//Configurações de banco de dados
define('HOST','127.0.0.1');
define('DB','FORUM');
define('USER','justino');
define('PWD','16242324');
