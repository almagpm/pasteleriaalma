<?php 
header('Content-Type: application/json');

include_once(__DIR__."/../admin/controllers/sistema.php");
include_once(__DIR__."/../admin/controllers/usuario.php");

$action = $_SERVER['REQUEST_METHOD'];
$id=isset($_GET['id'])?$_GET['id']:null;
switch($action):
    case 'DELETE':
        $data['mensaje']='No existe el usuario.';
        if(!is_null($id))
        {
            $contador=$usuario->delete($id);
            if($contador==1)
                $data['mensaje']='Se eliminó el usuario.';
        }
        break;
    case 'POST':
        $data=array();
        $data = $_POST['data'];
        if(is_null($id))
        {
            $cantidad = $usuario->new($data);
            if($cantidad!=0)
                $data['mensaje']='Se insertó un nuevo usuario.';
                //$data[]
            else
                $data['mensaje']='Ocurrió un error.';
        }
        else
        {
            $cantidad=$usuario->edit($id, $data);
            if($cantidad!=0)
                $data['mensaje']='Se modificó el usuario.';
                //$data[]
            else
                $data['mensaje']='Ocurrió un error.';
        }
        break;
    case 'GET':
    default:
        if(is_null($id))
            $data=$usuario->get();    
        else
            $data=$usuario->get($id);
endswitch;
$data=json_encode($data);
echo($data);
?>