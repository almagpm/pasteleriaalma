<?php
/**
 * Clase principal del sistema.
 *
 * @autor 2023 Escribe tu nombre
 */
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require_once('config.php');
class Sistema
{
   var $db = null;
   /**
    * Conexión a la base de datos
    *
    * @return PDOObject en $this->db
    * @param del archivo de configuracion config.php
    */
   public function db()
   {
      $dsn = DBDRIVER . ':host=' . DBHOST . ';dbname=' . DBNAME . ';port=' . DBPORT;
      $this->db = new PDO($dsn, DBUSER, DBPASS);
   }

   /**
    * Imprime un mensaje usando alerts de bootstrap
    *
    * @param $color el color del alert
    *        $msg el mesaje a imprimir
    */
   public function flash($color, $msg)
   {
      include('views/flash.php');
   }

   /**
    * Aquí al documentación
    *
    * @param 
    */
   public function uploadfile($tipo, $ruta, $archivo)
   {
      $name = false;
      $uploads['archivo'] = array("application/gzip", "application/zip", "application/x-zip-compressed");
      $uploads['fotografia'] = array("image/jpeg", "image/jpg", "image/gif", "image/png");
      if ($_FILES[$tipo]['error'] == 4) {
         return $name;
      }
      if ($_FILES[$tipo]['error'] == 0) {
         if (in_array($_FILES[$tipo]['type'], $uploads['archivo'])) {
            if ($_FILES[$tipo]['size'] <= 2 * 1048 * 1048) //Se puede declarar otro arreglo de tamaños
            {
               $origen = $_FILES[$tipo]['tmp_name'];
               $ext = explode(".", $_FILES[$tipo]['name']);
               $ext = $ext[sizeof($ext) - 1];
               $destino = $ruta . $archivo . "." . $ext;
               if (move_uploaded_file($origen, $destino)) {
                  $name = $destino;
               }
            }
         }
      }
      return $name;
   }

   public function login($correo, $contrasena)
   {
      if (!is_null($contrasena)) {
         if (strlen($contrasena) > 0) {
            if ($this->validateEmail($correo)) {
               $contrasena = md5($contrasena);
               $this->db();
               $sql = 'select id_usuario, correo, username from usuario where correo = :correo and contrasena = :contrasena';
               $st = $this->db->prepare($sql);
               $st->bindParam(":correo", $correo, PDO::PARAM_STR);
               $st->bindParam(":contrasena", $contrasena, PDO::PARAM_STR);
               $st->execute();
               $data = $st->fetchAll(PDO::FETCH_ASSOC);
               if (isset($data[0])) {
                  $data = $data[0];
                  $_SESSION = $data;
                  $_SESSION['roles'] = $this->getRoles($correo);
                  $_SESSION['privilegios'] = $this->getPrivilegios($correo);
                  $_SESSION['validado'] = true;
                  $this->validateRol1();
                  return true;
               }
            }
         }
      }
      return false;
   }

   public function logout()
   {
      unset($_SESSION["logueado"]);
      session_destroy();
   }

   public function getRoles($correo)
   {
      $roles = array();
      if ($this->validateEmail($correo)) {
         $this->db();
         $sql = 'select r.rol from usuario u 
         join usuario_rol ur on u.id_usuario = ur.id_usuario 
         join rol r on r.id_rol = ur.id_rol
         where u.correo = :correo';
         $st = $this->db->prepare($sql);
         $st->bindParam(":correo", $correo, PDO::PARAM_STR);
         $st->execute();
         $data = $st->fetchAll(PDO::FETCH_ASSOC);
         foreach ($data as $key => $rol) {
            array_push($roles, $rol['rol']);
         }
      }
      return $roles;
   }

   public function getPrivilegios($correo)
   {
      $privilegios = array();
      if ($this->validateEmail($correo)) {
         $this->db();
         $sql = 'select p.privilegio from privilegio p 
         join rol_privilegio rp on p.id_privilegio = rp.id_privilegio
         join rol r on r.id_rol = rp.id_rol
         join usuario_rol ur on r.id_rol = ur.id_rol
         join usuario u on u.id_usuario = ur.id_usuario
         where u.correo = :correo';
         $st = $this->db->prepare($sql);
         $st->bindParam(":correo", $correo, PDO::PARAM_STR);
         $st->execute();
         $data = $st->fetchAll(PDO::FETCH_ASSOC);
         foreach ($data as $key => $privilegio) {
            array_push($privilegios, $privilegio['privilegio']);
         }
      }
      return $privilegios;
   }

