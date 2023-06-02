<?php
/**
 * Enrutador departamento
 */
require_once("controllers/proyecto.php");
require_once("controllers/carrito.php");
require_once("controllers/departamento.php");
include_once('views/header.php');
include_once('views/menu.php');
$proyecto -> validateRol('Usuario');
$action = (isset($_GET['action'])) ? $_GET['action'] : 'get';
$id = (isset($_GET['id'])) ? $_GET['id'] : null;
$id_tarea = (isset($_GET['id_tarea'])) ? $_GET['id_tarea'] : null;
switch ($action) {
    case 'new':
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $cantidad = $proyecto->new($data);
            if ($cantidad) {
                $proyecto->flash('success', "Registro dado de alta con éxito");
                $data = $proyecto->get();
                include('views/categoria/index.php');
            } else {
                $proyecto->flash('danger', "Algo fallo");
                include('views/categoria/form.php');
            }
        } else {
            include('views/categoria/form.php');
        }
        break;
    case 'edit':
        $datadepartamentos = $departamento->get();
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $id = $_POST['data']['id_categoria'];
            $cantidad = $proyecto->edit($id, $data);
            if ($cantidad) {
                $proyecto->flash('success', "Registro actualizado con éxito");
                $data = $proyecto->get();
                include('views/categoria/index.php');
            } else {
                $proyecto->flash('warning', "Algo falló o no hubo cambios");
                $data = $proyecto->get();
                include('views/categoria/index.php');
            }
        } else {
            $data = $proyecto->get($id);
            include('views/categoria/form.php');
        }
        break;
    case 'delete':
        $cantidad = $proyecto->delete($id);
        if ($cantidad) {
            $proyecto->flash('success', "Registro eliminado con éxito");
            $data = $proyecto->get();
            include('views/categoria/index.php');
        } else {
            $proyecto->flash('danger', "Algo fallo");
            $data = $proyecto->get();
            include('views/categoria/index.php');
        }
        break;
    case 'task':
        $data = $proyecto->get($id);
        $data_tarea = $proyecto->getTask($id);
        include('views/categoria/tarea.php');
        break;
    case 'deleteTask':
        $cantidad = $proyecto->deleteTask($id_tarea);
        if ($cantidad) {
            $proyecto->flash('success', "Registro eliminado con éxito");
            $data = $proyecto->get($id);
            $data_tarea = $proyecto->getTask($id);
            include('views/categoria/tarea.php');
        } else {
            $proyecto->flash('danger', "Algo fallo");
            $data = $proyecto->get($id);
            $data_tarea = $proyecto->getTask($id);
            include('views/categoria/tarea.php');
        }
        break;
    case 'newProductoC':
        if (empty($_POST)) {
            $carrito->new($_SESSION['id_usuario'], $id, 1);
            if ($cantidad) {
                $carrito->flash('success', 'Se añadió el producto a su carrito');
                $subtotal = $carrito->getPrecio($_SESSION['id_usuario']);
                $subtotal = $subtotal[0]['SUBTOTAL'];
                $data = $carrito->get($_SESSION['id_usuario']);
                include('views/carrito/lista_carritos.php');
            } else {
                $carrito->flash('danger', 'Hubo un problema al añadir su producto');
            }
        } else {
            $data = $_POST['data'];
            if (isset($_POST['agregar'])) {
                $carrito->new($_SESSION['id_usuario'], $data['id_producto'], $data['cantidad']);
                if ($cantidad) {
                    $carrito->flash('success', 'Se añadió el producto a su carrito');
                    $data = $carrito->get($_SESSION['id_usuario']);
                    include('views/carrito/index.php');
                } else {
                    $carrito->flash('danger', 'Hubo un problema al añadir su producto');
                }
            }
        }
        break;
    case 'editTask':
        $data = $proyecto->get();
        $data_tarea = $proyecto->getTaskOne($id);
        include('views/categoria/tarea_form.php');
        break;
    case 'get':
    default:
        $data = $proyecto->get($id);
        include("views/categoria/index.php");
}
include_once('views/footer.php');
?>