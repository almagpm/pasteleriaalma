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
            $sql = "SELECT c.id_carrito, c.fecha, c.id_usuario, dc.id_producto, dc.cantidad, dc.costo from carrito c LEFT JOIN detalle_carrito dc ON c.id_carrito=dc.id_carrito";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "SELECT dc.*, p.*, c.* from carrito c RIGHT JOIN detalle_carrito dc ON c.id_carrito=dc.id_carrito RIGHT JOIN producto p ON dc.id_producto=p.id_producto where c.id_usuario=:id";
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
    public function new($id_user, $id_articulo, $cantidad)
{
    $this->db();
    
    // Verificar si ya existe un carrito con el ID de usuario
    $existingCart = $this->checkExistingCart($id_user);
    
    if ($existingCart) {
        // Ya existe un carrito para este usuario, puedes realizar alguna acción o devolver un mensaje de error
        // Ya existe un carrito para este usuario
        $id_carrito = $existingCart['id_carrito']; // Obtener la ID del carrito existente
        
        // Insertar el ID del carrito en la tabla detalle_carrito

        $this->insertDetalleCarrito($id_carrito, $id_articulo, $cantidad);
        
        return $id_carrito;
    }
        // Obtener la fecha actual
        $currentDate = date('Y-m-d'); // Formato: YYYY-MM-DD
        
        // Continuar con la inserción del nuevo carrito
        $sql = 'INSERT INTO carrito(fecha, id_usuario) VALUES (:fecha, :id_user)';
        $st = $this->db->prepare($sql);
        $st->bindParam(':fecha', $currentDate, PDO::PARAM_STR); // Bind a la variable $currentDate en lugar de :id_user
        $st->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $st->execute();
        
        // Obtener el ID del carrito recién insertado
        $id_carrito = $this->db->lastInsertId();
        
        // Insertar el ID del carrito en la tabla detalle_carrito

        $this->insertDetalleCarrito($id_carrito, $id_producto, $cantidad);
        
        return $id_carrito;
    }

    public function insertDetalleCarrito($id_carrito, $id_producto, $cantidad)
    {
        
    try {
        $sql = 'INSERT INTO detalle_carrito(id_carrito, id_articulo, cantidad) VALUES (:id_carrito, :id_articulo, :cantidad)';
        $st = $this->db->prepare($sql);
        $st->bindParam(':id_carrito', $id_carrito, PDO::PARAM_INT);
        $st->bindParam(':id_articulo', $id_articulo, PDO::PARAM_INT);
        $st->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
        $st->execute();
    } catch (PDOException $e) {
        if ($e->getCode() === '23000' && $e->errorInfo[1] === 1062) {
            // Error de duplicidad de clave primaria (producto ya existente en el carrito)
           $this->flash('primary', 'Ese producto ya se encuentra en el carrito');
        } else {
            // Otro tipo de error
            $this->flash('primary', 'Ese producto ya se encuentra en el carrito');
        }
    }
    }
    public function checkExistingCart($id_user)
    {
        $sql = 'SELECT * FROM carrito WHERE id_usuario = :id_user';
        $st = $this->db->prepare($sql);
        $st->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $st->execute();
        $result = $st->fetch(PDO::FETCH_ASSOC);
        
        return $result; // Retorna los datos del carrito si existe, o false si no existe
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
        $sql = "update departamento set departamento = :departamento where id_departamento = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->bindParam(":departamento", $data['departamento'], PDO::PARAM_STR);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    /**
     * Borrar departamento
     *
     * @return integer $rc cantidad de filas afectadas por el delete
     * @param  integer $id el identificador del departamento a eliminar
     */public function delete($id)
    {
        $this->db();
        try {
            $this->db->beginTransaction();
            $sql = "delete from detalle_carrito where id_carrito = :id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $sql2 = "delete from carrito where id_carrito = :id";
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

    public function cantidad($id_user){
        $this -> db();
        $sql = 'SELECT SUM(dc.cantidad) as suma from carrito c LEFT JOIN detalle_carrito dc ON c.id_carrito=dc.id_carrito where c.id_usuario=:id';
        $st = $this -> db -> prepare($sql);
        $st -> bindParam(':id',$id_user,PDO::PARAM_INT);
        $st -> execute();
        $data = $st -> fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    

}
$carrito = new Carrito;
?>