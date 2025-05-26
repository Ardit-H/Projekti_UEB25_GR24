<?php 
session_start();

function sendEmail($subject, $message) {
    // Ensure email is set and valid
    if (!isset($_SESSION['email']) || !filter_var($_SESSION['email'], FILTER_VALIDATE_EMAIL)) {
        die("Invalid or missing email address.");
    }

    $to = $_SESSION['email'];
    $headers = 'From: Amanpuri Hotel <dua.gashi@student.uni_pr.edu>' . "\r\n" .
               'Reply-To: duagashi14@gmail.com' . "\r\n" .
               'X-Mailer: PHP/' . phpversion();

    // Send email
    if (mail($to, $subject, $message, $headers)) {
        echo "Email was sent successfully!";
    } else {
        echo "Email was not sent.";
    }
}
?>
