<?php
    include_once("../../database.php");

    $sql = "
    SELECT br.id AS booking_id, r.name AS room_name, r.price AS room_price,
            u.firstname, u.lastname, u.username, br.check_in_time, br.check_out_time
    FROM book_room br
    LEFT JOIN rooms r ON br.room_id = r.id
    LEFT JOIN users u ON br.user_id = u.id
    ORDER BY br.check_in_time DESC
    ";

    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("SQL Error: " . mysqli_error($conn));
    }

    $reservations = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $checkin = new DateTime($row['check_in_time']);
        $checkout = new DateTime($row['check_out_time']);
        $days = $checkin->diff($checkout)->days;
        $row['total_price'] = number_format($days * $row['room_price'], 2);
        $reservations[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($reservations);

?>
