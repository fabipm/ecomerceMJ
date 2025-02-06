<?php

// Clase para renderizar el gráfico
class Chart {
    public function render($provincias, $total_pedidos) {
        ?>
        <canvas id="pedidoChart" width="400" height="200"></canvas>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            var provincias = <?php echo json_encode($provincias); ?>;
            var total_pedidos = <?php echo json_encode($total_pedidos); ?>;

            var ctx = document.getElementById('pedidoChart').getContext('2d');
            var pedidoChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: provincias,
                    datasets: [{
                        label: 'Total de pedidos completados',
                        data: total_pedidos,
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
