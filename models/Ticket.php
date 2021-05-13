<?php 

class Ticket extends Conectar{


    public function insertar($usu_id,$cat_id,$tick_titu,$tick_desc){
        $conexion = parent::conexion();
        parent::setNames();
        $sql = "INSERT INTO tickets (tick_id, usu_id, cat_id, tick_titulo, tick_descripcion,tick_estado,fecha_crea, est) VALUES (NULL, ?, ?, ?,?,'Abierto',now(), '1');";
        $sql = $conexion->prepare($sql);
        $sql->bindValue(1,$usu_id);
        $sql->bindValue(2,$cat_id);
        $sql->bindValue(3,$tick_titu);
        $sql->bindValue(4,$tick_desc);
        $sql->execute();
    }

    public function listar($usu_id){
        $conexion = parent::conexion();
        parent::setNames();
        $sql = "SELECT t.tick_id, t.usu_id, t.cat_id, t.tick_titulo,t.tick_descripcion,t.tick_estado,t.fecha_crea, u.usu_nom, u.usu_ape, c.cat_nom 
        FROM tickets t
        INNER JOIN categorias c ON t.cat_id = c.cat_id
        INNER JOIN usuarios u ON u.usu_id = t.usu_id
        WHERE t.est = 1
        AND t.usu_id = ?";
        $sql = $conexion->prepare($sql);
        $sql->bindValue(1,$usu_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function listar_soporte(){
        $conexion = parent::conexion();
        parent::setNames();
        $sql = "SELECT t.tick_id, t.usu_id, t.cat_id, t.tick_titulo,t.tick_descripcion,t.tick_estado,t.fecha_crea, u.usu_nom, u.usu_ape, c.cat_nom 
        FROM tickets t
        INNER JOIN categorias c ON t.cat_id = c.cat_id
        INNER JOIN usuarios u ON u.usu_id = t.usu_id
        WHERE t.est = 1";
        $sql = $conexion->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function listar_detalle_ticket($tick_id){
        $conexion = parent::conexion();
        parent::setNames();
        $sql = "SELECT 
        td.tickd_id,
        td.tickd_descripcion,
        td.fecha_crea,
        u.usu_nom,
        u.usu_ape,
        u.rol_id
        FROM ticket_detalle td
        INNER JOIN usuarios u ON u.usu_id = td.usu_id
        WHERE
        td.tick_id = ?";
        $sql = $conexion->prepare($sql);
        $sql->bindValue(1,$tick_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function listar_ticket_x_id($tick_id){
        $conexion = parent::conexion();
        parent::setNames();
        $sql = "SELECT 
        t.tick_id, 
        t.usu_id, 
        t.cat_id, 
        t.tick_titulo,
        t.tick_descripcion,
        t.tick_estado,
        t.fecha_crea, 
        u.usu_nom, 
        u.usu_ape,
        c.cat_nom 
        FROM tickets t
        INNER JOIN categorias c ON t.cat_id = c.cat_id
        INNER JOIN usuarios u ON u.usu_id = t.usu_id
        WHERE t.tick_id = ?";
        $sql = $conexion->prepare($sql);
        $sql->bindValue(1,$tick_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function insertar_ticketdetalle($tick_id,$usu_id,$tickd_descrip){
        $conexion = parent::conexion();
        parent::setNames();
        $sql = "INSERT INTO ticket_detalle (tickd_id, tick_id, usu_id, tickd_descripcion, fecha_crea, est) 
        VALUES (NULL, ?, ?, ?, now(), '1');";
        $sql = $conexion->prepare($sql);
        $sql->bindValue(1,$tick_id);
        $sql->bindValue(2,$usu_id);
        $sql->bindValue(3,$tickd_descrip);
        $sql->execute();
    }

    public function update_ticket($tick_id){
        $conexion = parent::conexion();
        parent::setNames();
        $sql = "UPDATE tickets SET tick_estado = 'Cerrado' WHERE tick_id = ?;";
        $sql = $conexion->prepare($sql);
        $sql->bindValue(1,$tick_id);
        $sql->execute();
    }

    public function insertar_cerrar_ticket($tick_id,$usu_id){
        $conexion = parent::conexion();
        parent::setNames();
        $sql = "INSERT INTO ticket_detalle (tickd_id, tick_id, usu_id, tickd_descripcion, fecha_crea, est) 
        VALUES (NULL, ?, ?, 'Ticket Cerrado...', now(), '1');";
        $sql = $conexion->prepare($sql);
        $sql->bindValue(1,$tick_id);
        $sql->bindValue(2,$usu_id);
        $sql->execute();
    }

    public function usuario_total_tickets($usu_id){
        $conexion = parent::conexion();
        parent::setNames();

        $sql = "SELECT count(*) as total FROM tickets WHERE usu_id = ? ";
        $sql = $conexion->prepare($sql);
        $sql->bindValue(1, $usu_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function usuario_tickets_abiertos($usu_id){
        $conexion = parent::conexion();
        parent::setNames();

        $sql = "SELECT count(*) as total FROM tickets WHERE usu_id = ? AND tick_estado = 'Abierto'";
        $sql = $conexion->prepare($sql);
        $sql->bindValue(1, $usu_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function usuario_tickets_cerrados($usu_id){
        $conexion = parent::conexion();
        parent::setNames();

        $sql = "SELECT count(*) as total FROM tickets WHERE usu_id = ? AND tick_estado = 'Cerrado'";
        $sql = $conexion->prepare($sql);
        $sql->bindValue(1, $usu_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
    
    public function soporte_total_tickets(){
        $conexion = parent::conexion();
        parent::setNames();

        $sql = "SELECT count(*) as total FROM tickets";
        $sql = $conexion->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function soporte_tickets_abiertos(){
        $conexion = parent::conexion();
        parent::setNames();

        $sql = "SELECT count(*) as total FROM tickets WHERE tick_estado = 'Abierto'";
        $sql = $conexion->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function soporte_tickets_cerrados(){
        $conexion = parent::conexion();
        parent::setNames();

        $sql = "SELECT count(*) as total FROM tickets WHERE tick_estado = 'Cerrado'";
        $sql = $conexion->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function get_grafica_soporte(){
        $conexion = parent::conexion();
        parent::setNames();

        $sql = "SELECT c.cat_nom AS nom, count(*) AS total FROM tickets t
        INNER JOIN categorias c ON C.cat_id = T.cat_id
        WHERE t.est = 1
        GROUP BY c.cat_nom
        ORDER BY total DESC;";

        $sql = $conexion->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function get_grafica_usuario($usu_id){
        $conexion = parent::conexion();
        parent::setNames();

        $sql = "SELECT c.cat_nom AS nom, count(*) AS total FROM tickets t
        INNER JOIN categorias c ON c.cat_id = t.cat_id
        WHERE t.est = 1
        AND t.usu_id = ?
        GROUP BY c.cat_nom
        ORDER BY total DESC;";

        $sql = $conexion->prepare($sql);
        $sql->bindValue(1,$usu_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
}