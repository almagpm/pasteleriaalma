<?php
/**
 * Enrutador departamento
 */
require_once("controllers/proyecto.php");
require_once("controllers/departamento.php");
include_once('views/header.php');
include_once('views/menu.php');
$proyecto -> validateRol('Administrador');
$action = (isset($_GET['action'])) ? $_GET['action'] : 'get';
$id = (isset($_GET['id'])) ? $_GET['id'] : null;
$id_tarea = (isset($_GET['id_producto'])) ? $_GET['id_producto'] : null;
switch ($action) {
    case 'new':
        $proyecto -> validatePrivilegio('Proyecto Crear');
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
        $proyecto -> validatePrivilegio('Proyecto Actualizar');
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
        $proyecto -> validatePrivilegio('Proyecto Eliminar');
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
        $proyecto -> validatePrivilegio('Proyecto Leer');
        $data = $proyecto->get($id);
        $data_tarea = $proyecto->getTask($id);
        include('views/categoria/tarea.php');
        break;
    case 'deleteTask':
        $proyecto -> validatePrivilegio('Proyecto Eliminar');
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
    case 'newTask':
        $data = $proyecto->get($id);
        if (isset($_POST['enviar'])) {

            $data2 = $_POST['data'];
            $cantidad = $proyecto->newProducto($id, $data2);
            if ($cantidad) {
                $proyecto->flash('success', "Registro dado de alta con éxito");

            } else {
                $proyecto->flash('danger', "Algo falló.");
            }
            $data_tarea = $proyecto->getTask($id);
            include('views/categoria/tarea.php');
        } else {
            include('views/categoria/tarea_form.php');
        }
        break;
    case 'editTask':
        $data = $proyecto->get($id);
        if (isset($_POST['enviar'])) {
            $data2 = $_POST['data'];
            $id_producto = $_POST['data']['id_producto'];
            $cantidad = $proyecto->updateProducto($id_producto,  $data2);
            if ($cantidad) {
                $proyecto->flash('success', 'Registro actualizado.');
            } else {
                $proyecto->flash('danger', 'Algo falló.');
            }
            $data_tarea = $proyecto->getTask($id);
            include('views/categoria/tarea.php');
        } else {
            $data_producto = $proyecto->getTaskOne($id_tarea);
            include('views/categoria/tarea_form.php');
        }
        break;
    case 'get':
    default:
        $proyecto -> validatePrivilegio('Proyecto Leer');
        $data = $proyecto->get($id);
        include("views/categoria/index.php");
}
include_once('views/footer.php');
?>