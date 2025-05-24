<?php
    require_once("../database.php");
    include("php/handle_send_email.php");
    session_start();
    
    if (isset($_POST['submit'])) {

        $name = $_POST['name'];
        $lastname=$_POST['lastname'];
        $telefon = $_POST['telefon'];
        $email = $_POST['email'];
        $checkin = $_POST['checkin'];
        $checkout = $_POST['checkout'];
        $room = $_POST['room'];
        $cardnumber = $_POST['cardnumber'];
         
        $today=date('Y-m-d');
        switch(true){
            case $checkin<$today:
                exit("ERROR : INVALID date ( book for tomorrow ) <a style=\"font-size: 1.5rem;\" href=\"../book.php\">Return BOOK NOW</a>");
                break;
            case $checkin>$checkout:
                exit("ERROR : INVALID date ( check-out date )<a style=\"font-size: 1.5rem;\" href=\"../book.php\">Return BOOK NOW</a> ");
                break;
            }
        insertBook($room, $checkin, $checkout);
    } else {
        echo "<h1>No data received.</h1><a style=\"font-size: 1.5rem;\" href=\"../book.php\">Return BOOK NOW</a>";
    }

    function insertBook($room ,$checkin, $checkout){
        global $conn;
        $user_id = $_SESSION['user_id'];

        $query = "SELECT id FROM rooms WHERE name = '$room' LIMIT 1";
        $result = mysqli_query($conn, $query);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            if ($row) { 
                $room_id = $row['id'];
            } else {
                echo "Room not found.";
            }
        } else {
            echo "Query error.";
        }
        $stmt = $conn->prepare("INSERT INTO book_room (user_id, room_id, check_in_time, check_out_time) VALUES (?, ?, ?, ?)");
        if (!$stmt) {die("Prepare failed: " . $conn->error);}

        $stmt->bind_param("iiss", $user_id, $room_id, $checkin, $checkout);
        if ($stmt->execute()) {
            //          $message="You reserved room: $room from $checkin to $checkout.";
            //          sendEmail("You have reserved a room in Amanpuri hotel",$message);           // gjendet tek file handle_send_email
            header("Location: ../book.php?success=1");
            exit();
        } else {
            echo "ERROR: " . $stmt->error;
        }

        $stmt->close();
    }
?>
