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
        $sql = "delete from tarea where id_tarea = :id";
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

    public function editTask($id, $id_tarea, $data2)
    {
        $this->db();
        $sql = "update tarea set tarea = :tarea, avance = :avance where id_tarea = :id_tarea and id_proyecto = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->bindParam(":id_tarea", $id_tarea, PDO::PARAM_INT);
        $st->bindParam(":tarea", $data2['tarea'], PDO::PARAM_STR);
        $st->bindParam(":avance", $data2['avance'], PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

}
$proyecto = new Proyecto;
?>