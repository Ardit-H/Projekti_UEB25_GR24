<?php
    session_start();
    function sendEmail($subject ,$message){
        $to      = $_SESSION['email']; 
        $headers = 'From: info@ourPage.com' . "\r\n" .
                'Reply-To: info@ourPage.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
        if (mail($to, $subject, $message, $headers)) {
            echo "Emaili was send !";
        } else {
            echo "Email was not send !";
        }
    }
?>