<?php
require_once("sistema.php");

/**
 * Controller relleno
 */
class Bizcocho extends Sistema
{
    /**
     * Obtiene los bizcochos solicitado
     *
     * @return array $data los bizcochos solicitados
     * @param integer $id si se especifica un id solo obtiene el relleno solicitado, de lo contrario obtiene todos
     */
    public function get($id = null)
    {
        $this->db();
        if (is_null($id)) {
            $sql = "select * from relleno";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "select * from relleno where id_bizcocho = :id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }

    /**
     * Nuevo relleno
     *
     * @return integer $rc cantidad de filas afectadas por el insert
     * @param array $data los datos del nuevo relleno
     */
    public function new($data)
    {
        $this->db();
        $sql = "INSERT INTO relleno (relleno, precio) VALUES (:relleno, :precio)";
        $st = $this->db->prepare($sql);
        
        $st->bindParam(":relleno", $data['relleno'], PDO::PARAM_STR);
        $st->bindParam(":precio", $data['precio'], PDO::PARAM_STR);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }


    /**
     * Editar relleno
     *
     * @return integer $rc cantidad de filas afectadas por el update
     * @param  integer $id el identificador del relleno a editar
     *         array $data los datos modificados del relleno
     */
    public function edit($id, $data)
    {
        $this->db();
        $sql = "update relleno set relleno= :relleno, precio=:precio  where id_relleno = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->bindParam(":relleno", $data['relleno'], PDO::PARAM_STR);
        $st->bindParam(":precio", $data['precio'], PDO::PARAM_STR);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    /**
     * Borrar relleno
     *
     * @return integer $rc cantidad de filas afectadas por el delete
     * @param  integer $id el identificador del relleno a eliminar
     */public function delete($id)
    {
        $this->db();
        $sql = "delete from relleno where id_relleno = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

}
$relleno = new Bizcocho;
?>