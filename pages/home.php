<?php
include_once("database.php");

// Statistika
$totalUsers = $conn->query("SELECT COUNT(*) as total FROM users")->fetch_assoc()['total'];
$totalComments = $conn->query("SELECT COUNT(*) as total FROM comments")->fetch_assoc()['total'];
$totalFlightAssists = $conn->query("SELECT COUNT(*) as total FROM flight_assistance")->fetch_assoc()['total'];
$totalRoomBookings = $conn->query("SELECT COUNT(*) as total FROM book_room")->fetch_assoc()['total'];

// Rezervimet e fundit
$reservations = $conn->query("
    SELECT 
      br.check_in_time,
      br.check_out_time,
      r.name AS room_name,
      r.price AS room_price,
      u.firstname,
      u.lastname
    FROM book_room br
    LEFT JOIN users u ON br.user_id = u.id
    LEFT JOIN rooms r ON br.room_id = r.id
    ORDER BY br.check_in_time DESC
    LIMIT 10
")->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .dashboard-section {
            margin: 30px auto;
            width: 90%;
        }
        .btn {
            margin-right: 10px;
            padding: 10px 16px;
            background-color: #f5c518;
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #d4a915;
        }
        .stats-container {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
            justify-content: space-between;
        }
        .stat-card {
            flex: 1;
            background-color: #f9f9f9;
            border-left: 6px solid #f5c518;
            padding: 20px;
            border-radius: 6px;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        thead {
            background-color: #f5c518;
            color: black;
        }
        tr:nth-child(even) {
            background-color: #fafafa;
        }
    </style>
</head>
<body>

<div class="dashboard-section">
    <h2>Statistics</h2>
    <div class="stats-container">
        <div class="stat-card">
            <h3>Total Users</h3>
            <p><?= $totalUsers ?></p>
        </div>
        <div class="stat-card">
            <h3>Room Bookings</h3>
            <p><?= $totalRoomBookings ?></p>
        </div>
        <div class="stat-card">
            <h3>Comments</h3>
            <p><?= $totalComments ?></p>
        </div>
        <div class="stat-card">
            <h3>Flight Assistance</h3>
            <p><?= $totalFlightAssists ?></p>
        </div>
    </div>
</div>

<div class="dashboard-section">
    <h2>Recent Reservations</h2>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Room</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($reservations) > 0): ?>
                <?php foreach ($reservations as $row): ?>
                    <tr style="text-align: center;">
                        <td><?= htmlspecialchars($row['firstname'] . ' ' . $row['lastname']) ?></td>
                        <td><?= htmlspecialchars($row['check_in_time']) ?></td>
                        <td><?= htmlspecialchars($row['check_out_time']) ?></td>
                        <td><?= htmlspecialchars($row['room_name']) ?></td>
                        <td>€<?= number_format($row['room_price'], 2) ?></td>
 
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="5" style="text-align:center;">Nuk ka rezervime të fundit</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>
