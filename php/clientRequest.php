<?php
   class ClientRequest{
      protected $name;
      protected $lastname;
      protected $email;
      protected $phone;
      protected $requestType;
      protected $details = [];

      public function __construct($name, $lastname, $email, $phone, $requestedType, $details){
         $this->name = $name;
         $this->lastname = $lastname;
         $this->email = $email;
         $this->phone = $phone;
         $this->requestType = $requestedType;
         foreach($details as $key => $value){
            $this->details[$key] = $value;
         }
      }
        
      public function getName() {
      return $this->name;
      }

      public function getRequestType() {
      return $this->requestType;
      }

      public function getDetails() {
      return $this->details;
      }

      public function print() {
         echo "<h2>Request Received:</h2>";
         echo "Name: {$this->name}<br>";
         echo "Lastname: {$this->lastname}<br>";
         echo "Email: {$this->email}<br>";
         echo "Phone: {$this->phone}<br>";
         echo "Type: {$this->requestType}<br>";

      echo "<h4>Details:</h4>";
         foreach ($this->details as $key => $value) {
            echo ucfirst(str_replace('_', ' ', $key)) . ": " . $value . "<br>";
         }
      }

      public function __destruct() {
      echo "<h2>The request has been sent!<h2>";
      }
      
         
   }
   
?>