<?php
session_start();
require_once("../database.php");

$userId = $_SESSION['user_id'] ?? null;

try {
    $query = "SELECT flight_number, arrival_time, additional_route 
              FROM flight_assistance 
              WHERE user_id = ? 
              ORDER BY arrival_time ASC";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>Flight number</th>
                    <th>Arrival Date</th>
                    <th>Notes</th>
                </tr>";
        
        while ($row = $result->fetch_assoc()) {
            $arrivalDate = $row['arrival_time'] ? date("Y-m-d ", strtotime($row['arrival_time'])) : 'Not specified';
            
            echo "<tr>
                    <td>{$row['flight_number']}</td>
                    <td>{$arrivalDate}</td>
                    <td>{$row['additional_route']}</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<div class='no-requests'>No flight requests found.</div>";
    }
} catch (Exception $e) {
    echo "<div class='error'>Error: " . $e->getMessage() . "</div>";
}
?>