<!DOCTYPE html>
<html>
<head>
    <title>Prueba de Lector de Voltaje</title>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-more.js"></script>
    <script src="https://code.highcharts.com/modules/solid-gauge.js"></script>
</head>
<body>
    <div id="chart_container" style="width: 260px; height: 300px;"></div>
    <script type="text/javascript">
        var chart;

        // Configuración del gráfico de medidor de voltaje
        var chartOptions = {
            chart: {
                type: 'gauge',
                plotBackgroundColor: null,
                plotBackgroundImage: null,
                plotBorderWidth: 0,
                plotShadow: false
            },
            title: {
                text: 'Pozo 2'
            },
            pane: {
                startAngle: -150,
                endAngle: 150,
                background: [{
                    backgroundColor: {
                        linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                        stops: [
                            [0, '#FFF'],
                            [1, '#FFF']
                        ]
                    },
                    borderWidth: 0,
                    outerRadius: '109%'
                }, {
                    backgroundColor: {
                        linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                        stops: [
                            [0, '#FFF'],
                            [1, '#FFF']
                        ]
                    },
                    borderWidth: 1,
                    outerRadius: '107%'
                }, {
                    background: '#DDD',
                    borderWidth: 0,
                    outerRadius: '105%',
                    innerRadius: '103%'
                }]
            },
            // El eje del medidor
            yAxis: {
                min: 0,
                max: 5,
                minorTickInterval: 'auto',
                minorTickWidth: 1,
                minorTickLength: 10,
                minorTickPosition: 'inside',
                minorTickColor: '#666',
                tickPixelInterval: 30,
                tickWidth: 2,
                tickPosition: 'inside',
                tickLength: 10,
                tickColor: '#666',
                labels: {
                    step: 1,
                    rotation: 'auto'
                },
                title: {
                    text: 'Voltaje (V)'
                },
            
                plotBands: [{
                    from: 0,
                    to: 1.5,
                    color: '#DF5353' // Rojo
                }, {
                    from: 1.5,
                    to: 3.5,
                    color: '#DDDF0D' // Amarillo
                }, {
                    from: 3.5,
                    to: 5,
                    color: '#55BF3B' // Verde
                }]
            },
            series: [{
                name: 'Voltaje',
                data: [3.5],
                tooltip: {
                    valueSuffix: ' V'
                }
            }]
        };

        // Crear el gráfico de medidor de voltaje
        chart = Highcharts.chart('chart_container', chartOptions);

        // Función para actualizar el valor del medidor con datos AJAX
        function updateVoltage() {
            $.ajax({
                url: 'get_voltage1.php',
                dataType: 'json',
                success: function(data) {
                    if (data && data.voltages && data.voltages.length > 0) {
                        var lastVoltage = parseFloat(data.voltages[data.voltages.length - 1]);
                        if (!isNaN(lastVoltage)) {
                            chart.series[0].points[0].update(lastVoltage);
                        } else {
                            console.error("Received invalid voltage value:", lastVoltage);
                        }
                    } else {
                        console.error("No valid data received.");
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX error:", error);
                }
            });
        }

        // Actualizar cada 1 segundo
        setInterval(updateVoltage, 1000);
    </script>
</body>
</html>

