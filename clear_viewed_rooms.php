<?php
session_start();

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'User not logged in']);
    exit;
}

// Pastro listën e dhomave të shikuara
$_SESSION['viewed_rooms'] = [];

echo json_encode(['success' => true]);
?>