<?php
/**
 * Enrutador departamento
 */
require_once("controllers/usuario.php");
include_once('views/header.php');
include_once('views/menu.php');
$action = (isset($_GET['action'])) ? $_GET['action'] : 'get';
$id = (isset($_GET['id'])) ? $_GET['id'] : null;
switch ($action) {
    case 'new':
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $cantidad = $usuario->new($data);
            if ($cantidad) {
                $usuario->flash('success', "Registro dado de alta con éxito");
                $data = $usuario->get();
                include('views/departamento/index.php');
            } else {
                $usuario->flash('danger', "Algo salió mal.");
                include('views/departamento/form.php');
            }
        } else {
            include('views/departamento/form.php');
        }
        break;
    case 'edit':
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $id = $_POST['data']['id_departamento'];
            $cantidad = $usuario->edit($id, $data);
            if ($cantidad) {
                $usuario->flash('success', "Registro actualizado con éxito");
                $data = $usuario->get();
                include('views/departamento/index.php');
            } else {
                $usuario->flash('warning', "Algo falló o no hubo cambios");
                $data = $usuario->get();
                include('views/departamento/index.php');
            }
        } else {
            $data = $usuario->get($id);
            include('views/departamento/form.php');
        }
        break;
    case 'delete':
        $cantidad = $departamento->delete($id);
        if ($cantidad) {
            $departamento->flash('success', "Registro eliminado con éxito");
            $data = $departamento->get();
            include('views/departamento/index.php');
        } else {
            $departamento->flash('danger', "Algo fallo");
            $data = $departamento->get();
            include('views/departamento/index.php');
        }
        break;
    case 'get':
    default:
        $data = $usuario->get($id);
        include("views/usuario/index.php");
}
include_once('views/footer.php');
?>