   public function validateEmail($correo)
   {
      if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
         return true;
      }
      return false;
   }

   public function validateRol1()
   {
      if (isset($_SESSION['validado'])) {
         if ($_SESSION['validado']) {
            if (isset($_SESSION['roles'])) {
               if (count($_SESSION['roles']) == 1 && in_array('Usuario', $_SESSION['roles'])) {
                  // Si el usuario solo tiene el rol "Usuario", redirige a la página deseada
                  header("Location: ../usuario/consesion/index.php");
               } else {
                  // El usuario tiene otros roles además de "Usuario"
                  if (in_array($rol, $_SESSION['roles'])) {
                     // El usuario tiene el rol adecuado, continua con la operación
                     print('Eres un usuario también');
                  } else {
                     // El usuario no tiene el rol adecuado, muestra un mensaje de error
                     $this->killApp('No tienes el rol adecuado.');
                  }
               }
            } else {
               $this->killApp('No tienes roles asignados.');
            }
         } else {
            $this->killApp('No estás validado.');
         }
      } else {
         $this->killApp('No te has logueado.');
      }
      
   }

   public function validateRol($rol)
   {
      if (isset($_SESSION['validado'])) {
         if ($_SESSION['validado']) {
            if (isset($_SESSION['roles'])) {
               
            } else {
               $this->killApp('No tienes roles asignados.');
            }
         } else {
            $this->killApp('No estás validado.');
         }
      } else {
         $this->killApp('No te has logueado.');
      }
      
   }

   public function validatePrivilegio($privilegio)
   {
      if (isset($_SESSION['validado'])) {
         if ($_SESSION['validado']) {
            if (isset($_SESSION['privilegios'])) {
               if (!in_array($privilegio, $_SESSION['privilegios'])) {
                  $this->killApp('No tienes el privilegio adecuado.');
               }
            } else {
               $this->killApp('No tienes privilegios asignados.');
            }
         } else {
            $this->killApp('No estás validado.');
         }
      } else {
         $this->killApp('No te has logueado.');
      }
   }

   

   public function killApp($mensaje)
   {
      ob_end_clean();
      include('views/header_error.php');
      $this->flash('danger', $mensaje);
      include('views/footer_error.php');
      die();
   }

   public function forgot($destinatario){
      if($this -> validateEmail($destinatario)){

            $token=$this->generarToken($destinatario);
         
            require '../vendor/autoload.php';

            $mail = new PHPMailer();

            $mail->isSMTP();

            $mail->SMTPDebug = SMTP::DEBUG_SERVER;

            $mail->Host = 'smtp.gmail.com';


            $mail->Port = 465;


            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

            $mail->SMTPAuth = true;


            $mail->Username = '20030274@itcelaya.edu.mx';

            $mail->Password = 'titubvehmksrrhzb';


            $mail->setFrom('20030274@itcelaya.edu.mx', 'Alma Ponce');


            $mail->addAddress($destinatario, 'Alma Ponce');


            $mail->Subject = 'Recuperacion de contraseña';

            $mail->msgHTML('hola esto es una prueba'.$token);

      if (!$mail->send()) {
         echo 'Mailer Error: ' . $mail->ErrorInfo;
      } else {
         echo 'Message sent!';

      }

      function save_mail($mail)
      {
         
         $path = '{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail';

         $imapStream = imap_open($path, $mail->Username, $mail->Password);

         $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
         imap_close($imapStream);

         return $result;
      }
      

      }
      

   }

   public function generarToken($correo){
      $token = "papaschicas";
      $n= rand(1, 1000000);
      $x =md5(md5($token));
      $y = md5($x . $n);
      $token = md5($y);
      $token = md5($token. 'calamardo');
      $token = md5('patricio').md5($token.$correo);
      return $token;

   }

   public function getDatosCuenta($id_user)
    {
        $this->db();
        $sql = "SELECT u.*, l.localidad FROM usuario u JOIN localidad l ON u.id_localidad=l.id_localidad WHERE u.id_usuario = :id_user";
        $st = $this->db->prepare($sql);
        $st->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $st->execute();
        $data = $st->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    
    public function editDatosCuenta($id_user, $data)
{
    $this->db();
    if($this->validateEmail($data['correo'])){
        try {
            $this->db->beginTransaction();
            if (empty($data['contrasena'])) {
                $sql = "UPDATE usuario SET 
                            username = :username, 
                            primer_apellido = :primer_apellido, 
                            segundo_apellido = :segundo_apellido, 
                            nombre = :nombre, 
                            nacimiento = :nacimiento, 
                            telefono = :telefono, 
                            lada = :lada, 
                            correo = :correo, 
                            id_localidad = :id_localidad, 
                            calle = :calle, 
                            n_calle = :n_calle 
                        WHERE id_usuario = :id";
            } else {
                $sql = "UPDATE usuario SET 
                            username = :username, 
                            primer_apellido = :primer_apellido, 
                            segundo_apellido = :segundo_apellido, 
                            nombre = :nombre, 
                            nacimiento = :nacimiento, 
                            telefono = :telefono, 
                            lada = :lada, 
                            correo = :correo, 
                            contrasena = md5(:contrasena), 
                            id_localidad = :id_localidad, 
                            calle = :calle, 
                            n_calle = :n_calle 
                        WHERE id_usuario = :id";
            }
            
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id_user, PDO::PARAM_INT);
            $st->bindParam(":username", $data['username'], PDO::PARAM_STR);
            $st->bindParam(":primer_apellido", $data['primer_apellido'], PDO::PARAM_STR);
            $st->bindParam(":segundo_apellido", $data['segundo_apellido'], PDO::PARAM_STR);
            $st->bindParam(":nombre", $data['nombre'], PDO::PARAM_STR);
            $st->bindParam(":nacimiento", $data['nacimiento'], PDO::PARAM_STR);
            $st->bindParam(":telefono", $data['telefono'], PDO::PARAM_STR);
            $st->bindParam(":lada", $data['lada'], PDO::PARAM_STR);
            $st->bindParam(":correo", $data['correo'], PDO::PARAM_STR);
            if (!empty($data['contrasena'])) {
                $st->bindParam(":contrasena", $data['contrasena'], PDO::PARAM_STR);
            }
            $st->bindParam(":id_localidad", $data['id_localidad'], PDO::PARAM_INT);
            $st->bindParam(":calle", $data['calle'], PDO::PARAM_STR);
            $st->bindParam(":n_calle", $data['n_calle'], PDO::PARAM_STR);

            $st->execute();
            $rc = $st->rowCount();
            return 'Correcto';
            
            $this->db->commit();
        } catch (PDOException $Exception) {
            $rc = 0;
            return 'false';
            $this->db->rollBack();
        }

    } else {
        $this->flash('danger', "Correo no válido, intente de nuevo");
    }
    
    return $rc;
}

}
$sistema = new sistema;
?>