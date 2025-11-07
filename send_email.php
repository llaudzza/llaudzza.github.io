<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/vendor/phpmailer/src/Exception.php';
require __DIR__ . '/vendor/phpmailer/src/PHPMailer.php';
require __DIR__ . '/vendor/phpmailer/src/SMTP.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $description = htmlspecialchars($_POST['description']);

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'laudza000@gmail.com';
        $mail->Password = 'xeeh fvyc mtcb ccea';  
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress('laudza000@gmail.com', 'Laudza');

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = "
            <h3>New message from your portfolio contact form</h3>
            <p><b>Name:</b> $name</p>
            <p><b>Email:</b> $email</p>
            <p><b>Message:</b><br>$description</p>
        ";
        $mail->AltBody = "Name: $name\nEmail: $email\n\nMessage:\n$description";

        $mail->send();
        $_SESSION['message'] = "✅ Message sent successfully!";
    } catch (Exception $e) {
        $_SESSION['message'] = "❌ Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    header("Location: index.php#contact");
    exit();
}
?>
