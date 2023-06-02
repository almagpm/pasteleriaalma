<?php
require_once(__DIR__."/sistema.php");

/**
 * Controller Proyecto
 */
class Pedido extends Sistema
{
    /**
     * Obtiene los proyectos solicitado
     *
     * @return array $data los proyectos solicitados
     * @param integer $id si se especifica un id solo obtiene el proyecto solicitado, de lo contrario obtiene todos
     */
    public function get($id = null)
    {
        $this->db();
        if (is_null($id)) {
            $sql = "select * from pedido";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "select * from pedido where id_pedido = :id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }

    /**
     * Nuevo proyecto
     *
     * @return integer $rc cantidad de filas afectadas por el insert
     * @param array $data los datos del nuevo proyecto
     */
    public function new($data)
    {
        $this->db();
        try {
            $this->db->beginTransaction();
            $sql = "insert into pedido (fecha, id_usuario, estatus, monto, codigo) values ( :fecha, :id_usuario, :estatus, :monto, :codigo)";
          
            $st = $this->db->prepare($sql);
            $currentDate = date('Y-m-d');
            $st->bindParam(":fecha", $currentDate, PDO::PARAM_STR);
            $st->bindParam(":id_usuario", $data['id_usuario'], PDO::PARAM_STR);
            if($data['pagado']==1){
                $estatus = 'Pagado';
            }else{
                $estatus = 'En espera';
            }
            $st->bindParam(":estatus", $estatus, PDO::PARAM_STR);
            $st->bindParam(":monto", $data['monto'], PDO::PARAM_STR);
            $cod = $this->generarCod();
            $st->bindParam(':codigo', $cod, PDO::PARAM_STR);
            
            $st->execute();
            $rc = $st->rowCount();
            $this->db->commit();
        } catch (PDOException $Exception) {
            $rc = 0;
            $this->db->rollBack();
        }
        return $rc;
    }

    /**
     * Editar proyecto
     *
     * @return integer $rc cantidad de filas afectadas por el update
     * @param  integer $id el identificador del proyecto a editar
     *         array $data los datos modificados del proyecto
     */
    public function edit($id, $data)

{
  

    try {
        $this->db->beginTransaction();

        $sql = "UPDATE pedido SET fecha = :fecha, id_usuario = :id_usuario, estatus = :estatus, monto = :monto WHERE id_pedido = :id";
      
        $st = $this->db->prepare($sql);
        $currentDate = date('Y-m-d');
        $st->bindParam(":fecha", $currentDate, PDO::PARAM_STR);
        $st->bindParam(":id_usuario", $data['id_usuario'], PDO::PARAM_STR);
        if($data['pagado'] == 1) {
            $estatus = 'Pagado';
        } else {
            $estatus = 'En espera';
        }
        $st->bindParam(":estatus", $estatus, PDO::PARAM_STR);
        $st->bindParam(":monto", $data['monto'], PDO::PARAM_STR);
        $st->bindParam(":id", $data['id_pedido'], PDO::PARAM_INT);
        
        $st->execute();
        $rc = $st->rowCount();

        $this->db->commit();
        } catch (PDOException $Exception) {
            $rc = 0;
            $this->db->rollBack();
        }


    return $rc;
}


    /**
     * Borrar proyecto
     *
     * @return integer $rc cantidad de filas afectadas por el delete
     * @param  integer $id el identificador del proyecto a eliminar
     */public function delete($id)
    {
        $this->db();
        try {
            $this->db->beginTransaction();
            $sql = "delete from pedido_detalle where id_pedido=:id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $sql2 = "delete from pedido where id_pedido = :id";
            $st2 = $this->db->prepare($sql2);
            $st2->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $st2->execute();
            $rc = $st2->rowCount();
            $this->db->commit();
        } catch (PDOException $Exception) {
            $rc = 0;
            $this->db->rollBack();
        }
        return $rc;
    }

    public function getdetalle($id)
    {
        $this->db();
        if (is_null($id)) {
            $sql = "select * from pedido_detalle";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "select * from pedido_detalle where id_pedido=:id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }


    public function deletedetalle($id,$id_producto)
    {
        $this->db();
        try {
            $this->db->beginTransaction();
            $sql = "delete from pedido_detalle where id_pedido=:id_pedido and id_producto=:id_producto";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id_pedido", $id, PDO::PARAM_INT);
            $st->bindParam(":id_producto", $id_producto, PDO::PARAM_INT);
            $st->execute();
            $rc = $st->rowCount();
        } catch (PDOException $Exception) {
            $rc = 0;
            $this->db->rollBack();
        }
        return $rc;
    }

    public function newdetalle($id, $data)
    {
        $this->db();
            $sql = "insert into pedido_detalle (id_pedido, id_producto, cantidad) values (:id_pedido, :id_producto, :cantidad)";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id_pedido", $data['id_pedido'], PDO::PARAM_INT);
            $st->bindParam(":id_producto", $data['id_producto'], PDO::PARAM_INT);
            $st->bindParam(":cantidad", $data['cantidad'], PDO::PARAM_INT);
            $st->execute();
            $rc = $st->rowCount();
        return $rc;
    }

    public function getUsuario($id = null)
    {
        $this->db();
        if (is_null($id)) {
            $sql = "SELECT * from usuario";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "SELECT * from usuario where id_usuario = :id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }
    public function getProducto($id = null)
    {
        $this->db();
        if (is_null($id)) {
            $sql = "SELECT * from producto";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "SELECT * from producto where id_producto = :id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
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
    public function mas_vendido()
    {
        $this->db();
            $sql = "SELECT pd.id_producto, SUM(pd.cantidad) AS total_vendido, p.nombre, p.precio_referencia, p.imagen FROM pedido_detalle pd JOIN producto p ON pd.id_producto = p.id_producto GROUP BY pd.id_producto ORDER BY total_vendido DESC LIMIT 5;";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;
    }

}
$pedido = new Pedido;
?>s