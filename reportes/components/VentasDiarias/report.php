<?php

// Función para obtener ventas diarias
function obtenerVentasDiarias($month) {
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

    return ['dates' => $dates, 'totals' => $totals];
}

// Puedes agregar más funciones aquí para otros reportes, por ejemplo:
function obtenerVentasPorProducto($month) {
    // Similar a la función anterior, pero consulta por producto.
}

?>
