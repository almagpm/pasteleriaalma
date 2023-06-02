<?php
require_once('sistema.php');
class Pago extends Sistema
{
    public function pago($id_user, $estatus,$subtotal)
    {
        $this->db();
        $sql = 'INSERT INTO pedido(fecha,id_usuario,estatus,monto, codigo) VALUES (:fecha,:id_usuario,:estatus,:monto, :codigo)';
        $st = $this->db->prepare($sql);
        $fecha = date('Y-m-d');
        $st->bindParam(':fecha', $fecha, PDO::PARAM_STR);
        $st->bindParam(':id_usuario', $id_user, PDO::PARAM_INT);
        $st->bindParam(':estatus', $estatus, PDO::PARAM_STR);
        
        $monto = sprintf("%.2f", $subtotal); // o $monto = number_format($subtotal, 2, '.', '');

        $st->bindParam(':monto', $monto, PDO::PARAM_STR);
        $cod = $this->generarCod();
        $st->bindParam(':codigo', $cod, PDO::PARAM_STR);
        $st->execute();
        $rc = $st->rowCount();
        $id_pedido = $this->db->lastInsertId(); 
        
        $this->pago_detalle($id_user, $id_pedido);
        return $rc;
    }
    public function pago_detalle($id_user,$id_pedido)
    {
        $this->db();
        $rc = 0;
        $lista_productos = $this->getProductos($id_user);
        foreach ($lista_productos as $key => $producto) {
            $producto_id = $producto['id_producto'];
            $cantidad = $producto['cantidad'];
            $sql = 'INSERT INTO pedido_detalle (id_pedido, id_producto, cantidad) VALUES (:id_pedido, :id_producto, :cantidad)';
            $st = $this->db->prepare($sql);
            $st->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);
            $st->bindParam(':producto_id', $producto_id, PDO::PARAM_INT);
            $st->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
            $st->execute();
            $rc = $st->rowCount();
            if ($rc == 0) {
                return $rc;
            }
        }
        return $rc;
    }

    public function getProductos($id_user)
    {
        $this->db();
        $sql = 'SELECT p.id_producto, dc.cantidad from producto p join detalle_carrito dc on dc.id_producto=p.id_producto
        JOIN carrito c ON dc.id_carrito=c.id_carrito  where c.id_usuario= :id';
        $st = $this->db->prepare($sql);
        $st->bindParam(':id', $id_user, PDO::PARAM_STR);
        $st->execute();
        $data = $st->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function limpiarCarrito($id_user)
    {
        $this->db();
        $sql = "DELETE FROM CARRITO_WEB WHERE USUARIO_WEB_ID= :USUARIO_WEB_ID";
        $st = $this->db->prepare($sql);
        $st->bindParam(':USUARIO_WEB_ID', $id_user, PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    public function generarCod()
    {
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $codigo = '';
        for ($i = 0; $i < 5; $i++) {
            $codigo .= $caracteres[rand(0, strlen($caracteres) - 1)];
        }
        $codigo = strtoupper($codigo);
        return $codigo;
    }

    public function getPrecio($id_user)
        {
            $this->db();
            $sql = "SELECT SUM((SELECT MAX(precio) FROM PRECIOS_ARTICULOS p1 JOIN articulos a1 ON p1.ARTICULO_ID=a1.ARTICULO_ID WHERE a1.ARTICULO_ID=a.ARTICULO_ID)) AS SUBTOTAL FROM CARRITO_WEB c JOIN ARTICULOS a ON c.ARTICULO_ID=a.ARTICULO_ID WHERE c.USUARIO_WEB_ID = :id_user";
            $st = $this->db->prepare($sql);
            $st->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }


}
$pago = new Pago;
?>