<?php
    require_once("../database.php");
    include(__DIR__ . 'handle_send_email.php');
    session_start();
    
    if (isset($_POST['submit'])) {

        $name = $_POST['name'];
        $lastname=$_POST['lastname'];
        $telefon = $_POST['telefon'];
        $email = $_POST['email'];
        $cardnumber = $_POST['cardnumber'];
        $checkin = filter_input(INPUT_POST, 'checkin', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $checkout = filter_input(INPUT_POST, 'checkout', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $room = filter_input(INPUT_POST, 'room',FILTER_SANITIZE_FULL_SPECIAL_CHARS);

      // Validate dates
        $today = strtotime(date('Y-m-d'));
        $checkin_date = strtotime($checkin);
        $checkout_date = strtotime($checkout);

        if ($checkin_date < $today) {
            exit("ERROR: INVALID date (book for tomorrow). <a style=\"font-size: 1.5rem;\" href=\"../book.php\">Return BOOK NOW</a>");
        }
        if ($checkin_date >= $checkout_date) {
            exit("ERROR: INVALID check-out date. <a style=\"font-size: 1.5rem;\" href=\"../book.php\">Return BOOK NOW</a>");
        }

        // Insert booking
        insertBook($room, $checkin, $checkout);
    } else {
        echo "<h1>No data received.</h1><a style=\"font-size: 1.5rem;\" href=\"../book.php\">Return BOOK NOW</a>";
    }

    function insertBook($room, $checkin, $checkout) {
        global $conn;
        $user_id = $_SESSION['user_id'];

        // Fetch room ID
        $stmt = $conn->prepare("SELECT id FROM rooms WHERE name = ? LIMIT 1");
        $stmt->bind_param("s", $room);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        if (!$row) {
            exit("Room not found.");
        }
        $room_id = $row['id'];
        $stmt->close();

        // Insert booking into database
        $stmt = $conn->prepare("INSERT INTO book_room (user_id, room_id, check_in_time, check_out_time) VALUES (?, ?, ?, ?)");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("iiss", $user_id, $room_id, $checkin, $checkout);
        if ($stmt->execute()) {
            $message = "You reserved room: $room from $checkin to $checkout.";
            sendEmail("You have reserved a room in Amanpuri hotel", $message); // gjendet tek file handle_send_email
            header("Location: ../book.php?success=1");
            exit();
        } else {
            echo "ERROR: " . $stmt->error;
        }

        $stmt->close();
    }
?>