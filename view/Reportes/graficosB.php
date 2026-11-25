<?php
require_once ("../../config/conexion.php");

$conectar = new Conectar();
$conn = $conectar->Conexion();

if (!$conn) {
    die("Error de conexión: No se pudo conectar a la base de datos.");
}

$queryProductos = "SELECT producto, SUM(cantidad) AS total_ventas FROM tm_compras GROUP BY producto";
$resultProductos = $conn->query($queryProductos);

$productos = [];
$cantidades = [];

while ($row = $resultProductos->fetch(PDO::FETCH_ASSOC)) {
    $productos[] = $row['producto'];
    $cantidades[] = $row['total_ventas'];
}

$queryVentasPorMes = "SELECT DATE_FORMAT(fecha, '%M') AS mes, SUM(cantidad) AS total_ventas FROM tm_compras WHERE YEAR(fecha) = YEAR(CURDATE()) AND fecha >= '2024-01-01' GROUP BY DATE_FORMAT(fecha, '%m')";
$resultVentasPorMes = $conn->query($queryVentasPorMes);

$meses = [];
$ventasPorMes = [];

while ($row = $resultVentasPorMes->fetch(PDO::FETCH_ASSOC)) {
    $meses[] = $row['mes'];
    $ventasPorMes[] = $row['total_ventas'];
}

$queryCategorias = "SELECT c.cat_nom AS Categoria, COUNT(*) AS total_ventas 
                    FROM tm_compras cm
                    INNER JOIN tm_categoria c ON cm.Categoria = c.cat_id
                    GROUP BY cm.Categoria";
$resultCategorias = $conn->query($queryCategorias);

$categorias = [];
$ventasPorCategoria = [];

while ($row = $resultCategorias->fetch(PDO::FETCH_ASSOC)) {
    $categorias[] = $row['Categoria'];
    $ventasPorCategoria[] = $row['total_ventas'];
}

$conn = null; 
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>Gráficos - Ventas</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="container">
        <canvas id="graficoBarras" width="400" height="200"></canvas>

        <canvas id="graficoLineas" width="400" height="200"></canvas>

        <canvas id="graficoCircular" width="400" height="200"></canvas>
    </div>

    <script>
        // Datos para el gráfico de barras
        var datosGraficoBarras = {
            labels: <?php echo json_encode($productos); ?>,
            datasets: [{
                label: "Ventas por producto",
                backgroundColor: [
                    "#36A2EB",
                    "#FFCE56",
                    "#4BC0C0",
                    "#FF6384",
                    "#9966FF"
                ],
                borderColor: [
                    "#36A2EB",
                    "#FFCE56",
                    "#4BC0C0",
                    "#FF6384",
                    "#9966FF"
                ],
                borderWidth: 1,
                data: <?php echo json_encode($cantidades); ?>
            }]
        };

        // Configuración del gráfico de barras
        var opcionesGraficoBarras = {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        };

        // Obtener el contexto del lienzo del gráfico de barras
        var contextoBarras = document.getElementById("graficoBarras").getContext("2d");

        // Crear el gráfico de barras
        var graficoBarras = new Chart(contextoBarras, {
            type: "bar",
            data: datosGraficoBarras,
            options: opcionesGraficoBarras
        });

        // Datos para el gráfico de líneas
        var datosGraficoLineas = {
            labels: <?php echo json_encode($meses); ?>,
            datasets: [{
                label: "Ventas por mes",
                borderColor: "#FF6384",
                backgroundColor: "rgba(255,99,132,0.2)",
                data: <?php echo json_encode($ventasPorMes); ?>
            }]
        };

        // Configuración del gráfico de líneas
        var opcionesGraficoLineas = {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    stepSize: 5, 
                    callback: function (value) { return value.toFixed(0); } 
                }
            }
        };

        // Obtener el contexto del lienzo del gráfico de líneas
        var contextoLineas = document.getElementById("graficoLineas").getContext("2d");

        // Crear el gráfico de líneas
        var graficoLineas = new Chart(contextoLineas, {
            type: "line",
            data: datosGraficoLineas,
            options: opcionesGraficoLineas
        });

        // Datos para el gráfico circular
        var datosGraficoCircular = {
            labels: <?php echo json_encode($categorias); ?>,
            datasets: [{
                label: "Ventas por categoría",
                backgroundColor: [
                    "#FF6384",
                    "#36A2EB",
                    "#FFCE56",
                    "#4BC0C0",
                    "#9966FF"
                ],
                borderColor: [
                    "#FF6384",
                    "#36A2EB",
                    "#FFCE56",
                    "#4BC0C0",
                    "#9966FF"
                ],
                borderWidth: 1,
                data: <?php echo json_encode($ventasPorCategoria); ?>
            }]
        };

        // Configuración del gráfico circular
        var opcionesGraficoCircular = {
            responsive: true,
            maintainAspectRatio: false,
        };


        // Obtener el contexto del lienzo del gráfico circular
        var contextoCircular = document.getElementById("graficoCircular").getContext("2d");

        // Crear el gráfico circular
        var graficoCircular = new Chart(contextoCircular, {
            type: "pie",
            data: datosGraficoCircular,
            options: opcionesGraficoCircular
        });

    </script>
</body>

</html>