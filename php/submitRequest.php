<?php
  require_once("clientRequest.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

$errors = [];

    function validateEmail($email) {
        return preg_match("/^[a-zA-Z0-9_]+@[a-zA-Z]+\.[a-z]{2,4}$/", $email);
    }

    function validatePhone($phone) {
        return preg_match("/^([+-]?\d{3}[- ])?\d{3}[- ]?\d{3}[- ]?\d{3}$/", $phone);
    }

    function validateText($text) {
        return preg_match("/^[a-zA-Z\s\-']+$/", $text);
    }

    $name = $_POST["name"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $requestType = $_POST["form_type"]; 
     $today=date('Y-m-d');
     $time = date('Y-m-d\TH:i');

    if (!validateText($name)) 
    $errors[] = "Invalid firstname. Only letters and spaces are allowed.";
    if (!validateText($lastname)) 
    $errors[] = "Invalid lastname. Only letters and spaces are allowed.";
    if (!validateEmail($email)) 
    $errors[] = "Invalid email format. Example: name@gmail.com";
    if (!validatePhone($phone)) 
    $errors[] = "Invalid phone number. Format should be 000-000-000";

    if ($requestType === 'flight') {
        $flightNumber = $_POST['flight_number'];
        $arrivalDate = $_POST['arrival_date'];

        if (!preg_match("/^[0-9]{1,4}$/", $flightNumber)) 
            $errors[] = "Invalid flight number. It should contain only digits and be up to 4 numbers long (e.g. 1234).";
        if ($arrivalDate < $today) 
            $errors[] = "Invalid arrival date. The date cannot be in the past.";
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
        exit;
    }

    $details = [];

    if($requestType === "flight"){
        $details = [
            'flight_number' => $_POST['flight_number'],
            'arrival_date' => $_POST['arrival_date'],
            'aditional_notes' => $_POST['notes']
            ];
    } else{
        echo "Invalid request type.";
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
