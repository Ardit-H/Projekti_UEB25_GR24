<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Marrim të dhënat nga forma dhe i filtrojmë
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

    ini_set('SMTP', 'smtp.gmail.com');
    ini_set('smtp_port', 25);
    ini_set('sendmail_from', $email);

    // Kontrollo validimin e email-it
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Emaili nuk është valid.");
    }

    // Vendosim të dhënat e email-it
    $to = "dua.gashi@student.uni-pr.edu"; // Zëvendësoni me email-in tuaj
    $subject = "Mesazh i ri nga $name";
    $body = "Emri: $name\nEmail: $email\n\nMesazhi:\n$message";
    $headers = "From: $email\r\nReply-To: $email\r\nX-Mailer: PHP/" . phpversion();

    // Përdorim funksionin mail()
    if (mail($to, $subject, $body, $headers)) {
        echo "Mesazhi u dërgua me sukses!";
    } else {
        echo "Ka ndodhur një gabim gjatë dërgimit të mesazhit.";
    }
} else {
    echo "Metoda e kërkesës nuk është e vlefshme.";
}
?>
