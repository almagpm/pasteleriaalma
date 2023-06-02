<?php
require_once("controllers/sistema.php");
require_once("../vendor/autoload.php");
use Spipu\Html2Pdf\Html2Pdf;
$html2pdf = new Html2Pdf();
$action = (isset($_GET['action'])) ? $_GET['action'] : 'get';
$id = (isset($_GET['id'])) ? $_GET['id'] : null;
$id_user=$_SESSION['id_usuario'];
$sistema->db();
switch($action):
    case 'proyecto':
        $sql = "SELECT p.nombre, p.precio_referencia, dc.cantidad FROM detalle_carrito dc join producto p ON dc.id_producto= p.id_producto WHERE id_carrito=:id_carrito;";
        $st = $sistema->db->prepare($sql);
        $st->bindParam(":id_carrito", $id, PDO::PARAM_INT);
        $st->execute();
        $data = $st->fetchAll(PDO::FETCH_ASSOC);

        $sql2 = "SELECT u.*,l.localidad FROM localidad l join usuario u on l.id_localidad=u.id_localidad where u.id_usuario=:id_usuario;";
        $st2 = $sistema->db->prepare($sql2);
        $st2->bindParam(":id_usuario", $id_user, PDO::PARAM_INT);
        $st2->execute();
        $data2 = $st2->fetchAll(PDO::FETCH_ASSOC);
        $subtotal=0;
        $html = '
        <head>
            <link rel="stylesheet" type="text/css" href="css/estilo.css">
        </head>
        <body>
        <div class="conteiner">
		<div class="title"> Nombre del cliente: '.  $data2[0]['nombre'] .' '.$data2[0]['primer_apellido'].' '.$data2[0]['segundo_apellido'].'</div>
        </div>

        <div style="text-align: center;">
     
        </div> 
        <hr>
        
        ';


        $html .= "<div class='texto'>
        <h3>Datos generales</h3>
         <p>Calle:" .$data2[0]['calle'] .",  Número de calle:".$data2[0]['n_calle'] ."<br>
         Localidad: " . $data2[0]['localidad']  . "<br>
         Fecha de emisión: " . date('Y-m-d') . "<br>
        Número de cuenta: 5516 0987 0547 5583 <br> Banco: Banco del bienestar</p>
        </div>";

        



        $html .= " 
        <hr>

        <div style='text-align: center;'>
        <h2> Resumen del pedido: </h2>
        </div>
        <br>


        <table class='table-fill'>
        <thead>
            <tr>
                <th class='text-left'>Nombre del producto</th>
                <th class='text-left'>Cantidad</th>
                <th class='text-left'>precio_referencia</th>
            </tr>
        </thead>
        <tbody class='table-hover'>";
        foreach($data as $key => $producto):
            $html .= 
            "
            <tr>
                <th>".$producto['nombre']."</th>
                <td>".$producto['cantidad']."</td>
                <td>$".$producto['precio_referencia']."</td>
            </tr>
             ";
             $subtotal+= $producto['precio_referencia']*$producto['cantidad']; 
        endforeach;
        $subtotal += 50;
        $html .= "
        </tbody>       
            <tr>
                <th>Costo de envio:</th>
                <td>-</td>
                <td>$50</td>
            </tr>
            <tr>
                <th class='text-left'></th>
                <th class='text-left'>Total:</th>
                <th class='text-left'>".$subtotal."</th>
            </tr>

        </table>
        <br>
        <br>
        <hr>
        </body>
        ";
        break;
    default:
        $html='<h1>Sin reporte</h1>No hay ningún reporte a generar';
endswitch;
$html2pdf->writeHTML($html);
$html2pdf->output();
?>