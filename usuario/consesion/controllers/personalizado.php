<?php
require_once("sistema.php");

/**
 * Controller Departamento
 */
class Personalizado extends Sistema
{
    /**
     * Obtiene los departamentos solicitado
     *
     * @return array $data los departamentos solicitados
     * @param integer $id si se especifica un id solo obtiene el departamento solicitado, de lo contrario obtiene todos
     */
    public function get($id = null)
    {
        $this->db();
        if (is_null($id)) {
            $sql = "SELECT * from carrito c LEFT JOIN detalle_carrito dc ON c.id_carrito=dc.id_carrito";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "SELECT * from pedido_personalizado Where id_usuario=:id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }
    public function getTamaño()
    {
        $this->db();
        
            $sql = "SELECT * from tamaño";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    public function new($data, $id_user, $status, $tamaño)
{
    $status = 'Pagado';
  
        $this->db();
        print_r($tamaño);

        $sql = 'INSERT INTO pedido_personalizado (comentario, status, precio,  fecha_entrega, hora_entrega,id_tamano, id_relleno, id_bizcocho, id_usuario) VALUES (:comentario,:status,:precio, :fecha_entrega, :hora_entrega,:id_tamano,:id_relleno, :id_bizcocho, :id_usuario)';
        $st = $this->db->prepare($sql);
        $st->bindParam(':comentario', $data['comentario'], PDO::PARAM_STR);        
        $st->bindParam(':status', $status, PDO::PARAM_STR);
        $st->bindParam(':precio', $data['subtotal'], PDO::PARAM_STR);
        $st->bindParam(':fecha_entrega', $data['fecha'], PDO::PARAM_STR);
        $st->bindParam(':hora_entrega', $data['hora'], PDO::PARAM_STR);
        $st->bindParam(':id_tamano', $tamaño, PDO::PARAM_STR);
        $st->bindParam(':id_relleno', $data['id_relleno'], PDO::PARAM_STR);
        $st->bindParam(':id_bizcocho', $data['id_bizcocho'], PDO::PARAM_STR);
        $st->bindParam(':id_usuario', $id_user, PDO::PARAM_INT);

        $st->execute();

        $rc = $st->rowCount();
        return $rc;
     // Realiza otras acciones según sea necesario para manejar el error
    
}

    public function getRelleno()
    {
        $this->db();
        
            $sql = "SELECT * from relleno";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    public function getBizcocho()
    {
        $this->db();
        
            $sql = "SELECT * from bizcocho";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

}
$personalizado = new Personalizado;
?>