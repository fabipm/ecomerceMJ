<?php

// Función para generar el gráfico
function generarGraficoVentas($dates, $totals) {
    ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns"></script>

    <script>
    // Obtener los datos de PHP para el gráfico
    var dates = <?php echo json_encode($dates); ?>;
    var totals = <?php echo json_encode($totals); ?>;

    // Crear el gráfico con Chart.js
    var ctx = document.getElementById('salesChart').getContext('2d');
    var salesChart = new Chart(ctx, {
        type: 'line', // Tipo de gráfico: línea
        data: {
            labels: dates.map(date => new Date(date)), // Convertimos las fechas en objetos Date
            datasets: [{
                label: 'Ventas Totales',
                data: totals, // Datos: las ventas totales
                borderColor: 'rgba(75, 192, 192, 1)', // Color de la línea
                backgroundColor: 'rgba(75, 192, 192, 0.2)', // Color del área debajo de la línea
                fill: true, // Rellenar el área debajo de la línea
                tension: 0.4, // Suavizar la línea
                pointRadius: 5, // Tamaño de los puntos
                pointBackgroundColor: 'rgba(75, 192, 192, 1)', // Color de los puntos
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    type: 'time', // Eje X de tipo tiempo
                    time: {
                        unit: 'day', // Unidades de tiempo: día
                        tooltipFormat: 'll', // Formato de las fechas en el tooltip
                    },
                    title: {
                        display: true,
                        text: 'Día'
                    }
                },
                y: {
                    beginAtZero: true, // Comenzar desde 0
                    title: {
                        display: true,
                        text: 'Ventas Totales'
                    }
                }
            }
        }
    });
    </script>
    <?php
}
?>
