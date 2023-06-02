<?php
require_once('controllers/localidad.php');
require_once('controllers/usuario.php');
require_once('controllers/pago.php');
include_once('views/header.php');
include_once('views/menu.php');
$action = (isset($_GET['action'])) ? $_GET['action'] : '';
$id = (isset($_GET['id'])) ? $_GET['id'] : null;
$estatus = 'pagado';
switch ($action) {
    case 'pagado':
            $subtotal = $pago->getPrecio($_SESSION['id_usuario']);
            $subtotal = $subtotal[0]['total']+ 50;
            $estatus = 'Pagado';
            $cantidad = $pago->pago($_SESSION['id_usuario'], $estatus, $subtotal);
            
                if ($cantidad) {
                    $pago->limpiarCarrito($_SESSION['id_usuario']);
                }
            
        include('views/pago/pago_exitoso.php');
        break;
    case 'espera':
            $subtotal = $pago->getPrecio($_SESSION['id_usuario']);
            $subtotal = $subtotal[0]['total']+ 50;
            $estatus = 'En espera';
            $cantidad = $pago->pago($_SESSION['id_usuario'], $estatus, $subtotal);
            
                if ($cantidad) {
                    $pago->limpiarCarrito($_SESSION['id_usuario']);
                }
            
        include('views/pago/pago_exitoso.php');
        break;
    case 'get':
    default:
        $subtotal = $pago->getPrecio($_SESSION['id_usuario']);
        $data = $usuario->get($_SESSION['id_usuario']);
        $datal= $localidad ->get($data[0]['id_localidad']);
        include('views/pago/form.php');
        break;
}
include_once('views/footer.php');
?>