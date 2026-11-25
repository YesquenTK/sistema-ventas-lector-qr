<?php
session_start(); 
include_once 'funciones.php';
include_once 'libraries/Requests/library/Requests.php';
Requests::register_autoloader();
include_once 'libraries/culqi-php/lib/culqi.php';

$SECRET_KEY = "sk_test_fe3b958a879a5ddd";
$culqi = new Culqi\Culqi(array('api_key' => $SECRET_KEY));

try {
    // Crear el cargo con Culqi
    $charge = $culqi->Charges->create(
        array(
            "amount" => $_POST['precio'],
            "currency_code" => "PEN",
            "email" => $_POST['email'],
            "source_id" => $_POST['token']
        )
    );

    var_dump($charge->id);

    $_SESSION['chargeId'] = $charge->id;

    header("Location: view/Inicio/detalles_compra.php?Email=" . $_POST['email'] . "&monto=" . $_POST['precio'] . "&chargeId=" . $charge->id . "&idUsuario=" . $id_usuario);
    exit;



} catch (Exception $e) {
    echo 'Error al crear el cargo con Culqi: ',  $e->getMessage();
}


?>
