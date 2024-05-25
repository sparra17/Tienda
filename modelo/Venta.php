<?php
    class Venta extends Conectar{
        public function InsertTempVenta(){
            $conectar = parent::Conexion();
            $sql = "CrearIdVenta ";
            $query = $conectar -> prepare($sql);
            $query -> execute();
            return $query -> fetchAll(PDO::FETCH_ASSOC);    
        }

    }
?>