<?php
include_once("database.php");

$sql = "
    SELECT 
        book_table.id, 
        book_table.created_time, 
        book_table.reservation_moment, 
        book_table.number_of_people,
        users.firstname,
        users.lastname
    FROM book_table
    LEFT JOIN users ON book_table.user_id = users.id
    ORDER BY book_table.created_time DESC
";

$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Gabim në marrjen e rezervimeve: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Menaxhimi i Rezervimeve në Tavolina</title>
    <style>
    
        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
        }
        th {
            background-color: #f5c518;
            color: black;
        }
    </style>
</head>
<body>
<div class="dashboard-section">
    <h2>Table Reservations</h2>
<table border="1" cellpadding="10" cellspacing="0" style="width: 100%; text-align: center;">
    <thead>
        <tr>
            <th>ID</th>
            <th>User</th>
            <th>Date for reservation</th>
            <th>Date of reservation</th>
            <th>Number of people</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= htmlspecialchars($row['id']) ?></td>
                <td>
                    <?php 
                    if ($row['firstname'] && $row['lastname']) {
                        echo htmlspecialchars($row['firstname'] . ' ' . $row['lastname']);
                    } else {
                        echo "Përdorues i panjohur";
                    }
                    ?>
                </td>
                <td>
                    <?= htmlspecialchars($row['reservation_moment'] ? $row['reservation_moment'] : 'Nuk është caktuar') ?>
                </td>
                <td>
                    <?= htmlspecialchars($row['created_time']) ?>
                </td>
                <td><?= htmlspecialchars($row['number_of_people']) ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
                </div>
</body>
</html>
