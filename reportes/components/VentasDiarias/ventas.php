<?php
// Incluir la clase de conexión
include_once '../../db/db.php';

// Obtener el mes seleccionado o usar el mes actual
$month = isset($_POST['month']) ? $_POST['month'] : date('m');
$year = date('Y');

// Usamos la conexión de PDO
$conn = Database::conexion();

try {
    // Preparamos la consulta SQL
    $sql = "SELECT DATE(fecha) AS day, SUM(precio_total) AS total_sales
            FROM pedido
            WHERE MONTH(fecha) = :month AND YEAR(fecha) = :year
            GROUP BY DATE(fecha)
            ORDER BY DATE(fecha)";
    
    // Preparar la consulta
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':month', $month, PDO::PARAM_INT);
    $stmt->bindParam(':year', $year, PDO::PARAM_INT);
    
    // Ejecutamos la consulta
    $stmt->execute();
    
    // Obtenemos los resultados
    $sales = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Error al ejecutar la consulta: " . $e->getMessage());
}

// Preparar los datos para el gráfico
$dates = [];
$totals = [];
foreach ($sales as $sale) {
    $dates[] = $sale['day']; // Almacenamos las fechas
    $totals[] = $sale['total_sales']; // Almacenamos las ventas totales
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas Diarias</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns"></script>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1> </h1>
    <form method="post" action="">
        
        <label for="month">Mes:</label>
        <select id="month" name="month">
            <option value="1" <?php if ($month == 1) echo 'selected'; ?>>Enero</option>
            <option value="2" <?php if ($month == 2) echo 'selected'; ?>>Febrero</option>
            <option value="3" <?php if ($month == 3) echo 'selected'; ?>>Marzo</option>
            <option value="4" <?php if ($month == 4) echo 'selected'; ?>>Abril</option>
            <option value="5" <?php if ($month == 5) echo 'selected'; ?>>Mayo</option>
            <option value="6" <?php if ($month == 6) echo 'selected'; ?>>Junio</option>
            <option value="7" <?php if ($month == 7) echo 'selected'; ?>>Julio</option>
            <option value="8" <?php if ($month == 8) echo 'selected'; ?>>Agosto</option>
            <option value="9" <?php if ($month == 9) echo 'selected'; ?>>Septiembre</option>
            <option value="10" <?php if ($month == 10) echo 'selected'; ?>>Octubre</option>
            <option value="11" <?php if ($month == 11) echo 'selected'; ?>>Noviembre</option>
            <option value="12" <?php if ($month == 12) echo 'selected'; ?>>Diciembre</option>
        </select>
        <button type="submit">Consultar</button>      </form>
    <button onclick="window.location.href='../../index.php';" class="btn">Regresar al Inicio</button>
    <h1>Ventas Diarias</h1>
    <!-- Crear el gráfico -->
    <canvas id="salesChart"></canvas>

    <script>
    // Obtener los datos de PHP para el gráfico
    var dates = <?php echo json_encode($dates); ?>;
    var totals = <?php echo json_encode($totals); ?>;

    // Crear el gráfico con Chart.js
    var ctx = document.getElementById('salesChart').getContext('2d');
    
    var salesChart = new Chart(ctx, {
        type: 'line', // Tipo de gráfico: línea
        data: {
            labels: dates.map(date => new Date(date)), // Convertimos las fechas en objetos Date
            datasets: [{
                label: 'Ventas Totales',
                data: totals, // Datos: las ventas totales
                borderColor: 'rgba(75, 192, 192, 1)', // Color de la línea
                backgroundColor: 'rgba(75, 192, 192, 0.2)', // Color del área debajo de la línea
                fill: true, // Rellenar el área debajo de la línea
                tension: 0.4, // Suavizar la línea
                pointRadius: 5, // Tamaño de los puntos
                pointBackgroundColor: 'rgba(75, 192, 192, 1)', // Color de los puntos
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    type: 'time', // Eje X de tipo tiempo
                    time: {
                        unit: 'day', // Unidades de tiempo: día
                        tooltipFormat: 'll', // Formato de las fechas en el tooltip
                    },
                    title: {
                        display: true,
                        text: 'Día'
                    }
                },
                y: {
                    beginAtZero: true, // Comenzar desde 0
                    title: {
                        display: true,
                        text: 'Ventas Totales'
                    }
                }
            }
        }
    });
    </script>
</body>
</html>
