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

    } elseif ($requestType === 'car') {
        $pickupTime = $_POST['pickup_time'];
        $pickupLocation = $_POST['pickup_location'];
        $destination = $_POST['destination'];

        if (empty($pickupTime)) {
        $errors[] = "Pickup time is required.";
    } else if ($pickupTime < $time) {
        $errors[] = "Pickup time cannot be in the past.";
    }
        if (!validateText($pickupLocation))
            $errors[] = "Invalid pickup location. Only letters and spaces are allowed (e.g. Main Street).";
        if (!validateText($destination))
            $errors[] = "Invalid destination. Only letters and spaces are allowed (e.g. Central Station).";

    } elseif ($requestType === 'lost') {
        $preferredTime = $_POST['preferred_time'];
        $reason = $_POST['reason'];
        $stayDate = $_POST['stay_date'];
        $roomNumber = $_POST['room_number'];
        $itemDescription = $_POST['item_description'];

        if ($stayDate > $today) 
            $errors[] = "Invalid stay date. The stay date cannot be in the future.";
        if (!preg_match("/^([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-9]{2}|300)$/", $roomNumber)) 
            $errors[] = "Invalid room number. It must be a number between 0 and 300.";
        if (strlen($itemDescription) < 5) 
            $errors[] = "Item description is too short. Please enter at least 5 characters.";
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
        exit;
    }

    $details = [];

    switch($requestType){
       case 'flight' :
        $details = [
          'flight_number' => $_POST['flight_number'],
          'arrival_date' => $_POST['arrival_date'],
          'aditional_notes' => $_POST['notes']
        ]; 
        break;
      
      case 'car':
        $details = [
          'pickup_location' => $_POST['pickup_location'],
          'pickup_time' => $_POST['pickup_time'],
          'destination' => $_POST['destination'],
          'vehicle' => $_POST['vehicle'],
          'notes' => $_POST['notes']
        ];
        break;
      
      case 'lost':
        $details = [
          'preferred_time' => $_POST['preferred_time'],
          'reason' => $_POST['reason'],
          'stay_date' => $_POST['stay_date'],
          'room_number' => $_POST['room_number'],
          'item_description' => $_POST['item_description'],
          'additional_info' => $_POST['additional_info']
        ];
        break;

        default :
        echo "Invalid request type.";
        exit;
    }
    $client = new ClientRequest($name, $lastname, $email, $phone, $requestType, $details);
    $client->print();


  }
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
