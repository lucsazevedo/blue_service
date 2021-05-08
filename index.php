<?php
define("__PATHURL", "http://localhost/teste");

session_start();
$request = preg_replace("|/*(.+?)/*$|", "\\1", $_SERVER['REQUEST_URI']);
$uri = explode('/', $request);
$uri0 = 'publico';
$uri1 = 'index';

$pathName = 'blue_service';
if(!empty($uri[2])){
    $uri0 = $uri[2];
}

if(!empty($uri[3])){
    $uri1 = explode('?',$uri[3])[0];
}

if($uri0 == 'pedidos'){
    $uri0 = 'publico';
    $uri1 = 'getPedidos';
}

require_once "lib/Database.php";
require_once "controller/".ucfirst($uri0).".php";
require_once "model/".ucfirst($uri0)."Model.php";
$db = new Database();
$modelString = ucfirst($uri0)."Model";
$modelObject = ucfirst($uri0);
$model = new $modelString($db);
$controller = new $modelObject($model);

if ($uri0 && $uri1 && $uri1 === 'detail') {         // Detail
    $id = $_GET['id'];
    $controller->detail($id);
} elseif ($uri0 && $uri1 && $uri1 === 'edit') {     // Edit
    $id = $_GET['id'];
    $controller->edit($id);
} elseif ($uri0 && $uri1 && $uri1 === 'delete') {   // Delete
    $id = $_GET['id'];
    $controller->delete($id);
} elseif ($uri0 && $uri1 && $uri1 === 'create') {   // Create
    $controller->create();
} elseif($uri1 && $uri1 == 'addCarrinho'){
    $controller->addCarrinho();
} elseif($uri1 && $uri1 == 'finalizarcompra'){
    $controller->finalizarCompra();
} elseif($uri1 && $uri1 == 'getPedidos'){
    $controller->getPedidos();
}else {      
    $controller->index();
}