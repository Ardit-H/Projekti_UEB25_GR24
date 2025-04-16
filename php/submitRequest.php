<?php
  require_once("clientRequest.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

$errors = [];

    function validateEmail($email) {
        return preg_match("/^[a-zA-Z_]+@[a-zA-Z]+\.[a-z]{2,4}$/", $email);
    }

    function validatePhone($phone) {
        return preg_match("/^[0-9]{7,15}$/", $phone);
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
    $errors[] = "Invalid name format.";
    if (!validateText($lastname)) 
    $errors[] = "Invalid lastname format.";
    if (!validateEmail($email)) 
    $errors[] = "Invalid email format.";
    if (!validatePhone($phone)) 
    $errors[] = "Invalid phone number.";

    if ($requestType === 'flight') {
        $flightNumber = $_POST['flight_number'];
        $arrivalDate = $_POST['arrival_date'];

        if (!preg_match("/^[0-9]{1,4}$/", $flightNumber)) 
            $errors[] = "Invalid flight number.";
        if ($arrivalDate < $today) 
            $errors[] = "Invalid arrival date.";

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
            $errors[] = "Invalid pickup location.";
        if (!validateText($destination))
            $errors[] = "Invalid destination.";

    } elseif ($requestType === 'lost') {
        $preferredTime = $_POST['preferred_time'];
        $reason = $_POST['reason'];
        $stayDate = $_POST['stay_date'];
        $roomNumber = $_POST['room_number'];
        $itemDescription = $_POST['item_description'];

        if ($stayDate > $today) 
            $errors[] = "Invalid stay date.";
        if (!preg_match("/^[0-9]{1,3}$/", $roomNumber)) 
            $errors[] = "Invalid room number.";
        if (strlen($itemDescription) < 5) 
            $errors[] = "Item description is too short.";
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
