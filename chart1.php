<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sheets</title>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div id="chart-chart1">
       
    <canvas id="chart3" width="1590" height="450" style="display: block; box-sizing: border-box; height: 450px; width: 1590px;"></canvas>
    </div>
    
 

    <script>
        var ctxxx = document.getElementById('chart3').getContext('2d');
        var chart3 = new Chart(ctxxx, {
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
        function updateChart3() {
        var x = new XMLHttpRequest();
        x.open('GET', 'get2.php', true);
        x.onreadystatechange = function () {
            if (x.readyState === 4 && x.status === 200) {
                var data = JSON.parse(x.responseText);
                // Actualizar los datos del gráfico
                chart3.data.labels = data.timestamps;
                chart3.data.datasets[0].data = data.voltages;
                chart3.update();
            }
        };
        x.send();
    }
    setInterval(updateChart3, 1000); // Actualizar cada 1 segundo
</script>
</body>
</html>