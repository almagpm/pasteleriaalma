<?php
require_once("sistema.php");
class Pedido extends Sistema{
    public function get($id_user){
        $this -> db();
        $sql = "SELECT * FROM pedido WHERE id_usuario = :id_user";
        $st = $this -> db -> prepare($sql);
        $st -> bindParam(':id_user',$id_user,PDO::PARAM_INT);
        $st -> execute();
        $data = $st -> fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function get_detalle($id_user){
        $this -> db();
        $sql = "SELECT pd.*,a.nombre, a.imagen FROM pedido_detalle pd JOIN producto a on pd.id_producto= a.id_producto  LEFT JOIN pedido p on p.id_pedido=pd.id_pedido WHERE p.id_usuario=:id_user";
        $st = $this -> db -> prepare($sql);
        $st -> bindParam(':id_user',$id_user,PDO::PARAM_INT);
        $st -> execute();
        $data = $st -> fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}
$pedido = new Pedido();
?>