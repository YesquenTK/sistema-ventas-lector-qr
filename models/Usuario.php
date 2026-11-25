<?php
class Usuario extends Conectar
{
    public function loguear_usuario($usuario, $clave)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM usuarios WHERE user=?  AND clave=? AND estado = 1;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usuario);
        $sql->bindValue(2, $clave);
        $sql->execute();
        return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function register_usuario($usu_nom, $apellidos, $dni, $user, $clave)
    {
        $conectar = parent::conexion();
        parent::set_names();
        
        try {
            $sql = "INSERT INTO usuarios (nombres, apellidos, dni, user, clave, tipo, fech_crea, estado) VALUES (?, ?, ?, ?, ?, '2', NOW(), '1')";
            $stmt = $conectar->prepare($sql);
            $stmt->bindValue(1, $usu_nom);
            $stmt->bindValue(2, $apellidos);
            $stmt->bindValue(3, $dni);
            $stmt->bindValue(4, $user);
            $stmt->bindValue(5, $clave);
    
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    

    public function get_correo($user)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM `usuarios` WHERE user = ? AND estado = '1';";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $user);
        $sql->execute();
        return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
