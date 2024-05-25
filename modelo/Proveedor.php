

<?php
    class Proveedor extends Conectar{
        public function Proveedor(){
            $conectar = parent::Conexion();
            $sql = "SP_ListarProveedores";
            $query = $conectar -> prepare($sql);
            $query -> execute();
            return $query -> fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>