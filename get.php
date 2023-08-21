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
    $spreadsheetId = '1LYpudZjT8Hdya5D8zowTCaGpseKZIqA9OZ6mvEOXO1c'; //Hoja de google, en este caso V
    $range = '!A:B'; //Rango toda la columna A y B

    $response = $service->spreadsheets_values->get($spreadsheetId, $range);
    $values = $response->getValues();

    $timestamps = [];
    $voltages = [];

    foreach ($values as $row) {
        $timestamps[] = $row[0];
        $voltages[] = $row[1];
    }

    $data = [
        "timestamps" => $timestamps,
        "voltages" => $voltages,
    ];

    header('Content-Type: application/json');
    echo json_encode($data);
} catch (Google\Service\Exception $e) {
    echo "Error en la solicitud a la API de Google Sheets: " . $e->getMessage();
}
?>
