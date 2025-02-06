<?php
class ReportMenosVentas {
    public function getMenosVentas() {
        // Establecer la conexión a la base de datos
        $pdo = Database::conexion();
        
        // Consulta SQL para obtener los 3 meses con menos ventas
        $sql = "SELECT
        MONTH(p.fecha) AS mes,
        SUM(p.precio_total) AS total_vendido
    FROM
        pedido p
    WHERE
        YEAR(p.fecha) = 2024
    GROUP BY
        MONTH(p.fecha)
    ORDER BY
        total_vendido ASC
    LIMIT 3";
        
        // Ejecutar la consulta
        $stmt = $pdo->query($sql);

        // Arreglos para almacenar los resultados
        $meses = [];
        $total_vendido = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $meses[] = $row['mes'];
            $total_vendido[] = $row['total_vendido'];
        }

        return ['meses' => $meses, 'total_vendido' => $total_vendido];
    }
}
?>
