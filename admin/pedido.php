<?php
/**
 * Enrutador departamento
 */
require_once("controllers/usuario.php");
require_once("controllers/pedido.php");
include_once('views/header.php');
include_once('views/menu.php');
$pedido -> validateRol('Administrador');
$action = (isset($_GET['action'])) ? $_GET['action'] : 'get';
$id = (isset($_GET['id'])) ? $_GET['id'] : null;
$id_producto = (isset($_GET['id_producto'])) ? $_GET['id_producto'] : null;
switch ($action) {
    case 'new':
        $datausuario = $pedido -> getUsuario();
        $dataproducto = $pedido -> getProducto();
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $cantidad = $pedido->new($data);
            if ($cantidad) {
                $pedido->flash('success', "Registro dado de alta con éxito");
                $data = $pedido->get();
                include('views/pedido/index.php');
            } else {
                $pedido->flash('danger', "Algo fallo");
                include('views/pedido/form.php');
            }
        } else {
            include('views/pedido/form.php');
        }
        break;
    case 'edit':
        $datausuario = $pedido -> getUsuario();
        $dataproducto = $pedido -> getProducto();
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $id = $_POST['data']['id_usuario'];
            $cantidad = $pedido->edit($id, $data);
            if ($cantidad) {
                $pedido->flash('success', "Registro actualizado con éxito");
                $data = $pedido->get();
                include('views/pedido/index.php');
            } else {
                $pedido->flash('warning', "Algo falló o no hubo cambios");
                $data = $pedido->get();
                include('views/pedido/index.php');
            }
        } else {
            $data = $pedido->get($id);
            include('views/pedido/form.php');
        }
        break;
    case 'delete':
        $cantidad = $pedido->delete($id);
        if ($cantidad) {
            $pedido->flash('success', "Registro eliminado con éxito");
            $data = $pedido->get();
            include('views/pedido/index.php');
        } else {
            $pedido->flash('danger', "Algo fallo");
            $data = $pedido->get();
            include('views/pedido/index.php');
        }
        break;
    case 'detalle':
        $data = $pedido->get($id);
        $data_detalle = $pedido->getdetalle($id);
        include('views/pedido/detalle.php');
        break;
    case 'deletedetalle':
        $cantidad = $pedido->deletedetalle($id,$id_producto);
        if ($cantidad) {
            $pedido->flash('success', "Registro eliminado con éxito");
            $data = $pedido->get($id);
            $data_detalle = $pedido->getdetalle($id);
            include('views/pedido/detalle.php');
        } else {
            $pedido->flash('danger', "Algo fallo");
            $data = $pedido->get($id);
            $data_detalle = $pedido->getdetalle($id);
            include('views/pedido/detalle.php');
        }
        break;
    case 'newdetalle':
        $data = $pedido->get($id);
        $dataproducto = $pedido -> getProducto();
        if (isset($_POST['enviar'])) {
            $data2 = $_POST['data'];
            $cantidad = $pedido->newdetalle($id, $data2);
            if ($cantidad) {
                $pedido->flash('success', "Registro dado de alta con éxito");
                $data_detalle = $pedido->get($id);
                include('views/pedido/index.php');

            } else {
                $pedido->flash('danger', "Algo falló.");
            }
        } else {
            include('views/pedido/detalle_form.php');
        }
        break;
    case 'get':
    default:
        $data = $pedido->get($id);
        include("views/pedido/index.php");
}
include_once('views/footer.php');
?>