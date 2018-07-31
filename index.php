<?php 
session_start();
require_once("vendor/autoload.php");
use \Slim\Slim;
use \Hcode\Page;
use \Hcode\PageAdmin;
use \Hcode\Model\User;


$app = new Slim();
$app->config('debug', true);
$app->get('/', function() {
   
	$page = new Page();
	$page->setTpl("index");
});

$app->get('/admin', function() {
    User::verifyLogin();
	$page = new PageAdmin();
	$page->setTpl("index");
});

$app->get('/admin/login', function() {
	$page = new PageAdmin([
		"header"=>false,
		"footer"=>false
	]);
	$page->setTpl("login");
});


$app->post('/admin/login', function() {
	User::login($_POST["login"], $_POST["password"]);
	header("Location: /admin");
	exit;
});

$app->get('/admin/logout', function() {
	User::logout();
	header("Location: /admin/login");
	exit;
});

//lista todos os usuarios
$app->get('/admin/users', function() {
//verificar se o usuario esta logado e possue acesso adem
	USER::verifyLogin();
	$users = User::listAll();
	$page = new PageAdmin();
	$page->setTpl("users",array(
		"users"=>$users
	));
});



/*$app->get('/admin/users/:iduser', function() {
	USER::verifyLogin();
	$users = Users::listALL();
	$page = new PageAdmin();
	$page->setTpl("users",array(
		"users"=>$users
	));
});
*/

//
$app->get("/admin/users/create", function() {
	User::verifyLogin();
	$user = new User();
	$user->setTpl("users-create");
	$_POST["inadimin"] = (isset($_POST["inadimin"]))?1:0;
	$user->setData($_POST);
	$user->save();
	header("Location: /admin/users");
		exit;
});	


//a ordem das rotas interferem nas regras de funcionamento
//o slin não recebe o metodo delete so via post
$app->get("/admin/users/delete/:iduser", function($iduser){
	USER::verifyLogin();
	//carregar usuario para verificar se ele existe;
	$user = new User();
	$user->get((int)$iduser);
	$user->delete();
	header("Location: /admin/users");
	exit;
	
});

//
$app->get("/admin/users/update/:iduser", function() {
	User::verifyLogin();
	$user = new User();
	$user->get((int)$idusers);
	$page = new PageAdmin();

	$page->setTpl("users-update", array(
		"user"=>$user->getValues()
	));
	$page->setTpl("users-update");


});




$app->post("/admin/users/:iduser", function($iduser){
	USER::verifyLogin();	

	$user = new User();
	$user->get((int)$iduser);
	$user->setData($_POST);
	$_POST["inadimin"] = (isset($_POST["inadimin"]))?1:0;

	$user->update();
	header("Location: /admin/users");
	
	exit;
});

$app->run();
 ?>