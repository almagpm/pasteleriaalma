<?php
/**
 * Enrutador bizcocho
 */
require_once("controllers/bizcocho.php");
include_once('views/header.php');
include_once('views/menu.php');
$bizcocho -> validateRol('Administrador');
$action = (isset($_GET['action'])) ? $_GET['action'] : 'get';
$id = (isset($_GET['id'])) ? $_GET['id'] : null;
switch ($action) {
    case 'new':
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $cantidad = $bizcocho->new($data);
            if ($cantidad) {
                $bizcocho->flash('success', "Registro dado de alta con éxito");
                $data = $bizcocho->get();
                include('views/bizcocho/index.php');
            } else {
                $bizcocho->flash('danger', "Algo salió mal.");
                include('views/bizcocho/form.php');
            }
        } else {
            include('views/bizcocho/form.php');
        }
        break;
    case 'edit':
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $id = $_POST['data']['id_bizcocho'];
            $cantidad = $bizcocho->edit($id, $data);
            if ($cantidad) {
                $bizcocho->flash('success', "Registro actualizado con éxito");
                $data = $bizcocho->get();
                include('views/bizcocho/index.php');
            } else {
                $bizcocho->flash('warning', "Algo falló o no hubo cambios");
                $data = $bizcocho->get();
                include('views/bizcocho/index.php');
            }
        } else {
            $data = $bizcocho->get($id);
            include('views/bizcocho/form.php');
        }
        break;
    case 'delete':
        $cantidad = $bizcocho->delete($id);
        if ($cantidad) {
            $bizcocho->flash('success', "Registro eliminado con éxito");
            $data = $bizcocho->get();
            include('views/bizcocho/index.php');
        } else {
            $bizcocho->flash('danger', "Algo fallo");
            $data = $bizcocho->get();
            include('views/bizcocho/index.php');
        }
        break;
    case 'get':
    default:
        $data = $bizcocho->get($id);
        include("views/bizcocho/index.php");
}
include_once('views/footer.php');
?>