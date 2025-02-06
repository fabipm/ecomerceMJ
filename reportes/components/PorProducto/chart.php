<?php

class ChartPorProducto {
    public function render($productos, $total_vendido) {
        ?>
        <canvas id="productoChart" width="400" height="200"></canvas>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            var productos = <?php echo json_encode($productos); ?>;
            var total_vendido = <?php echo json_encode($total_vendido); ?>;

            var ctx = document.getElementById('productoChart').getContext('2d');
            var productoChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: productos,
                    datasets: [{
                        label: 'Total de Unidades Vendidas',
                        data: total_vendido,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
        <?php
    }
}
?>
