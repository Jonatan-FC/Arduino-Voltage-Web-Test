<!DOCTYPE html>
<html>
<head>
    <title>Gráfico de Indicadores de Voltaje</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        #chart_div {
            width: 80%;
            max-width: 250px;
            height: 250px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div id="chart_div"></div>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['gauge']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart(voltage) {
            var options = {
                width: '100%', height: 250,
                max: 5, 
                redFrom: 0, redTo: 2,
                yellowFrom: 2, yellowTo: 4,
                greenFrom: 4, greenTo: 5,
                minorTicks: 5
            };
            var chart = new google.visualization.Gauge(document.getElementById('chart_div'));
            var data = google.visualization.arrayToDataTable([
                ['Label', 'Value'],
                ['Voltaje', voltage]
            ]);
            chart.draw(data, options);
        }
        function updateVoltage() {
            $.ajax({
                url: 'get_voltage.php',
                dataType: 'json',
                success: function(data) {
                    var lastVoltage = data.voltages[data.voltages.length - 1];
                    drawChart(parseFloat(lastVoltage));
                }
            });
        }
        // Actualizar cada 1 segundo 
        setInterval(updateVoltage, 1000);
    </script>
</body>
</html>
