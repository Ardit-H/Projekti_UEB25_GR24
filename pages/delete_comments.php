<?php
include_once(__DIR__ . "/../database.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $commentId = intval($_POST['id'] ?? 0);

    if ($commentId > 0) {
        $stmt = $conn->prepare("DELETE FROM comments WHERE id = ?");
        $stmt->bind_param("i", $commentId);
        $stmt->execute();
        $deleted = $stmt->affected_rows > 0;
        $stmt->close();
        echo json_encode(['success' => $deleted]);
    } else {
        echo json_encode(['success' => false, 'message' => 'ID invalid']);
    }
}
