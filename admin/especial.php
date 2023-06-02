<?php
/**
 * Enrutador especial
 */
require_once("controllers/especial.php");
include_once('views/header.php');
include_once('views/menu.php');
$especial -> validateRol('Administrador');
$action = (isset($_GET['action'])) ? $_GET['action'] : 'get';
$id = (isset($_GET['id'])) ? $_GET['id'] : null;
switch ($action) {
    case 'new':
        $datausuario= $especial -> getUsuario();
        $datatamaño=$especial ->getTamaño();
        $datarelleno= $especial ->getRelleno();
        $databizcocho =$especial ->getBizcocho();
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $cantidad = $especial->new($data);
            if ($cantidad) {
                $especial->flash('success', "Registro dado de alta con éxito");
                $data = $especial->get();
                include('views/especial/index.php');
            } else {
                $especial->flash('danger', "Algo salió mal.");
                include('views/especial/form.php');
            }
        } else {
            include('views/especial/form.php');
        }
        break;
    case 'edit':
        $datausuario= $especial -> getUsuario();
        $datatamaño=$especial ->getTamaño();
        $datarelleno= $especial ->getRelleno();
        $databizcocho =$especial ->getBizcocho();
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $id = $_POST['data']['id_personalizado'];
            $cantidad = $especial->edit($id, $data);
            if ($cantidad) {
                $especial->flash('success', "Registro actualizado con éxito");
                $data = $especial->get();
                include('views/especial/index.php');
            } else {
                $especial->flash('warning', "Algo falló o no hubo cambios");
                $data = $especial->get();
                include('views/especial/index.php');
            }
        } else {
            $data = $especial->get($id);
            include('views/especial/form.php');
        }
        break;
    case 'delete':
        $cantidad = $especial->delete($id);
        if ($cantidad) {
            $especial->flash('success', "Registro eliminado con éxito");
            $data = $especial->get();
            include('views/especial/index.php');
        } else {
            $especial->flash('danger', "Algo fallo");
            $data = $especial->get();
            include('views/especial/index.php');
        }
        break;
    case 'get':
    default:
        $data = $especial->get($id);
        include("views/especial/index.php");
}
include_once('views/footer.php');
?>