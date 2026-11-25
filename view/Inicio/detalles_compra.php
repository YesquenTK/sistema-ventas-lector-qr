<?php
session_start();

require_once ("../../config/conexion.php");

$conectar = new Conectar();
$conexion = $conectar->Conexion();
$conectar->set_names();

function generarCodigoAleatorio() {
    $numeros = random_int(1000, 9999);  // Generar un número aleatorio de 4 dígitos
    $letras = bin2hex(random_bytes(3));  // Generar una cadena aleatoria de 6 caracteres (3 bytes)
    return "chr_" . $numeros . $letras;
}

$codigoUnico = bin2hex(random_bytes(16)) . uniqid();

require_once ("../Main/mainhead.php");
require_once ("../Main/mainheadpanel.php");
require_once ("../Main/mainleftpanel.php");
require_once '../../funciones.php';

$email = isset($_GET['Email']) ? $_GET['Email'] : 'No disponible';
$monto = isset($_GET['monto']) ? number_format($_GET['monto'] / 100, 2, '.', ',') : 'No disponible';
$chargeId = isset($_GET['chargeId']) ? $_GET['chargeId'] : 'No disponible';

if ($chargeId === 'No disponible') {
    // Generar un código aleatorio único
    $chargeId = generarCodigoAleatorio();
}

$fechaCompra = date("Y-m-d H:i:s");
$carrito = isset($_GET['carrito']) ? json_decode(urldecode($_GET['carrito']), true) : array();

$totalCompra = 0; 

foreach ($carrito as $item) {
    $producto = isset($item['producto']) ? $item['producto'] : '';
    $precio = isset($item['precio']) ? $item['precio'] : 0;
    $cantidad = isset($item['cantidad']) ? $item['cantidad'] : 0; 
    $cat_id = isset($item['cat_id']) ? $item['cat_id'] : 0;

    $subtotal = $precio * $cantidad; 
    $totalCompra += $subtotal;

    $query = "INSERT INTO tm_compras (id, correo, producto, cantidad, precio, fecha, Categoria) VALUES ('$codigoUnico', '$email', '$producto', $cantidad, $precio, '$fechaCompra', '$cat_id')";

    if (!$conexion->query($query)) {
        $errorInfo = $conexion->errorInfo();
        echo "Error al insertar datos: " . $errorInfo[2];
    } else {
        // Update product quantity
        $updateQuery = "UPDATE productos SET prod_cant = prod_cant - ? WHERE producto = ?";
        $updateStmt = $conexion->prepare($updateQuery);
        $updateStmt->bindValue(1, $cantidad, PDO::PARAM_INT);
        $updateStmt->bindValue(2, $producto, PDO::PARAM_STR);
        if (!$updateStmt->execute()) {
            $errorInfo = $updateStmt->errorInfo();
            echo "Error al actualizar la cantidad del producto: " . $errorInfo[2];
        }
    }
}

$idUsuario = isset($_GET['idUsuario']) ? $_GET['idUsuario'] : null;

$conexion = null;
?>

<!DOCTYPE html>
<html lang="es">

<?php
require_once ("detalles_head.php");
?>

