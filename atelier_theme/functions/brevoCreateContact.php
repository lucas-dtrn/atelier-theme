<?php
$_ENV = include($_SERVER['DOCUMENT_ROOT'] . '/config/env.php');

// Stelle sicher, dass die Anfrage eine POST-Anfrage ist
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Hole die Daten aus dem POST-Body
    $params = json_decode(file_get_contents('php://input'));

    // Format the params for the Brevo API
    $params = array(
        "attributes" => array(
            "VORNAME" => $params->customer->firstname,
            "NACHNAME" => $params->customer->lastname,
            "SMS" => $params->customer->phone, // TODO Check the phone format in JS
        ),
        "updateEnabled" => false,
        "email" => $params->customer->email,
    );

    // Definiere die Anfrage-URL
    $url = 'https://api.brevo.com/v3/contacts';

    // Setze die Header für die Anfrage
    $headers = array(
        'Content-Type: application/json',
        'api-key: ' . $_ENV['BREVO_API_KEY'],
    );

    // Erstelle den cURL-Handle
    $curl = curl_init();

    // Setze die cURL-Optionen
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($params));

    // Führe die Anfrage an die API durch
    $result = curl_exec($curl);
    $httpResponseCode = curl_getinfo($curl, CURLINFO_RESPONSE_CODE);

    // Schließe den cURL-Handle
    curl_close($curl);

    // Überprüfe das Ergebnis und gib es als JSON zurück
    if ($httpResponseCode === 200 && $result !== false) {
        echo $result;
    } else {
        http_response_code(500); // Fehlercode, falls die Anfrage fehlschlägt
        echo json_encode(array('error' => 'Die Anfrage an die API ist fehlgeschlagen.'));
    }
} else {
    http_response_code(405); // Fehlercode, falls die Anfrage keine POST-Anfrage ist
    echo json_encode(array('error' => 'Ungültige Anfrage. Es werden nur POST-Anfragen akzeptiert.'));
}
