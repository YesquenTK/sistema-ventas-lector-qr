<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Carga el autoloader de PHPMailer
require '../../../libraries/PHPMailer/Exception.php';
require '../../../libraries/PHPMailer/PHPMailer.php';
require '../../../libraries/PHPMailer/SMTP.php';

// Crea una instancia de PHPMailer
$mail = new PHPMailer(true);

try {
    // Configuración del servidor SMTP
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'IngresarTuGmail@gmail.com'; 
    $mail->Password   = 'xxxx'; 
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;

    // Destinatario del correo
    $email = $_POST['email'];
    $correo = $_POST['correo'];
    $monto = $_POST['monto'];
    $chargeId = $_POST['chargeId'];
    $carrito = json_decode($_POST['carrito'], true);

    // Verifica si 'codigoUnico' está presente en los datos POST
    if(isset($_POST['codigoUnico'])) {
        $codigoUnico = $_POST['codigoUnico'];
        // Construye el nombre del archivo del comprobante utilizando $codigoUnico
        $comprobantePath = '../../../ComprobantesDePago/comprobante_' . $codigoUnico . '.pdf';
    } else {
        // Si 'codigoUnico' no está presente, muestra un mensaje de error y finaliza el script
        echo "Error: No se recibió el parámetro 'codigoUnico'.";
        exit;
    }

    // Configura el remitente y el destinatario
    $mail->setFrom('yesquentineokenner@gmail.com', 'REPRESENTACIONES GENERALES HABEL EIRL');
    $mail->addAddress($correo);

    // Adjunta el comprobante de la compra
    $mail->addAttachment($comprobantePath);

    // Configura el contenido del correo
    $mail->isHTML(true);
    $mail->Subject = 'Confirmacion de compra y comprobante de pago';
    $mail->Body    = 'Gracias por confiar en nosotros para tu compra reciente. Nos complace confirmar que hemos recibido tu pedido y estamos procesando tu transacción. Adjunto a este correo electrónico encontrarás el comprobante de pago correspondiente a tu compra. Por favor, revisa la información detalladamente y asegúrate de que todo esté correcto. Si tienes alguna pregunta o necesitas asistencia adicional, no dudes en ponerte en contacto con nuestro equipo de atención al cliente. Apreciamos sinceramente tu preferencia y esperamos que disfrutes de tu compra. ¡Gracias por elegirnos! Saludos cordiales,';

    // Enviar el correo
    $mail->send();
    echo 'Correo enviado correctamente.';
} catch (Exception $e) {
    echo "Error al enviar el correo: {$mail->ErrorInfo}";
}
?>
