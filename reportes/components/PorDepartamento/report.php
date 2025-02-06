<?php

// Clase para generar el reporte
class Report {
    public function getPedidosPorProvincia() {
        // Establecer la conexión a la base de datos
        $pdo = Database::conexion(); // Usamos la clase Database para obtener la conexión
        
        // Consulta SQL
        $sql = "SELECT p.departamento, 
       SUM(pp.unidades) AS total_vendido
        FROM pedido_producto pp
        JOIN pedido p ON pp.pedido_id = p.id
        GROUP BY p.departamento
        ORDER BY total_vendido DESC
        ";
        
        // Ejecutar la consulta
        $stmt = $pdo->query($sql);

        // Arreglos para almacenar los resultados
        $provincias = [];
        $total_pedidos = [];

        // Recoger los resultados de la consulta
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $provincias[] = $row['departamento'];
            $total_pedidos[] = $row['total_vendido'];
        }

        // Devolver los datos obtenidos
        return ['departamento' => $provincias, 'total_vendido' => $total_pedidos];
    }
}
?>
