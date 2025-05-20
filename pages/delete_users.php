<?php
header("Content-Type: application/json");
include_once("../database.php");

$response = ["success" => false];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $userId = intval($_POST['id']);

    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    if ($stmt) {
        $stmt->bind_param("i", $userId);
        if ($stmt->execute()) {
            $response["success"] = true;
        } else {
            $response["message"] = "Gabim gjatë ekzekutimit.";
        }
        $stmt->close();
    } else {
        $response["message"] = "Gabim në përgatitjen e deklaratës.";
    }
} else {
    $response["message"] = "Kërkesë e pavlefshme.";
}

echo json_encode($response);
exit;
