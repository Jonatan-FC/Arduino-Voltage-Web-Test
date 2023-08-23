<?php
require 'vendor/autoload.php';
putenv('GOOGLE_APPLICATION_CREDENTIALS=C:\\path\\to\\credentials.json');
use Google\Service\Sheets;
use Google\Client;

$client = new Client();
$client->useApplicationDefaultCredentials();
$client->addScope(Sheets::SPREADSHEETS_READONLY);

try {
    $service = new Sheets($client);
    $spreadsheetId = '1O-Dvwv2VF-PlntI5-zVfkGF6zrLqsnaAXKzPRq7h8eA'; 
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
