<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Contact Form</title>
</head>
<body>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name    = $_POST["name"]    ?? '';
    $email   = $_POST["email"]   ?? '';
    $subject = $_POST["subject"] ?? '';
    $message = $_POST["message"] ?? '';

    $errors = [];

    //  Validate input
    if (empty($name)) {
        $errors[] = "Name is required.";
    }

    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email format is invalid.";
    }

    if (empty($subject)) {
        $errors[] = "Subject is required.";
    }

    if (empty($message)) {
        $errors[] = "Message is required.";
    }

    // Sanitize only if valid input
    if (empty($errors)) {
        $name    = filter_var($name, FILTER_SANITIZE_SPECIAL_CHARS);
        $email   = filter_var($email, FILTER_SANITIZE_EMAIL);
        $subject = filter_var($subject, FILTER_SANITIZE_SPECIAL_CHARS);
        $message = filter_var($message, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // Recipient = company email
        $to = "precisionanalytics.official@gmail.com";

        // Message content
        $body = "You received a message from <strong>$name</strong>:<br><br>"
              . "<strong>Email:</strong> $email<br>"
              . "<strong>Subject:</strong> $subject<br>"
              . "<strong>Message:</strong><br>" . nl2br($message);

        // Email headers
        $headers  = "From: noreply@precisionanalytics.com\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

        // Send the email
        if (mail($to, $subject, $body, $headers)) {
            echo "<h2 style='color: green;'>Thank you, your message has been sent successfully! We will contact you soon.</h2>";
        } else {
            echo "<h2 style='color: red;'>Something went wrong. Please try again later.</h2>";
        }
        
    } else {
        // Show errors
        echo "<h3 style='color:red;'>Please fix the following errors:</h3><ul style='color:red;'>";
        foreach ($errors as $err) {
            echo "<li>$err</li>";
        }
        echo "</ul>";
    }
}
?>

</body>
</html>
