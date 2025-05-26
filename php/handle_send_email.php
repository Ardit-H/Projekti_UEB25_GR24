<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// require 'vendor/autoload.php';
require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';

session_start();

function sendEmail($subject, $message) {
    // Kontrollo nëse email-i ekziston dhe është valid
    if (!isset($_SESSION['email']) || !filter_var($_SESSION['email'], FILTER_VALIDATE_EMAIL)) {
        die("Invalid or missing email address.");
    }

    $to = $_SESSION['email'];

    $mail = new PHPMailer(true);

    try {
        // Konfigurimi i serverit SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Përdor Gmail SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'dua.gashi@student.uni-pr.edu';
        $mail->Password = 'ivhcsfqosthhslqb';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Dërguesi dhe marrësi
        $mail->setFrom('dua.gashi@student.uni-pr.edu', 'Amanpuri Hotel');
        $mail->addAddress($to);

        // Përmbajtja e email-it
        $mail->isHTML(false); // Për të ruajtur stilin origjinal (tekst i thjeshtë)
        $mail->Subject = $subject;
        $mail->Body = $message;

        // Dërgo emailin
        if ($mail->send()) {
            echo "Email was sent successfully!";
        } else {
            echo "Email was not sent.";
        }
    } catch (Exception $e) {
        echo "Email could not be sent. Error: {$mail->ErrorInfo}";
    }
}
?>

