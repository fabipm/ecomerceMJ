<?php   
class ReportVentasAnio2024 {
    public function getVentasPorMes2024() {
        // Establecer la conexión a la base de datos
        $pdo = Database::conexion();
        
        // Consulta SQL para obtener las ventas por mes para el año 2024
        $sql = "SELECT DATE_FORMAT(p.fecha, '%Y-%m') AS mes, 
                       SUM(pp.unidades) AS total_vendido
                FROM pedido_producto pp
                JOIN pedido p ON pp.pedido_id = p.id
                WHERE YEAR(p.fecha) = 2024
                GROUP BY mes
                ORDER BY mes DESC";
        
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
