<?php

class ReportGananciasPorMes2024 {
    public function getGananciasTotalesPorMes() {
        $pdo = Database::conexion();
        $sql = "
            SELECT
    MONTH(p.fecha) AS mes,
    SUM(p.precio_total) AS ganancias_totales
FROM
    pedido p
GROUP BY
    MONTH(p.fecha)
ORDER BY
    mes ASC

        ";
        $stmt = $pdo->query($sql);

        $meses = [];
        $ganancias_totales = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $meses[] = $row['mes'];
            $ganancias_totales[] = $row['ganancias_totales'];
        }

        return ['meses' => $meses, 'ganancias_totales' => $ganancias_totales];
    }
}
?>
