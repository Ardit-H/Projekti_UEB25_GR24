<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Më poshtë vendos rrugën relative nga send_email.php drejt skedarëve në PHPMailer
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Emaili nuk është valid.");
    }

    $mail = new PHPMailer(true);

    try {
        // Serveri SMTP Gmail
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'dua.gashi@student.uni-pr.edu'; // Vendos email-in tënd Gmail
        $mail->Password = 'ivhcsfqosthhslqb';   // Vendos fjalëkalimin e aplikacionit (App Password)
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Email dërgues dhe reply-to
        $mail->setFrom($email, $name);
        $mail->addReplyTo($email, $name);

        // Email marrës
        $mail->addAddress('duagashi14@gmail.com');

        // Përmbajtja e mesazhit
        $mail->Subject = "Mesazh i ri nga $name";
        $mail->Body    = "$message\n\n$name\nEmail: $email";

        $mail->send();
        echo 'Mesazhi u dërgua me sukses!';
    } catch (Exception $e) {
        echo "Gabim gjatë dërgimit të emailit: {$mail->ErrorInfo}";
    }
} else {
    echo "Metoda e kërkesës nuk është e vlefshme.";
}
?>
