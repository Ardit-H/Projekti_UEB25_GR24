<?php
$conn = new mysqli("localhost", "root", "", "projekti");

// Kontrollo lidhjen
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $flightNumber = $conn->real_escape_string($_POST['flight_number']);
    $notes = $conn->real_escape_string($_POST['notes']);
    $userId = $_SESSION['user_id'];

    // Kontrollo nëse ekziston fluturimi për përdoruesin
    $checkQuery = "SELECT id FROM flight_assistance WHERE flight_number = '$flightNumber' AND user_id = '$userId'";
    $result = $conn->query($checkQuery);

    if ($result->num_rows > 0) {
        // Përditëso notes për fluturimin e gjetur
        $updateQuery = "UPDATE flight_assistance SET additional_route = '$notes' WHERE flight_number = '$flightNumber' AND user_id = '$userId'";
        if ($conn->query($updateQuery) === TRUE) {
            echo "Notes updated successfully!";
        } else {
            echo "Error updating notes: " . $conn->error;
        }
    } else {
        echo "Flight not found or you do not have permission to update it.";
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
