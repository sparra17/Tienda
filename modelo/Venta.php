<?php
    class Venta extends Conectar{
        public function InsertTempVenta(){
            $conectar = parent::Conexion();
            $sql = "CrearIdVenta ";
            $query = $conectar -> prepare($sql);
            $query -> execute();
            return $query -> fetchAll(PDO::FETCH_ASSOC);    
        }

        public function InsertDetalleVenta($idVenta, $idProducto, $PrecioVenta, $Cantidad){
            $conectar = parent::Conexion();
            $sql = "InsertDetalleVenta ?,?,?,?";
            $query = $conectar -> prepare($sql);
            $query -> bindValue(1,$idVenta);
            $query -> bindValue(2,$idProducto);
            $query -> bindValue(3,$PrecioVenta);
            $query -> bindValue(4,$Cantidad);
            $query -> execute();
            //return $query -> fetchAll(PDO::FETCH_ASSOC);
        }

        public function ListarTempVenta($idVenta){
            $conectar = parent::Conexion();
            $sql = "ListarTempVenta ?";
            $query = $conectar -> prepare($sql);
            $query -> bindValue(1,$idVenta);
            $query -> execute();
            return $query -> fetchAll(PDO::FETCH_ASSOC);    
        }

        public function EliminarTempVenta($idTempVenta){
            $conectar = parent::Conexion();
            $sql = "EliminarTempVenta ?";
            $query = $conectar -> prepare($sql);
            $query -> bindValue(1,$idTempVenta);
            $query -> execute();
        }

    }
?>