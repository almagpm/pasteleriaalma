<?php
require_once(__DIR__."/sistema.php");

/**
 * Controller Departamento
 */
class Localidad extends Sistema
{
    /**
     * Obtiene los departamentos solicitado
     *
     * @return array $data los departamentos solicitados
     * @param integer $id si se especifica un id solo obtiene el departamento solicitado, de lo contrario obtiene todos
     */
    public function get($id = null)
    {
        $this->db2();
        if (is_null($id)) {
            $sql = "select * from localidad";
            $st = $this->db2->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "select * from localidad where id_localidad = :id";
            $st = $this->db2->prepare($sql);
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
            $sql = "INSERT INTO localidad (localidad) VALUES (:localidad)";
            $st = $this->db->prepare($sql);
            $st->bindParam(":localidad", $data['localidad'], PDO::PARAM_STR);
            $st->execute();
            $rc = $st->rowCount();

            $this->db2();
            $sql2 = "INSERT INTO localidad (localidad) VALUES (:localidad)";
            $st2 = $this->db2->prepare($sql2); // Corregir aquí, se utiliza $sql2 en lugar de $sql
            $st2->bindParam(":localidad", $data['localidad'], PDO::PARAM_STR);
            $st2->execute();
            $rc2 = $st2->rowCount();
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
        try {
            
            $this->db();
            $this->db->beginTransaction();
            $sql = "update localidad set localidad = :localidad where id_localidad = :id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->bindParam(":localidad", $data['localidad'], PDO::PARAM_STR);
            $st->execute();
            $rc = $st->rowCount();

            $this->db2();
            $sql2 = "update localidad set localidad = :localidad where id_localidad = :id";
            $st2 = $this->db2->prepare($sql);
            $st2->bindParam(":id", $id, PDO::PARAM_INT);
            $st2->bindParam(":localidad", $data['localidad'], PDO::PARAM_STR);
            $st2->execute();
            $rc2 = $st2->rowCount();
            
            $this->db->commit();
        } catch (PDOException $Exception) {
            $rc = 0;
            $this->db->rollBack();
        }
        return $rc;
       
    }

    /**
     * Borrar departamento
     *
     * @return integer $rc cantidad de filas afectadas por el delete
     * @param  integer $id el identificador del departamento a eliminar
     */public function delete($id)
    {
        try {
           
            $this->db();
            $this->db->beginTransaction();
            $sql = "delete from localidad where id_localidad = :id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $rc = $st->rowCount();

            $this->db2();
            $sql2 = "delete from localidad where id_localidad = :id";
            $st2 = $this->db->prepare($sql2);
            $st2->bindParam(":id", $id, PDO::PARAM_INT);
            $st2->execute();
            $rc2 = $st2->rowCount();
            $this->db->commit();
        } catch (PDOException $Exception) {
            $rc = 0;
            $this->db->rollBack();
        }
            return $rc;
    }

}
$localidad = new Localidad;
?>