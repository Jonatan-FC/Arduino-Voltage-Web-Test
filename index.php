<!DOCTYPE html>
<html>
<head>
    <style>
        .dashboard {
            display: flex;
            flex-direction: column;
            height: 100vh;
        }
        .block-table {
            flex: 0 0 15%;
            background-color: #e0e0e0;
            padding: 10px;
            margin-bottom: 10px; 
        }
        .block-tablex {
            flex: 0 0 15%;
            background-color: #e0e0e0;
            padding: 10px;
            margin-bottom: 10px; 
        }
        .additional-content {
            flex: 0 0 auto; 
            background-color: #d3d3d3;
            padding: 10px;
            margin-top: 10px; 
        }
        table {
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #888;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <div>
            <table> 
                <tr>
                    <td> <?php include('semaforo.php') ?></td>
                    <td>  <?php include('bar.php') ?></td>
                </tr>
            </table>
        </div>
            <div>
            <table>
                <tr>
                <td> <?php include('semaforo1.php') ?></td>
                    <td><?php include('chart.php') ?></td>
                </tr>
            </table>
        </div>
        <div>
            <table> 
                <tr>
                <td> <?php include('semaforo2.php') ?></td>
                    <td>  <?php include('chart1.php') ?></td>
                </tr>
            </table>
        </div>
        <div >
        </div>
    </div>
</body>
</html>
