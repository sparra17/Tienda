

<?php
    class Categoria extends Conectar{
        public function Categoria(){
            $conectar = parent::Conexion();
            $sql = "SP_ListarCatgorias";
            $query = $conectar -> prepare($sql);
            $query -> execute();
            return $query -> fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>