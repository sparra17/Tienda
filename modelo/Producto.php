<?php
    class Producto extends Conectar{
        public function Producto(){
            $conectar = parent::Conexion();
            $sql = "SP_ListarProductos";
            $query = $conectar -> prepare($sql);
            $query -> execute();
            return $query -> fetchAll(PDO::FETCH_ASSOC);

        }

        public function EliminarProductos($idProducto){
            $conectar = parent::Conexion();
            $sql = "sp_EliminarProductos ?";
            $query = $conectar -> prepare($sql);
            $query -> bindValue(1,$idProducto);
            $query -> execute();
        }

        public function AgregarProducto($Producto,$Caducidad,$Lote,$idProveedor,$idCategoria,$Stock,$PrecioVenta,$PrecioCompra){
            $conectar = parent::Conexion();

            $sql = "AgregarProducto ?,?,?,?,?,?,?,?";
            $query = $conectar -> prepare($sql);
            $query -> bindValue(1,$Producto);
            $query -> bindValue(2,$Caducidad);
            $query -> bindValue(3,$Lote);
            $query -> bindValue(4,$idProveedor);
            $query -> bindValue(5,$idCategoria);
            $query -> bindValue(6,$Stock);
            $query -> bindValue(7,$PrecioVenta);
            $query -> bindValue(8,$PrecioCompra);

            $query -> execute();
        }

        public function ModificarProducto($idProducto,$Producto,$Caducidad,$Lote,$idProveedor,$idCategoria,$Stock,$PrecioVenta,$PrecioCompra){
            $conectar = parent::Conexion();

            $sql = "ModificarProducto ?,?,?,?,?,?,?,?,?";
            $query = $conectar -> prepare($sql);
            $query -> bindValue(1,$idProducto);
            $query -> bindValue(2,$Producto);
            $query -> bindValue(3,$Caducidad);
            $query -> bindValue(4,$Lote);
            $query -> bindValue(5,$idProveedor);
            $query -> bindValue(6,$idCategoria);
            $query -> bindValue(7,$Stock);
            $query -> bindValue(8,$PrecioVenta);
            $query -> bindValue(9,$PrecioCompra);
            $query -> execute();
        }

        public function ProductoID($idProducto){
            $conectar = parent::Conexion();
            $sql = "SP_ListarProductosID ?";
            $query = $conectar -> prepare($sql);
            $query -> bindValue(1,$idProducto);
            $query -> execute();
            return $query -> fetchAll(PDO::FETCH_ASSOC);

        }

    }
?>