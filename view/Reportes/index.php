<?php
require_once ("../Main/sesion.php");

require_once ("../../config/conexion.php");

$conectar = new Conectar();

$conn = $conectar->Conexion();

if (!$conn) {
    die("Error de conexión: No se pudo conectar a la base de datos.");
}

$queryTotal = "SELECT COUNT(DISTINCT id) AS total_filas FROM tm_compras";
$resultTotal = $conn->query($queryTotal);
$total_filas = $resultTotal->fetch(PDO::FETCH_ASSOC)['total_filas'];

$resultados_por_pagina = 10;

$total_paginas = ceil($total_filas / $resultados_por_pagina);

if (!isset($_GET['pagina'])) {
    $pagina = 1;
} else {
    $pagina = $_GET['pagina'];
}

$offset = ($pagina - 1) * $resultados_por_pagina;

$query = "SELECT id, correo, GROUP_CONCAT(producto SEPARATOR ', ') AS productos, SUM(cantidad) AS total_cantidad, SUM(cantidad * precio) AS precio_total, fecha
            FROM tm_compras 
            GROUP BY id 
            ORDER BY fecha DESC 
            LIMIT $resultados_por_pagina OFFSET $offset";


$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once ("../Main/mainhead.php"); ?>
    <title>Eventu - Reportes</title>
    <link rel="stylesheet" type="text/css" href="../../public/cam/estilo_camara.css" />
    <link rel="stylesheet" type="text/css" href="../../public/cam/css/plugins/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../../public/cam/css/plugins/simple-line-icons.css" />
    <link rel="stylesheet" type="text/css" href="../../public/cam/css/plugins/animate.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
</head>

<body>
    <div id="main-wrapper">
        <?php
        require_once ("../Main/mainheadpanel.php");
        require_once ("../Main/mainleftpanel.php");
        ?>

        <div class="content-body">
            <div class="container-fluid">
                <div class="page-titles">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Panel</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Reportes</a></li>
                    </ol>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Historial de Compras</h4>
                                <div class="table-responsive">
                                    <table id="compras_data" class="display min-w850" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Correo</th>
                                                <th>Productos</th>
                                                <th>Total Cantidad</th>
                                                <th>Precio Total</th>
                                                <th>Fecha</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                                echo "<tr>";
                                                echo "<td>" . $row['id'] . "</td>";
                                                echo "<td>" . $row['correo'] . "</td>";
                                                echo "<td>" . $row['productos'] . "</td>";
                                                echo "<td>" . $row['total_cantidad'] . "</td>";
                                                echo "<td>" . $row['precio_total'] . "</td>";

                                                // Formatear la fecha
                                                $fecha_formateada = date('Y-m-d H:i:s', strtotime($row['fecha']));
                                                echo "<td>" . $fecha_formateada . "</td>";

                                                echo "</tr>";
                                            }
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Ver Gráficos</h4>
                        <p class="card-text">Haz clic en el botón para ver los gráficos.</p>
                        <a href="graficos.php" class="btn btn-primary">Ver Gráficos</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once ("../Main/mainjs.php"); ?>

    <script>
        $(document).ready(function () {
            $('#compras_data').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "pageLength": <?php echo $resultados_por_pagina; ?>,
                "lengthChange": false,
                "language": {
                    "search": "Buscar:",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                    "infoEmpty": "Mostrando 0 de 0 registros",
                    "infoFiltered": "(filtrado de _MAX_ registros totales)"
                }
            });
        });
    </script>
</body>

</html>