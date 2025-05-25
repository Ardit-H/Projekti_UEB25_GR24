<?php
include_once("../database.php");

$sql = "SELECT 
            fa.id AS request_id,
            fa.flight_number,
            fa.arrival_time,
            fa.additional_route AS notes,
            fa.created_time,
            u.firstname,
            u.lastname,
            u.username,
            u.email
        FROM flight_assistance fa
        LEFT JOIN users u ON fa.user_id = u.id
        ORDER BY fa.arrival_time DESC";

$result = mysqli_query($conn, $sql);

if (!$result) {
    echo "<p style='color:red;'>Error retrieving flight requests: " . mysqli_error($conn) . "</p>";
    exit;
}
?>
<div class="dashboard-section">
    <h2>Flight Assistance Requests</h2>
    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; text-align: center;">
        <thead style="background-color: #f5c518; color: black;">
            <tr>
                <th>Request ID</th>
                <th>Flight Number</th>
                <th>Passenger</th>
                <th>Email</th>
                <th>Arrival Date</th>
                <th>Notes</th>
                <th>Request Date</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <?php
                $arrivalTime = new DateTime($row['arrival_time']);
                $createdTime = new DateTime($row['created_time']);
                ?>
                <tr>
                    <td><?= htmlspecialchars($row['request_id']) ?></td>
                    <td><?= htmlspecialchars($row['flight_number']) ?></td>
                    <td><?= htmlspecialchars($row['firstname'] . ' ' . $row['lastname']) ?> </td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= $arrivalTime->format('d/m/Y') ?></td>
                    <td><?= htmlspecialchars($row['notes']) ?></td>
                    <td><?= $createdTime->format('d/m/Y H:i') ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<style>
.dashboard-section {
    background-color: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    margin: 20px 0;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.dashboard-section h2 {
    color: #343a40;
    margin-bottom: 20px;
    text-align: center;
}

table {
    border-collapse: collapse;
    width: 100%;
    margin-top: 20px;
}

th, td {
    padding: 12px;
    border: 1px solid #ddd;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #e9e9e9;
}
</style>