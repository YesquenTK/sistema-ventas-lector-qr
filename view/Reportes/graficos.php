<?php
require_once ("../Main/sesion.php");

require_once ("../../config/conexion.php");

$conectar = new Conectar();

$conn = $conectar->Conexion();


if (!$conn) {
    die("Error de conexión: No se pudo conectar a la base de datos.");
}

// ventas de hoy
function obtenerVentasHoy($conn)
{
    $hoy = date('Y-m-d');
    $query = "SELECT COUNT(*) AS ventasHoy FROM tm_compras WHERE DATE(fecha) = :hoy";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':hoy', $hoy, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['ventasHoy'];
}

// ventas totales en el mes
function obtenerVentasMes($conn)
{
    $primerDiaMes = date('Y-m-01');
    $hoy = date('Y-m-d');
    $query = "SELECT SUM(cantidad) AS ventasMes FROM tm_compras WHERE DATE(fecha) BETWEEN :primerDiaMes AND :hoy";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':primerDiaMes', $primerDiaMes, PDO::PARAM_STR);
    $stmt->bindValue(':hoy', $hoy, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['ventasMes'];
}

// ingresos totales en el mes
function obtenerIngresoMes($conn)
{
    $primerDiaMes = date('Y-m-01');
    $hoy = date('Y-m-d');
    $query = "SELECT SUM(cantidad * precio) AS ingresoMes FROM tm_compras WHERE DATE(fecha) BETWEEN :primerDiaMes AND :hoy";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':primerDiaMes', $primerDiaMes, PDO::PARAM_STR);
    $stmt->bindValue(':hoy', $hoy, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['ingresoMes'];
}

$ventasMes = obtenerVentasMes($conn);
$ventasMes = $ventasMes ? $ventasMes : 0;  

$ingresoMes = obtenerIngresoMes($conn);
$ingresoMes = $ingresoMes ? $ingresoMes : 0; 

$ventasHoy = obtenerVentasHoy($conn);

$conn = null; 

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once ("../Main/mainhead.php"); ?>
    <title>Eventu - Gráficos</title>
    <link rel="stylesheet" type="text/css" href="../../public/cam/estilo_camara.css" />
    <link rel="stylesheet" type="text/css" href="../../public/cam/css/plugins/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../../public/cam/css/plugins/simple-line-icons.css" />
    <link rel="stylesheet" type="text/css" href="../../public/cam/css/plugins/animate.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Gráficos</a></li>
                    </ol>
                </div>

                <div class="row">
                    <div class="col-md-4 mt-3">
                        <div class="card bg-success">
                            <div class="card-body">
                                <h4 class="card-title text-white">Hoy</h4>
                                <p class="card-text text-white">Ventas de hoy: <strong><span id="ventasHoy"><?php echo $ventasHoy; ?></span></strong></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mt-3">
                        <div class="card bg-info">
                            <div class="card-body">
                                <h4 class="card-title text-white">Total Mes</h4>
                                <p class="card-text text-white">Ventas totales en el mes: <strong><span id="ventasMes"><?php echo $ventasMes; ?></span></strong></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mt-3">
                        <div class="card bg-warning">
                            <div class="card-body">
                                <h4 class="card-title text-white">Ingresos</h4>
                                <p class="card-text text-white">Ingresos totales en el mes: <strong><span id="ingresoMes"><?php echo $ingresoMes; ?></span></strong></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <canvas id="graficoCircular" height="400"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <canvas id="graficoLineas" height="400"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mt-3">
                        <div class="card">
                            <div class="card-body">
                                <canvas id="graficoBarras" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php require_once ("../Main/mainjs.php"); ?>

    
    <?php require_once ("graficosB.php"); ?>


</body>

</html>
