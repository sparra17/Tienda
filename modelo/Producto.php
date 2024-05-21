<?php
    class Producto extends Conectar{
        public function Producto(){
            $conectar = parent::Conexion();
            $sql = "SP_ListarProductos";
            $query = $conectar -> prepare($sql);
            $query -> execute();
            return $query -> fetchAll(PDO::FETCH_ASSOC);

        }
    }
?>