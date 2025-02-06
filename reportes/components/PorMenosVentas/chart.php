<?php

class ChartMenosVentas {
    public function render($meses, $total_vendido) {
        ?>
        <canvas id="menosVentasChart" width="400" height="200"></canvas>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            var meses = <?php echo json_encode($meses); ?>;
            var total_vendido = <?php echo json_encode($total_vendido); ?>;

            var ctx = document.getElementById('menosVentasChart').getContext('2d');
            var menosVentasChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: meses,
                    datasets: [{
                        label: 'Total de Ganancias',
                        data: total_vendido,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
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
