<?php
/**
 * Enrutador relleno
 */
require_once("controllers/relleno.php");
include_once('views/header.php');
include_once('views/menu.php');
$relleno -> validateRol('Administrador');
$action = (isset($_GET['action'])) ? $_GET['action'] : 'get';
$id = (isset($_GET['id'])) ? $_GET['id'] : null;
switch ($action) {
    case 'new':
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $cantidad = $relleno->new($data);
            if ($cantidad) {
                $relleno->flash('success', "Registro dado de alta con éxito");
                $data = $relleno->get();
                include('views/relleno/index.php');
            } else {
                $relleno->flash('danger', "Algo salió mal.");
                include('views/relleno/form.php');
            }
        } else {
            include('views/relleno/form.php');
        }
        break;
    case 'edit':
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $id = $_POST['data']['id_relleno'];
            $cantidad = $relleno->edit($id, $data);
            if ($cantidad) {
                $relleno->flash('success', "Registro actualizado con éxito");
                $data = $relleno->get();
                include('views/relleno/index.php');
            } else {
                $relleno->flash('warning', "Algo falló o no hubo cambios");
                $data = $relleno->get();
                include('views/relleno/index.php');
            }
        } else {
            $data = $relleno->get($id);
            include('views/relleno/form.php');
        }
        break;
    case 'delete':
        $cantidad = $relleno->delete($id);
        if ($cantidad) {
            $relleno->flash('success', "Registro eliminado con éxito");
            $data = $relleno->get();
            include('views/relleno/index.php');
        } else {
            $relleno->flash('danger', "Algo fallo");
            $data = $relleno->get();
            include('views/relleno/index.php');
        }
        break;
    case 'get':
    default:
        $data = $relleno->get($id);
        include("views/relleno/index.php");
}
include_once('views/footer.php');
?>