<?php
require_once("sistema.php");

/**
 * Controller Departamento
 */
class Especial extends Sistema
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
            $sql = "SELECT * from pedido_personalizado";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "SELECT * from pedido_personalizado Where id_personalizado=:id";
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
    public function delete($id)
    {
        $this->db();
        $sql = "delete from pedido_personalizado where id_personalizado = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }


    
    public function edit($id, $data)
{
    $status = 'Pagado';

    $this->db();

    $sql = 'UPDATE pedido_personalizado SET comentario = :comentario, status = :status, precio = :precio, fecha_entrega = :fecha_entrega, hora_entrega = :hora_entrega, id_tamano = :id_tamano, id_relleno = :id_relleno, id_bizcocho = :id_bizcocho, id_usuario = :id_usuario WHERE id_personalizado = :id_personalizado';
    $st = $this->db->prepare($sql);
    $st->bindParam(':comentario', $data['comentario'], PDO::PARAM_STR);
    $st->bindParam(':status', $status, PDO::PARAM_STR);
    $st->bindParam(':precio', $data['precio'], PDO::PARAM_STR);
    $st->bindParam(':fecha_entrega', $data['fecha_entrega'], PDO::PARAM_STR);
    $st->bindParam(':hora_entrega', $data['hora_entrega'], PDO::PARAM_STR);
    $st->bindParam(':id_tamano', $data['id_tamano'], PDO::PARAM_STR);
    $st->bindParam(':id_relleno', $data['id_relleno'], PDO::PARAM_STR);
    $st->bindParam(':id_bizcocho', $data['id_bizcocho'], PDO::PARAM_STR);
    $st->bindParam(':id_usuario', $data['id_usuario'], PDO::PARAM_INT);
    $st->bindParam(':id_personalizado', $id, PDO::PARAM_INT);

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
    public function getUsuario()
    {
        $this->db();
        
            $sql = "SELECT * from usuario";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

}
$especial = new Especial;
?>