<?php
require 'vendor/autoload.php';
putenv('GOOGLE_APPLICATION_CREDENTIALS=C:\\xampp\\htdocs\\credentials.json');
use Google\Service\Sheets;
use Google\Client;

$client = new Client();
$client->useApplicationDefaultCredentials();
$client->addScope(Sheets::SPREADSHEETS_READONLY);

try {
    $service = new Sheets($client);
    $spreadsheetId = '1Ibabq9PW2xfKI1TlbH1knx8GjHm-ZZlv7L_0Av07jdc'; 
    $range = '!B:B'; // Hoja "V", columna B

    $response = $service->spreadsheets_values->get($spreadsheetId, $range);
    $values = $response->getValues();
    $voltages = [];

    foreach ($values as $row) {
        $voltages[] = $row[0];
    }

    $data = [
        "voltages" => $voltages,
    ];

    header('Content-Type: application/json');
    echo json_encode($data);
} catch (Google\Service\Exception $e) {
    echo "Error en la solicitud a la API de Google Sheets: " . $e->getMessage();
}

?>
