<?php
require_once("../config/conexion.php");
require_once("../models/Usuario.php");

session_start();
$usuario = new Usuario();

switch ($_GET["op"]) {

    case 'ingresar':
        $datos = $usuario->loguear_usuario($_POST["alias"], $_POST["clave"]);
        if (is_array($datos) == true and count($datos) > 0) {
            $_SESSION["id"] = $datos[0]["id"];
            $_SESSION["nombres"] = $datos[0]["nombres"];
            $_SESSION["tipo"] = $datos[0]["tipo"]; 

            echo json_encode(array("id" => $datos[0]["id"]));
        } else {
            echo json_encode(array("id" => 0));
        }
        break;


        case "registro":
            $usu_nom = isset($_POST["usu_nom"]) ? $_POST["usu_nom"] : null;
            $apellidos = isset($_POST["apellidos"]) ? $_POST["apellidos"] : null;
            $dni = isset($_POST["dni"]) ? $_POST["dni"] : null;
            $usu_correo = isset($_POST["usu_correo"]) ? $_POST["usu_correo"] : null;
            $clave = isset($_POST["clave"]) ? $_POST["clave"] : null;
        
            if ($usu_nom === null || $apellidos === null || $dni === null || $usu_correo === null || $clave === null) {
                echo "Error: Campos incompletos.";
            } else {
                $datos = $usuario->get_correo($usu_correo);
                if (is_array($datos) && count($datos) > 0) {
                    echo "1"; // Correo ya registrado
                } else {
                    // Llama al método register_usuario con los campos adicionales
                    $usuario->register_usuario($usu_nom, $apellidos, $dni, $usu_correo, $clave);
                    echo "0"; // Registro exitoso
                }
            }
            break;
        


}
?>