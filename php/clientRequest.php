<?php
   class ClientRequest{
      private $name;
      private $lastname;
      private $email;
      private $phone;
      private $requestType;
      private $details = [];

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
      return  "<h2>" . $this->name . "</h2>";
      }

      public function getRequestType() {
      return  "<p>".$this->requestType . "</p>";
      }


      public function print() {
         echo "<h2>Request Received:</h2>";
         echo "<h3>Name: {$this->name}</h3><br>";
         echo "<h3>Last Name: {$this->lastname}</h3><br>";
         echo "<h3>Email: {$this->email}</h3><br>";
         echo "<h3>Phone: {$this->phone}</h3><br>";
         echo "<h3>Type: {$this->requestType}</h3><br>";

      echo "<h3>Details:</h3>";
         echo "<pre class='details'>";

         foreach ($this->details as $key => $value) {
            echo ucfirst(str_replace('_', ' ', $key)) . ": " . $value . "<br>";
         }
         echo "</pre>";
        
      }

      public function __destruct() {
      echo "<h2>The request has been sent!</h2>";
      }
      
         
   }
   
?>