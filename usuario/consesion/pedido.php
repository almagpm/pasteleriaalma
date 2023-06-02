<?php
require_once("controllers/pedido.php");
include("views/header.php");
include("views/menu.php");
$pedido -> validateRol('Usuario');
$action = (isset($_GET['accion']))? $_GET['accion'] : 'get';
switch($action){
    case 'get':
        default:
        $data = $pedido -> get($_SESSION['id_usuario']);
        $data_detalle = $pedido -> get_detalle($_SESSION['id_usuario']);
        include_once("views/pedido/index.php");
        break;
}
include("views/footer.php");
?>