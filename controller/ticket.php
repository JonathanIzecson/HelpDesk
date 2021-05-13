<?php

require_once("../config/conexion.php");
require_once("../models/Ticket.php");
$ticket = new Ticket();

switch ($_GET['op']) {
    case 'insert':
        $ticket->insertar($_POST['usu_id'], $_POST['cat_id'], $_POST['tick_titulo'], $_POST['tick_desc']);
        break;

    case 'update':
        $ticket->update_ticket($_POST['tick_id']);
        $ticket->insertar_cerrar_ticket($_POST['tick_id'],$_POST['usu_id']);
        break;

    case 'listar':
        $datos = $ticket->listar($_POST['usu_id']);
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row['tick_id'];
            $sub_array[] = $row['cat_nom'];
            $sub_array[] = $row['tick_titulo'];

            if ($row['tick_estado'] == "Abierto") {
                $sub_array[] = "<span class='label label-pill label-success'>Abierto</span>";
            } else {
                $sub_array[] = "<span class='label label-pill label-danger'>Cerrado</span>";
            }
            $sub_array[] = date("d/m/Y H:i:s", strtotime($row['fecha_crea']));
            $sub_array[] = '<button type="button" onClick="ver(' . $row["tick_id"] . ');" id="' . $row["tick_id"] . '" class="btn btn-inline btn-warning btn-sm ladda-button"><div><i class="fa fa-eye"></i></div></button>';

            $data[] = $sub_array;
        }

        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );

        echo json_encode($results);
        break;

    case 'listar_soporte':
        $datos = $ticket->listar_soporte();
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row['tick_id'];
            $sub_array[] = $row['cat_nom'];
            $sub_array[] = $row['tick_titulo'];

            if ($row['tick_estado'] == "Abierto") {
                $sub_array[] = "<span class='label label-pill label-success'>Abierto</span>";
            } else {
                $sub_array[] = "<span class='label label-pill label-danger'>Cerrado</span>";
            }
            $sub_array[] = date("d/m/Y H:i:s", strtotime($row['fecha_crea']));
            $sub_array[] = '<button type="button" onClick="ver(' . $row["tick_id"] . ');" id="' . $row["tick_id"] . '" class="btn btn-inline btn-warning btn-icon"><div><i class="fa fa-eye"></i></div></button>';
            $data[] = $sub_array;
        }

        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );

        echo json_encode($results);
        break;

    case "listardetalle":
        $data = $ticket->listar_detalle_ticket($_POST['tick_id']);
?>

        <?php
        foreach ($data as $row) {
        ?>

            <article class="activity-line-item box-typical">
                <div class="activity-line-date">
                    <?php echo date("d/m/Y", strtotime($row['fecha_crea'])); ?>
                </div>
                <header class="activity-line-item-header">
                    <div class="activity-line-item-user">
                        <div class="activity-line-item-user-photo">
                            <a href="#">
                                <img src="../../public/<?php echo $row['rol_id']; ?>.png" alt="">
                            </a>
                        </div>
                        <div class="activity-line-item-user-name"><?php echo $row['usu_nom'] . ' ' . $row['usu_ape']; ?></div>
                        <div class="activity-line-item-user-status"><?php echo $row['rol_id'] == 1 ? "Usuario" : "Soporte"; ?></div>
                    </div>
                </header>
                <div class="activity-line-action-list">
                    <section class="activity-line-action">
                        <div class="time"><?php echo date("H:i:s", strtotime($row['fecha_crea'])); ?></div>
                        <div class="cont">
                            <div class="cont-in">
                                <p><?php echo $row['tickd_descripcion']; ?></p>
                            </div>
                        </div>
                    </section>
                    <!--.activity-line-action-->
                </div>
                <!--.activity-line-action-list-->
            </article>
            <!--.activity-line-item-->

        <?php
        }

        ?>

<?php

        break;

    case "mostrar":

        $datos = $ticket->listar_ticket_x_id($_POST['tick_id']);

        if (is_array($datos) == true && count($datos) > 0) {
            foreach ($datos as $row) {
                $output['tick_id'] = $row['tick_id'];
                $output['usu_id'] = $row['usu_id'];
                $output['tick_titulo'] = $row['tick_titulo'];
                $output['tick_descripcion'] = $row['tick_descripcion'];
                $output['fecha_crea'] = date("d/m/Y H:i:s", strtotime($row['fecha_crea']));
                if ($row['tick_estado'] == "Abierto") {
                    $output['tick_estado'] = "<span class='label label-pill label-success'>Abierto</span>";
                } else {
                    $output['tick_estado'] = "<span class='label label-pill label-danger'>Cerrado</span>";
                }
                $output['tick_estado_cerrar'] = $row['tick_estado'];
                $output['usu_nom'] = $row['usu_nom'];
                $output['usu_ape'] = $row['usu_ape'];
                $output['cat_nom'] = $row['cat_nom'];
            }
            echo json_encode($output);
        }

        break;

    case 'insertdetalle':
        $ticket->insertar_ticketdetalle($_POST['tick_id'], $_POST['usu_id'], $_POST['tickd_descrip']);
        break;

    case 'total_usuario':
        $datos = $ticket->usuario_total_tickets($_POST['usu_id']);

        if (is_array($datos) && count($datos) > 0 ){
            foreach($datos as $row){
                $output['total'] = $row['total'];
            }
        }
        echo json_encode($output);
        break;

    case 'usuario_abiertos':
        $datos = $ticket->usuario_tickets_abiertos($_POST['usu_id']);

        if (is_array($datos) && count($datos) > 0 ){
            foreach($datos as $row){
                $output['total'] = $row['total'];
            }
        }
        echo json_encode($output);
        break;

    case 'usuario_cerrados':
        $datos = $ticket->usuario_tickets_cerrados($_POST['usu_id']);

        if (is_array($datos) && count($datos) > 0 ){
            foreach($datos as $row){
                $output['total'] = $row['total'];
            }
        }
        echo json_encode($output);
        break;

    case 'total_soporte':
        $datos = $ticket->soporte_total_tickets();

        if (is_array($datos) && count($datos) > 0 ){
            foreach($datos as $row){
                $output['total'] = $row['total'];
            }
        }
        echo json_encode($output);
        break;

    case 'soporte_abiertos':
        $datos = $ticket->soporte_tickets_abiertos();

        if (is_array($datos) && count($datos) > 0 ){
            foreach($datos as $row){
                $output['total'] = $row['total'];
            }
        }
        echo json_encode($output);
        break;

    case 'soporte_cerrados':
        $datos = $ticket->soporte_tickets_cerrados();

        if (is_array($datos) && count($datos) > 0 ){
            foreach($datos as $row){
                $output['total'] = $row['total'];
            }
        }
        echo json_encode($output);
        break;

    case 'grafica_soporte':
        $datos = $ticket->get_grafica_soporte();
        echo json_encode($datos);
        break;

    case 'grafica_usuario':
        $datos = $ticket->get_grafica_usuario($_POST['usu_id']);
        echo json_encode($datos);
        break;
}
