<?php
class Usuario extends Conectar{

    public function login(){
        $conexion = parent::conexion();
        parent::setNames();

        if(isset($_POST['enviar'])){
            $correo = $_POST['usu_correo'];
            $pass = $_POST['usu_pass'];
            $rol = $_POST['rol_id'];

            if(empty($correo) || empty($pass)){
                header("Location: " . conectar::ruta() . "index.php?m=2");
                exit();
            }else{
                $sql ="SELECT * FROM usuarios WHERE usu_correo = ? AND usu_pass = ? AND rol_id = ? AND est = 1;";
                $statement = $conexion->prepare($sql);
                $statement->bindValue(1,$correo);
                $statement->bindValue(2,$pass);
                $statement->bindValue(3,$rol);
                $statement->execute();

                $resultado = $statement->fetch();

                if(is_array($resultado) && count($resultado) > 0){
                    $_SESSION['usu_id'] = $resultado['usu_id'];
                    $_SESSION['usu_nom'] = $resultado['usu_nom'];
                    $_SESSION['usu_ape'] = $resultado['usu_ape'];
                    $_SESSION['rol_id'] = $resultado['rol_id'];
                    header("Location: " . conectar::ruta() . "view/Home/");
                    exit();
                }else{
                    header("Location: " . Conectar::ruta() . "index.php?m=1");
                    exit();
                }
            }

        }
    }

    public function insert($usu_nom,$usu_ape,$usu_correo,$usu_pass,$rol_id){
        $conexion = parent::conexion();
        parent::setNames();

        $sql = "INSERT INTO usuarios (usu_id, usu_nom, usu_ape, usu_correo, usu_pass, rol_id, fech_crea, fech_modi, fech_elim, est) VALUES (NULL, ?, ?, ?, ?, ?, now(), NULL, NULL, '1');";
        $statement = $conexion->prepare($sql);
        $statement->bindValue(1, $usu_nom);
        $statement->bindValue(2, $usu_ape);
        $statement->bindValue(3, $usu_correo);
        $statement->bindValue(4, $usu_pass);
        $statement->bindValue(5,$rol_id);
        $statement->execute();
        return $resultado = $statement->fetchAll();
    }

    public function update($usu_id, $usu_nom, $usu_ape, $usu_correo, $usu_pass, $rol_id){
        $conexion = parent::conexion();
        parent::setNames();

        $sql = "UPDATE usuarios SET usu_nom = ?, usu_ape = ?, usu_correo = ?, usu_pass = ?, rol_id = ?, fech_modi = now() WHERE usu_id = ?;";
        $statement = $conexion->prepare($sql);
        $statement->bindValue(1, $usu_nom);
        $statement->bindValue(2, $usu_ape);
        $statement->bindValue(3, $usu_correo);
        $statement->bindValue(4, $usu_pass);
        $statement->bindValue(5, $rol_id);
        $statement->bindValue(6, $usu_id);
        $statement->execute();

        return $resultado = $statement->fetchAll();
    }

    public function delete($usu_id){
        $conexion = parent::conexion();
        parent::setNames();

        $sql = "UPDATE usuarios SET est = 0, fech_elim = now() WHERE usu_id = ?;";
        $statement = $conexion->prepare($sql);
        $statement->bindValue(1,$usu_id);
        $statement->execute();
        return $resultado = $statement->fetchAll();
    }

    public function listar(){
        $conexion = parent::conexion();
        parent::setNames();

        $sql = "SELECT * FROM usuarios WHERE est = 1";
        $statement = $conexion->prepare($sql);
        $statement->execute();
        return $resultado = $statement->fetchAll();
    }

    public function listar_x_id($usu_id){
        $conexion = parent::conexion();
        parent::setNames();

        $sql = "SELECT * FROM usuarios WHERE usu_id = ?;";
        $statement = $conexion->prepare($sql);
        $statement->bindValue(1, $usu_id);
        $statement->execute();
        return $resultado = $statement->fetchAll();
    }
}
?>