<body>
    <?php require_once ("../Main/mainheadpanel.php"); ?>
    <?php require_once ("../Main/mainleftpanel.php"); ?>

    <div class="content-body">
        <div class="container-fluid">
            <div class="page-titles">
                <h2>Detalles de la Compra</h2>
            </div>

            <div class="details-container">
                <h3><strong>Monto de la compra:</strong> S/. <?php echo $monto; ?></h3>
                <h3><strong>Email:</strong> <?php echo $email; ?></h3>
                <h3><strong>Fecha de la compra:</strong> <?php echo $fechaCompra; ?></h3>
                <h3><strong>ID de cargo:</strong> <?php echo $chargeId; ?></h3>

                <?php
                require_once ("../../config/conexion.php");
                $conectar = new Conectar();
                $conexion = $conectar->Conexion();
                $conectar->set_names();

                $queryUsuario = "SELECT nombres, apellidos, dni FROM usuarios WHERE id = '$idUsuario'";
                $resultado = $conexion->query($queryUsuario);

                if ($resultado && $resultado->rowCount() > 0) {
                    $usuario = $resultado->fetch(PDO::FETCH_ASSOC);
                    $nombres = $usuario['nombres'];
                    $apellidos = $usuario['apellidos'];
                    $dni = $usuario['dni'];
                } else {
                    $nombres = 'No disponible';
                    $apellidos = 'No disponibles';
                    $dni = 'No disponible';
                }

                echo "<h3><strong>Detalles del Usuario:</strong></h3>";
                echo "<h3><strong>Nombres:</strong> $nombres</h3>";
                echo "<h3><strong>Apellidos:</strong> $apellidos</h3>";
                echo "<h3><strong>DNI:</strong> $dni</h3>";
                ?>

                <?php if (!empty($carrito)): ?>
                    <h3><strong>Productos Comprados:</strong></h3>
                    <table>
                        <tr>
                            <th>Nombre del Producto</th>
                            <th>Precio Unitario</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                        </tr>

                        <?php
                        $totalCompra = 0;

                        foreach ($carrito as $item):
                            $producto = isset($item['producto']) ? $item['producto'] : '';
                            $precio = isset($item['precio']) ? $item['precio'] : 0;
                            $cantidad = isset($item['cantidad']) ? $item['cantidad'] : 0;

                            $subtotal = $precio * $cantidad;
                            $totalCompra += $subtotal;
                            ?>
                            <tr>
                                <td style="max-width: 150px;"><?php echo wordwrap($producto, 25, "<br/>", true); ?></td>
                                <td>S/. <?php echo number_format($precio, 2, '.', ','); ?></td>
                                <td><?php echo $cantidad; ?></td>
                                <td>S/. <?php echo number_format($subtotal, 2, '.', ','); ?></td>
                            </tr>
                        <?php endforeach; ?>

                        <tr class="total-row">
                            <td colspan="3">Total de la Compra:</td>
                            <td>S/. <?php echo number_format($totalCompra, 2, '.', ','); ?></td>
                        </tr>
                    </table>
                <?php endif; ?>


                <!-- Botones adicionales -->
                <button id="btnGenerarComprobante">Generar Comprobante</button>
                <button id="btnEnviarCorreo" class="btn btn-success btn-lg" data-toggle="modal"
                    data-target="#correoModal">Enviar comprobante al correo</button>
                <a href="../Inicio/index.php" class="btn btn-primary btn-lg" id="btnRegresar"
                    style="margin-top: 0px;">Regresar al Inicio</a>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="correoModal" tabindex="-1" role="dialog" aria-labelledby="correoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="correoModalLabel">Ingresar correo electrónico</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="correoForm">
                        <div class="form-group">
                            <label for="correo">Correo electrónico:</label>
                            <input type="email" class="form-control" id="correo"
                                placeholder="Ingrese su correo electrónico">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="enviarCorreoBtn">Enviar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        var codigoUnico = "<?php echo $codigoUnico; ?>";
        var comprobanteGenerado = false; 

        $(document).ready(function () {
            $("#enviarCorreoBtn").click(function () {
                var correo = $("#correo").val(); 

                if (!comprobanteGenerado) {
                    alert("Genere primero un comprobante antes de enviar el correo.");
                    return;
                }

                var email = "<?php echo $email; ?>";
                var monto = "<?php echo $monto; ?>";
                var chargeId = "<?php echo $chargeId; ?>";
                var carrito = <?php echo json_encode($carrito); ?>;

                $.ajax({
                    type: "POST",
                    url: 'enviargmail/enviar_correo.php',
                    data: {
                        email: email,
                        correo: correo,
                        monto: monto,
                        chargeId: chargeId,
                        carrito: JSON.stringify(carrito),
                        codigoUnico: codigoUnico 
                    },
                    success: function (response) {
                        alert(response);

                        $('#correoModal').modal('hide');
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                    }
                });
            });
        });

        $("#btnGenerarComprobante").click(function () {
            var email = "<?php echo $email; ?>";
            var monto = "<?php echo $monto; ?>";
            var chargeId = "<?php echo $chargeId; ?>";
            var carrito = <?php echo json_encode($carrito); ?>;
            var codigoUnico = "<?php echo $codigoUnico; ?>";
            var idUsuario = "<?php echo $idUsuario; ?>"; 
            var nombres = "<?php echo $nombres; ?>";
            var apellidos = "<?php echo $apellidos; ?>";
            var dni = "<?php echo $dni; ?>"; 

            $.ajax({
                type: "POST",
                url: "../../funciones.php",
                data: {
                    generarComprobante: true,
                    email: email,
                    monto: monto,
                    chargeId: chargeId,
                    carrito: JSON.stringify(carrito),
                    codigoUnico: codigoUnico,
                    idUsuario: idUsuario,
                    nombres: nombres, 
                    apellidos: apellidos, 
                    dni: dni 
                },
                success: function (response) {
                    alert(response);
                    comprobanteGenerado = true;
                }
            });
        });

    </script>

    <?php require_once ("../Main/mainjs.php"); ?>

    <script>
        console.log("ID del usuario:", <?php echo json_encode($idUsuario); ?>);
        console.log("Codigo unico:", <?php echo json_encode($codigoUnico); ?>);
    </script>

</body>

</html>
