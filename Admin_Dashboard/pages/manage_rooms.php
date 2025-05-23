<?php
include_once("../database.php"); 

$sql = "SELECT 
            br.id AS booking_id,
            r.name AS room_name,
            r.price AS room_price,
            u.firstname,
            u.lastname,
            u.username,
            br.check_in_time,
            br.check_out_time
        FROM book_room br
        LEFT JOIN rooms r ON br.room_id = r.id
        LEFT JOIN users u ON br.user_id = u.id
        ORDER BY br.check_in_time DESC";

$result = mysqli_query($conn, $sql);

if (!$result) {
    echo "<p style='color:red;'>Error retrieving reservations: " . mysqli_error($conn) . "</p>";
    exit;
}
?>
<div class="dashboard-section">
    <h2>Room Reservations</h2>
    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; text-align: center;">
        <thead style="background-color: #f5c518;; color: black;">
            <tr>
                <th>Reservation ID</th>
                <th>Room Name</th>
                <th>Price (€)</th>
                <th>User</th>
                <th>Check-In</th>
                <th>Check-Out</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= htmlspecialchars($row['booking_id']) ?></td>
                    <td><?= htmlspecialchars($row['room_name']) ?></td>
                    <td><?= htmlspecialchars($row['room_price']) ?></td>
                    <td><?= htmlspecialchars($row['firstname'] . ' ' . $row['lastname']) ?> (<?= htmlspecialchars($row['username']) ?>)</td>
                    <td><?= htmlspecialchars($row['check_in_time']) ?></td>
                    <td><?= htmlspecialchars($row['check_out_time']) ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
