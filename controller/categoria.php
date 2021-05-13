<?php

require_once("../config/conexion.php");
require_once("../models/Categoria.php");

$categoria = new Categoria();

switch ($_GET['op']) {
    case 'combo':
        $datos = $categoria->getCategorias();
        if(is_array($datos) && count($datos) > 0){

            foreach($datos as $row){
                $html .= "<option value='" . $row['cat_id'] . "'>" . $row['cat_nom'] . "</option>";
            }

            echo $html;
        }
        break;
}

?>