<?php
/**
 * Enrutador departamento
 */
require_once("controllers/personalizado.php");
require_once('controllers/localidad.php');
require_once('controllers/usuario.php');
include_once('views/header.php');
include_once('views/menu.php');
$localidad -> validateRol('Usuario');
$action = (isset($_GET['action'])) ? $_GET['action'] : 'get';
$id = (isset($_GET['id'])) ? $_GET['id'] : null;
switch ($action) {
    case 'new':
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $cantidad = $carrito->new($data);
            if ($cantidad) {
                $carrito->flash('success', "Registro dado de alta con éxito");
                $data = $carrito->get();
                include('views/carrito/index.php');
            } else {
                $carrito->flash('danger', "Algo salió mal.");
                include('views/carrito/form.php');
            }
        } else {
            include('views/carrito/form.php');
        }
        break;
    case 'mostrar':
            $data = $personalizado-> get($_SESSION['id_usuario']);
            include_once("views/personalizado/mostar.php");
            break;
    case 'new':
    default:
            $datatamaño= $personalizado->getTamaño();
            $databizcocho= $personalizado->getBizcocho();
            $datarelleno= $personalizado->getRelleno();
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $datau = $usuario->get($_SESSION['id_usuario']);
            $datal= $localidad ->get($datau[0]['id_localidad']);
            include('views/personalizado/pago.php');
            /*empezar el proceso de pago*/
                


        } else {
            include('views/personalizado/index.php');
        }
}
include_once('views/footer.php');
?>