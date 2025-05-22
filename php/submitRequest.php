<?php
session_start();
require_once("clientRequest.php");
require_once("../database.php");

function error_handler($errno, $errstr, $errfile, $errline) {
    error_log("Error [$errno] in $errfile row $errline: $errstr\n", 3, "error_log.txt");
    echo "<p style='color:red;'>An error occurred. Please contact us.</p>";
}
set_error_handler("error_handler");
// echo $undefined_variable;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
try{
    global $conn;

    // function validateEmail($email) {
    //     return preg_match("/^[a-zA-Z0-9_]+@[a-zA-Z]+\.[a-z]{2,4}$/", $email);
    // }

    // function validatePhone($phone) {
    //     return preg_match("/^([+-]?\d{3}[- ])?\d{3}[- ]?\d{3}[- ]?\d{3}$/", $phone);
    // }

    // function validateText($text) {
    //     return preg_match("/^[a-zA-Z\s\-']+$/", $text);
    // }

    $userId = &$_SESSION['user_id'];
    $name   = $_SESSION["firstname"];
    $lastname = $_SESSION["lastname"];
    $email = $_SESSION["email"];
    $phone = $_SESSION["phone"];

    $requestType = $_POST["form_type"]; 
    $flightNumber = $_POST["flight_number"];
    $arrivalDate = $_POST["arrival_date"];
    $notes = $_POST["notes"];
    $today=date('Y-m-d');

    // if (!validateText($name)) 
    // $errors[] = "Invalid firstname. Only letters and spaces are allowed.";
    // if (!validateText($lastname)) 
    // $errors[] = "Invalid lastname. Only letters and spaces are allowed.";
    // if (!validateEmail($email)) 
    // $errors[] = "Invalid email format. Example: name@gmail.com";
    // if (!validatePhone($phone)) 
    // $errors[] = "Invalid phone number. Format should be 000-000-000";

    $errors = [];
    if (!preg_match("/^[0-9]{1,4}$/", $flightNumber)){ 
        $errors[] = "Invalid flight number. It should contain only digits and be up to 4 numbers long (e.g. 1234).";
    }
    if ($arrivalDate < $today){
        $errors[] = "Invalid arrival date. The date cannot be in the past.";
    }
    if(!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
        exit;
    }

$details = [
    'flight_number' => $flightNumber,
    'arrival_date' => $arrivalDate,
    'aditional_notes' => $notes
    ];

$stmt = $conn->prepare("
    INSERT INTO flight_assistance (user_id, flight_number, arrival_time, additional_route)
    VALUES (?, ?, ?, ?)
");
if (!$stmt) {
    throw new Exception("The insertion failed: " . $conn->error);
}

$stmt->bind_param("isss", $userId, $flightNumber, $arrivalDate, $notes);

if ($stmt->execute()) {
    $log = fopen("flight_log.txt", "a");
    fwrite($log, "[$today] Request from: $name $lastname (ID: $userId), Flight: $flightNumber\n");
    fclose($log);

    echo "<p style='color:green;'>Request is saved!</p>";
} else {
    throw new Exception("Execution failed: " . $stmt->error);
}

unset($userId);
$stmt->close();
$conn->close();

} catch(Exception $e) {
    echo "<p style='color:red;'>Gabim: " . htmlspecialchars($e->getMessage()) . "</p>";
}
}
$client = new ClientRequest($name, $lastname, $email, $phone, $requestType, $details);
$client->print();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Request</title>
    <style>
        body{
            background-color:black;
        }
        h2,h3,p{
            color:white;
            text-align: center;
            margin-bottom:-10px;
        }
        a {
        color: white;
        text-align: center;
        display: block;
        margin-top: 20px;
        font-size: 1.5rem;
        text-decoration: none;
        }
        .details {
        color: white;
        text-align: center;
        margin: 20px auto;
        display: block;
        width: fit-content;
        max-width: 90%;
        white-space: pre-wrap;
        word-wrap: break-word;
        }
    </style>
</head>
<body>
    <a style="font-size: 1.5rem;" href="../contact.php">Return Contact</a>
</body>
</html>
