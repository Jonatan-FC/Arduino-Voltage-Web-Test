<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sheets</title>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div id="chart-container">
       
    <canvas id="myChart" width="1590" height="450" style="display: block; box-sizing: border-box; height: 450px; width: 1590px;"></canvas>
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
                responsive: true,
                maintainAspectRatio: false,
                
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
</body>
</html>
