<?php
session_start();
header('Content-Type: application/json');

// Inicializo ambientet nëse nuk janë të vendosura
if (!isset($_SESSION['ambientet'])) {
    $_SESSION['ambientet'] = array(
        "Infinity Pool",
        "Beach Lounge",
        "Sunset Bar",
        "Ocean Pavilion",
        "Spa & Wellness Center"
    );
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Shto një ambient të ri
    $newAmbient = isset($_POST['ambient']) ? trim($_POST['ambient']) : '';
    if ($newAmbient !== '') {
        $_SESSION['ambientet'][] = $newAmbient;
        echo json_encode(['status' => 'success', 'ambientet' => $_SESSION['ambientet']]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Ambient i pavlefshëm']);
    }
    exit;
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Fshij një ambient
    parse_str(file_get_contents("php://input"), $data);
    $ambientToDelete = isset($data['ambient']) ? trim($data['ambient']) : '';

    if (($key = array_search($ambientToDelete, $_SESSION['ambientet'])) !== false) {
        unset($_SESSION['ambientet'][$key]);
        $_SESSION['ambientet'] = array_values($_SESSION['ambientet']); // Rindekso listën
        echo json_encode(['status' => 'success', 'ambientet' => $_SESSION['ambientet']]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Ambient nuk u gjet']);
    }
    exit;
} else {
    // Merr të gjithë ambientet
    $ambientet = $_SESSION['ambientet'];
    sort($ambientet);
    echo json_encode($ambientet);
    exit;
}
?>
