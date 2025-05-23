<?php
header('Content-Type: application/json');

// Fshi cookie-n 'liked_rooms' 
setcookie('liked_rooms', '', time() - 3600, '/');

echo json_encode(['success' => true]);
?>