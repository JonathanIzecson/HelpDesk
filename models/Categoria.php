<?php

class Categoria extends Conectar{

    public function getCategorias(){
        $conexion = parent::conexion();
        parent::setNames();

        $sql = "SELECT * FROM categorias WHERE est = 1";
        $sql = $conexion->prepare($sql);
        $sql->execute();

        return $resultado = $sql->fetchAll();
    }
}

?>