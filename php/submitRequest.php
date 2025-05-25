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
header("Location: ../contact.php");
echo "Request has been send";
exit;

?>
