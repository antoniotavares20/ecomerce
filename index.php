<?php 

require_once("vendor/autoload.php");
//emprego somente dessa linha
use \Slim\Slim;
//emprego somente dessa classe
use \Hcode\Page;
//carrega as paginas desejadas
$app = new \Slim\Slim();
//recebe a configuração
$app->config('debug', true);
//determina a raiz das rotas
$app->get('/', function() {
//carregas a paginas
	//cria o construtor da pagina
    $page =  new Page();
//carrega a pagina desejada
    $page->setTpl("index");
});

$app->run();

 ?>