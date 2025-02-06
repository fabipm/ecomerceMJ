<?php

// Incluir la conexión a la base de datos
include('db/db.php');

// Determinar el reporte seleccionado por la URL (Por defecto: Por Departamento)
$reporteSeleccionado = isset($_GET['reporte']) ? $_GET['reporte'] : 'PorDepartamento';

// Inicializar variables para los reportes
$titulo = "";
$ejes = [];
$data = [];

if ($reporteSeleccionado === 'PorDepartamento') {
    // Incluir el reporte de Pedidos por Provincia
    include('components/PorDepartamento/report.php');
    // Incluir el gráfico de Pedidos por Provincia
    include('components/PorDepartamento/chart.php');
    
    // Crear una instancia del reporte de Pedidos por Provincia
    $report = new Report();
    // Obtener los datos de Pedidos por Provincia
    $data = $report->getPedidosPorProvincia();
    
    // Título del reporte
    $titulo = "Celulares Vendidos Por Departamento";
    
    // Datos para los ejes del gráfico
    $ejes = [
        'x' => $data['departamento'],
        'y' => $data['total_vendido']
    ];
} elseif ($reporteSeleccionado === 'PorProducto') {
    // Incluir el reporte de Productos Más Vendidos
    include('components/PorProducto/report.php');
    // Incluir el gráfico de Productos Más Vendidos
    include('components/PorProducto/chart.php');
    
    // Crear una instancia del reporte de Productos Más Vendidos
    $report = new ReportPorProducto();
    // Obtener los datos de Productos Más Vendidos
    $data = $report->getTopProductos();
    
    // Título del reporte
    $titulo = "Productos Más Vendidos";
    
    // Datos para los ejes del gráfico
    $ejes = [
        'x' => $data['productos'],
        'y' => $data['total_vendido']
    ];
} elseif ($reporteSeleccionado === 'PorMenosVentas') {
    // Incluir el reporte de Los 3 meses con menos ventas
    include('components/PorMenosVentas/report.php');
    // Incluir el gráfico de Los 3 meses con menos ventas
    include('components/PorMenosVentas/chart.php');
    
    // Crear una instancia del reporte de Los 3 meses con menos ventas
    $report = new ReportMenosVentas();
    // Obtener los datos de Los 3 meses con menos ventas
    $data = $report->getMenosVentas();
    
    // Título del reporte
    $titulo = "Los Meses con Menos Ganacias (2024)";
    
    // Datos para los ejes del gráfico
    $ejes = [
        'x' => $data['meses'],
        'y' => $data['total_vendido']
    ];
} elseif ($reporteSeleccionado === 'PorVentasAnio2024') {
    // Incluir el reporte de Ventas por mes en 2024
    include('components/PorVentasAnio2024/report.php');
    // Incluir el gráfico de Ventas por mes en 2024
    include('components/PorVentasAnio2024/chart.php');
    
    // Crear una instancia del reporte de Ventas por mes en 2024
    $report = new ReportVentasAnio2024();
    // Obtener los datos de Ventas por mes en 2024
    $data = $report->getVentasPorMes2024();
    
    // Título del reporte
    $titulo = "Ventas en los ultimos meses";
    
    // Datos para los ejes del gráfico
    $ejes = [
        'x' => $data['meses'],
        'y' => $data['total_vendido']
    ];

} elseif ($reporteSeleccionado === 'GananciasPorMes2024') {
    include('components/GananciasPorMes2024/report.php');
    include('components/GananciasPorMes2024/chart.php');

    $report = new ReportGananciasPorMes2024();
    $data = $report->getGananciasTotalesPorMes();

    $titulo = "Ganancias Totales por Mes (2024)";
    $ejes = [
        'x' => $data['meses'],
        'y' => $data['ganancias_totales']
    ];
}elseif (isset($_GET['reporte']) && $_GET['reporte'] === 'GananciasDiarias2024') {
    // Redirigir al archivo especificado
    header("Location: components/VentasDiarias/ventas.php");
    exit();
} else {
    die("Reporte no encontrado.");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes Dinámicos</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>

    <!-- Botones para cambiar entre reportes -->
    <div class="button-container">
        <a href="index.php?reporte=PorDepartamento" class="btn">Celulares Vendidos Por Departamento</a>
        <a href="index.php?reporte=PorProducto" class="btn">Ver Reporte por Producto</a>
        <a href="index.php?reporte=PorMenosVentas" class="btn">Ver Reporte de Menos Ventas</a>  <!-- Nuevo botón para los 3 meses con menos ventas -->
        <a href="index.php?reporte=PorVentasAnio2024" class="btn">Ver Reporte por Ventas 2024</a>  <!-- Nuevo botón para el reporte de ventas por mes en 2024 -->
        <a href="index.php?reporte=GananciasPorMes2024" class="btn">Ganancias Totales 2024</a>
        <a href="index.php?reporte=GananciasDiarias2024" class="btn">Ganancias Diarias</a>
        <button onclick="window.location.href='http://localhost/proyecto/';" class="btn">Regresar al Inicio</button>
    </div>
    <!-- Título y contenido del reporte -->
    <div class="report-container">
        <h1><?php echo $titulo; ?></h1>
        <div class="chart-container">
            <?php
            // Renderizar el gráfico correspondiente según el reporte seleccionado
            if ($reporteSeleccionado === 'PorDepartamento') {
                // Crear el gráfico de Pedidos por Provincia
                $chart = new Chart();
                $chart->render($ejes['x'], $ejes['y']);
            } elseif ($reporteSeleccionado === 'PorProducto') {
                // Crear el gráfico de Productos Más Vendidos
                $chart = new ChartPorProducto();
                $chart->render($ejes['x'], $ejes['y']);
            } elseif ($reporteSeleccionado === 'PorMenosVentas') {
                // Crear el gráfico de Los 3 meses con menos ventas
                $chart = new ChartMenosVentas();
                $chart->render($ejes['x'], $ejes['y']);
            } elseif ($reporteSeleccionado === 'PorVentasAnio2024') {
                // Crear el gráfico de Ventas por mes en 2024
                $chart = new ChartVentasAnio2024();
                $chart->render($ejes['x'], $ejes['y']);
            } elseif ($reporteSeleccionado === 'GananciasPorMes2024') {
                $chart = new ChartGananciasPorMes2024();
                $chart->render($ejes['x'], $ejes['y']);
            }
            
            ?>
        </div>
    </div>

</body>
</html>
