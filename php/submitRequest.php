<?php
  require_once("clientRequest.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $requestType = $_POST["form_type"]; 

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
