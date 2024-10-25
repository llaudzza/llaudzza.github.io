<?php
session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $description = htmlspecialchars($_POST['description']);

    $to = "laudza000@gmail.com"; // Replace with your email address
    $headers = "From: $name <$email>" . "\r\n" .
               "Reply-To: $email" . "\r\n" .
               "X-Mailer: PHP/" . phpversion();

    $message = "Name: $name\nEmail: $email\n\nDescription:\n$description";

    if (mail($to, $subject, $message, $headers)) {
        $_SESSION['message'] = "Message sent successfully!";
    } else {
        $_SESSION['message'] = "Message could not be sent.";
    }

    header("Location: index.php"); // Redirect back to the form
    exit();
} else {
    echo "Invalid request.";
}
?>
