<?php
require_once("../config/conexion.php");
require_once("../models/Producto.php");
$producto = new Producto();

switch ($_GET["op"]) {

    case "listar":
        $datos = $producto->get_producto();
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["id"];
            $sub_array[] = $row["codigo"];
            $sub_array[] = $row["cat_nom"];
            $sub_array[] = $row["producto"];
            $sub_array[] = $row["precio"];
            $sub_array[] = $row["prod_cant"];
            $sub_array[] = '<img src="../../assets/img/' . $row["imagen"] . '"  width = "100px" height = "100px" ></img>';
            $sub_array[] = '<img src="../../assets/QRS/' . $row["QR"] . '"  width = "100px" height = "100px" ></img>';
            $sub_array[] = '<button type="button" onClick="editar(' . $row["id"] . ');" id="' . $row["id"] . '"class="btn btn-outline-primary btn-icon"><div><i class="fa fa-edit"></i></div></button>';
            $sub_array[] = '<button type="button" onClick="eliminar(' . $row["id"] . ');" id="' . $row["id"] . '" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-trash"></i></div></button>';

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

    case "guardaryeditar":
        $id = isset($_POST["id"]) ? $_POST["id"] : "";
        $cat_id = $_POST["cat_id"];
        $codigo = $_POST["codigo"];
        $producto_nombre = $_POST["producto"];
        $precio = $_POST["precio"];
        $prod_cant = $_POST["prod_cant"];

        $imagen = isset($_FILES["file"]["name"][0]) ? $_FILES["file"]["name"][0] : "";
        $imagen_qr = isset($_FILES["fileqr"]["name"][0]) ? $_FILES["fileqr"]["name"][0] : "";

        if (!empty($imagen)) {
            $ruta_imagen = "../assets/img/";
            move_uploaded_file($_FILES["file"]["tmp_name"][0], $ruta_imagen . $imagen);
        }

        if (!empty($imagen_qr)) {
            $ruta_qr = "../assets/QRS/";
            move_uploaded_file($_FILES["fileqr"]["tmp_name"][0], $ruta_qr . $imagen_qr);
        }

        if (empty($id)) {
            $producto->insert_producto($cat_id, $codigo, $producto_nombre, $precio, $prod_cant, $imagen, $imagen_qr);
        } else {
            if (!empty($imagen) && !empty($imagen_qr)) {
                $producto->update_producto($id, $cat_id, $codigo, $producto_nombre, $precio, $prod_cant, $imagen, $imagen_qr);
            } elseif (!empty($imagen)) {
                $producto->update_producto_solo_imagen($id, $cat_id, $codigo, $producto_nombre, $precio, $prod_cant, $imagen);
            } elseif (!empty($imagen_qr)) {
                $producto->update_producto_solo_qr($id, $cat_id, $codigo, $producto_nombre, $precio, $prod_cant, $imagen_qr);
            } else {
                $producto->update_producto_sin_img($id, $cat_id, $codigo, $producto_nombre, $precio, $prod_cant);
            }
        }
        break;

    case "mostrar":
        $datos = $producto->get_producto_x_id($_POST["id"]);
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
                $output["id"] = $row["id"];
                $output["codigo"] = $row["codigo"];
                $output["cat_id"] = $row["cat_id"];
                $output["producto"] = $row["producto"];
                $output["precio"] = $row["precio"];
                $output["prod_cant"] = $row["prod_cant"];
                $output["imagen"] = $row["imagen"];
                $output["QR"] = $row["QR"];
            }
            echo json_encode($output);
        }
        break;

    case "mostrar_codigo":
        $datos = $producto->get_producto__x_cod($_POST["producto_cod"]);
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
                $output["id"] = $row["id"];
                $output["codigo"] = $row["codigo"];
                $output["producto"] = $row["producto"];
                $output["precio"] = $row["precio"];
                $output["prod_cant"] = $row["prod_cant"];
                $output["imagen"] = $row["imagen"];
                $output["QR"] = $row["QR"];
                $output["cat_id"] = $row["cat_id"]; 
            }
            echo json_encode($output);
        }
        break;

    case "eliminar":
        $producto->delete_producto($_POST["id"]);
        break;
}
?>
