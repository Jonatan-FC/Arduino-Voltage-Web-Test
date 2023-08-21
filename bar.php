<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sheets</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            text-align: center;
            margin-top: 20px;
        }
        #chart-container {
            max-width: 1200px; /* Ajusta el ancho máximo del contenedor */
            margin: 0 auto;
        }
        #center{
            margin: 0 auto;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>  Voltaje</h1>
    <div id="chart-container">
        <canvas id="myChart" width="1000" height="400"></canvas> <!-- Ajusta el ancho del lienzo del gráfico -->
    </div>
    
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [], 
                datasets: [{
                    label: 'V',
                    data: [],
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    fill: false
                }]
            },
            options: {
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: ''
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Volts'
                        }
                    }
                }
            }
        });
        // AJAX
        function updateChart() {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'get.php', true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var data = JSON.parse(xhr.responseText);
                    // Actualizar los datos del gráfico
                    myChart.data.labels = data.timestamps;
                    myChart.data.datasets[0].data = data.voltages;
                    myChart.update();
                }
            };
            xhr.send();
        }
        setInterval(updateChart, 1000); // Actualizar cada 1 segundo
    </script>
    <br>

    
    <?php 
    // include('semaforo.php');
    ?>
    
</body>
</html>


