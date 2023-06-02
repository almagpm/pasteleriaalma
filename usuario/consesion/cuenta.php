<?php
require_once('controllers/sistema.php');
include_once('views/header.php');
include_once('views/menu.php');
include('controllers/localidad.php');
$localidad -> validateRol('Usuario');
$opcion = 'personal';
$action = (isset($_GET['action'])) ? $_GET['action'] : '';
switch ($action) {

    case 'edit':
        $datalocalidad= $localidad->get();
        if (isset($_POST['aceptar'])) {
            $data = $_POST['data'];
            $hubo_error = $sistema->editDatosCuenta($_SESSION['id_usuario'], $data);
            if ($hubo_error == "Correcto") {
                $sistema->flash('success', 'Los cambios se han realizado correctamente, se reflejaran al iniciar sesion nuevamene');
            } else {
                $sistema->flash('danger', $hubo_error);
            }
            $data = $sistema->getDatosCuenta($_SESSION['id_usuario']);
            
        }
        break;
        
    case 'get':
        default:
            $data = $sistema->getDatosCuenta($_SESSION['id_usuario']);
            $datalocalidad= $localidad->get();
            include('views/cuenta/index.php');
            break;
}
include_once('views/footer.php');
?>