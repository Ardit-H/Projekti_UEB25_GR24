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
        public function __toString(){
            return"
            <br>
            <p> Name:____$this->name ____</p><br>
            <p> Telefon:____$this->telefon ____</p><br>
            <p> Email:____$this->email ____</p><br>
            <p>  Check-in Data:____$this->checkin ____</p><br>
            <p>  Check-out Data:____$this->checkout ____</p><br>
            <p> Room type:____$this->room ____</p><br>
            <p> Card number:____$this->cardnumber ____</p><br>
            <p> Thank you for choosing ".self::HOTEL." .We’re excited to welcome you soon. 
            ";
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

    if(empty($name) || empty($telefon)  || empty($email)  || empty($checkin)  || empty($checkout) || empty($room )  || empty($cardnumber) ){
        exit();
        header("Location : ../book.php");
    }
    echo "<h1>Booking Confirmed!</h1>";

    $k= new Client($name,$telefon,$email,$checkin,$checkout,$room,$cardnumber);

    echo $k;

} else {
    echo "<h1>No data received.</h1>";
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