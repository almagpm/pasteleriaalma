<?php
/**
 * Enrutador departamento
 */
require_once("controllers/carrito.php");
require_once("controllers/usuario.php");
require_once("controllers/proyecto.php");
include_once('views/header.php');
include_once('views/menu.php');
$carrito -> validateRol('Administrador');
$action = (isset($_GET['action'])) ? $_GET['action'] : 'get';
$id = (isset($_GET['id'])) ? $_GET['id'] : null;
switch ($action) {
    case 'new':
        $datausuario= $carrito-> getUsuario();
        $dataproducto = $carrito -> getProducto();
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
    case 'edit':
        $datausuario= $carrito-> getUsuario();
        $dataproducto = $carrito -> getProducto();
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $id = $_POST['data']['id_carrito'];
            $cantidad = $carrito->edit($id, $data);
            if ($cantidad) {
                $carrito->flash('success', "Registro actualizado con éxito");
                $data = $carrito->get();
                include('views/carrito/index.php');
            } else {
                $carrito->flash('warning', "Algo falló o no hubo cambios");
                $data = $carrito->get();
                include('views/carrito/index.php');
            }
        } else {
            $data = $carrito->get($id);
            include('views/carrito/form.php');
        }
        break;
    case 'delete':
        $cantidad = $carrito->delete($id);
        if ($cantidad) {
            $carrito->flash('success', "Registro eliminado con éxito");
            $data = $carrito->get();
            include('views/carrito/index.php');
        } else {
            $carrito->flash('danger', "Algo fallo");
            $data = $carrito->get();
            include('views/carrito/index.php');
        }
        break;
    case 'get':
    default:
        $data = $carrito->get($id);
        include("views/carrito/index.php");
}
include_once('views/footer.php');
?>