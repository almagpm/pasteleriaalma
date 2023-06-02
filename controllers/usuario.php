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
    public function new($id, $data)
    {
        $this->db();
        if($this->validateEmail($data['correo'])){
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
                
                if ($rc > 0) {
                    $usuarioId = $this->db->lastInsertId();
                    
                    // Insertar en la tabla usuario_rol
                    $rolId = 3; // ID del rol por defecto
                    $sqlUsuarioRol = "INSERT INTO usuario_rol (id_usuario, id_rol) VALUES (:id_usuario, :id_rol)";
                    $stUsuarioRol = $this->db->prepare($sqlUsuarioRol);
                    $stUsuarioRol->bindParam(":id_usuario", $usuarioId, PDO::PARAM_INT);
                    $stUsuarioRol->bindParam(":id_rol", $rolId, PDO::PARAM_INT);
                    $stUsuarioRol->execute();
                    
                    $rcUsuarioRol = $stUsuarioRol->rowCount();
                    if ($rcUsuarioRol > 0) {
                        $this->flash('light', "Puede iniciar sesion");
                    } else {
                        $this->flash('dark', "Todavia no puede iniciar sesion, espere correo del administrador");
                    }
                } else {
                    // Error al insertar en la tabla usuario
                }

                

                
                $this->db->commit();
            } catch (PDOException $Exception) {
                $rc = 0;
                $this->db->rollBack();
            }

        }else{
            $this->flash('danger', "Correo no valido, intente de nuevo");
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
        $sql = "delete from departamento where id_departamento = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

}
$usuario= new Usuario;
?>