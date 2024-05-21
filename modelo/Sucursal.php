<?php
    class Sucursal extends Conectar{
        public function sucursales(){
            $conectar = parent::Conexion();
            $sql = "SP_Sucursales";
            $query = $conectar -> prepare($sql);
            $query -> execute();
            return $query -> fetchAll(PDO::FETCH_ASSOC);

        }
    }
?>