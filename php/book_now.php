<?php
    class Client{
        const  HOTEL="Amanpuri Hotel";
        private $name;
        private $telefon;
        private $email;
        private $checkin;
        private $checkout;
        private $room;
        private $cardnumber;
        private $roomPrices = [
            'Standard Room' => 250,
            'Family Room' => 750,
            'Private Villas' => 900,
            'Wellness Suite' => 1250,
            'Luxury Room' => 1500
        ];
        public function __construct($name,$telefon,$email,$checkin,$checkout,$room,$cardnumber){
            $this->name=$name;
            $this->telefon=$telefon;
            $this->email=$email;
            $this->checkin=$checkin;
            $this->checkout=$checkout;
            $this->room=$room;
            $this->cardnumber=$cardnumber;
        }
        public function __destruct(){
            echo "<h1> Have a nice day!!</h1>";
        }
        public function calculateTotalPrice() {
            $pricePerNight = $this->roomPrices[$this->room] ?? 0;
            
            // Calculate the number of nights
            $checkinDate = new DateTime($this->checkin);
            $checkoutDate = new DateTime($this->checkout);
            $interval = $checkinDate->diff($checkoutDate);
            
            $numOfDays = $interval->days;
    
            if ($numOfDays <= 0) {
                return 0;
            }
            
            return $numOfDays * $pricePerNight;
        }
        public function __toString(){
            $price=$this->calculateTotalPrice();
            return"
            <br>
            <p> Name:____$this->name ____</p><br>
            <p> Telefon:____$this->telefon ____</p><br>
            <p> Email:____$this->email ____</p><br>
            <p>  Check-in Data:____$this->checkin ____</p><br>
            <p>  Check-out Data:____$this->checkout ____</p><br>
            <p> Room type:____$this->room ____</p><br>
            <p> Card number:____ ".preg_replace('/\d{1}/', '*',$this->cardnumber,12)." ____</p><br>
            <p> Thank you for choosing ".self::HOTEL." .We’re excited to welcome you soon. <\p><br>
            <P style=\"color: green; font-size: 1.2rem;\"> Çmimi total  $  $price <br>";    
        }
    }
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $telefon = $_POST['telefon'];
    $email = $_POST['email'];
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    $room = $_POST['room'];
    $cardnumber = $_POST['cardnumber'];
    
   
        $today=date('Y-m-d');
        switch(true){
            case !preg_match("/^[a-zA-Z]+$/",$name):
                exit("ERROR : INVALID name ( must contain only letters) <a style=\"font-size: 1.5rem;\" href=\"../book.php\">Return BOOK NOW</a> ");
                break;
            case !preg_match("/^([+-]?\d{3}[- ])?\d{3}[- ]?\d{3}[- ]?\d{3}$/",$telefon):
                exit("ERROR !!!!! : INVALID phone number <a style=\"font-size: 1.5rem;\" href=\"../book.php\">Return BOOK NOW</a>");
                break; 
            case !preg_match('/^[A-Za-z0-9_\.\-]+?@[A-Za-z0-9_\-]+\.[A-Za-z0-9_\-\.]+$/',$email):
                exit("ERROR : INVALID email ( must contain @ ) <a style=\"font-size: 1.5rem;\" href=\"../book.php\">Return BOOK NOW</a>");
                break;
            case $checkin<$today:
                exit("ERROR : INVALID date ( book for tomorrow ) <a style=\"font-size: 1.5rem;\" href=\"../book.php\">Return BOOK NOW</a>");
                break;
            case $checkin>$checkout:
                exit("ERROR : INVALID date ( check-out date )<a style=\"font-size: 1.5rem;\" href=\"../book.php\">Return BOOK NOW</a> ");
                break;
            case !preg_match("/^[0-9]{16}$/",$cardnumber):
                exit("ERROR : INVALID card number ( must contain only 16 numbers)  <a style=\"font-size: 1.5rem;\" href=\"../book.php\">Return BOOK NOW</a>");
                break;
            }
    echo "<h1>Booking Confirmed!</h1>";

    $k= new Client($name,$telefon,$email,$checkin,$checkout,$room,$cardnumber);

    echo $k;

} else {
    echo "<h1>No data received.</h1><a style=\"font-size: 1.5rem;\" href=\"../book.php\">Return BOOK NOW</a>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmed / Declined !!</title>
    <style>
        body{
            background-color:black;
        }
        h1,p,a{
            color:white;
            text-align: center;
            margin-bottom:-10px;
        }
    </style>
</head>
<body>
        <a style="font-size: 1.5rem;" href="../index.html">Return HOME</a>
</body>
</html>
<?php   echo "<br><br>";var_dump($_POST);?>