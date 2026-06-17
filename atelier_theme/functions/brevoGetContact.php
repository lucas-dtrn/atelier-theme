<?php
$_ENV = include($_SERVER['DOCUMENT_ROOT'] . '/config/env.php');

// Stelle sicher, dass die Anfrage eine POST-Anfrage ist
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Hole die Daten aus dem POST-Body
    $data = json_decode(file_get_contents('php://input'));

    // Definiere die Anfrage-URL
    $url = 'https://api.brevo.com/v3/contacts/' . $data->customer->email;

    // Setze die Header für die Anfrage
    $headers = array(
        'accept: application/json',
        'api-key: ' . $_ENV['BREVO_API_KEY'],
    );

    // Erstelle den cURL-Handle
    $curl = curl_init();

    // Setze die cURL-Optionen
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');

    // Führe die Anfrage an die API durch
    $result = curl_exec($curl);
    $httpResponseCode = curl_getinfo($curl, CURLINFO_RESPONSE_CODE);

    // Schließe den cURL-Handle
    curl_close($curl);

    // Überprüfe das Ergebnis und gib es als JSON zurück
    if ($httpResponseCode === 200 && $result !== false) {
        echo $result;
    } else {
        http_response_code(404); // Fehlercode, falls die Anfrage fehlschlägt
        echo $result;
    }
} else {
    http_response_code(405); // Fehlercode, falls die Anfrage keine POST-Anfrage ist
    echo json_encode(array('error' => 'Ungültige Anfrage. Es werden nur POST-Anfragen akzeptiert.'));
}
