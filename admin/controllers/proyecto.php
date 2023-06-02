<?php
require_once("sistema.php");

/**
 * Controller Proyecto
 */
class Proyecto extends Sistema
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
            $sql = "select * from categoria";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "select * from categoria where id_categoria=:id";
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
    public function new ($data)
    {
        $this->db();
        $sql = "insert into categoria (categoria) values (:categoria)";
       
        $st = $this->db->prepare($sql);
        $st->bindParam(":categoria", $data['categoria'], PDO::PARAM_STR);
        $st->execute();
        $rc = $st->rowCount();
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
        $this->db();
        $sql = "update categoria set categoria = :categoria  where id_categoria = :id";
        
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->bindParam(":categoria", $data['categoria'], PDO::PARAM_STR);
       
        $st->execute();
        $rc = $st->rowCount();
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
        $sql = "delete from categoria where id_categoria = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    public function getTask ($id)
    {
        $this->db();
        if (is_null($id)) {
            $sql = "select * from producto t left join categoria p on p.id_categoria = t.id_categoria";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "select * from producto t left join categoria p on p.id_categoria = t.id_categoria where t.id_categoria=:id";
            
            $st = $this->db->prepare($sql);

            $st->bindParam(":id", $id, PDO::PARAM_INT);
            
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
            
        }
        return $data;
    }

    public function getTaskOne($id)
    {
        $data = null;
        $this->db();
        if (is_null($id)) {
            die("Ocurrió un error");
        } else {
            $sql = "select * from producto t left join categoria p on p.id_categoria = t.id_categoria where t.id_producto=:id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }

    public function deleteTask($id)
    {
        $this->db();
        $sql = "delete from producto where id_producto = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    public function newTask ($id, $data)
    {
        $this->db();
        $sql = "insert into producto (precio_referencia, nombre, descripcion, id_categoria) values (:id_categoria, :nombre, :descripcion, :precio_referencia)";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id_categoria", $id, PDO::PARAM_INT);
        $st->bindParam(":nombre", $data['nombre'], PDO::PARAM_STR);
        $st->bindParam(":descripcion", $data['descripcion'], PDO::PARAM_STR);
        $st->bindParam(":precio_referencia", $data['precio_referencia'], PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    public function newProducto($id, $data)
    {
        $this->db();
        try {
            $this->db->beginTransaction();
            $sql = "insert into producto (precio_referencia, nombre, descripcion, imagen, id_categoria) 
        values (:precio_referencia, :nombre, :descripcion, :imagen, :id_categoria)";
            $st = $this->db->prepare($sql);
            $st->bindParam(":precio_referencia", $data['precio_referencia'], PDO::PARAM_STR);
            $st->bindParam(":nombre", $data['nombre'], PDO::PARAM_STR);
            $imagen = file_get_contents($_FILES['imagen']['tmp_name']);
            $st->bindParam(":imagen", $imagen, PDO::PARAM_STR);
            $st->bindParam(":descripcion", $data['descripcion'], PDO::PARAM_STR);
            $st->bindParam(":id_categoria", $id, PDO::PARAM_STR);

            $st->execute();
            $rc = $st->rowCount();
            $this->db->commit();
        } catch (PDOException $Exception) {
            $rc = 0;
            $this->db->rollBack();
        }
        return $rc;
    }

    public function updateProducto($id, $data)
    {
        $this->db();
        try {
            $this->db->beginTransaction();
            if (!empty($_FILES['imagen']['tmp_name'])) {
                // El archivo ha sido cargado, puedes obtener su contenido
                $sql = "UPDATE producto SET precio_referencia = :precio_referencia, nombre = :nombre, descripcion = :descripcion, imagen = :imagen, id_categoria = :id_categoria WHERE id_producto = :id";
                $st = $this->db->prepare($sql);
                $st->bindParam(":precio_referencia", $data['precio_referencia'], PDO::PARAM_STR);
                $st->bindParam(":nombre", $data['nombre'], PDO::PARAM_STR);
                $imagen = file_get_contents($_FILES['imagen']['tmp_name']);
                $st->bindParam(":imagen", $imagen, PDO::PARAM_STR);
                $st->bindParam(":descripcion", $data['descripcion'], PDO::PARAM_STR);
                $st->bindParam(":id_categoria", $data['id_categoria'], PDO::PARAM_STR);
                $st->bindParam(":id", $id, PDO::PARAM_INT);
            
                $st->execute();
                $rc = $st->rowCount();
            } else {
                $sql = "UPDATE producto SET precio_referencia = :precio_referencia, nombre = :nombre, descripcion = :descripcion, id_categoria = :id_categoria WHERE id_producto = :id";
                $st = $this->db->prepare($sql);
                $st->bindParam(":precio_referencia", $data['precio_referencia'], PDO::PARAM_STR);
                $st->bindParam(":nombre", $data['nombre'], PDO::PARAM_STR);
                $st->bindParam(":descripcion", $data['descripcion'], PDO::PARAM_STR);
                $st->bindParam(":id_categoria", $data['id_categoria'], PDO::PARAM_STR);
                $st->bindParam(":id", $id, PDO::PARAM_INT);
            
                $st->execute();
                $rc = $st->rowCount();
            }
            
            
            $this->db->commit();
        } catch (PDOException $Exception) {
            $rc = 0;
            $this->db->rollBack();
        }
        return $rc;
    }


}
$proyecto = new Proyecto;
?>