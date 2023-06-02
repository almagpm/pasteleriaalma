<?php
/**
 * Enrutador localidad
 */
require_once("controllers/localidad.php");
include_once('views/header.php');
include_once('views/menu.php');
$localidad -> validateRol('Administrador');
$action = (isset($_GET['action'])) ? $_GET['action'] : 'get';
$id = (isset($_GET['id'])) ? $_GET['id'] : null;
switch ($action) {
    case 'new':
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $cantidad = $localidad->new($data);
            if ($cantidad) {
                $localidad->flash('success', "Registro dado de alta con éxito");
                $data = $localidad->get();
                include('views/localidad/index.php');
            } else {
                $localidad->flash('danger', "Algo salió mal.");
                include('views/localidad/form.php');
            }
        } else {
            include('views/localidad/form.php');
        }
        break;
    case 'edit':
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $id = $_POST['data']['id_localidad'];
            $cantidad = $localidad->edit($id, $data);
            if ($cantidad) {
                $localidad->flash('success', "Registro actualizado con éxito");
                $data = $localidad->get();
                include('views/localidad/index.php');
            } else {
                $localidad->flash('warning', "Algo falló o no hubo cambios");
                $data = $localidad->get();
                include('views/localidad/index.php');
            }
        } else {
            $data = $localidad->get($id);
            include('views/localidad/form.php');
        }
        break;
    case 'delete':
        $cantidad = $localidad->delete($id);
        if ($cantidad) {
            $localidad->flash('success', "Registro eliminado con éxito");
            $data = $localidad->get();
            include('views/localidad/index.php');
        } else {
            $localidad->flash('danger', "Algo fallo");
            $data = $localidad->get();
            include('views/localidad/index.php');
        }
        break;
    case 'get':
    default:
        $data = $localidad->get($id);
        include("views/localidad/index.php");
}
include_once('views/footer.php');
?>