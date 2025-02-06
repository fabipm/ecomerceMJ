<?php

// Incluir la conexión a la base de datos
include('db/db.php');

// Determinar el reporte seleccionado por la URL (Por defecto: Por Departamento)
$reporteSeleccionado = isset($_GET['reporte']) ? $_GET['reporte'] : 'PorDepartamento';

// Obtener el mes seleccionado (por defecto: enero 2024)
$mesSeleccionado = isset($_GET['mes']) ? $_GET['mes'] : '2024-01';

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
    $titulo = "Los 3 Meses con Menos Ventas";
    
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
    $titulo = "Ventas por Mes en 2024";
    
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
} elseif ($reporteSeleccionado === 'GananciasDiarias2024') {
    include('components/GananciasDiarias2024/report.php');
    include('components/GananciasDiarias2024/chart.php');
    
    $report = new ReportGananciasDiarias2024();
    
    // Depurar entrada
    if (!$mesSeleccionado) {
        die("No se seleccionó un mes.");
    }

    // Obtener datos del reporte
    $data = $report->getGananciasDiarias($mesSeleccionado);

    // Depurar resultado de la consulta
    if (empty($data['dias'])) {
        die("No se encontraron datos para el mes: $mesSeleccionado");
    }

    $titulo = "Ganancias Diarias del Mes " . date('F Y', strtotime($mesSeleccionado));
    $ejes = [
        'x' => $data['dias'],
        'y' => $data['ganancias_diarias']
    ];

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
        <a href="index.php?reporte=GananciasDiarias2024" class="btn">Ganancias Diarias (Enero 2024)</a>
        <!-- Formulario para seleccionar el mes -->
        <?php if ($reporteSeleccionado === 'GananciasDiarias2024'): ?>
        <form method="GET" action="index.php">
            <input type="hidden" name="reporte" value="GananciasDiarias2024">
            <label for="mes">Seleccione un mes:</label>
            <select name="mes" id="mes">
                <?php
                // Generar opciones de meses dinámicamente
                $meses = [
                    '2024-01' => 'Enero 2024',
                    '2024-02' => 'Febrero 2024',
                    '2024-03' => 'Marzo 2024',
                    '2024-04' => 'Abril 2024',
                    '2024-05' => 'Mayo 2024',
                    '2024-06' => 'Junio 2024',
                    '2024-07' => 'Julio 2024',
                    '2024-08' => 'Agosto 2024',
                    '2024-09' => 'Septiembre 2024',
                    '2024-10' => 'Octubre 2024',
                    '2024-11' => 'Noviembre 2024',
                    '2024-12' => 'Diciembre 2024',
                ];

                foreach ($meses as $valor => $nombre) {
                    $selected = ($mesSeleccionado === $valor) ? 'selected' : '';
                    echo "<option value=\"$valor\" $selected>$nombre</option>";
                }
                ?>
            </select>
            <button type="submit">Ver Reporte</button>
        </form>
    <?php endif; ?>
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
            } elseif ($reporteSeleccionado === 'PorMes') {
                // Crear el gráfico de Ventas y Pedidos por Mes
                $chart = new ChartPorMes();
                $chart->render($ejes['x'], $ejes['y1'], $ejes['y2']);
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
            } elseif ($reporteSeleccionado === 'GananciasDiarias2024') {
                $chart = new ChartGananciasDiarias2024();
                $chart->render($ejes['x'], $ejes['y']);
            }
            
            ?>
        </div>
    </div>

</body>
</html>
