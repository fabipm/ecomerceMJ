<?php
// Clase para generar el reporte
class ReportPorProducto {
    public function getTopProductos() {
        // Establecer la conexión a la base de datos
        $pdo = Database::conexion();
        
        // Consulta SQL
        $sql = "SELECT p.nombre AS producto, 
                       SUM(pp.unidades) AS total_vendido
                FROM pedido_producto pp
                JOIN producto p ON pp.producto_id = p.id
                GROUP BY pp.producto_id
                ORDER BY total_vendido DESC
                LIMIT 5";
        
        // Ejecutar la consulta
        $stmt = $pdo->query($sql);

        // Arreglos para almacenar los resultados
        $productos = [];
        $total_vendido = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $productos[] = $row['producto'];
            $total_vendido[] = $row['total_vendido'];
        }

        return ['productos' => $productos, 'total_vendido' => $total_vendido];
    }
}
?>
