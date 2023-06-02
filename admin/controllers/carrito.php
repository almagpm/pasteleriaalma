<?php
require_once("sistema.php");

/**
 * Controller Departamento
 */
class Carrito extends Sistema
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
            $sql = "SELECT c.id_carrito, c.fecha, c.id_usuario, dc.id_producto, dc.cantidad, dc.costo from carrito c RIGHT JOIN detalle_carrito dc ON c.id_carrito=dc.id_carrito";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "SELECT c.id_carrito, c.fecha, c.id_usuario, dc.id_producto, dc.cantidad, dc.costo from carrito c RIGHT JOIN detalle_carrito dc ON c.id_carrito=dc.id_carrito where c.id_carrito = :id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
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

    /**
     * Nuevo departamento
     *
     * @return integer $rc cantidad de filas afectadas por el insert
     * @param array $data los datos del nuevo departamento
     */
    public function new ($data)
    {
        try {
            
            $this->db();
            $this->db->beginTransaction();
        $sql = "insert into carrito (fecha, id_usuario) values (:fecha, :id_usuario)";
        $st = $this->db->prepare($sql);
        $currentDate = date('Y-m-d');
        $st->bindParam(":fecha", $currentDate, PDO::PARAM_STR);
        $st->bindParam(":id_usuario", $data['id_usuario'], PDO::PARAM_STR);
        $st->execute();
        $id_carrito = $this->db->lastInsertId();
        $sql2 = "insert into detalle_carrito (id_carrito, id_producto, cantidad) values (:id_carrito, :id_producto, :cantidad)";
        $st2 = $this->db->prepare($sql2);
        $st2->bindParam(":id_carrito", $id_carrito, PDO::PARAM_STR);
        $st2->bindParam(":id_producto", $data['id_producto'], PDO::PARAM_STR);
        $st2->bindParam(":cantidad", $data['cantidad'], PDO::PARAM_STR);
        $st2->execute();
        
        $rc = $st2->rowCount();
        $this->db->commit();
        } catch (PDOException $Exception) {
            $rc = 0;
            $this->db->rollBack();
        }
        return $rc;
    }

    /**
     * Editar departamento
     *
     * @return integer $rc cantidad de filas afectadas por el update
     * @param  integer $id el identificador del departamento a editar
     *         array $data los datos modificados del departamento
     */
    public function edit($id, $data)
    {
        $this->db();
        
        // Verificar si el carrito existe
        $existingCart = $this->checkExistingCartById($data['id_carrito']);
        
        if ($existingCart) {
            // El carrito existe, puedes realizar la actualización del detalle_carrito
            $this->updateDetalleCarrito($data['id_carrito'], $data['id_producto'], $data['cantidad']);
            
            return true;
        } else {
            $sql = "UPDATE carrito SET fecha = :fecha, id_usuario = :id_usuario WHERE id_carrito = :id_carrito";
            $st = $this->db->prepare($sql);
            $st->bindParam(":fecha", $data['fecha'], PDO::PARAM_STR);
            $st->bindParam(":id_usuario", $data['id_usuario'], PDO::PARAM_STR);
            $st->bindParam(":id_carrito", $data['id_carrito'], PDO::PARAM_STR);
            $st->execute();
            
            $sql2 = "UPDATE detalle_carrito SET id_producto = :id_producto, cantidad = :cantidad WHERE id_carrito = :id_carrito";
            $st2 = $this->db->prepare($sql2);
            $st2->bindParam(":id_producto", $data['id_producto'], PDO::PARAM_STR);
            $st2->bindParam(":cantidad", $data['cantidad'], PDO::PARAM_STR);
            $st2->bindParam(":id_carrito", $data['id_carrito'], PDO::PARAM_STR);
            $st2->execute();
            // El carrito no existe, puedes mostrar un mensaje de error o realizar alguna acción
            return false;
        }
    }

    public function updateDetalleCarrito($id_carrito, $id_producto, $cantidad)
    {
        try {
            $sql = 'UPDATE detalle_carrito SET id_producto = :id_producto, cantidad = :cantidad WHERE id_carrito = :id_carrito';
            $st = $this->db->prepare($sql);
            $st->bindParam(':id_carrito', $id_carrito, PDO::PARAM_INT);
            $st->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
            $st->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
            $st->execute();
        } catch (PDOException $e) {
            if ($e->getCode() === '23000' && $e->errorInfo[1] === 1062) {
                // Error de duplicidad de clave primaria (producto ya existente en el carrito)
                $this->flash('primary', 'Ese producto ya se encuentra en el carrito');
            } else {
                // Otro tipo de error
                $errorMessage = $e->getMessage(); // Obtener el mensaje de error
                $this->flash('primary', 'Otro: ' . $errorMessage);
            }
        }
    }

    public function checkExistingCartById($id_carrito)
    {
        $sql = 'SELECT * FROM carrito WHERE id_carrito = :id_carrito';
        $st = $this->db->prepare($sql);
        $st->bindParam(':id_carrito', $id_carrito, PDO::PARAM_INT);
        $st->execute();
        $result = $st->fetch(PDO::FETCH_ASSOC);
        
        return $result; // Retorna los datos del carrito si existe, o false si no existe
    }


    /**
     * Borrar departamento
     *
     * @return integer $rc cantidad de filas afectadas por el delete
     * @param  integer $id el identificador del departamento a eliminar
     */public function delete($id)
    {
        $this->db();
        $sql = "delete from detalle_carrito where id_carrito = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->execute();

        $sql2 = "delete from carrito where id_carrito = :id";
        $st2 = $this->db->prepare($sql2);
        $st2->bindParam(":id", $id, PDO::PARAM_INT);
        $st2->execute();


        $rc = $st2->rowCount();
        return $rc;
    }

}
$carrito = new Carrito;
?>