<?php
header('Content-Type: application/json');

// Skedari ku ruhen ambientet
$file = 'ambientet.json';

// Lexo ambientet nga skedari JSON
function getAmbientet() {
    global $file;
    if (!file_exists($file)) {
        file_put_contents($file, json_encode([]));
    }
    return json_decode(file_get_contents($file), true);
}

// Ruaj ambientet në skedarin JSON
function saveAmbientet($ambientet) {
    global $file;
    file_put_contents($file, json_encode($ambientet, JSON_PRETTY_PRINT));
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Kthe listën e ambientëve
    echo json_encode(getAmbientet());
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Shto një ambient të ri
    $newAmbient = isset($_POST['ambient']) ? trim($_POST['ambient']) : '';
    if ($newAmbient === '') {
        echo json_encode(['status' => 'error', 'message' => 'Ambienti nuk mund të jetë i zbrazët.']);
        exit;
    }

    $ambientet = getAmbientet();
    if (in_array($newAmbient, $ambientet)) {
        echo json_encode(['status' => 'error', 'message' => 'Ambienti ekziston tashmë.']);
        exit;
    }

    $ambientet[] = $newAmbient;
    saveAmbientet($ambientet);

    echo json_encode(['status' => 'success', 'message' => 'Ambienti u shtua me sukses.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Fshi një ambient
    parse_str(file_get_contents('php://input'), $_DELETE);
    $ambientToDelete = isset($_DELETE['ambient']) ? trim($_DELETE['ambient']) : '';
    if ($ambientToDelete === '') {
        echo json_encode(['status' => 'error', 'message' => 'Ambienti nuk mund të jetë i zbrazët.']);
        exit;
    }

    $ambientet = getAmbientet();
    if (!in_array($ambientToDelete, $ambientet)) {
        echo json_encode(['status' => 'error', 'message' => 'Ambienti nuk ekziston.']);
        exit;
    }

    $ambientet = array_filter($ambientet, function ($ambient) use ($ambientToDelete) {
        return $ambient !== $ambientToDelete;
    });

    saveAmbientet(array_values($ambientet));

    echo json_encode(['status' => 'success', 'message' => 'Ambienti u fshi me sukses.']);
    exit;
}

http_response_code(405);
echo json_encode(['status' => 'error', 'message' => 'Metoda e kërkesës nuk mbështetet.']);
