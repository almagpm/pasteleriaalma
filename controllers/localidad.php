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
        $this->db();
        if (is_null($id)) {
            $sql = "select * from localidad";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "select * from localidad where id_localidad = :id";
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
        $this->db();
        $sql = "insert into privilegio (privilegio) values (:privilegio)";
        $st = $this->db->prepare($sql);
        $st->bindParam(":privilegio", $data['privilegio'], PDO::PARAM_STR);
        $st->execute();
        $rc = $st->rowCount();
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
        $sql = "update privilegio set privilegio = :privilegio where id_privilegio = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->bindParam(":privilegio", $data['privilegio'], PDO::PARAM_STR);
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
        $sql = "delete from privilegio where id_privilegio = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

}
$localidad = new Localidad;
?>