<?php

class ChartGananciasPorMes2024 {
    public function render($meses, $ganancias_totales) {
        ?>
        <canvas id="gananciasChart" width="400" height="200"></canvas>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            var meses = <?php echo json_encode($meses); ?>;
            var ganancias_totales = <?php echo json_encode($ganancias_totales); ?>;

            var ctx = document.getElementById('gananciasChart').getContext('2d');
            var gananciasChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: meses,
                    datasets: [{
                        label: 'Ganancias Totales (2024)',
                        data: ganancias_totales,
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 1,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Ganancias Totales por Mes - 2024'
                        }
                    },
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
