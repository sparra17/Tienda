

<?php
    class Categoria extends Conectar{
        public function Categoria(){
            $conectar = parent::Conexion();
            $sql = "SP_ListarCatgorias";
            $query = $conectar -> prepare($sql);
            $query -> execute();
            return $query -> fetchAll(PDO::FETCH_ASSOC);
        }

        public function agregarCategoria($Categoria, $Refrigeracion){
            $conectar = parent::Conexion();

            $sql = "AgregarCategoria ?,?";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$Categoria);
            $query->bindValue(2,$Refrigeracion);

            $query->execute();
        }
        public function modificarCategoria($Categoria, $Refrigeracion,$idCategoria){
            $conectar = parent::Conexion();

            $sql = "ModificarCategoria ?,?,?";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$Categoria);
            $query->bindValue(2,$Refrigeracion);
            $query->bindValue(3,$idCategoria);

            $query->execute();
        }
        public function eliminarCategoria($idCategoria){
            $conectar = parent::Conexion();
            $sql = "EliminarCategoria ?";

            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idCategoria);
            $query->execute();
        }
    }
?>