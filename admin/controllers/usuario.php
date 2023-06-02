<?php
require_once("sistema.php");

/**
 * Controller Departamento
 */
class Usuario extends Sistema
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
            $sql = "select * from usuario";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "select * from usuario where id_usuario = :id";
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
    public function new($data)
    {
        $rc=0;
        $this->db();
            try {
                $this->db->beginTransaction();
                $sql = "INSERT INTO usuario (username, primer_apellido, segundo_apellido, nombre, nacimiento, telefono, lada, correo, contrasena, id_localidad, calle, n_calle) VALUES (:username, :primer_apellido, :segundo_apellido, :nombre, :nacimiento, :telefono, :lada, :correo, md5(:contrasena), :id_localidad, :calle, :n_calle)";
                $st = $this->db->prepare($sql);
                $st->bindParam(":username", $data['username'], PDO::PARAM_STR);
                $st->bindParam(":primer_apellido", $data['primer_apellido'], PDO::PARAM_STR);
                $st->bindParam(":segundo_apellido", $data['segundo_apellido'], PDO::PARAM_STR);
                $st->bindParam(":nombre", $data['nombre'], PDO::PARAM_STR);
                $st->bindParam(":nacimiento", $data['nacimiento'], PDO::PARAM_STR);
                $st->bindParam(":telefono", $data['telefono'], PDO::PARAM_STR);
                $st->bindParam(":lada", $data['lada'], PDO::PARAM_STR);
                $st->bindParam(":correo", $data['correo'], PDO::PARAM_STR);
                $st->bindParam(":contrasena", $data['contrasena'], PDO::PARAM_STR);
                $st->bindParam(":id_localidad", $data['id_localidad'], PDO::PARAM_INT);
                $st->bindParam(":calle", $data['calle'], PDO::PARAM_STR);
                $st->bindParam(":n_calle", $data['n_calle'], PDO::PARAM_STR);

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
     * Editar departamento
     *
     * @return integer $rc cantidad de filas afectadas por el update
     * @param  integer $id el identificador del departamento a editar
     *         array $data los datos modificados del departamento
     */
    public function edit($id, $data)
{
    $rc = 0;
    $this->db();
    try {
        $this->db->beginTransaction();
        if($data['cambiar']==1){
        
        $sql = "UPDATE usuario SET username = :username, primer_apellido = :primer_apellido, segundo_apellido = :segundo_apellido, nombre = :nombre, nacimiento = :nacimiento, telefono = :telefono, lada = :lada, correo = :correo, contrasena = md5(:contrasena), id_localidad = :id_localidad, calle = :calle, n_calle = :n_calle WHERE id_usuario = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":username", $data['username'], PDO::PARAM_STR);
        $st->bindParam(":primer_apellido", $data['primer_apellido'], PDO::PARAM_STR);
        $st->bindParam(":segundo_apellido", $data['segundo_apellido'], PDO::PARAM_STR);
        $st->bindParam(":nombre", $data['nombre'], PDO::PARAM_STR);
        $st->bindParam(":nacimiento", $data['nacimiento'], PDO::PARAM_STR);
        $st->bindParam(":telefono", $data['telefono'], PDO::PARAM_STR);
        $st->bindParam(":lada", $data['lada'], PDO::PARAM_STR);
        $st->bindParam(":correo", $data['correo'], PDO::PARAM_STR);
        $st->bindParam(":contrasena", $data['contrasena'], PDO::PARAM_STR);
        $st->bindParam(":id_localidad", $data['id_localidad'], PDO::PARAM_INT);
        $st->bindParam(":calle", $data['calle'], PDO::PARAM_STR);
        $st->bindParam(":n_calle", $data['n_calle'], PDO::PARAM_STR);
        $st->bindParam(":id", $id, PDO::PARAM_INT);

        $st->execute();
        $rc = $st->rowCount();
    }else{
        $sql = "UPDATE usuario SET username = :username, primer_apellido = :primer_apellido, segundo_apellido = :segundo_apellido, nombre = :nombre, nacimiento = :nacimiento, telefono = :telefono, lada = :lada, correo = :correo, id_localidad = :id_localidad, calle = :calle, n_calle = :n_calle WHERE id_usuario = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":username", $data['username'], PDO::PARAM_STR);
        $st->bindParam(":primer_apellido", $data['primer_apellido'], PDO::PARAM_STR);
        $st->bindParam(":segundo_apellido", $data['segundo_apellido'], PDO::PARAM_STR);
        $st->bindParam(":nombre", $data['nombre'], PDO::PARAM_STR);
        $st->bindParam(":nacimiento", $data['nacimiento'], PDO::PARAM_STR);
        $st->bindParam(":telefono", $data['telefono'], PDO::PARAM_STR);
        $st->bindParam(":lada", $data['lada'], PDO::PARAM_STR);
        $st->bindParam(":correo", $data['correo'], PDO::PARAM_STR);
        $st->bindParam(":id_localidad", $data['id_localidad'], PDO::PARAM_INT);
        $st->bindParam(":calle", $data['calle'], PDO::PARAM_STR);
        $st->bindParam(":n_calle", $data['n_calle'], PDO::PARAM_STR);
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


    /**
     * Borrar departamento
     *
     * @return integer $rc cantidad de filas afectadas por el delete
     * @param  integer $id el identificador del departamento a eliminar
     */public function delete($id)
    {
        $this->db();
        $sql = "delete from usuario where id_usuario = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    public function getRol($id)
    {
        $this->db();
        if (is_null($id)) {
            $sql = "select r.* from rol r join usuario_rol ur on r.id_rol = ur.id_rol";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "select r.* from rol r join usuario_rol ur on r.id_rol = ur.id_rol where ur.id_usuario=:id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }
    public function deleteRol($id, $id2)
    {
        $this->db();
        $sql = "delete from usuario_rol where id_usuario = :id and id_rol=:id2";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->bindParam(":id2", $id2, PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    public function newRol($id, $data)
    {
        $this->db();
        $rc=0;

        try{
            $sql = "insert into usuario_rol (id_rol,id_usuario) values (:id_rol, :id_usuario)";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id_rol",$data['id_rol'],  PDO::PARAM_INT);
            $st->bindParam(":id_usuario",$data['id_usuario'], PDO::PARAM_INT);
            $st->execute();
            $rc = $st->rowCount();
            
        }catch(PDOException $e){
            echo "Error al insertar el rol, ya existe ese rol para este usuario " ;

        }
        return $rc;
    }

}
$usuario= new Usuario;
?>