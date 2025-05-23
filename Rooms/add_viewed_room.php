<?php
session_start();

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'User not logged in']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$roomName = $data['roomName'] ?? '';

if (empty($roomName)) {
    echo json_encode(['success' => false, 'error' => 'No room name provided']);
    exit;
}

if (!isset($_SESSION['viewed_rooms'])) {
    $_SESSION['viewed_rooms'] = [];
}

if (!in_array($roomName, $_SESSION['viewed_rooms'])) {
    $_SESSION['viewed_rooms'][] = $roomName;
}

echo json_encode(['success' => true]);
?>