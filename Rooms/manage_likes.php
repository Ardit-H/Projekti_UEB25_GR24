<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    echo json_encode(['error' => 'User not logged in']);
    exit;
}
// Merr të dhënat nga POST
$data = json_decode(file_get_contents('php://input'), true);
$roomName = $data['roomName'] ?? '';
$action = $data['action'] ?? ''; 

if (empty($roomName) || !in_array($action, ['like', 'unlike'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid request']);
    exit;
}

// Merr ose inicializo vargun e pëlqimeve nga cookie
$likedRooms = isset($_COOKIE['liked_rooms']) ? json_decode($_COOKIE['liked_rooms'], true) : [];

if ($action === 'like') {
    // Shto dhomën në listën e pëlqimeve nëse nuk ekziston
    if (!in_array($roomName, $likedRooms)) {
        $likedRooms[] = $roomName;
    }
} elseif ($action === 'unlike') {
    // Hiq dhomën nga lista e pëlqimeve
    $likedRooms = array_filter($likedRooms, fn($room) => $room !== $roomName);
}

// Përditëso cookie-n (p.sh. vlefshmëri për 30 ditë)
setcookie('liked_rooms', json_encode(array_values($likedRooms)), time() + (30 * 24 * 60 * 60), '/');
echo json_encode(['success' => true, 'likedRooms' => $likedRooms]);
?>