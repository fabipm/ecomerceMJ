<?php

class ChartVentasAnio2024 {
    public function render($meses, $total_vendido) {
        ?>
        <canvas id="ventasAnio2024Chart" width="400" height="200"></canvas>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            var meses = <?php echo json_encode($meses); ?>;
            var total_vendido = <?php echo json_encode($total_vendido); ?>;

            var ctx = document.getElementById('ventasAnio2024Chart').getContext('2d');
            var ventasAnio2024Chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: meses,
                    datasets: [{
                        label: 'Total Unidades Vendidas',
                        data: total_vendido,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
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
