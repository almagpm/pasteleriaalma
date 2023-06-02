<?php
require_once("sistema.php");

/**
 * Controller bizcocho
 */
class Bizcocho extends Sistema
{
    /**
     * Obtiene los bizcochos solicitado
     *
     * @return array $data los bizcochos solicitados
     * @param integer $id si se especifica un id solo obtiene el bizcocho solicitado, de lo contrario obtiene todos
     */
    public function get($id = null)
    {
        $this->db();
        if (is_null($id)) {
            $sql = "select * from bizcocho";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "select * from bizcocho where id_bizcocho = :id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }

    /**
     * Nuevo bizcocho
     *
     * @return integer $rc cantidad de filas afectadas por el insert
     * @param array $data los datos del nuevo bizcocho
     */
    public function new ($data)
    {
        $this->db();
        $sql = "insert into bizcocho (sabor, precio) values (:sabor, :precio)";
        $st = $this->db->prepare($sql);
        $st->bindParam(":sabor", $data['sabor'], PDO::PARAM_STR);
        $st->bindParam(":precio", $data['precio'], PDO::PARAM_STR);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    /**
     * Editar bizcocho
     *
     * @return integer $rc cantidad de filas afectadas por el update
     * @param  integer $id el identificador del bizcocho a editar
     *         array $data los datos modificados del bizcocho
     */
    public function edit($id, $data)
    {
        $this->db();
        $sql = "update bizcocho set sabor= :sabor, precio=:precio  where id_bizcocho = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->bindParam(":sabor", $data['sabor'], PDO::PARAM_STR);
        $st->bindParam(":precio", $data['precio'], PDO::PARAM_STR);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    /**
     * Borrar bizcocho
     *
     * @return integer $rc cantidad de filas afectadas por el delete
     * @param  integer $id el identificador del bizcocho a eliminar
     */public function delete($id)
    {
        $this->db();
        $sql = "delete from bizcocho where id_bizcocho = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

}
$bizcocho = new Bizcocho;
?>